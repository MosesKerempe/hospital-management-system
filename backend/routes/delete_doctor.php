<?php
// backend/routes/delete_doctor.php

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $doctorId = intval($_POST['id']);
    
    try {
        $stmt = $conn->prepare("DELETE FROM Doctors WHERE id = :id");
        $stmt->bindParam(':id', $doctorId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
