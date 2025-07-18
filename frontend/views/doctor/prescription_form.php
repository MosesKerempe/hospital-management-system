<?php
session_start();

if (!isset($_SESSION['doctor_name'])) {
    header("Location: ../auth/doctor_login.php");
    exit;
}

require_once '../../../backend/config/db.php';
require_once '../../../backend/models/AppointmentModel.php';

$doctorName = $_SESSION['doctor_name'];
$appointmentId = $_GET['appointment_id'] ?? null;
$appointment = null;

if ($appointmentId) {
    $appointmentModel = new AppointmentModel();
    $appointments = $appointmentModel->getAppointmentsByDoctorUsername($doctorName);
    foreach ($appointments as $app) {
        if ($app['AppointmentID'] == $appointmentId) {
            $appointment = $app;
            break;
        }
    }
}

if (!$appointment) {
    echo "Invalid appointment ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Prescription | Doctor | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .form-wrapper {
            background: #fff;
            padding: 30px;
            margin-top: 30px;
            border-radius: 5px;
            width: 100%;
        }

        .form-wrapper h3 {
            color: #2f3e9e;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group textarea {
            width: 100%;
            padding: 15px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            min-height: 120px;
        }

        .submit-btn {
            background-color: #2f3e9e;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        .feedback {
            margin: 15px 0;
            font-weight: bold;
            color: red;
        }

        .dashboard-main h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include_once '../../includes/doctor_layout.php'; ?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/doctor_sidebar.php'; ?>

    <div class="dashboard-main">
        <h2>Add Prescription</h2>

        <div class="form-wrapper">
            <h3>Welcome Dr. <?= htmlspecialchars($doctorName) ?>, Prescribe for <?= htmlspecialchars($appointment['FirstName'] . ' ' . $appointment['LastName']) ?></h3>

            <?php if (isset($_SESSION['prescription_error'])): ?>
                <div class="feedback"><?= $_SESSION['prescription_error']; unset($_SESSION['prescription_error']); ?></div>
            <?php elseif (isset($_SESSION['prescription_success'])): ?>
                <div class="feedback" style="color: green;"><?= $_SESSION['prescription_success']; unset($_SESSION['prescription_success']); ?></div>
            <?php endif; ?>

            <form action="../../../backend/routes/add_prescription.php" method="POST">
                <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointmentId) ?>">

                <div class="form-group">
                    <label for="disease">Disease <span style="color:red">*</span></label>
                    <textarea name="disease" id="disease" required></textarea>
                </div>

                <div class="form-group">
                    <label for="allergy">Allergies</label>
                    <textarea name="allergy" id="allergy"></textarea>
                </div>

                <div class="form-group">
                    <label for="prescription">Prescription <span style="color:red">*</span></label>
                    <textarea name="prescription" id="prescription" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Prescription</button>
            </form>
        </div>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>
</body>
</html>
