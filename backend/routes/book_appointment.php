<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
    $specialization = $_POST['specialization'];
    $doctor_username = $_POST['doctor'];
    $doctor_fee = $_POST['doctor_fee'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    try {
        // Fetch patient info
        $stmt = $conn->prepare("SELECT FirstName, LastName, Gender, Email, Contact FROM PatientRegistration WHERE PatientId = :id");
        $stmt->bindParam(':id', $patient_id);
        $stmt->execute();
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$patient) {
            throw new Exception("Patient not found.");
        }

        // Insert appointment without DoctorID
        $insert = $conn->prepare("INSERT INTO Appointment 
            (PatientID, FirstName, LastName, Gender, Email, Contact, Doctor, DoctorFees, AppointmentDate, AppointmentTime, UserStatus, DoctorStatus)
            VALUES 
            (:patient_id, :fname, :lname, :gender, :email, :contact, :doctor, :fees, :date, :time, 'Active', 'Active')");

        $insert->execute([
            ':patient_id' => $patient_id,
            ':fname' => $patient['FirstName'],
            ':lname' => $patient['LastName'],
            ':gender' => $patient['Gender'],
            ':email' => $patient['Email'],
            ':contact' => $patient['Contact'],
            ':doctor' => $doctor_username,
            ':fees' => $doctor_fee,
            ':date' => $date,
            ':time' => $time
        ]);

        header("Location: ../../frontend/views/patient/appointment_history.php?success=1");
        exit();
    } catch (Exception $e) {
        header("Location: ../../frontend/views/patient/book_appointment.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../../frontend/views/patient/book_appointment.php?error=Unauthorized");
    exit();
}
