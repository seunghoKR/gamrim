<?php declare(strict_types=1);

class AuthController {
    public function registerForm(): void {
        if (isset($_SESSION['user_id'])) {
            header('Location: /'); exit;
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require ROOT_PATH . '/views/auth/register.php';
    }

    public function registerSubmit(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register'); exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $church = trim($_POST['church_name'] ?? '');

        if (empty($username) || empty($password) || empty($name) || empty($phone)) {
            header('Location: /register?error=empty'); exit;
        }

        $model = new UserModel();
        if ($model->findByUsername($username)) {
            header('Location: /register?error=duplicate'); exit;
        }

        $userId = $model->create([
            'username' => $username,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'name' => $name,
            'phone' => $phone,
            'church_name' => $church,
            'role' => 'MEMBER',
            'consult_status' => isset($_POST['need_consult']) ? '일반상담필요' : 'NONE',
            'provider' => 'LOCAL',
            'agree_notice_event' => isset($_POST['agree_notice_event']) ? 1 : 0,
            'agree_notice_rental' => isset($_POST['agree_notice_rental']) ? 1 : 0,
            'agree_notice_stay' => isset($_POST['agree_notice_stay']) ? 1 : 0,
            'agree_marketing' => isset($_POST['agree_marketing']) ? 1 : 0
        ]);

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = 'MEMBER';

        header('Location: /?registered=1'); exit;
    }

    public function loginForm(): void {
        if (isset($_SESSION['user_id'])) {
            header('Location: /'); exit;
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require ROOT_PATH . '/views/auth/login.php';
    }

    public function loginSubmit(): void {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $model = new UserModel();
        $user = $model->findByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: /'); exit;
        }

        header('Location: /login?error=1'); exit;
    }

    public function logout(): void {
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_role']);
        header('Location: /?logout=1'); exit;
    }
}