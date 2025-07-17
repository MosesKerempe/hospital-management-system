<?php
// backend/models/PrescriptionModel.php
require_once __DIR__ . '/../config/db.php';

class PrescriptionModel {
    private $conn;
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Create new prescription
    public function createPrescription(array $data): bool {
        $sql = "
          INSERT INTO Prescription
            (DoctorName, PatientID, FirstName, LastName,
             AppointmentDate, AppointmentTime,
             Disease, Allergy, Prescription)
          VALUES
            (:DoctorName, :PatientID, :FirstName, :LastName,
             :AppointmentDate, :AppointmentTime,
             :Disease, :Allergy, :Prescription)
        ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Fetch prescriptions written by this doctor
    public function getByDoctor(string $doctorName): array {
        $stmt = $this->conn->prepare("
          SELECT * FROM Prescription
          WHERE DoctorName = :doc
          ORDER BY AppointmentDate DESC, AppointmentTime DESC
        ");
        $stmt->bindParam(':doc', $doctorName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
