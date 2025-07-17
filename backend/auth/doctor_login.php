<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../config/db.php';
require_once '../models/DoctorModel.php';
// validator.php isn’t needed here anymore since we’re not validating email format
// require_once '../helpers/validator.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please enter valid credentials.";
    } else {
        // Use $conn (from db.php), not $pdo
        $doctorModel = new DoctorModel($conn);
        $doctor = $doctorModel->authenticateByUsername($username, $password);

        if ($doctor) {
            $_SESSION['doctor_id']   = $doctor['id'];
            $_SESSION['doctor_name'] = $doctor['UserName'];
            $_SESSION['doctor_email']= $doctor['Email'];
            header("Location: ../../frontend/views/doctor/dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

// If there was an error, store and redirect back to login form
if (!empty($error)) {
    $_SESSION['login_error'] = $error;
    header("Location: ../../frontend/views/auth/doctor_login.php");
    exit();
}
