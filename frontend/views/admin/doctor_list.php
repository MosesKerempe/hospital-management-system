<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../../backend/config/db.php';
include_once '../../includes/admin_layout.php';
?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/admin_sidebar.php'; ?>
    <div class="dashboard-main">
        <h2>Doctor List</h2>

        <?php if(isset($_GET['success'])): ?>
            <p class="msg success">Doctor deleted successfully.</p>
        <?php endif; ?>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th><th>Username</th><th>Email</th><th>Specialization</th><th>Fees (Ksh)</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $conn->query("SELECT * FROM Doctors ORDER BY id DESC");
                    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (count($doctors) === 0) {
                        echo '<tr><td colspan="6">No doctors found.</td></tr>';
                    }
                    foreach ($doctors as $i => $doc) {
                        echo '<tr>
                            <td>'.($i+1).'</td>
                            <td>'.htmlspecialchars($doc['UserName']).'</td>
                            <td>'.htmlspecialchars($doc['Email']).'</td>
                            <td>'.htmlspecialchars($doc['Specialization']).'</td>
                            <td>'.htmlspecialchars($doc['DoctorFees']).'</td>
                            <td><a class="btn-delete" href="delete_doctor.php?id='.$doc['id'].'" onclick="return confirm(\'Delete this doctor?\')">Delete</a></td>
                        </tr>';
                    }
                } catch (Exception $e) {
                    echo '<tr><td colspan="6" class="error">Error: '.$e->getMessage().'</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<style>
.h2 { text-align: center; }
.msg.success { color: green; font-weight: bold; margin: 15px auto; text-align: center; }
.styled-table {
    width: 90%; margin: 20px auto; border-collapse: collapse; font-family: Arial, sans-serif;
}
.styled-table thead tr {
    background: #3a0ca3; color: white; text-align: left;
}
.styled-table th, .styled-table td {
    padding: 12px 15px; border: 1px solid #ddd;
}
.styled-table tbody tr:nth-of-type(even) {
    background: #f3f3f3;
}
.btn-delete {
    color: white;
    background: #e74c3c;
    padding: 6px 10px;
    border-radius: 4px;
    text-decoration: none;
}
.btn-delete:hover {
    background: #c0392b;
}
.error { color: red; font-weight: bold; text-align: center; }
</style>
