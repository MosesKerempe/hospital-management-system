<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include DB connection
require_once __DIR__ . '/../config/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_doctor'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $specialization = trim($_POST['specialization']);
    $fee = floatval($_POST['fee']);

    // Validate passwords
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Use correct table name "Doctors"
        $stmt = $conn->prepare("INSERT INTO Doctors (Username, Email, Password, Specialization, DoctorFees) 
                                VALUES (:username, :email, :password, :specialization, :fee)");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':specialization', $specialization);
        $stmt->bindParam(':fee', $fee);
        $stmt->execute();

        // Redirect on success
        header("Location: ../../frontend/views/admin/doctor_list.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
} else {
    die("Unauthorized access or invalid form submission.");
}
