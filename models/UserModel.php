<?php declare(strict_types=1);

class UserModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function findByUsername(string $username): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO users 
            (username, password_hash, name, phone, church_name, role, consult_status, provider, agree_notice_event, agree_notice_rental, agree_notice_stay, agree_marketing) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['username'],
            $data['password_hash'],
            $data['name'],
            $data['phone'],
            $data['church_name'] ?? '',
            $data['role'] ?? 'MEMBER',
            $data['consult_status'] ?? 'NONE',
            $data['provider'] ?? 'LOCAL',
            $data['agree_notice_event'] ?? 0,
            $data['agree_notice_rental'] ?? 0,
            $data['agree_notice_stay'] ?? 0,
            $data['agree_marketing'] ?? 0
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function getAll(array $filters = []): array {
        $sql = "SELECT * FROM users WHERE 1=1";
        $params = [];

        if (!empty($filters['role'])) {
            $sql .= " AND role = ?";
            $params[] = $filters['role'];
        }
        if (!empty($filters['consult_status'])) {
            $sql .= " AND consult_status = ?";
            $params[] = $filters['consult_status'];
        }
        if (!empty($filters['search'])) {
            $sql .= " AND (name LIKE ? OR username LIKE ? OR phone LIKE ? OR church_name LIKE ?)";
            $s = "%" . $filters['search'] . "%";
            $params[] = $s; $params[] = $s; $params[] = $s; $params[] = $s;
        }

        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function updateRoleAndConsult(int $id, string $role, string $consultStatus): bool {
        $stmt = $this->pdo->prepare("UPDATE users SET role = ?, consult_status = ? WHERE id = ?");
        return $stmt->execute([$role, $consultStatus, $id]);
    }
}