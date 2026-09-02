<?php declare(strict_types=1);

require_once ROOT_PATH . '/models/RoomModel.php';
require_once ROOT_PATH . '/models/BookingModel.php';

class StayController {
    public function index(): void {
        $roomModel = new RoomModel();
        $rooms = $roomModel->getAll('운영중');
        require_once ROOT_PATH . '/views/stay/index.php';
    }

    public function search(): void {
        $checkin = $_GET['checkin'] ?? '';
        $checkout = $_GET['checkout'] ?? '';
        $guests = isset($_GET['guests']) ? (int)$_GET['guests'] : 1;

        $roomModel = new RoomModel();
        $availableRooms = [];

        if ($checkin && $checkout) {
            $availableRooms = $roomModel->getAvailable($checkin, $checkout, $guests);
        }

        require_once ROOT_PATH . '/views/stay/search.php';
    }

    public function book(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403); die('Invalid Request');
        }

        $bookingNo = 'ST-' . date('Ymd') . '-' . sprintf('%04d', random_int(0, 9999));
        $password = $_POST['password'] ?? '1234';
        $roomId = (int)$_POST['room_id'];

        $roomModel = new RoomModel();
        $room = $roomModel->getById($roomId);
        $roomNumber = $room ? ($room['building_name'] . ' ' . $room['room_number']) : '배정객실';

        $data = [
            'booking_no' => $bookingNo,
            'room_id' => $roomId,
            'guest_name' => htmlspecialchars($_POST['guest_name'] ?? ''),
            'phone' => htmlspecialchars($_POST['phone'] ?? ''),
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'church_name' => htmlspecialchars($_POST['church_name'] ?? ''),
            'guest_count' => (int)($_POST['guest_count'] ?? 1),
            'checkin_date' => htmlspecialchars($_POST['checkin_date'] ?? ''),
            'checkout_date' => htmlspecialchars($_POST['checkout_date'] ?? ''),
            'purpose' => htmlspecialchars($_POST['purpose'] ?? '개인묵상'),
            'car_number' => htmlspecialchars($_POST['car_number'] ?? ''),
            'status' => '예약대기'
        ];

        $bookingModel = new BookingModel();
        $bookingModel->create($data);

        // 카카오톡 알림: 숙소 예약 담당자에게 즉시 신규 예약 알림 전송!
        $data['room_number'] = $roomNumber;
        KakaoAPI::sendBookingRequestAlertToManager($data);

        header('Location: /stay?success=1&booking_no=' . $bookingNo); exit;
    }

    public function lookup(): void {
        require_once ROOT_PATH . '/views/stay/lookup.php';
    }
}