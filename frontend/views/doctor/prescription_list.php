<?php
session_start();
if (!isset($_SESSION['doctor_name'])) {
    header("Location: ../auth/doctor_login.php");
    exit();
}

require_once '../../../backend/config/db.php';

$doctorName = $_SESSION['doctor_name'];

try {
    $stmt = $conn->prepare("
        SELECT 
            id AS PrescriptionID,
            PatientID,
            FirstName,
            LastName,
            AppointmentID,
            AppointmentDate,
            AppointmentTime,
            Disease,
            Allergy,
            Prescription
        FROM prescriptions
        WHERE DoctorName = :doctorName
        ORDER BY AppointmentDate DESC, AppointmentTime DESC
    ");
    $stmt->bindParam(':doctorName', $doctorName);
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
    <title>Doctor Prescription List | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .prescription-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        .prescription-table th, .prescription-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .prescription-table th {
            background-color: #2f3e9e;
            color: white;
        }
        .prescription-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .dashboard-main {
            padding: 20px;
        }
    </style>
</head>
<body>

<?php include_once '../../includes/doctor_layout.php'; ?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/doctor_sidebar.php'; ?>

    <div class="dashboard-main">
        <h2>My Prescription List</h2>
        <table class="prescription-table">
            <thead>
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
            </thead>
            <tbody>
                <?php if (empty($prescriptions)): ?>
                    <tr><td colspan="10">No prescriptions found.</td></tr>
                <?php else: ?>
                    <?php foreach ($prescriptions as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['PatientID']) ?></td>
                            <td><?= htmlspecialchars($row['FirstName']) ?></td>
                            <td><?= htmlspecialchars($row['LastName']) ?></td>
                            <td><?= htmlspecialchars($row['AppointmentID']) ?></td>
                            <td><?= htmlspecialchars($row['AppointmentDate']) ?></td>
                            <td><?= htmlspecialchars($row['AppointmentTime']) ?></td>
                            <td><?= htmlspecialchars($row['Disease']) ?></td>
                            <td><?= htmlspecialchars($row['Allergy']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['Prescription'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

</body>
</html>
