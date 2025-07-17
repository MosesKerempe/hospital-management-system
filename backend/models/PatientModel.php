<?php
require_once __DIR__ . '/../config/db.php';

class PatientModel {
    private $conn;

    public function __construct($pdo = null) {
        // Use global $conn if not injected
        if ($pdo) {
            $this->conn = $pdo;
        } else {
            global $conn;
            $this->conn = $conn;
        }
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

    // Delete a patient by ID
    public function deletePatient($id) {
        $sql = "DELETE FROM PatientRegistration WHERE PatientId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // ✅ Add patient (registration)
    public function registerPatient($data) {
        $sql = "INSERT INTO PatientRegistration (FirstName, LastName, Gender, Email, Contact, Password)
                VALUES (:FirstName, :LastName, :Gender, :Email, :Contact, :Password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':FirstName' => $data['FirstName'],
            ':LastName' => $data['LastName'],
            ':Gender' => $data['Gender'],
            ':Email' => $data['Email'],
            ':Contact' => $data['Contact'],
            ':Password' => password_hash($data['Password'], PASSWORD_DEFAULT)
        ]);
    }

    // ✅ Login by email (used in patient_login.php)
    public function getPatientByEmail($email) {
        $sql = "SELECT * FROM PatientRegistration WHERE Email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Update patient profile
    public function updatePatient($id, $data) {
        $sql = "UPDATE PatientRegistration SET FirstName = :FirstName, LastName = :LastName, Gender = :Gender, Email = :Email, Contact = :Contact
                WHERE PatientId = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':FirstName' => $data['FirstName'],
            ':LastName' => $data['LastName'],
            ':Gender' => $data['Gender'],
            ':Email' => $data['Email'],
            ':Contact' => $data['Contact'],
            ':id' => $id
        ]);
    }

    // ✅ Optional: Change password
    public function changePassword($id, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE PatientRegistration SET Password = :password WHERE PatientId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
