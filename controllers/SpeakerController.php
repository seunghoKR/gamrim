<?php declare(strict_types=1);

class SpeakerController {
    private function checkAuth(): void {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '강사 관리'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function index(): void {
        $this->checkAuth();
        $model = new SpeakerModel();
        $speakers = $model->getAll();
        $this->render('views/admin/speakers/index.php', ['speakers' => $speakers], '강사(설교자) 관리');
    }

    public function detail(): void {
        $this->checkAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header('Location: /admin/speakers'); exit;
        }

        $model = new SpeakerModel();
        $speaker = $model->getById($id);
        if (!$speaker) {
            header('Location: /admin/speakers'); exit;
        }

        $history = $model->getServiceHistory($id);

        $this->render('views/admin/speakers/detail.php', [
            'speaker' => $speaker,
            'history' => $history
        ], $speaker['name'] . ' ' . $speaker['title'] . ' 상세 프로필 & 사역 이력');
    }

    public function create(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profileImage = htmlspecialchars($_POST['profile_image'] ?? '/assets/images/speaker_default.jpg');

            if (!empty($_FILES['image_file']['tmp_name'])) {
                $uploadDir = ROOT_PATH . '/assets/images/speakers/';
                if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0777, true); }
                $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                $filename = 'speaker_' . time() . '_' . rand(100, 999) . '.' . $ext;
                if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadDir . $filename)) {
                    $profileImage = '/assets/images/speakers/' . $filename;
                }
            }

            $name = htmlspecialchars($_POST['name'] ?? '');
            $title = htmlspecialchars($_POST['title'] ?? '목사');
            $church = htmlspecialchars($_POST['church'] ?? '');
            $phone = htmlspecialchars($_POST['phone'] ?? '');

            $model = new SpeakerModel();
            $speakerId = $model->create([
                'name' => $name,
                'title' => $title,
                'church' => $church,
                'phone' => $phone,
                'phone_sub' => htmlspecialchars($_POST['phone_sub'] ?? ''),
                'manager_name' => htmlspecialchars($_POST['manager_name'] ?? ''),
                'manager_phone' => htmlspecialchars($_POST['manager_phone'] ?? ''),
                'bio' => htmlspecialchars($_POST['bio'] ?? ''),
                'profile_image' => $profileImage,
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ]);

            // 강사 추가 시 회원(users) 테이블에도 'SPEAKER' 그룹으로 자동 등록!
            try {
                $userModel = new UserModel();
                $userModel->create([
                    'username' => 'speaker_' . $speakerId,
                    'password_hash' => password_hash('gamrim2026!', PASSWORD_BCRYPT),
                    'name' => $name . ' (' . $title . ')',
                    'phone' => $phone ?: '055-374-4111',
                    'church_name' => $church,
                    'role' => 'SPEAKER',
                    'consult_status' => 'NONE',
                    'provider' => 'LOCAL',
                    'agree_notice_event' => 1,
                    'agree_notice_rental' => 1,
                    'agree_notice_stay' => 1,
                    'agree_marketing' => 1
                ]);
            } catch(Exception $e){}

            header('Location: /admin/speakers?saved=1'); exit;
        }
    }

    public function update(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $profileImage = htmlspecialchars($_POST['profile_image'] ?? '/assets/images/speaker_default.jpg');

                if (!empty($_FILES['image_file']['tmp_name'])) {
                    $uploadDir = ROOT_PATH . '/assets/images/speakers/';
                    if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0777, true); }
                    $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                    $filename = 'speaker_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadDir . $filename)) {
                        $profileImage = '/assets/images/speakers/' . $filename;
                    }
                }

                $name = htmlspecialchars($_POST['name'] ?? '');
                $title = htmlspecialchars($_POST['title'] ?? '목사');
                $church = htmlspecialchars($_POST['church'] ?? '');
                $phone = htmlspecialchars($_POST['phone'] ?? '');

                $model = new SpeakerModel();
                $model->update($id, [
                    'name' => $name,
                    'title' => $title,
                    'church' => $church,
                    'phone' => $phone,
                    'phone_sub' => htmlspecialchars($_POST['phone_sub'] ?? ''),
                    'manager_name' => htmlspecialchars($_POST['manager_name'] ?? ''),
                    'manager_phone' => htmlspecialchars($_POST['manager_phone'] ?? ''),
                    'bio' => htmlspecialchars($_POST['bio'] ?? ''),
                    'profile_image' => $profileImage,
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ]);

                // users 테이블 내 강사 정보도 함께 동기화
                try {
                    $pdo = Database::getInstance();
                    $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ?, church_name = ? WHERE username = ?");
                    $stmt->execute([$name . ' (' . $title . ')', $phone, $church, 'speaker_' . $id]);
                } catch(Exception $e){}
            }
            header('Location: /admin/speakers?updated=1'); exit;
        }
    }

    public function delete(): void {
        $this->checkAuth();
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        if ($id > 0) {
            $model = new SpeakerModel();
            $model->delete($id);

            // users 테이블에서도 계정 삭제
            try {
                $pdo = Database::getInstance();
                $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
                $stmt->execute(['speaker_' . $id]);
            } catch(Exception $e){}
        }
        header('Location: /admin/speakers?deleted=1'); exit;
    }
}