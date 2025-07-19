<?php

class PrescriptionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addPrescription($data) {
        $sql = "INSERT INTO Prescription (
            DoctorName, PatientID, AppointmentID, FirstName, LastName, 
            AppointmentDate, AppointmentTime, Disease, Allergy, Prescription
        ) VALUES (
            :DoctorName, :PatientID, :AppointmentID, :FirstName, :LastName, 
            :AppointmentDate, :AppointmentTime, :Disease, :Allergy, :Prescription
        )";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAllPrescriptions() {
        $stmt = $this->conn->prepare("SELECT * FROM Prescription ORDER BY AppointmentDate DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrescriptionsByDoctor($doctorName) {
        $stmt = $this->conn->prepare("SELECT * FROM Prescription WHERE DoctorName = :doctorName ORDER BY AppointmentDate DESC");
        $stmt->bindParam(':doctorName', $doctorName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrescriptionsByPatientId($patientId) {
        $stmt = $this->conn->prepare("SELECT * FROM Prescription WHERE PatientID = :patientId ORDER BY AppointmentDate DESC");
        $stmt->bindParam(':patientId', $patientId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}