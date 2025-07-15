<?php
require_once '../../includes/admin_layout.php';
require_once '../../../backend/controllers/appointments.php';

$controller = new AppointmentController();
$appointments = $controller->getAppointments();
?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/admin_sidebar.php'; ?>

    <div class="dashboard-main">
        <h2>Appointment Details</h2>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Doctor</th>
                    <th>Fees</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User Status</th>
                    <th>Doctor Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($appointments) === 0): ?>
                    <tr>
                        <td colspan="11" style="text-align:center;">No appointments found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($appointments as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                            <td><?= htmlspecialchars($row['Gender']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['Contact']) ?></td>
                            <td><?= htmlspecialchars($row['Doctor']) ?></td>
                            <td><?= htmlspecialchars($row['DoctorFees']) ?></td>
                            <td><?= htmlspecialchars($row['AppointmentDate']) ?></td>
                            <td><?= htmlspecialchars($row['AppointmentTime']) ?></td>
                            <td><?= htmlspecialchars($row['UserStatus']) ?></td>
                            <td><?= htmlspecialchars($row['DoctorStatus']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<!-- ✅ Styles -->
<style>
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        background-color: #fff;
        font-size: 15px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .styled-table th {
        background-color: #2f3e9e;
        color: #fff;
    }

    .styled-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .dashboard-main h2 {
        margin-top: 20px;
        color: #2f3e9e;
    }
</style>
