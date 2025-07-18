<?php
require_once '../config/db.php';
require_once '../models/PrescriptionModel.php';

header('Content-Type: application/json');

try {
    $model = new PrescriptionModel($conn);
    $prescriptions = $model->getAllPrescriptions();

    echo json_encode([
        'status' => 'success',
        'data' => $prescriptions
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to load prescriptions: ' . $e->getMessage()
    ]);
}
