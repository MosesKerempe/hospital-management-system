<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../auth/patient_login.php");
    exit;
}

require_once '../../../backend/config/db.php';
require_once '../../../backend/models/PrescriptionModel.php';

$patientId = $_SESSION['patient_id'];
$model = new PrescriptionModel($conn);
$pres = $model->getPrescriptionsByPatientId($patientId);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Prescriptions</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #2f3e9e;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php include '../../includes/sidebar.php'; ?>
<table class="table">
    <tr>
        <th>#</th>
        <th>Doctor Name</th>
        <th>Appointment ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Diseases</th>
        <th>Allergies</th>
        <th>Prescription</th>
        <th>Bill Payment</th>
    </tr>
    <?php foreach($pres as $i=>$r): ?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= htmlspecialchars($r['DoctorName']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentID']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentDate']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentTime']) ?></td>
        <td><?= htmlspecialchars($r['Disease']) ?></td>
        <td><?= htmlspecialchars($r['Allergy']) ?></td>
        <td><?= nl2br(htmlspecialchars($r['Prescription'])) ?></td>
        <td>N/A</td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../../includes/footer.php'; ?>
</body>
</html>