<?php declare(strict_types=1);

class FacilityModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll(bool $activeOnly = false): array {
        $sql = "SELECT * FROM facilities";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY facility_id ASC";
        $facilities = $this->pdo->query($sql)->fetchAll();

        // 각 시설의 다중 이미지 묶음 매핑
        foreach ($facilities as &$f) {
            $f['images'] = $this->getImages((int)$f['facility_id']);
        }
        return $facilities;
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM facilities WHERE facility_id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $row['images'] = $this->getImages($id);
        }
        return $row ?: null;
    }

    public function getImages(int $facilityId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM facility_images WHERE facility_id = ? ORDER BY sort_order ASC, id ASC");
        $stmt->execute([$facilityId]);
        return $stmt->fetchAll();
    }

    public function addImage(int $facilityId, string $imageUrl): int {
        // 현재 최대 sort_order 구하기
        $stmt = $this->pdo->prepare("SELECT COALESCE(MAX(sort_order), -1) FROM facility_images WHERE facility_id = ?");
        $stmt->execute([$facilityId]);
        $nextOrder = ((int)$stmt->fetchColumn()) + 1;

        $ins = $this->pdo->prepare("INSERT INTO facility_images (facility_id, image_url, sort_order) VALUES (?, ?, ?)");
        $ins->execute([$facilityId, $imageUrl, $nextOrder]);
        return (int)$this->pdo->lastInsertId();
    }

    public function deleteImage(int $imageId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM facility_images WHERE id = ?");
        return $stmt->execute([$imageId]);
    }

    public function updateImageOrder(array $imageIds): bool {
        $stmt = $this->pdo->prepare("UPDATE facility_images SET sort_order = ? WHERE id = ?");
        foreach ($imageIds as $order => $imgId) {
            $stmt->execute([$order, (int)$imgId]);
        }
        return true;
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("UPDATE facilities SET code = ?, name = ?, capacity = ?, specs = ?, usage_guide = ?, image_url = ?, is_active = ? WHERE facility_id = ?");
        return $stmt->execute([
            $data['code'],
            $data['name'],
            $data['capacity'] ?? 0,
            $data['specs'] ?? '',
            $data['usage_guide'] ?? '',
            $data['image_url'] ?? '/assets/images/grand_sanctuary.jpg',
            $data['is_active'] ?? 1,
            $id
        ]);
    }

    public function checkConflict(int $facilityId, string $startDate, string $endDate, string $timeSlot): bool {
        $sql = "SELECT COUNT(*) FROM facility_rentals 
                WHERE facility_id = :facility_id 
                  AND status IN ('심사승인', '확정완료') 
                  AND (start_date <= :end_date AND end_date >= :start_date)
                  AND (time_slot = :time_slot OR time_slot = 'ALL_DAY' OR :time_slot_2 = 'ALL_DAY')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'facility_id' => $facilityId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'time_slot' => $timeSlot,
            'time_slot_2' => $timeSlot
        ]);
        return (int)$stmt->fetchColumn() > 0;
    }
}