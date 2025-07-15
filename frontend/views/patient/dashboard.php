<?php
session_start();

// Show error messages during development (optional, remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
if (!isset($_SESSION['patient_id'])) {
    header("Location: ../auth/patient_login.php");
    exit();
}

$patient_name = $_SESSION['patient_name']; // Coming from session after login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .dashboard-main h2 {
            color: #2f3e9e;
            text-align: center;
            margin: 20px 0;
        }
        .card-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 60px;
            height: 60px;
        }
        .card h3 {
            margin: 15px 0;
            color: #34495e;
        }
        .btn {
            display: inline-block;
            background: #3a0ca3;
            color: #fff;
            padding: 10px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #2196f3;
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <header class="main-header">
        <div class="header-left">
            <img src="../../assets/images/logo.png" class="logo" alt="Logo">
            <span class="hospital-name">MODERN HMS</span>
        </div>
        <div class="header-right">
            <!-- ✅ Updated logout path -->
            <a href="../../views/home/" class="logout-btn">Logout</a>
        </div>
    </header>

    <!-- Dashboard Body -->
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <?php require_once '../../includes/sidebar.php'; ?>

        <!-- Main Section -->
        <main class="dashboard-main">
            <h2>Welcome, <?php echo htmlspecialchars($patient_name); ?>!</h2>

            <div class="card-group">
                <div class="card">
                    <img src="../../assets/images/calendar-icon.png" alt="Book Icon" />
                    <h3>Book My Appointment</h3>
                    <a href="book_appointment.php" class="btn">Click to Book</a>
                </div>
                <div class="card">
                    <img src="../../assets/images/history-icon.png" alt="History Icon" />
                    <h3>My Appointments</h3>
                    <a href="appointment_history.php" class="btn">View History</a>
                </div>
                <div class="card">
                    <img src="../../assets/images/prescription-icon.png" alt="Prescription Icon" />
                    <h3>Prescriptions</h3>
                    <a href="prescriptions.php" class="btn">View Prescriptions</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
