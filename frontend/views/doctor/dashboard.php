<?php
session_start();
if (!isset($_SESSION['doctor_email'])) {
    header("Location: ../auth/doctor_login.php");
    exit();
}

$doctorName = $_SESSION['doctor_name'] ?? 'Doctor';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        header.main-header {
            background: #2f3e9e;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            height: 40px;
        }

        .hospital-name {
            font-size: 20px;
            font-weight: bold;
            margin-left: 10px;
        }

        .logout-btn {
            color: white;
            font-weight: bold;
            text-decoration: none;
            background: crimson;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .dashboard-wrapper {
            display: flex;
        }

        .sidebar {
            background-color: #2f3e9e;
            padding: 20px;
            width: 220px;
            min-height: calc(100vh - 65px);
            color: white;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: 10px;
            background: transparent;
            border-radius: 4px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3c4eff;
        }

        .dashboard-main {
            flex: 1;
            padding: 30px;
        }

        .dashboard-main h2 {
            color: #2f3e9e;
            margin-bottom: 30px;
        }

       .card-group {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 40px;
    padding-left: 20px; /* Adds spacing from sidebar */
}

        .card {
            width: 220px;
            background-color: #fff;
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .card a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header/Navbar -->
    <header class="main-header">
        <div class="header-left">
            <img src="../../assets/images/logo.png" class="logo" alt="Hospital Logo">
            <span class="hospital-name">MODERN HMS - Doctor</span>
        </div>
        <div class="header-right">
            <a href="../home/index.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <!-- Main Content with Sidebar -->
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="appointments.php">Appointments</a></li>
                <li><a href="prescription_list.php">Prescription List</a></li>
            </ul>
        </div>

        <!-- Main Dashboard -->
        <div class="dashboard-main">
            <h2>Welcome Dr. <?= htmlspecialchars($doctorName); ?></h2>

            <div class="card-group">
                <div class="card">
                    <img src="../../assets/images/appointment-icon.png" alt="Appointments">
                    <h3>View Appointments</h3>
                    <a href="appointments.php">Appointment List</a>
                </div>

                <div class="card">
                    <img src="../../assets/images/prescription-icon.png" alt="Prescriptions">
                    <h3>Prescriptions</h3>
                    <a href="prescription_list.php">Prescription List</a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../../includes/footer.php'; ?>
</body>
</html>
