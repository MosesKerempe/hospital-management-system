<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_SESSION['patient_id'] ?? null;
    $doctor_id = $_POST['doctor_id'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $appointment_time = $_POST['appointment_time'] ?? '';
    $fee = $_POST['consultancy_fee'] ?? 0;

    if ($patient_id && $doctor_id && $appointment_date && $appointment_time) {
        try {
            $stmt = $pdo->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, doctor_fee) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$patient_id, $doctor_id, $appointment_date, $appointment_time, $fee]);

            $_SESSION['appointment_message'] = "✅ Appointment booked successfully!";
        } catch (PDOException $e) {
            $_SESSION['appointment_message'] = "❌ Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['appointment_message'] = "❌ Please fill all fields.";
    }

    header("Location: ../../frontend/views/patient/book_appointment.php");
    exit();
}
?>
