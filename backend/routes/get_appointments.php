<?php
// backend/routes/get_appointments.php

require_once __DIR__ . '/../controllers/appointments.php';

$controller = new AppointmentController();

try {
    // ✅ Check if filtering by doctor email (used in doctor dashboard)
    if (isset($_GET['doctor_email'])) {
        $doctorEmail = $_GET['doctor_email'];
        $appointments = $controller->getAppointmentsByDoctor($doctorEmail);
    } else {
        // ✅ Default: return all appointments (admin or global access)
        $appointments = $controller->getAppointments();
    }

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'data' => $appointments
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
