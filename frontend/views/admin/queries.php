<?php
require_once '../../../backend/config/db.php';
require_once '../../../backend/models/QueryModel.php';

$queryModel = new QueryModel($conn);
$queries = $queryModel->getAllQueries();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Queries - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background: #3a0ca3;
            color: white;
        }
    </style>
</head>
<body>
    <?php include_once '../../includes/admin_layout.php'; ?>
    <div class="dashboard-wrapper">
        <?php include_once '../../includes/admin_sidebar.php'; ?>
        <main class="dashboard-main">
            <h2>User Queries</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($queries as $i => $query): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($query['Name']) ?></td>
                            <td><?= htmlspecialchars($query['Email']) ?></td>
                            <td><?= htmlspecialchars($query['Contact']) ?></td>
                            <td><?= htmlspecialchars($query['Message']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
