<?php
require_once '../config/db.php';

$specialization = $_GET['specialization'] ?? '';

if ($specialization !== '') {
    $stmt = $pdo->prepare("SELECT id, CONCAT(first_name, ' ', last_name) AS name, fees AS fee FROM doctors WHERE specialization = ?");
    $stmt->execute([$specialization]);

    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($doctors);
}
?>
