<?php declare(strict_types=1);

class UserManageController {
    private function checkAuth(): void {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '회원 & 권한 관리'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function index(): void {
        $this->checkAuth();
        $model = new UserModel();

        $filterRole = $_GET['role'] ?? '';
        $filterConsult = $_GET['consult_status'] ?? '';
        $search = $_GET['search'] ?? '';

        $users = $model->getAll([
            'role' => $filterRole,
            'consult_status' => $filterConsult,
            'search' => $search
        ]);

        $this->render('views/admin/users/index.php', [
            'users' => $users,
            'filterRole' => $filterRole,
            'filterConsult' => $filterConsult,
            'search' => $search
        ], '회원·상담 & 그룹 관리 (개발자 전용)');
    }

    public function updateRole(): void {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $role = htmlspecialchars($_POST['role'] ?? 'MEMBER');
            $consult = htmlspecialchars($_POST['consult_status'] ?? 'NONE');

            if ($id > 0) {
                $model = new UserModel();
                $model->updateRoleAndConsult($id, $role, $consult);
            }
            header('Location: /admin/users?updated=1'); exit;
        }
    }
}