<?php
// backend/routes/add_prescription.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

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
        $_SESSION['prescription_error'] = "Please fill all required fields.";
        header("Location: ../../frontend/views/doctor/prescription_form.php?appointment_id=$appointmentId");
        exit;
    }

    $appointmentModel = new AppointmentModel();
    $appointment = null;

    try {
        $appointments = $appointmentModel->getAllAppointments();
        foreach ($appointments as $app) {
            if ($app['AppointmentID'] == $appointmentId) {
                $appointment = $app;
                break;
            }
        }

        if (!$appointment) {
            throw new Exception("Appointment not found.");
        }

        // Prepare data for prescription
        $data = [
            'DoctorName'       => $doctorName,
            'PatientID'        => $appointment['PatientID'],
            'FirstName'        => $appointment['FirstName'],
            'LastName'         => $appointment['LastName'],
            'AppointmentDate'  => $appointment['AppointmentDate'],
            'AppointmentTime'  => $appointment['AppointmentTime'],
            'Disease'          => $disease,
            'Allergy'          => $allergy,
            'Prescription'     => $prescription
        ];

        $model = new PrescriptionModel($conn);
        $result = $model->addPrescription($data);

        if ($result) {
            $_SESSION['prescription_success'] = "Prescription submitted successfully.";
            header("Location: ../../frontend/views/doctor/prescription_list.php");
            exit;
        } else {
            throw new Exception("Failed to save prescription.");
        }
    } catch (Exception $e) {
        $_SESSION['prescription_error'] = "Error: " . $e->getMessage();
        header("Location: ../../frontend/views/doctor/prescription_form.php?appointment_id=$appointmentId");
        exit;
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}
