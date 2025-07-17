<?php
// backend/controllers/PrescriptionController.php
require_once __DIR__ . '/../models/PrescriptionModel.php';

class PrescriptionController {
    private $model;
    public function __construct() {
        $this->model = new PrescriptionModel();
    }

    // Save a new prescription
    public function addPrescription(array $data): bool {
        return $this->model->createPrescription($data);
    }

    // Get all for a doctor
    public function getDoctorPrescriptions(string $doctorName): array {
        return $this->model->getByDoctor($doctorName);
    }
}
