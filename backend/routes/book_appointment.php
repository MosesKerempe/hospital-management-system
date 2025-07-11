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
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
    $specialization = $_POST['specialization'];
    $doctor = $_POST['doctor'];
    $fee = $_POST['doctor_fee'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    // Get DoctorID from username
    $stmt = $conn->prepare("SELECT DoctorID FROM Doctors WHERE UserName = :doctor LIMIT 1");
    $stmt->bindParam(':doctor', $doctor);
    $stmt->execute();
    $doctor_row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($doctor_row) {
        $doctor_id = $doctor_row['DoctorID'];
        $sql = "INSERT INTO appointmenttable (PatientID, DoctorID, AppointmentDate, AppointmentTime, CurrentStatus) VALUES (:patient_id, :doctor_id, :date, :time, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        if ($stmt->execute()) {
            header('Location: ../../frontend/views/patient/appointment_history.php?success=1');
            exit();
        }
    }
    header('Location: ../../frontend/views/patient/book_appointment.php?error=1');
    exit();
}
header('Location: ../../frontend/views/patient/book_appointment.php');
exit();
