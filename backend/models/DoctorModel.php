<?php
// backend/models/DoctorModel.php

class DoctorModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all doctors
    public function getAllDoctors() {
        $sql = "SELECT * FROM Doctors ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single doctor by ID
    public function getDoctorById($id) {
        $sql = "SELECT * FROM Doctors WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete doctor by ID
    public function deleteDoctor($id) {
        $sql = "DELETE FROM Doctors WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Add a new doctor
    public function addDoctor($username, $email, $password, $specialization, $fees) {
        $sql = "INSERT INTO Doctors (UserName, Email, Password, Specialization, DoctorFees) 
                VALUES (:username, :email, :password, :specialization, :fees)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username",      $username);
        $stmt->bindParam(":email",         $email);
        $stmt->bindParam(":password",      $password);        // Make sure to hash before passing
        $stmt->bindParam(":specialization",$specialization);
        $stmt->bindParam(":fees",          $fees);
        return $stmt->execute();
    }

    // Authenticate doctor using username (instead of email)
    public function authenticateByUsername($username, $password) {
        $sql = "SELECT * FROM Doctors WHERE UserName = :username LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($doctor && password_verify($password, $doctor['Password'])) {
            return $doctor;
        }

        return false;
    }
}
