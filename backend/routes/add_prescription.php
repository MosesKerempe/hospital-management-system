<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/PrescriptionModel.php';
require_once __DIR__ . '/../notifications/email_notifier.php';
require_once __DIR__ . '/../notifications/sms_notifier.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['doctor_name'])) {
    header('Location: ../../frontend/views/auth/doctor_login.php');
    exit();
}

// Gather and sanitize
$data = [
    'DoctorName'       => $_SESSION['doctor_name'],
    'PatientID'        => filter_var($_POST['patient_id'], FILTER_VALIDATE_INT),
    'FirstName'        => trim($_POST['first_name']),
    'LastName'         => trim($_POST['last_name']),
    'AppointmentDate'  => $_POST['date'],
    'AppointmentTime'  => $_POST['time'],
    'Disease'          => trim($_POST['disease']),
    'Allergy'          => trim($_POST['allergy']),
    'Prescription'     => trim($_POST['prescription']),
];

$model = new PrescriptionModel();

try {
    $model->createPrescription($data);

    // Notify patient via email & SMS
    $emailer = new EmailNotifier();
    $smser   = new SmsNotifier();
    $patientEmail = ''; // fetch from DB if needed
    $patientPhone = ''; // fetch from DB if needed

    $subject = "New Prescription from Dr. {$data['DoctorName']}";
    $body    = "Dear {$data['FirstName']},\n\n"
             . "Dr. {$data['DoctorName']} has submitted your prescription:\n"
             . "{$data['Prescription']}\n\n"
             . "Please review it in your dashboard.\n\n"
             . "Regards,\nMODERN HMS";

    $emailer->send($patientEmail, $subject, $body);
    $smser->send($patientPhone, "Your prescription is ready. Check your MODERN HMS dashboard.");

    header('Location: ../../frontend/views/doctor/prescription_list.php?success=1');
    exit();
} catch (Exception $e) {
    // Log error as needed
    die("Failed to save prescription: " . $e->getMessage());
}
