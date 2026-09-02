<?php declare(strict_types=1);

class SpeakerModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll(bool $activeOnly = false): array {
        $sql = "SELECT * FROM speakers";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY id ASC";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM speakers WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * 해당 강사의 과거 및 예정 집회/예배 인도 히스토리 조회
     */
    public function getServiceHistory(int $speakerId): array {
        $stmt = $this->pdo->prepare("
            SELECT * FROM services 
            WHERE speaker_id = ? 
            ORDER BY event_date DESC, event_time DESC
        ");
        $stmt->execute([$speakerId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO speakers 
            (name, title, church, phone, phone_sub, manager_name, manager_phone, bio, profile_image, is_active) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['name'],
            $data['title'] ?? '목사',
            $data['church'] ?? '',
            $data['phone'] ?? '',
            $data['phone_sub'] ?? '',
            $data['manager_name'] ?? '',
            $data['manager_phone'] ?? '',
            $data['bio'] ?? '',
            $data['profile_image'] ?? '/assets/images/speaker_default.jpg',
            $data['is_active'] ?? 1
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("
            UPDATE speakers 
            SET name = ?, title = ?, church = ?, phone = ?, phone_sub = ?, manager_name = ?, manager_phone = ?, bio = ?, profile_image = ?, is_active = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['name'],
            $data['title'] ?? '목사',
            $data['church'] ?? '',
            $data['phone'] ?? '',
            $data['phone_sub'] ?? '',
            $data['manager_name'] ?? '',
            $data['manager_phone'] ?? '',
            $data['bio'] ?? '',
            $data['profile_image'] ?? '/assets/images/speaker_default.jpg',
            $data['is_active'] ?? 1,
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM speakers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}