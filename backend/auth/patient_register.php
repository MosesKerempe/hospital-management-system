<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $gender = $_POST['gender'];
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        header("Location: ../../frontend/views/auth/patient_register.php?error=Passwords do not match");
        exit();
    }

    try {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM PatientRegistration WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: ../../frontend/views/auth/patient_register.php?error=Email already exists");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO PatientRegistration (FirstName, LastName, Gender, Email, Contact, Password) VALUES (:fname, :lname, :gender, :email, :contact, :password)");
        $insert->bindParam(':fname', $first_name);
        $insert->bindParam(':lname', $last_name);
        $insert->bindParam(':gender', $gender);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':contact', $contact);
        $insert->bindParam(':password', $hashed_password);

        if ($insert->execute()) {
            header("Location: ../../frontend/views/auth/patient_login.php?success=Registration successful. Please login.");
            exit();
        } else {
            header("Location: ../../frontend/views/auth/patient_register.php?error=Failed to register");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../../frontend/views/auth/patient_register.php?error=Error: " . $e->getMessage());
        exit();
    }
} else {
    header("Location: ../../frontend/views/auth/patient_register.php?error=Invalid request method");
    exit();
}
