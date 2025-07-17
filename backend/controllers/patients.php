<?php
// backend/controllers/patients.php

require_once __DIR__ . '/../models/PatientModel.php';

class PatientController {
    private $model;

    public function __construct() {
        $this->model = new PatientModel();
    }

    // ✅ Get all patients
    public function getAllPatients() {
        return $this->model->getAllPatients();
    }

    // ✅ Get single patient by ID
    public function getPatientById($id) {
        return $this->model->getPatientById($id);
    }

    // ✅ Register new patient (used during registration)
    public function registerPatient($data) {
        return $this->model->registerPatient($data);
    }

    // ✅ Authenticate patient login
    public function loginPatient($email, $password) {
        $patient = $this->model->getPatientByEmail($email);
        if ($patient && password_verify($password, $patient['Password'])) {
            return $patient;
        }
        return false;
    }

    // ✅ Update patient profile
    public function updatePatient($id, $data) {
        return $this->model->updatePatient($id, $data);
    }

    // ✅ Delete a patient
    public function deletePatient($id) {
        return $this->model->deletePatient($id);
    }

    // ✅ Change password (optional)
    public function changePassword($id, $newPassword) {
        return $this->model->changePassword($id, $newPassword);
    }
}
