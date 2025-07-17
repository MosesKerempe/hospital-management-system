<?php
// frontend/includes/doctor_sidebar.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<aside class="sidebar" style="
    width:220px;
    background:#2f3e9e;
    color:white;
    padding-top:20px;
">
  <ul style="list-style:none; margin:0; padding:0;">
    <li style="padding:12px 20px;"><a href="/MODERN_HMS/frontend/views/doctor/dashboard.php" style="color:white; text-decoration:none;">Dashboard</a></li>
    <li style="padding:12px 20px;"><a href="/MODERN_HMS/frontend/views/doctor/appointments.php" style="color:white; text-decoration:none;">Appointments</a></li>
    <li style="padding:12px 20px;"><a href="/MODERN_HMS/frontend/views/doctor/prescription_list.php" style="color:white; text-decoration:none;">My Prescriptions</a></li>
  </ul>
</aside>
