<?php declare(strict_types=1);

class FacilityManageController {
    private function checkAuth(): void {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '대관 시설 관리'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function index(): void {
        $this->checkAuth();
        $model = new FacilityModel();
        $facilities = $model->getAll();
        $this->render('views/admin/facilities/index.php', ['facilities' => $facilities], '대관 시설 마스터 & 갤러리 관리');
    }

    public function update(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['facility_id'] ?? 0);
            if ($id > 0) {
                $model = new FacilityModel();
                $model->update($id, [
                    'code' => htmlspecialchars($_POST['code'] ?? ''),
                    'name' => htmlspecialchars($_POST['name'] ?? ''),
                    'capacity' => (int)($_POST['capacity'] ?? 0),
                    'specs' => htmlspecialchars($_POST['specs'] ?? ''),
                    'usage_guide' => htmlspecialchars($_POST['usage_guide'] ?? ''),
                    'image_url' => htmlspecialchars($_POST['image_url'] ?? ''),
                    'is_active' => isset($_POST['is_active']) ? 1 : 0
                ]);
            }
            header('Location: /admin/facilities?updated=1'); exit;
        }
    }

    // 드래그 앤 드롭 및 다중 이미지 업로드
    public function uploadImage(): void {
        $this->checkAuth();
        $facilityId = (int)($_POST['facility_id'] ?? 0);
        if ($facilityId <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid facility_id']); exit;
        }

        $uploadedImages = [];
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = ROOT_PATH . '/assets/images/facilities/';
            if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0777, true); }

            $model = new FacilityModel();
            foreach ($_FILES['images']['name'] as $idx => $name) {
                if ($_FILES['images']['error'][$idx] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $filename = 'fac_' . $facilityId . '_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$idx], $uploadDir . $filename)) {
                        $url = '/assets/images/facilities/' . $filename;
                        $imgId = $model->addImage($facilityId, $url);
                        $uploadedImages[] = ['id' => $imgId, 'url' => $url];
                    }
                }
            }
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'images' => $uploadedImages]); exit;
        }
        header('Location: /admin/facilities?uploaded=1'); exit;
    }

    // Sortable.js 순서 변경 AJAX
    public function reorderImages(): void {
        $this->checkAuth();
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data['order']) && is_array($data['order'])) {
            $model = new FacilityModel();
            $model->updateImageOrder($data['order']);
            header('Content-Type: application/json');
            echo json_encode(['success' => true]); exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => false]); exit;
    }

    public function deleteImage(): void {
        $this->checkAuth();
        $id = (int)($_POST['image_id'] ?? 0);
        if ($id > 0) {
            $model = new FacilityModel();
            $model->deleteImage($id);
        }
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json'); echo json_encode(['success' => true]); exit;
        }
        header('Location: /admin/facilities'); exit;
    }
}