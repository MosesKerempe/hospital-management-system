<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'];

    $stmt = $conn->prepare("UPDATE appointments SET DoctorStatus = 0 WHERE ID = ?");
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        header("Location: ../../frontend/views/doctor/appointments.php?status=cancelled");
        exit;
    } else {
        echo "Failed to cancel appointment.";
    }
}
?>
