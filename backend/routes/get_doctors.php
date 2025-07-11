<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$specialization = $_GET['specialization'] ?? '';
if ($specialization) {
    $stmt = $conn->prepare("SELECT UserName, DoctorFees FROM Doctors WHERE Specialization = :spec");
    $stmt->bindParam(':spec', $specialization);
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($doctors);
} else {
    echo json_encode([]);
}
