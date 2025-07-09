<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: ../auth/patient_login.php");
    exit();
}
$patient_name = $_SESSION['patient_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>

    <!-- Top Header -->
    <header class="main-header">
        <div class="header-left">
            <img src="../../assets/images/logo.png" class="logo" alt="Logo">
            <span class="hospital-name">MODERN HMS</span>
        </div>
        <div class="header-right">
            <a href="../../logout/logged_out.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <!-- Dashboard Body -->
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul>
                <li class="active"><span>🔒 Dashboard</span></li>
                <li><a href="book_appointment.php">📅 Book Appointment</a></li>
                <li><a href="appointment_history.php">📖 Appointment History</a></li>
                <li><a href="prescriptions.php">💊 Prescriptions</a></li>
            </ul>
        </aside>

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
