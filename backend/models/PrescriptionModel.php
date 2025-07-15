<?php
class PrescriptionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllPrescriptions() {
        $stmt = $this->conn->prepare("SELECT * FROM Prescription ORDER BY AppointmentDate DESC, AppointmentTime DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
