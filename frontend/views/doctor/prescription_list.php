<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['doctor_name'])) {
    header("Location: ../auth/doctor_login.php");
    exit;
}

require_once '../../../backend/config/db.php';
require_once '../../../backend/models/PrescriptionModel.php';

$doctorName = $_SESSION['doctor_name'];
$model = new PrescriptionModel($conn);
$list = $model->getPrescriptionsByDoctor($doctorName);
?>

<!DOCTYPE html>
<html>
<head>
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
<?php include '../../includes/doctor_layout.php'; ?>
<table class="table">
    <tr>
        <th>#</th>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Appointment ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Disease</th>
        <th>Allergy</th>
        <th>Prescription</th>
    </tr>
    <?php foreach($list as $i=>$r): ?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= htmlspecialchars($r['PatientID']) ?></td>
        <td><?= htmlspecialchars($r['FirstName']) ?></td>
        <td><?= htmlspecialchars($r['LastName']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentID']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentDate']) ?></td>
        <td><?= htmlspecialchars($r['AppointmentTime']) ?></td>
        <td><?= htmlspecialchars($r['Disease']) ?></td>
        <td><?= htmlspecialchars($r['Allergy']) ?></td>
        <td><?= nl2br(htmlspecialchars($r['Prescription'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../../includes/footer.php'; ?>
</body>
</html>