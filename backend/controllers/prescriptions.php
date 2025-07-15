<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/PrescriptionModel.php';

try {
    $model = new PrescriptionModel($conn);
    $prescriptions = $model->getAllPrescriptions();

    echo json_encode([
        'status' => 'success',
        'data' => $prescriptions
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
