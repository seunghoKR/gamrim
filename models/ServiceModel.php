<?php declare(strict_types=1);

class ServiceModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getUpcoming(int $limit = 5): array {
        $stmt = $this->pdo->prepare("
            SELECT s.*, sp.name as speaker_name, sp.title as speaker_title, sp.church as speaker_church, sp.profile_image as speaker_image 
            FROM services s 
            LEFT JOIN speakers sp ON s.speaker_id = sp.id 
            WHERE s.event_date >= CURDATE() 
            ORDER BY s.event_date ASC, s.event_time ASC 
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMultiMonthServices(int $monthsAhead = 3): array {
        $stmt = $this->pdo->prepare("
            SELECT s.*, sp.name as speaker_name, sp.title as speaker_title, sp.church as speaker_church 
            FROM services s 
            LEFT JOIN speakers sp ON s.speaker_id = sp.id 
            WHERE s.event_date >= CURDATE() - INTERVAL 7 DAY 
              AND s.event_date <= CURDATE() + INTERVAL ? MONTH 
            ORDER BY s.event_date ASC, s.event_time ASC
        ");
        $stmt->execute([$monthsAhead]);
        return $stmt->fetchAll();
    }

    public function getAll(int $limit = 100): array {
        $stmt = $this->pdo->prepare("
            SELECT s.*, sp.name as speaker_name, sp.title as speaker_title, sp.church as speaker_church 
            FROM services s 
            LEFT JOIN speakers sp ON s.speaker_id = sp.id 
            ORDER BY s.event_date DESC, s.event_time ASC 
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create(array $data): int {
        // 구글 캘린더 등록용 웹 URL 생성
        $gCalUrl = $this->buildGoogleCalendarUrl(
            $data['title'],
            $data['event_date'],
            $data['event_time'],
            $data['preacher'] ?? '',
            $data['description'] ?? ''
        );

        $stmt = $this->pdo->prepare("
            INSERT INTO services 
            (title, service_type, preacher, speaker_id, event_date, event_time, youtube_url, description, google_calendar_url, is_special) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['title'],
            $data['service_type'] ?? '정기예배',
            $data['preacher'],
            !empty($data['speaker_id']) ? (int)$data['speaker_id'] : null,
            $data['event_date'],
            $data['event_time'],
            $data['youtube_url'] ?? '',
            $data['description'] ?? '',
            $gCalUrl,
            $data['is_special'] ?? 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $gCalUrl = $this->buildGoogleCalendarUrl(
            $data['title'],
            $data['event_date'],
            $data['event_time'],
            $data['preacher'] ?? '',
            $data['description'] ?? ''
        );

        $stmt = $this->pdo->prepare("
            UPDATE services 
            SET title = ?, service_type = ?, preacher = ?, speaker_id = ?, event_date = ?, event_time = ?, youtube_url = ?, description = ?, google_calendar_url = ?, is_special = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['title'],
            $data['service_type'] ?? '정기예배',
            $data['preacher'],
            !empty($data['speaker_id']) ? (int)$data['speaker_id'] : null,
            $data['event_date'],
            $data['event_time'],
            $data['youtube_url'] ?? '',
            $data['description'] ?? '',
            $gCalUrl,
            $data['is_special'] ?? 0,
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM services WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buildGoogleCalendarUrl(string $title, string $date, string $time, string $preacher, string $desc): string {
        $cleanDate = str_replace('-', '', $date);
        $startTime = "103000"; // 기본 오전 10:30
        $endTime = "120000";

        if (str_contains($time, '새벽') || str_contains($time, '05:00')) {
            $startTime = "050000"; $endTime = "063000";
        } elseif (str_contains($time, '저녁') || str_contains($time, '19:30') || str_contains($time, '철야') || str_contains($time, '22:00')) {
            $startTime = "193000"; $endTime = "213000";
        } elseif (str_contains($time, '오후') || str_contains($time, '15:00')) {
            $startTime = "150000"; $endTime = "163000";
        }

        $dates = "{$cleanDate}T{$startTime}/{$cleanDate}T{$endTime}";
        $text = urlencode("[감림산기도원] " . $title . ($preacher ? " (강사: {$preacher})" : ""));
        $details = urlencode("강사: {$preacher}\n일시: {$date} {$time}\n장소: 감림산기도원 대성전\n내용: {$desc}\n문의: 055-374-4111");
        $location = urlencode("경상남도 양산시 상북면 삼감중앙길 48 감림산기도원");

        return "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$text}&dates={$dates}&details={$details}&location={$location}";
    }

    public function generateIcsFeed(): string {
        $services = $this->getMultiMonthServices(6);
        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//감림산기도원//연중집회스케줄//KO\r\n";
        $ics .= "CALSCALE:GREGORIAN\r\n";
        $ics .= "METHOD:PUBLISH\r\n";
        $ics .= "X-WR-CALNAME:감림산기도원 연중집회일정\r\n";
        $ics .= "X-WR-TIMEZONE:Asia/Seoul\r\n";

        foreach ($services as $s) {
            $dt = str_replace('-', '', $s['event_date']);
            $uid = "gamrim-service-{$s['id']}@gamrim.kr";
            $summary = "[감림산] {$s['title']} - " . ($s['speaker_name'] ?: $s['preacher']);
            $desc = "집회: {$s['title']}\\n강사: {$s['preacher']}\\n시간: {$s['event_time']}\\n내용: " . str_replace("\n", "\\n", $s['description'] ?? '');
            
            $ics .= "BEGIN:VEVENT\r\n";
            $ics .= "UID:{$uid}\r\n";
            $ics .= "DTSTAMP:" . date('Ymd\THis\Z') . "\r\n";
            $ics .= "DTSTART;VALUE=DATE:{$dt}\r\n";
            $ics .= "DTEND;VALUE=DATE:{$dt}\r\n";
            $ics .= "SUMMARY:{$summary}\r\n";
            $ics .= "DESCRIPTION:{$desc}\r\n";
            $ics .= "LOCATION:경상남도 양산시 상북면 삼감중앙길 48 감림산기도원\r\n";
            $ics .= "STATUS:CONFIRMED\r\n";
            $ics .= "END:VEVENT\r\n";
        }

        $ics .= "END:VCALENDAR\r\n";
        return $ics;
    }
}