<?php
// backend/models/AppointmentModel.php

require_once __DIR__ . '/../config/db.php';

class AppointmentModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllAppointments() {
        $stmt = $this->conn->prepare("SELECT * FROM Appointment ORDER BY AppointmentDate DESC, AppointmentTime DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAppointment($data) {
        $sql = "INSERT INTO Appointment (PatientID, FirstName, LastName, Gender, Email, Contact, Doctor, DoctorFees, AppointmentDate, AppointmentTime, UserStatus, DoctorStatus)
                VALUES (:PatientID, :FirstName, :LastName, :Gender, :Email, :Contact, :Doctor, :DoctorFees, :AppointmentDate, :AppointmentTime, :UserStatus, :DoctorStatus)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}
