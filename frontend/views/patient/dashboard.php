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
    <style>
        /* Optional: style for dynamic content area */
        #dashboard-content {
            margin-top: 30px;
        }
    </style>
    <script>
    // Load content dynamically into dashboard-content div
    function loadDashboardContent(page) {
        const contentDiv = document.getElementById('dashboard-content');
        contentDiv.innerHTML = '<div style="text-align:center;padding:40px;">Loading...</div>';
        fetch(page)
            .then(response => response.text())
            .then(html => {
                contentDiv.innerHTML = html;
            })
            .catch(() => {
                contentDiv.innerHTML = '<div style="color:red;text-align:center;">Failed to load content.</div>';
            });
    }

    // Optional: highlight active sidebar link
    function setActiveSidebar(link) {
        document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
        link.parentElement.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Attach click handlers to sidebar links
        document.querySelectorAll('.sidebar ul li a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                loadDashboardContent(this.getAttribute('href'));
                setActiveSidebar(this);
            });
        });

        // Attach click handlers to dashboard cards
        document.querySelectorAll('.card a.btn').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                loadDashboardContent(this.getAttribute('href'));
                // Optionally highlight sidebar
                const sidebarLink = document.querySelector('.sidebar ul li a[href="' + this.getAttribute('href') + '"]');
                if (sidebarLink) setActiveSidebar(sidebarLink);
            });
        });
    });
    </script>
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
            <!-- Dynamic content area -->
            <div id="dashboard-content"></div>
        </main>
    </div>
</body>
</html>
