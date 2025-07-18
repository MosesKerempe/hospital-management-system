<?php
// backend/models/PrescriptionModel.php

class PrescriptionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addPrescription($data) {
        $sql = "INSERT INTO Prescription (DoctorName, PatientID, FirstName, LastName, AppointmentDate, AppointmentTime, Disease, Allergy, Prescription)
                VALUES (:DoctorName, :PatientID, :FirstName, :LastName, :AppointmentDate, :AppointmentTime, :Disease, :Allergy, :Prescription)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAllPrescriptions() {
        $sql = "SELECT * FROM Prescription ORDER BY AppointmentDate DESC, AppointmentTime DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrescriptionsByPatientId($patientId) {
        $sql = "SELECT * FROM Prescription WHERE PatientID = :patientId ORDER BY AppointmentDate DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrescriptionsByDoctor($doctorName) {
        $sql = "SELECT * FROM Prescription WHERE DoctorName = :doctorName ORDER BY AppointmentDate DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':doctorName', $doctorName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
