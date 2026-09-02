<?php
/**
 * 파일 역할: 중보기도 모델
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class PrayerModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int {
        $sql = "INSERT INTO prayers (name, title, content, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['name'], $data['title'], $data['content'], $data['status']
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function getAll(string $status = ''): array {
        $sql = "SELECT * FROM prayers";
        $params = [];
        if ($status !== '') {
            $sql .= " WHERE status = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function updateReply(int $id, string $reply): bool {
        $sql = "UPDATE prayers SET reply = ?, status = '응답완료', replied_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$reply, $id]);
    }
}
