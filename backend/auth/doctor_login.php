<?php
session_start();
require_once '../config/db.php';
require_once '../models/DoctorModel.php';
require_once '../helpers/validator.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!is_valid_email($email) || empty($password)) {
        $error = "Please enter valid credentials.";
    } else {
        $doctorModel = new DoctorModel($pdo);
        $doctor = $doctorModel->authenticate($email, $password);

        if ($doctor) {
            $_SESSION['doctor_id'] = $doctor['id'];
            $_SESSION['doctor_name'] = $doctor['UserName'];
            header("Location: ../../frontend/views/doctor/dashboard.php");
            exit();
        } else {
            $error = "Invalid login credentials.";
        }
    }
}
?>
