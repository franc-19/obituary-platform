<?php
require_once __DIR__ . '/../config/db.php';

class ObituaryModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllObituaries() {
        $stmt = $this->pdo->query("SELECT * FROM obituaries ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
