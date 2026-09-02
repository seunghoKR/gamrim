<?php
/**
 * 파일 역할: 예약 모델
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class BookingModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): string {
        $sql = "INSERT INTO bookings (booking_no, room_id, guest_name, phone, password_hash, checkin, checkout, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['booking_no'], $data['room_id'], $data['guest_name'], $data['phone'],
            $data['password_hash'], $data['checkin'], $data['checkout'], $data['status']
        ]);
        return $data['booking_no'];
    }

    public function findByCredentials(string $name, string $phone, string $password): ?array {
        $sql = "SELECT * FROM bookings WHERE guest_name = ? AND phone = ? ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $phone]);
        $booking = $stmt->fetch();

        if ($booking && password_verify($password, $booking['password_hash'])) {
            return $booking;
        }
        return null;
    }

    public function updateStatus(int $id, string $status): bool {
        $sql = "UPDATE bookings SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function getByRoomAndDateRange(int $roomId, string $start, string $end): array {
        $sql = "SELECT * FROM bookings WHERE room_id = ? AND checkin < ? AND checkout > ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roomId, $end, $start]);
        return $stmt->fetchAll();
    }

    public function getAll(array $filters = []): array {
        $sql = "SELECT b.*, r.name as roomName FROM bookings b JOIN rooms r ON b.room_id = r.id ORDER BY b.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getForRoomRack(int $days = 30): array {
        $start = date('Y-m-d');
        $end = date('Y-m-d', strtotime("+$days days"));
        
        $sql = "SELECT b.*, r.name as roomName FROM bookings b 
                JOIN rooms r ON b.room_id = r.id 
                WHERE b.checkout >= ? AND b.checkin <= ? 
                AND b.status IN ('예약대기', '예약확정')
                ORDER BY r.name ASC, b.checkin ASC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$start, $end]);
        return $stmt->fetchAll();
    }
}
