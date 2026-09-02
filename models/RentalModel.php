<?php
/**
 * 파일 역할: 대관 모델
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class RentalModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getApprovedEvents(?int $facilityId = null): array {
        $sql = "SELECT r.*, f.code as facilityCode, f.name as facilityName 
                FROM rentals r 
                JOIN facilities f ON r.facility_id = f.id 
                WHERE r.status IN ('승인', '확정')";
        
        $params = [];
        if ($facilityId !== null) {
            $sql .= " AND r.facility_id = ?";
            $params[] = $facilityId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rentals = $stmt->fetchAll();
        
        $events = [];
        foreach ($rentals as $rental) {
            $events[] = [
                'id' => $rental['id'],
                'title' => $rental['facilityName'] . ' - ' . $rental['applicant_name'],
                'start' => $rental['start_date'],
                'end' => $rental['end_date'],
                'facilityCode' => $rental['facilityCode']
            ];
        }
        return $events;
    }

    public function create(array $data): string {
        $sql = "INSERT INTO rentals (rental_no, facility_id, start_date, end_date, time_slot, applicant_name, applicant_phone, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['rental_no'], $data['facility_id'], $data['start_date'], $data['end_date'],
            $data['time_slot'], $data['applicant_name'], $data['applicant_phone'], $data['status']
        ]);
        return $data['rental_no'];
    }

    public function updateStatus(int $id, string $status, ?string $adminComment = null): bool {
        $sql = "UPDATE rentals SET status = ?, admin_comment = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $adminComment, $id]);
    }

    public function getAll(array $filters = []): array {
        $sql = "SELECT r.*, f.name as facilityName FROM rentals r JOIN facilities f ON r.facility_id = f.id ORDER BY r.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM rentals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
