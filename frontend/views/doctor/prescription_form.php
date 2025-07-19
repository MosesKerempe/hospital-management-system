<?php
session_start();
require_once '../../../backend/config/db.php';
require_once '../../../backend/models/AppointmentModel.php';

if (!isset($_SESSION['doctor_name'])) {
    header('Location: ../auth/doctor_login.php'); exit;
}

$doctorName = $_SESSION['doctor_name'];
$appointmentId = $_GET['appointment_id'] ?? null;

$appointment = null;
if ($appointmentId) {
    $ams = (new AppointmentModel())->getAppointmentsByDoctorUsername($doctorName);
    foreach ($ams as $a) {
        if ($a['AppointmentID'] == $appointmentId) {
            $appointment = $a;
            break;
        }
    }
}
if (!$appointment) {
    exit('Invalid appointment ID.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Doctor Prescription</title>
<link rel="stylesheet" href="../../assets/css/dashboard.css">
<style>
.form-wrapper{background:#fff;padding:30px;margin:30px auto;border-radius:6px;max-width:600px;}
.form-wrapper label{font-weight:bold;}
.form-wrapper textarea{width:100%;padding:12px;border:1px solid #ccc;border-radius:4px;min-height:120px;}
.submit-btn{display:inline-block;background:#2f3e9e;color:#fff;padding:10px 20px;border:none;border-radius:4px; cursor:pointer;}
.feedback{margin:15px;color:red;font-weight:bold;text-align:center;}
</style>
</head>
<body>
<?php include_once '../../includes/doctor_layout.php'; ?>
<div class="dashboard-wrapper">
<?php include_once '../../includes/doctor_sidebar.php'; ?>
<div class="dashboard-main">
<h2>Prescribe</h2>
<div class="form-wrapper">
    <h3>Dr <?= htmlspecialchars($doctorName) ?> → <?= htmlspecialchars($appointment['FirstName'].' '.$appointment['LastName']) ?></h3>
    <?php if ($_SESSION['prescription_error'] ?? false): ?>
        <div class="feedback"><?= $_SESSION['prescription_error']; unset($_SESSION['prescription_error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="../../../backend/routes/add_prescription.php">
        <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointmentId) ?>">
        <label>Disease*:</label><textarea name="disease" required></textarea>
        <label>Allergy:</label><textarea name="allergy"></textarea>
        <label>Prescription*:</label><textarea name="prescription" required></textarea>
        <button class="submit-btn" type="submit">Submit Prescription</button>
    </form>
</div>
</div></div>
<?php include_once '../../includes/footer.php'; ?>
</body>
</html>