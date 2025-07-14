<?php
session_start();
require_once '../../backend/config/db.php';
require_once '../../backend/helpers/auth_helper.php';

checkDoctorLogin(); // ensure doctor is logged in
$doctorUsername = $_SESSION['doctor_username'];

$query = "SELECT * FROM appointments WHERE Doctor = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $doctorUsername);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include('../includes/doctor_layout.php'); ?>

<div class="container">
    <h2 class="mt-4">My Appointments</h2>
    <table class="table table-striped mt-3">
        <thead class="thead-dark">
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['ID']) ?></td>
                <td><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Contact']) ?></td>
                <td><?= htmlspecialchars($row['AppointmentDate']) ?></td>
                <td><?= htmlspecialchars($row['AppointmentTime']) ?></td>
                <td><?= htmlspecialchars($row['UserStatus'] === '1' && $row['DoctorStatus'] === '1' ? 'Active' : 'Cancelled') ?></td>
                <td>
                    <form action="../../backend/routes/cancel_appointment.php" method="POST">
                        <input type="hidden" name="appointment_id" value="<?= $row['ID'] ?>">
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Cancel this appointment?')">Cancel</button>
                    </form>
                </td>
                <td>
                    <form action="prescription_form.php" method="GET">
                        <input type="hidden" name="appointment_id" value="<?= $row['ID'] ?>">
                        <button class="btn btn-success btn-sm">Prescribe</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
