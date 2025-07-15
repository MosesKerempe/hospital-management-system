<?php
class QueryModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllQueries() {
        $stmt = $this->conn->prepare("SELECT * FROM Contact ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
