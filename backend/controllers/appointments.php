<?php
// backend/controllers/appointments.php

require_once __DIR__ . '/../models/AppointmentModel.php';

class AppointmentController {
    private $appointmentModel;

    public function __construct() {
        $this->appointmentModel = new AppointmentModel();
    }

    public function getAppointments() {
        return $this->appointmentModel->getAllAppointments();
    }

    public function addAppointment($data) {
        return $this->appointmentModel->createAppointment($data);
    }

    // ✅ NEW METHOD: Fetch appointments by doctor email
    public function getAppointmentsByDoctor($email) {
        return $this->appointmentModel->getAppointmentsByDoctorEmail($email);
    }
}
