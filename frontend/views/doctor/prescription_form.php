<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['doctor_name'], $_SESSION['doctor_id'])) {
    header('Location: ../auth/doctor_login.php');
    exit();
}

require_once '../../../backend/config/db.php';

$appointment_id = $_GET['appointment_id'] ?? null;
if (!$appointment_id) {
    $error = "No appointment specified.";
} else {
    try {
        $stmt = $conn->prepare("
            SELECT PatientID, FirstName, LastName, AppointmentDate, AppointmentTime
            FROM Appointment
            WHERE ID = :id
        ");
        $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
        $stmt->execute();
        $appt = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$appt) {
            throw new Exception("Appointment not found.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<?php include_once '../../includes/doctor_layout.php'; ?>

    <h2>Welcome, Dr. <?= htmlspecialchars($_SESSION['doctor_name']) ?></h2>
    <?php if (!empty($appt)): ?>
      <h3>Prescribe for <?= htmlspecialchars("{$appt['FirstName']} {$appt['LastName']}") ?></h3>
    <?php endif; ?>

    <style>
      .form-wrapper {
        max-width: 700px;
        margin: 30px auto;
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      }
      .form-group { margin-bottom: 20px; }
      label { display: block; margin-bottom: 8px; font-weight: 600; }
      input[type="text"], textarea {
        width: 100%;
        padding: 12px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        resize: vertical;
      }
      textarea { min-height: 140px; }
      .error-msg {
        background: #f8d7da;
        color: #842029;
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
      }
      .btn-submit {
        padding: 12px 20px;
        background: #28a745;
        color: white;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.2s;
      }
      .btn-submit:hover {
        background: #218838;
      }
    </style>

    <?php if (!empty($error)): ?>
      <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php else: ?>
      <div class="form-wrapper">
        <form action="../../../backend/routes/add_prescription.php" method="POST">
          <input type="hidden" name="appointment_id"   value="<?= $appointment_id ?>">
          <input type="hidden" name="patient_id"       value="<?= htmlspecialchars($appt['PatientID']) ?>">
          <input type="hidden" name="first_name"       value="<?= htmlspecialchars($appt['FirstName']) ?>">
          <input type="hidden" name="last_name"        value="<?= htmlspecialchars($appt['LastName']) ?>">
          <input type="hidden" name="date"             value="<?= htmlspecialchars($appt['AppointmentDate']) ?>">
          <input type="hidden" name="time"             value="<?= htmlspecialchars($appt['AppointmentTime']) ?>">

          <div class="form-group">
            <label for="disease">Disease</label>
            <input id="disease" name="disease" type="text" required>
          </div>

          <div class="form-group">
            <label for="allergy">Allergy</label>
            <input id="allergy" name="allergy" type="text" required>
          </div>

          <div class="form-group">
            <label for="prescription">Prescription</label>
            <textarea id="prescription" name="prescription" required></textarea>
          </div>

          <button type="submit" class="btn-submit">Submit Prescription</button>
        </form>
      </div>
    <?php endif; ?>

  </main>
</div>

<?php include_once '../../includes/footer.php'; ?>
</body>
</html>
