<?php
session_start();
require_once '../config/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['book_appointment']) && isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
    $specialization = $_POST['specialization'];
    $doctor_username = $_POST['doctor'];
    $fee = $_POST['doctor_fee'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    try {
        // Fetch patient info
        $stmt = $conn->prepare("SELECT FirstName, LastName, Gender, Email, Contact FROM patientregistration WHERE PatientId = :pid");
        $stmt->bindParam(':pid', $patient_id);
        $stmt->execute();
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$patient) {
            $_SESSION['error'] = "Patient not found.";
            header("Location: ../../frontend/views/patient/book_appointment.php?error=patient_not_found");
            exit();
        }

        // Fetch doctor ID
        $stmt = $conn->prepare("SELECT DoctorID FROM Doctors WHERE UserName = :uname");
        $stmt->bindParam(':uname', $doctor_username);
        $stmt->execute();
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$doctor) {
            $_SESSION['error'] = "Doctor not found.";
            header("Location: ../../frontend/views/patient/book_appointment.php?error=doctor_not_found");
            exit();
        }

        $doctor_id = $doctor['DoctorID'];

        // Insert into Appointment table
        $insert = $conn->prepare("INSERT INTO Appointment 
            (PatientID, DoctorID, FirstName, LastName, Gender, Email, Contact, Doctor, DoctorFees, AppointmentDate, AppointmentTime, UserStatus, DoctorStatus)
            VALUES 
            (:pid, :did, :fname, :lname, :gender, :email, :contact, :doctorName, :fees, :adate, :atime, 1, 1)");

        $insert->execute([
            ':pid' => $patient_id,
            ':did' => $doctor_id,
            ':fname' => $patient['FirstName'],
            ':lname' => $patient['LastName'],
            ':gender' => $patient['Gender'],
            ':email' => $patient['Email'],
            ':contact' => $patient['Contact'],
            ':doctorName' => $doctor_username,
            ':fees' => $fee,
            ':adate' => $date,
            ':atime' => $time
        ]);

        header("Location: ../../frontend/views/patient/book_appointment.php?success=1");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../../frontend/views/patient/book_appointment.php?error=exception");
        exit();
    }
} else {
    header("Location: ../../frontend/views/patient/book_appointment.php");
    exit();
}
