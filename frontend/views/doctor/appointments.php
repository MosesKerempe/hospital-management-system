<?php
session_start();
if (!isset($_SESSION['doctor_name'], $_SESSION['doctor_id'])) {
    header('Location: ../auth/doctor_login.php');
    exit();
}
require_once '../../../backend/models/AppointmentModel.php';
require_once '../../../backend/config/db.php';

$model = new AppointmentModel();
$error = '';
try {
    $appointments = $model->getAppointmentsByDoctorUsername($_SESSION['doctor_name']);
} catch (Throwable $e) {
    $appointments = [];
    $error = $e->getMessage();
}
?>

<?php include_once '../../includes/doctor_layout.php'; ?>

    <h2>My Appointments</h2>

    <style>
      .appointments-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
      }
      .appointments-table th,
      .appointments-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
      }
      .appointments-table th {
        background: #2f3e9e;
        color: white;
      }
      .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
      }
      .btn-cancel {
        background: #f44336; color: white;
      }
      .btn-cancel:hover {
        background: #d32f2f;
      }
      .btn-prescribe {
        background: #28a745; color: white;
      }
      .btn-prescribe:hover {
        background: #218838;
      }
      .error-msg {
        color: red;
        margin: 20px 0;
        text-align: center;
      }
    </style>

    <?php if ($error): ?>
      <div class="error-msg">Error: <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table class="appointments-table">
      <thead>
        <tr>
          <th>#</th><th>Patient Name</th><th>Gender</th><th>Email</th>
          <th>Contact</th><th>Doctor</th><th>Fees</th><th>Date</th>
          <th>Time</th><th>User Status</th><th>Doctor Status</th>
          <th>Action</th><th>Prescribe</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($appointments)): ?>
          <tr><td colspan="13">No appointments found.</td></tr>
        <?php else: foreach ($appointments as $i => $a): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= htmlspecialchars("$a[FirstName] $a[LastName]") ?></td>
            <td><?= htmlspecialchars($a['Gender']) ?></td>
            <td><?= htmlspecialchars($a['Email']) ?></td>
            <td><?= htmlspecialchars($a['Contact']) ?></td>
            <td><?= htmlspecialchars($a['Doctor']) ?></td>
            <td><?= htmlspecialchars($a['DoctorFees']) ?></td>
            <td><?= htmlspecialchars($a['AppointmentDate']) ?></td>
            <td><?= htmlspecialchars(substr($a['AppointmentTime'],0,5)) ?></td>
            <td><?= htmlspecialchars($a['UserStatus']) ?></td>
            <td><?= htmlspecialchars($a['DoctorStatus']) ?></td>
            <td>
              <form action="../../../backend/routes/cancel_appointment.php" method="POST">
                <input type="hidden" name="appointment_id" value="<?= $a['AppointmentID'] ?>">
                <button class="btn btn-cancel">Cancel</button>
              </form>
            </td>
            <td>
              <form action="prescription_form.php" method="GET">
                <input type="hidden" name="appointment_id" value="<?= $a['AppointmentID'] ?>">
                <button class="btn btn-prescribe">Prescribe</button>
              </form>
            </td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>

  </main>            <!-- close dashboard-main -->
</div>               <!-- close dashboard-wrapper -->

<?php include_once '../../includes/footer.php'; ?>
</body>
</html>
