<?php
// backend/auth/patient_login.php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM PatientRegistration WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $patient['Password'])) {
                $_SESSION['patient_id'] = $patient['PatientId'];
                $_SESSION['patient_name'] = $patient['FirstName'] . ' ' . $patient['LastName'];

                header("Location: ../../frontend/views/patient/dashboard.php");
                exit();
            } else {
                header("Location: ../../frontend/views/auth/patient_login.php?error=Invalid password");
                exit();
            }
        } else {
            header("Location: ../../frontend/views/auth/patient_login.php?error=Email not found");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../../frontend/views/auth/patient_login.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../../frontend/views/auth/patient_login.php");
    exit();
}
