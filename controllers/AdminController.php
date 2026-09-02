<?php declare(strict_types=1);

class AdminController {
    private function checkAuth(): void {
        if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
            header('Location: /admin/login'); exit;
        }
    }

    private function render(string $viewPath, array $data = [], string $pageTitle = '관리자'): void {
        extract($data);
        $adminName = $_SESSION['admin_name'] ?? '관리자';
        ob_start();
        require ROOT_PATH . '/' . ltrim($viewPath, '/');
        $content = ob_get_clean();
        require ROOT_PATH . '/views/layouts/admin_layout.php';
    }

    public function loginForm(): void {
        if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
            header('Location: /admin'); exit;
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require ROOT_PATH . '/views/admin/login.php';
    }

    public function loginSubmit(): void {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare('SELECT admin_id, password_hash, name, role FROM admins WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            if($admin && password_verify($password, $admin['password_hash'])){
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_name'] = $admin['name'];
                $_SESSION['admin_role'] = $admin['role'];
                header('Location: /admin'); exit;
            }
        } catch(Exception $e){}
        header('Location: /admin/login?error=1'); exit;
    }

    public function logout(): void {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: /admin/login?logout=1'); exit;
    }

    public function dashboard(): void {
        $this->checkAuth();
        $stats = ['rentals' => 0, 'bookings' => 0, 'prayers' => 0, 'services' => 0, 'consults' => 0];
        try {
            $pdo = Database::getInstance();
            $stats['rentals'] = (int)$pdo->query("SELECT COUNT(*) FROM facility_rentals WHERE DATE(created_at) = CURDATE()")->fetchColumn();
            $stats['bookings'] = (int)$pdo->query("SELECT COUNT(*) FROM room_bookings WHERE DATE(created_at) = CURDATE()")->fetchColumn();
            $stats['prayers'] = (int)$pdo->query("SELECT COUNT(*) FROM prayer_requests WHERE status = '접수'")->fetchColumn();
            $stats['services'] = (int)$pdo->query("SELECT COUNT(*) FROM services WHERE event_date = CURDATE()")->fetchColumn();
            $stats['consults'] = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE consult_status != 'NONE' AND consult_status != '상담완료'")->fetchColumn();
        } catch(Exception $e){}

        $recentRentals = [];
        $recentBookings = [];
        $pendingPrayers = [];
        try {
            $pdo = Database::getInstance();
            $recentRentals = $pdo->query("SELECT r.*, f.name as facility_name FROM facility_rentals r LEFT JOIN facilities f ON r.facility_id = f.facility_id ORDER BY r.created_at DESC LIMIT 5")->fetchAll();
            $recentBookings = $pdo->query("SELECT b.*, rm.room_number FROM room_bookings b LEFT JOIN rooms rm ON b.room_id = rm.id ORDER BY b.created_at DESC LIMIT 5")->fetchAll();
            $pendingPrayers = $pdo->query("SELECT * FROM prayer_requests WHERE status = '접수' ORDER BY created_at DESC LIMIT 5")->fetchAll();
        } catch(Exception $e){}

        $this->render('views/admin/dashboard.php', [
            'stats' => $stats,
            'recentRentals' => $recentRentals,
            'recentBookings' => $recentBookings,
            'pendingPrayers' => $pendingPrayers
        ], '통합 현황판');
    }

    public function rentalCalendar(): void {
        $this->checkAuth();
        $rentals = [];
        try {
            $pdo = Database::getInstance();
            $rentals = $pdo->query("SELECT r.*, f.name as facility_name, f.code as facility_code FROM facility_rentals r LEFT JOIN facilities f ON r.facility_id = f.facility_id ORDER BY r.start_date DESC")->fetchAll();
        } catch(Exception $e){}

        $this->render('views/admin/rental_calendar.php', [
            'rentalList' => $rentals,
            'rentals' => $rentals
        ], '대관 시설 관리');
    }

    public function updateRentalStatus(): void {
        $this->checkAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = (int)($_POST['id'] ?? 0);
            $status = htmlspecialchars($_POST['status'] ?? '');
            $comment = htmlspecialchars($_POST['admin_comment'] ?? '');
            $allowed = ['접수대기', '심사승인', '확정완료', '반려', '취소'];
            if($id > 0 && in_array($status, $allowed)){
                try {
                    $pdo = Database::getInstance();
                    $stmt = $pdo->prepare("UPDATE facility_rentals SET status = ?, admin_comment = ? WHERE id = ?");
                    $stmt->execute([$status, $comment, $id]);
                } catch(Exception $e){}
            }
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
                header('Content-Type: application/json'); echo json_encode(['success' => true]); exit;
            }
        }
        header('Location: /admin/rental'); exit;
    }

    public function roomRack(): void {
        $this->checkAuth();
        $rooms = [];
        $bookings = [];
        $days = 30;
        try {
            $pdo = Database::getInstance();
            $rooms = $pdo->query("SELECT * FROM rooms WHERE status = '운영중' ORDER BY id")->fetchAll();
            $stmt = $pdo->prepare("SELECT b.*, r.room_number FROM room_bookings b LEFT JOIN rooms r ON b.room_id = r.id WHERE b.status IN ('예약대기', '예약확정', '입실완료') AND b.checkout_date >= CURDATE() ORDER BY b.checkin_date");
            $stmt->execute();
            $bookings = $stmt->fetchAll();
        } catch(Exception $e){}

        $this->render('views/admin/room_rack.php', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'days' => $days
        ], '숙소 예약 (룸 랙)');
    }

    public function updateBookingStatus(): void {
        $this->checkAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = (int)($_POST['id'] ?? 0);
            $status = htmlspecialchars($_POST['status'] ?? '');
            $allowed = ['예약대기', '예약확정', '입실완료', '퇴실완료', '취소'];
            if($id > 0 && in_array($status, $allowed)){
                try {
                    $pdo = Database::getInstance();
                    // 성도 정보 및 방 정보 미리 조회
                    $bk = $pdo->query("SELECT b.*, r.building_name, r.room_number FROM room_bookings b LEFT JOIN rooms r ON b.room_id = r.id WHERE b.id = {$id}")->fetch();
                    
                    $stmt = $pdo->prepare("UPDATE room_bookings SET status = ? WHERE id = ?");
                    $stmt->execute([$status, $id]);

                    // 성도 카카오톡 알림: 예약확정(확약) 또는 취소/반려 시 발송!
                    if ($bk && ($status === "예약확정" || $status === "취소")) {
                        $rName = ($bk["building_name"] ?? "") . " " . ($bk["room_number"] ?? "");
                        KakaoAPI::sendBookingStatusAlertToGuest($bk["phone"], $bk["guest_name"], $rName, $bk["checkin_date"], $bk["checkout_date"], $status);
                    }
                } catch(Exception $e){}
            }
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                header('Content-Type: application/json'); echo json_encode(['success' => true]); exit;
            }
        }
        header('Location: /admin/rooms'); exit;
    }

    public function prayerList(): void {
        $this->checkAuth();
        $prayers = [];
        try {
            $pdo = Database::getInstance();
            $prayers = $pdo->query("SELECT * FROM prayer_requests ORDER BY created_at DESC")->fetchAll();
        } catch(Exception $e){}

        $this->render('views/admin/prayer_list.php', [
            'prayers' => $prayers
        ], '중보기도 핫라인');
    }

    public function prayerReply(): void {
        $this->checkAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = (int)($_POST['id'] ?? 0);
            $reply = htmlspecialchars($_POST['reply'] ?? '');
            if($id > 0){
                try {
                    $pdo = Database::getInstance();
                    $stmt = $pdo->prepare("UPDATE prayer_requests SET reply_content = ?, status = '응답완료' WHERE id = ?");
                    $stmt->execute([$reply, $id]);
                } catch(Exception $e){}
            }
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                header('Content-Type: application/json'); echo json_encode(['success' => true]); exit;
            }
        }
        header('Location: /admin/prayer'); exit;
    }

    public function settings(): void {
        $this->checkAuth();
        $currentSettings = [];
        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
            $currentSettings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        } catch(Exception $e){}

        $this->render('views/admin/settings.php', [
            'currentSettings' => $currentSettings
        ], '사이트 기본 설정');
    }

    public function saveSettings(): void {
        $this->checkAuth();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $keys = ['site_name', 'slogan', 'address', 'phone_office', 'phone_shuttle', 'shuttle_schedule', 'daily_verse', 'youtube_channel_id', 'kakao_js_key', 'youtube_api_key'];
            try {
                $pdo = Database::getInstance();
                $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
                foreach($keys as $k){
                    if(isset($_POST[$k])){
                        $v = htmlspecialchars($_POST[$k]);
                        $stmt->execute([$k, $v, $v]);
                    }
                }
            } catch(Exception $e){}
        }
        header('Location: /admin/settings?saved=1'); exit;
    }
}