<?php declare(strict_types=1);

class RoomModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll(string $status = ''): array {
        $sql = "SELECT * FROM rooms";
        if ($status !== '') {
            $sql .= " WHERE status = :status ORDER BY building_name ASC, room_number ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['status' => $status]);
        } else {
            $stmt = $this->pdo->query($sql . " ORDER BY building_name ASC, room_number ASC");
        }
        return $stmt->fetchAll();
    }

    public function getAvailable(string $checkin, string $checkout, int $guests): array {
        $sql = "SELECT * FROM rooms 
                WHERE status = '운영중' 
                  AND capacity_max >= :guests
                  AND id NOT IN (
                    SELECT room_id FROM room_bookings 
                    WHERE status IN ('예약대기', '예약확정', '입실완료')
                      AND NOT (checkout_date <= :checkin OR checkin_date >= :checkout)
                  )
                ORDER BY building_name ASC, room_number ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'guests' => $guests,
            'checkin' => $checkin,
            'checkout' => $checkout
        ]);
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function updateOptions(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("
            UPDATE rooms 
            SET building_name = ?, floor = ?, room_type = ?, room_number = ?, bed_type = ?, 
                capacity_standard = ?, capacity_max = ?, has_bathroom = ?, amenities = ?, 
                maintenance_memo = ?, status = ?, cleaning_status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['building_name'],
            $data['floor'] ?? '1층',
            $data['room_type'] ?? '개인실',
            $data['room_number'],
            $data['bed_type'] ?? '온돌',
            $data['capacity_standard'] ?? 1,
            $data['capacity_max'] ?? 2,
            $data['has_bathroom'] ?? 1,
            $data['amenities'] ?? '냉난방, 개별온수, 와이파이, 침구류',
            $data['maintenance_memo'] ?? '',
            $data['status'] ?? '운영중',
            $data['cleaning_status'] ?? '청소완료',
            $id
        ]);
    }

    public function updateCleaningStatus(int $id, string $status): bool {
        $stmt = $this->pdo->prepare("UPDATE rooms SET cleaning_status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function updateMaintenanceMemo(int $id, string $memo): bool {
        $stmt = $this->pdo->prepare("UPDATE rooms SET maintenance_memo = ? WHERE id = ?");
        return $stmt->execute([$memo, $id]);
    }
}