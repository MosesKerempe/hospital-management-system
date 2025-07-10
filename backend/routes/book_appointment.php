<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['book_appointment'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO appointmenttable 
            (PatientID, FirstName, LastName, Gender, Email, Contact, Doctor, DoctorFees, AppointmentDate, AppointmentTime) 
            SELECT PatientId, FirstName, LastName, Gender, Email, Contact, ?, ?, ?, ? 
            FROM patientregistration WHERE PatientId = ?");

        $stmt->execute([
            $_POST['doctor'],
            $_POST['fees'],
            $_POST['date'],
            $_POST['time'],
            $_POST['patient_id']
        ]);

        $_SESSION['success'] = "Appointment booked successfully!";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
header("Location: ../../frontend/views/patient/book_appointment.php");
exit();
