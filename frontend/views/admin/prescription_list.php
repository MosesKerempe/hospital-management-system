<?php
session_start();
require_once '../../../backend/config/db.php';
require_once '../../../backend/models/PrescriptionModel.php';

$model = new PrescriptionModel($conn);
$prescriptions = $model->getAllPrescriptions();
?>

<?php include '../../includes/admin_layout.php'; ?>
<style>
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background: #fff;
    }
    .styled-table th, .styled-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .styled-table th {
        background-color: #2f3e9e;
        color: white;
    }
    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
</style>

<div class="dashboard-wrapper">
<?php include '../../includes/admin_sidebar.php'; ?>
<div class="dashboard-main">
    <h2>Prescription List</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Doctor</th>
                <th>Patient ID</th>
                <th>Appointment ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Disease</th>
                <th>Allergy</th>
                <th>Prescription</th>
            </tr>
        </thead>
        <tbody id="presc-body">
        <?php foreach($prescriptions as $i => $r): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= htmlspecialchars($r['DoctorName']) ?></td>
                <td><?= htmlspecialchars($r['PatientID']) ?></td>
                <td><?= htmlspecialchars($r['AppointmentID']) ?></td>
                <td><?= htmlspecialchars($r['FirstName']) ?></td>
                <td><?= htmlspecialchars($r['LastName']) ?></td>
                <td><?= htmlspecialchars($r['AppointmentDate']) ?></td>
                <td><?= htmlspecialchars($r['AppointmentTime']) ?></td>
                <td><?= htmlspecialchars($r['Disease']) ?></td>
                <td><?= htmlspecialchars($r['Allergy']) ?></td>
                <td><?= nl2br(htmlspecialchars($r['Prescription'])) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<?php include '../../includes/footer.php'; ?>