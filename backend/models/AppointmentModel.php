<?php
// backend/models/AppointmentModel.php

require_once __DIR__ . '/../config/db.php';

class AppointmentModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    /**
     * Fetch all appointments (for Admin view).
     *
     * @return array
     */
    public function getAllAppointments(): array {
        $stmt = $this->conn->prepare("
            SELECT 
                ID AS AppointmentID,
                PatientID,
                FirstName,
                LastName,
                Gender,
                Email,
                Contact,
                Doctor,
                DoctorFees,
                AppointmentDate,
                AppointmentTime,
                UserStatus,
                DoctorStatus
            FROM Appointment
            ORDER BY AppointmentDate DESC, AppointmentTime DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new appointment (used by Patient booking).
     *
     * @param array $data
     * @return bool
     */
    public function createAppointment(array $data): bool {
        $sql = "
            INSERT INTO Appointment
                (PatientID, FirstName, LastName, Gender, Email, Contact,
                 Doctor, DoctorFees, AppointmentDate, AppointmentTime, UserStatus, DoctorStatus)
            VALUES
                (:PatientID, :FirstName, :LastName, :Gender, :Email, :Contact,
                 :Doctor, :DoctorFees, :AppointmentDate, :AppointmentTime, :UserStatus, :DoctorStatus)
        ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * (Deprecated) Fetch appointments by doctor email.
     * @deprecated Use getAppointmentsByDoctorUsername() instead.
     */
    public function getAppointmentsByDoctorEmail(string $email): array {
        $stmt = $this->conn->prepare("
            SELECT * 
            FROM Appointment 
            WHERE Doctor = :email 
            ORDER BY AppointmentDate DESC, AppointmentTime DESC
        ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch appointments for a specific doctor by their USERNAME.
     *
     * @param string $username
     * @return array
     */
    public function getAppointmentsByDoctorUsername(string $username): array {
        $stmt = $this->conn->prepare("
            SELECT 
                ID AS AppointmentID,
                PatientID,
                FirstName,
                LastName,
                Gender,
                Email,
                Contact,
                Doctor,
                DoctorFees,
                AppointmentDate,
                AppointmentTime,
                UserStatus,
                DoctorStatus
            FROM Appointment
            WHERE Doctor = :doctor
            ORDER BY AppointmentDate DESC, AppointmentTime DESC
        ");
        $stmt->bindParam(':doctor', $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * ✅ Get single appointment by ID (for prescription form usage).
     *
     * @param int $id
     * @return array|null
     */
    public function getAppointmentById(int $id): ?array {
        $stmt = $this->conn->prepare("
            SELECT 
                ID AS AppointmentID,
                PatientID,
                FirstName,
                LastName,
                Gender,
                Email,
                Contact,
                Doctor,
                DoctorFees,
                AppointmentDate,
                AppointmentTime,
                UserStatus,
                DoctorStatus
            FROM Appointment
            WHERE ID = :id
            LIMIT 1
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

        return $appointment ?: null;
    }
}
