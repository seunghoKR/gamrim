<?php declare(strict_types=1);

class ServiceScheduleController {
    private function checkAuth(): void {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '연중 집회 일정'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function index(): void {
        $this->checkAuth();
        $svcModel = new ServiceModel();
        $spkModel = new SpeakerModel();

        $services = $svcModel->getMultiMonthServices(6);
        $speakers = $spkModel->getAll(true);

        $this->render('views/admin/services/index.php', [
            'services' => $services,
            'speakers' => $speakers
        ], '연중 집회 스케줄 & 구글 캘린더 연동');
    }

    public function create(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $svcModel = new ServiceModel();
            $preacher = htmlspecialchars($_POST['preacher'] ?? '');
            $speakerId = (int)($_POST['speaker_id'] ?? 0);

            if ($speakerId > 0) {
                $spkModel = new SpeakerModel();
                $speaker = $spkModel->getById($speakerId);
                if ($speaker) {
                    $preacher = $speaker['name'] . ' ' . $speaker['title'] . ' (' . $speaker['church'] . ')';
                }
            }

            $svcModel->create([
                'title' => htmlspecialchars($_POST['title'] ?? ''),
                'service_type' => htmlspecialchars($_POST['service_type'] ?? '정기예배'),
                'preacher' => $preacher,
                'speaker_id' => $speakerId ?: null,
                'event_date' => htmlspecialchars($_POST['event_date'] ?? date('Y-m-d')),
                'event_time' => htmlspecialchars($_POST['event_time'] ?? '오전 10:30'),
                'youtube_url' => htmlspecialchars($_POST['youtube_url'] ?? ''),
                'description' => htmlspecialchars($_POST['description'] ?? ''),
                'is_special' => isset($_POST['is_special']) ? 1 : 0
            ]);

            header('Location: /admin/services?saved=1'); exit;
        }
    }

    public function delete(): void {
        $this->checkAuth();
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $svcModel = new ServiceModel();
            $svcModel->delete($id);
        }
        header('Location: /admin/services?deleted=1'); exit;
    }

    // iCal (.ics) 구독 피드 (구글 캘린더 실시간 동기화용)
    public function icalFeed(): void {
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="gamrim_services.ics"');
        $svcModel = new ServiceModel();
        echo $svcModel->generateIcsFeed();
        exit;
    }
}