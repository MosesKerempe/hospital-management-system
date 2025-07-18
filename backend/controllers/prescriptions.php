<?php
require_once '../config/db.php';
require_once '../models/PrescriptionModel.php';

class PrescriptionController {
    private $model;

    public function __construct($db) {
        $this->model = new PrescriptionModel($db);
    }

    public function getAll() {
        return $this->model->getAllPrescriptions();
    }

    public function getByPatient($patientId) {
        return $this->model->getPrescriptionsByPatientId($patientId);
    }

    public function getByDoctor($doctorName) {
        return $this->model->getPrescriptionsByDoctorName($doctorName);
    }

    public function create($data) {
        return $this->model->addPrescription($data);
    }
}
