<?php
require_once '../config/db.php';

$doctor = $_POST['Doctor'] ?? '';
$stmt = $conn->prepare("SELECT DoctorFees FROM Doctors WHERE UserName = ?");
$stmt->execute([$doctor]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo $row ? $row['DoctorFees'] : '';
