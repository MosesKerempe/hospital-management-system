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
        <h2>Patient List</h2>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $conn->query("SELECT * FROM PatientRegistration ORDER BY PatientId DESC");
                    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (count($patients) === 0) {
                        echo '<tr><td colspan="6">No patients found.</td></tr>';
                    }
                    foreach ($patients as $i => $patient) {
                        echo '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td>' . htmlspecialchars($patient['FirstName']) . '</td>
                            <td>' . htmlspecialchars($patient['LastName']) . '</td>
                            <td>' . htmlspecialchars($patient['Gender']) . '</td>
                            <td>' . htmlspecialchars($patient['Email']) . '</td>
                            <td>' . htmlspecialchars($patient['Contact']) . '</td>
                        </tr>';
                    }
                } catch (Exception $e) {
                    echo '<tr><td colspan="6" class="error">Error: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<style>
h2 {
    text-align: center;
    color: #2f3e9e;
}
.styled-table {
    width: 90%;
    margin: 30px auto;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}
.styled-table thead {
    background-color: #3a0ca3;
    color: white;
}
.styled-table th, .styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}
.styled-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}
.error {
    color: red;
    text-align: center;
    font-weight: bold;
}
</style>
