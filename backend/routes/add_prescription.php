<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../models/PrescriptionModel.php';
require_once '../models/AppointmentModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorName = $_SESSION['doctor_name'] ?? '';
    $appointmentId = $_POST['appointment_id'] ?? null;
    $disease = trim($_POST['disease'] ?? '');
    $allergy = trim($_POST['allergy'] ?? '');
    $prescription = trim($_POST['prescription'] ?? '');

    if (!$doctorName || !$appointmentId || empty($disease) || empty($prescription)) {
        $_SESSION['prescription_error'] = "Please fill in all required fields.";
        header("Location: ../../frontend/views/doctor/prescription_form.php?appointment_id=$appointmentId");
        exit;
    }

    $appointmentModel = new AppointmentModel();
    $appointments = $appointmentModel->getAllAppointments();

    $appointment = null;
    foreach ($appointments as $app) {
        if ($app['AppointmentID'] == $appointmentId) {
            $appointment = $app;
            break;
        }
    }

    if (!$appointment) {
        $_SESSION['prescription_error'] = "Invalid Appointment ID.";
        header("Location: ../../frontend/views/doctor/prescription_form.php?appointment_id=$appointmentId");
        exit;
    }

    $data = [
        'DoctorName' => $doctorName,
        'PatientID' => $appointment['PatientID'],
        'AppointmentID' => $appointmentId,
        'FirstName' => $appointment['FirstName'],
        'LastName' => $appointment['LastName'],
        'AppointmentDate' => $appointment['AppointmentDate'],
        'AppointmentTime' => $appointment['AppointmentTime'],
        'Disease' => $disease,
        'Allergy' => $allergy,
        'Prescription' => $prescription
    ];

    $model = new PrescriptionModel($conn);
    if ($model->addPrescription($data)) {
        $_SESSION['prescription_success'] = "Prescription submitted successfully.";
        header("Location: ../../frontend/views/doctor/prescription_list.php");
    } else {
        $_SESSION['prescription_error'] = "Database error while submitting prescription.";
        header("Location: ../../frontend/views/doctor/prescription_form.php?appointment_id=$appointmentId");
    }
    exit;
} else {
    echo "Method Not Allowed";
    http_response_code(405);
}