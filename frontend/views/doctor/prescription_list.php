<?php
session_start();
if (!isset($_SESSION['doctor_name'])) {
    header('Location: ../auth/doctor_login.php');
    exit();
}
require_once '../../../backend/controllers/PrescriptionController.php';

$ctrl = new PrescriptionController();
$list = $ctrl->getDoctorPrescriptions($_SESSION['doctor_name']);
?>

<?php include_once '../../includes/doctor_layout.php'; ?>

  <h2>My Prescriptions</h2>

  <style>
    .presc-table {
      width:100%; border-collapse:collapse; margin-top:20px; background:#fff;
    }
    .presc-table th, .presc-table td {
      border:1px solid #ddd; padding:8px; text-align:center;
    }
    .presc-table th { background:#2f3e9e; color:#fff; }
    .success {
      background:#d4edda; color:#155724;
      padding:10px; border-radius:4px; margin-bottom:10px;
    }
  </style>

  <?php if (!empty($_GET['success'])): ?>
    <div class="success">Prescription saved successfully.</div>
  <?php endif; ?>

  <table class="presc-table">
    <thead>
      <tr>
        <th>#</th><th>Patient</th><th>Date</th><th>Time</th>
        <th>Disease</th><th>Allergy</th><th>Prescription</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($list)): ?>
        <tr><td colspan="7">No prescriptions yet.</td></tr>
      <?php else: foreach ($list as $i => $p): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= htmlspecialchars("{$p['FirstName']} {$p['LastName']}") ?></td>
          <td><?= htmlspecialchars($p['AppointmentDate']) ?></td>
          <td><?= htmlspecialchars(substr($p['AppointmentTime'],0,5)) ?></td>
          <td><?= htmlspecialchars($p['Disease']) ?></td>
          <td><?= htmlspecialchars($p['Allergy']) ?></td>
          <td><?= htmlspecialchars($p['Prescription']) ?></td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>

<?php include_once '../../includes/footer.php'; ?>
</body>
</html>
