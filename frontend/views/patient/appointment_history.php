<?php
// filepath: /opt/lampp/htdocs/MODERN_HMS/frontend/views/patient/appointment_history.php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: ../auth/patient_login.php');
    exit();
}
require_once '../../../backend/config/db.php';

$patient_id = $_SESSION['patient_id'];
try {
    $sql = "SELECT a.AppointmentID, a.AppointmentDate, a.AppointmentTime, a.CurrentStatus, d.UserName AS DoctorName, d.DoctorFees
            FROM appointmenttable a
            JOIN Doctors d ON a.DoctorID = d.DoctorID
            WHERE a.PatientID = :patient_id
            ORDER BY a.AppointmentDate DESC, a.AppointmentTime DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $appointments = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment History | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px auto;
            background: #fff;
        }
        .history-table th, .history-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .history-table th {
            background: #3498db;
            color: #fff;
        }
        .history-table tr:nth-child(even) {
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
            <h2>My Appointment History</h2>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Consultancy Fee</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($appointments) === 0): ?>
                        <tr>
                            <td colspan="6">No appointments found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['DoctorName']) ?></td>
                                <td><?= htmlspecialchars($row['DoctorFees']) ?></td>
                                <td><?= htmlspecialchars($row['AppointmentDate']) ?></td>
                                <td><?= htmlspecialchars(substr($row['AppointmentTime'], 0, 5)) ?></td>
                                <td><?= htmlspecialchars($row['CurrentStatus']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>