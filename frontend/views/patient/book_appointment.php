<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}
require_once '../../../backend/config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/forms.css">
    <script src="../../scripts/appointment.ts" defer></script>
</head>
<body>
    <div class="form-container">
        <h2>Book an Appointment</h2>
        <form action="../../../backend/routes/book_appointment.php" method="POST" id="appointmentForm">
            <input type="hidden" name="patient_id" value="<?= $_SESSION['patient_id'] ?>">

            <label for="specialization">Doctor Specialization:</label>
            <select name="specialization" id="specialization" required>
                <option value="">-- Select Specialization --</option>
                <!-- Filled dynamically via JS -->
            </select>

            <label for="doctor">Doctor:</label>
            <select name="doctor" id="doctor" required>
                <option value="">-- Select Doctor --</option>
                <!-- Filled dynamically -->
            </select>

            <label for="fees">Consultancy Fees (KSh):</label>
            <input type="text" id="fees" name="fees" readonly>

            <label for="date">Appointment Date:</label>
            <input type="date" id="date" name="date" required min="<?= date('Y-m-d') ?>">

            <label for="time">Time Slot:</label>
            <select name="time" id="time" required>
                <option value="">-- Select Time --</option>
                <option value="08:00:00">8:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="12:00:00">12:00 PM</option>
                <option value="14:00:00">2:00 PM</option>
                <option value="16:00:00">4:00 PM</option>
            </select>

            <button type="submit" name="book_appointment">Book Appointment</button>
        </form>
    </div>
</body>
</html>
