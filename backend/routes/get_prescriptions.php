<?php
session_start();
require_once '../config/db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['patient_id'])) {
    echo json_encode([]);
    exit();
}

$patient_id = $_SESSION['patient_id'];
$stmt = $conn->prepare("SELECT p.PrescriptionID, p.PrescriptionDate, d.UserName AS DoctorName, p.Medicine, p.Dosage, p.Notes
                        FROM prescriptions p
                        JOIN Doctors d ON p.DoctorID = d.DoctorID
                        WHERE p.PatientID = :patient_id
                        ORDER BY p.PrescriptionDate DESC");
$stmt->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
$stmt->execute();
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($prescriptions);