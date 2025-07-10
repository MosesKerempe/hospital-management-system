<?php
require_once '../config/db.php';

$specialization = $_GET['specialization'] ?? ''; // use lowercase to match JS

try {
    $stmt = $conn->prepare("SELECT UserName, DoctorFees FROM Doctors WHERE Specialization = ?");
    $stmt->execute([$specialization]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($doctors);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
