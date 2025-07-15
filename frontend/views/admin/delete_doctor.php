<?php
require_once '../../../backend/config/db.php';
session_start();

// Fetch all doctors
$stmt = $conn->query("SELECT id, UserName, Specialization, DoctorFees FROM Doctors");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Doctor</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #3a0ca3;
            color: white;
        }
        .btn-delete {
            padding: 6px 10px;
            background-color: crimson;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <?php require_once '../../includes/admin_sidebar.php'; ?>

    <main class="dashboard-main">
        <h2>Delete Doctor</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Specialization</th>
                    <th>Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="doctor-table-body">
                <?php foreach ($doctors as $doc): ?>
                <tr id="row-<?= $doc['id'] ?>">
                    <td><?= $doc['id'] ?></td>
                    <td><?= htmlspecialchars($doc['UserName']) ?></td>
                    <td><?= htmlspecialchars($doc['Specialization']) ?></td>
                    <td><?= htmlspecialchars($doc['DoctorFees']) ?></td>
                    <td>
                        <button class="btn-delete" onclick="deleteDoctor(<?= $doc['id'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script>
    function deleteDoctor(id) {
        if (!confirm('Are you sure you want to delete this doctor?')) return;

        fetch('../../../backend/routes/delete_doctor.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id=${id}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`row-${id}`).remove();
                alert('Doctor deleted successfully.');
            } else {
                alert('Error: ' + data.error);
            }
        });
    }
    </script>
</body>
</html>
