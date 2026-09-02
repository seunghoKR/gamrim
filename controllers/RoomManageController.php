<?php declare(strict_types=1);

class RoomManageController {
    private function checkAuth(): void {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '숙소 시설 관리'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function index(): void {
        $this->checkAuth();
        $model = new RoomModel();
        $rooms = $model->getAll();

        // 4대 건물 정의
        $officialBuildings = ['대성전 숙소', '벧엘성전 숙소', '교육관 숙소', '목양관 숙소'];
        $buildings = [];
        foreach ($officialBuildings as $b) {
            $buildings[$b] = ['total' => 0, 'clean' => 0, 'need_clean' => 0, 'cleaning' => 0];
        }

        foreach ($rooms as $r) {
            $b = $r['building_name'] ?? '대성전 숙소';
            if (!isset($buildings[$b])) {
                $buildings[$b] = ['total' => 0, 'clean' => 0, 'need_clean' => 0, 'cleaning' => 0];
            }
            $buildings[$b]['total']++;
            if ($r['cleaning_status'] === '청소완료') $buildings[$b]['clean']++;
            elseif ($r['cleaning_status'] === '청소필요') $buildings[$b]['need_clean']++;
            else $buildings[$b]['cleaning']++;
        }

        $this->render('views/admin/rooms/manage.php', [
            'rooms' => $rooms,
            'buildings' => $buildings,
            'officialBuildings' => $officialBuildings
        ], '숙소 건물·호실·청소·유지보수 정밀 관리');
    }

    public function toggleCleaning(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $status = htmlspecialchars($_POST['cleaning_status'] ?? '청소완료');
            if ($id > 0) {
                $model = new RoomModel();
                $model->updateCleaningStatus($id, $status);
            }
        }
        header('Location: /admin/rooms-manage'); exit;
    }

    public function updateMemo(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $memo = htmlspecialchars($_POST['maintenance_memo'] ?? '');
            if ($id > 0) {
                $model = new RoomModel();
                $room = $model->getById($id);
                $model->updateMaintenanceMemo($id, $memo);

                // 유지보수 내용이 등록되면 유지보수 담당자에게 카톡 알림 발송!
                if (!empty($memo) && $room) {
                    KakaoAPI::sendMaintenanceAlert($room['room_number'], $room['building_name'], $memo);
                }
            }
            header('Location: /admin/rooms-manage?saved=1'); exit;
        }
    }

    public function editOptions(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $model = new RoomModel();
                $model->updateOptions($id, [
                    'building_name' => htmlspecialchars($_POST['building_name'] ?? '대성전 숙소'),
                    'floor' => htmlspecialchars($_POST['floor'] ?? '1층'),
                    'room_type' => htmlspecialchars($_POST['room_type'] ?? '개인실'),
                    'room_number' => htmlspecialchars($_POST['room_number'] ?? ''),
                    'bed_type' => htmlspecialchars($_POST['bed_type'] ?? '온돌'),
                    'capacity_standard' => (int)($_POST['capacity_standard'] ?? 1),
                    'capacity_max' => (int)($_POST['capacity_max'] ?? 2),
                    'has_bathroom' => isset($_POST['has_bathroom']) ? 1 : 0,
                    'amenities' => htmlspecialchars($_POST['amenities'] ?? '냉난방, 개별온수, 와이파이, 침구류'),
                    'maintenance_memo' => htmlspecialchars($_POST['maintenance_memo'] ?? ''),
                    'status' => htmlspecialchars($_POST['status'] ?? '운영중'),
                    'cleaning_status' => htmlspecialchars($_POST['cleaning_status'] ?? '청소완료')
                ]);
            }
            header('Location: /admin/rooms-manage?edited=1'); exit;
        }
    }
}