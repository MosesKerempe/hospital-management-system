<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: ../auth/patient_login.php');
    exit();
}

require_once '../../../backend/config/db.php';

$patient_id = $_SESSION['patient_id'];

try {
    $sql = "SELECT 
                DoctorName,
                AppointmentID,
                AppointmentDate,
                AppointmentTime,
                Disease,
                Allergy,
                Prescription
            FROM prescriptions
            WHERE PatientID = :patient_id
            ORDER BY AppointmentDate DESC, AppointmentTime DESC";
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
            background: #2f3e9e;
            color: #fff;
        }
        .prescription-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            margin: 30px 0;
        }
        .main-header {
            background-color: #2f3e9e;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left .logo {
            height: 40px;
            margin-right: 10px;
        }
        .hospital-name {
            font-size: 20px;
            font-weight: bold;
        }
        .logout-btn {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            background-color: #e74c3c;
            border-radius: 4px;
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
        <?php include_once '../../includes/sidebar.php'; ?>

        <main class="dashboard-main">
            <h2>My Prescriptions</h2>
            <table class="prescription-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor Name</th>
                        <th>Appointment ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Disease</th>
                        <th>Allergy</th>
                        <th>Prescription</th>
                        <th>Bill Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($prescriptions) === 0): ?>
                        <tr>
                            <td colspan="9">No prescriptions found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($prescriptions as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['DoctorName']) ?></td>
                                <td><?= htmlspecialchars($row['AppointmentID']) ?></td>
                                <td><?= htmlspecialchars($row['AppointmentDate']) ?></td>
                                <td><?= htmlspecialchars($row['AppointmentTime']) ?></td>
                                <td><?= htmlspecialchars($row['Disease']) ?></td>
                                <td><?= htmlspecialchars($row['Allergy']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['Prescription'])) ?></td>
                                <td>N/A</td> <!-- You can update this if billing is added later -->
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>

    <?php include_once '../../includes/footer.php'; ?>
</body>
</html>
