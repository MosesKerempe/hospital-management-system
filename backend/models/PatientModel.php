<?php
require_once __DIR__ . '/../config/db.php';

class PatientModel {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    // Fetch all patients
    public function getAllPatients() {
        $sql = "SELECT * FROM PatientRegistration ORDER BY PatientId DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get one patient by ID
    public function getPatientById($id) {
        $sql = "SELECT * FROM PatientRegistration WHERE PatientId = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete a patient by ID (optional)
    public function deletePatient($id) {
        $sql = "DELETE FROM PatientRegistration WHERE PatientId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
