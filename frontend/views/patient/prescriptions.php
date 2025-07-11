<?php
// filepath: /opt/lampp/htdocs/MODERN_HMS/frontend/views/patient/prescriptions.php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: ../auth/patient_login.php');
    exit();
}
require_once '../../../backend/config/db.php';

$patient_id = $_SESSION['patient_id'];
try {
    $sql = "SELECT p.PrescriptionID, p.PrescriptionDate, d.UserName AS DoctorName, p.Medicine, p.Dosage, p.Notes
            FROM prescriptions p
            JOIN Doctors d ON p.DoctorID = d.DoctorID
            WHERE p.PatientID = :patient_id
            ORDER BY p.PrescriptionDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
    $stmt->execute();
    $prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $prescriptions = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Prescriptions | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .prescription-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px auto;
            background: #fff;
        }
        .prescription-table th, .prescription-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .prescription-table th {
            background: #3498db;
            color: #fff;
        }
        .prescription-table tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-left">
            <img src="../../assets/images/logo.png" class="logo" alt="Logo">
            <span class="hospital-name">MODERN HMS</span>
        </div>
        <div class="header-right">
            <a href="../../logout/logged_out.php" class="logout-btn">Logout</a>
        </div>
    </header>
    <div class="dashboard-wrapper">
        <?php require_once '../../includes/sidebar.php'; ?>
        <main class="dashboard-main">
            <h2>My Prescriptions</h2>
            <table class="prescription-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Medicine</th>
                        <th>Dosage</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($prescriptions) === 0): ?>
                        <tr>
                            <td colspan="6">No prescriptions found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($prescriptions as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['PrescriptionDate']) ?></td>
                                <td><?= htmlspecialchars($row['DoctorName']) ?></td>
                                <td><?= htmlspecialchars($row['Medicine']) ?></td>
                                <td><?= htmlspecialchars($row['Dosage']) ?></td>
                                <td><?= htmlspecialchars($row['Notes']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </