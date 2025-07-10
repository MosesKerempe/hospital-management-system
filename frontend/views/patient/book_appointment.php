<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Redirect if not logged in
if (!isset($_SESSION['patient_id'])) {
    header('Location: ../../auth/patient_login.php');
    exit();
}

// DB connection
require_once '../../../backend/config/db.php';

try {
    // Fetch specializations
    $sql = "SELECT DISTINCT Specialization FROM Doctors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $specializations = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "<div style='color:red; padding:20px;'>Database error: " . htmlspecialchars($e->getMessage()) . "</div>";
    $specializations = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #34495e;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #333;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 25px;
            padding: 12px;
            width: 100%;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
    </style>
    <script>
    function fetchDoctorsBySpecialization(specialization) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../../backend/routes/get_doctors.php?specialization=" + encodeURIComponent(specialization), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const doctorDropdown = document.getElementById("doctor");
                const feeField = document.getElementById("doctor_fee");

                doctorDropdown.innerHTML = "";
                response.forEach(doctor => {
                    const option = document.createElement("option");
                    option.value = doctor.UserName;
                    option.text = doctor.UserName;
                    option.setAttribute("data-fee", doctor.DoctorFees);
                    doctorDropdown.appendChild(option);
                });

                // Auto set first doctor fee
                if (response.length > 0) {
                    feeField.value = response[0].DoctorFees;
                } else {
                    feeField.value = '';
                }
            }
        };
        xhr.send();
    }

    function updateFee() {
        const doctorSelect = document.getElementById("doctor");
        const selected = doctorSelect.options[doctorSelect.selectedIndex];
        document.getElementById("doctor_fee").value = selected ? (selected.getAttribute("data-fee") || '') : '';
    }
    </script>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar Only -->
        <?php require_once '../../includes/sidebar.php'; ?>
        <!-- Main Content -->
        <main class="dashboard-main">
            <div class="form-container">
                <h3>Book My Appointment</h3>
                <form action="../../../backend/routes/book_appointment.php" method="POST">
                    <label for="specialization">Specialization:</label>
                    <select name="specialization" id="specialization" required onchange="fetchDoctorsBySpecialization(this.value)">
                        <option value="">-- Select Specialization --</option>
                        <?php foreach ($specializations as $spec): ?>
                            <option value="<?= htmlspecialchars($spec) ?>"><?= htmlspecialchars($spec) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="doctor">Doctor:</label>
                    <select name="doctor" id="doctor" required onchange="updateFee()">
                        <option value="">-- Select Doctor --</option>
                    </select>

                    <label for="doctor_fee">Consultancy Fees:</label>
                    <input type="text" id="doctor_fee" name="doctor_fee" readonly placeholder="Select a doctor">

                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" name="appointment_date" required min="<?= date('Y-m-d') ?>">

                    <label for="appointment_time">Appointment Time:</label>
                    <select name="appointment_time" required>
                        <option value="08:00:00">8:00 AM</option>
                        <option value="10:00:00">10:00 AM</option>
                        <option value="12:00:00">12:00 PM</option>
                        <option value="14:00:00">2:00 PM</option>
                        <option value="16:00:00">4:00 PM</option>
                    </select>

                    <button type="submit">Create New Entry</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
