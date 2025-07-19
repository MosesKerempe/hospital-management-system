<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/PrescriptionModel.php';
require_once __DIR__ . '/../config/db.php';

$model = new PrescriptionModel($conn);
$data = $model->getAllPrescriptions();

header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'data' => $data]);