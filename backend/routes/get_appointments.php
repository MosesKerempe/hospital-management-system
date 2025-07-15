<?php
// backend/routes/get_appointments.php

require_once __DIR__ . '/../controllers/appointments.php';

$controller = new AppointmentController();

try {
    $appointments = $controller->getAppointments();
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
