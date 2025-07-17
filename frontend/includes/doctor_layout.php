<?php
// frontend/includes/doctor_layout.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Doctor Panel – MODERN HMS</title>
  <link rel="stylesheet" href="/MODERN_HMS/frontend/assets/css/dashboard.css">
  <style>
    /* Reset and layout */
    body, html { margin:0; padding:0; height:100%; }
    .main-header {
      background: linear-gradient(to right, #3a0ca3, #2196f3);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      height: 60px;
    }
    .dashboard-wrapper {
      display: flex;
      min-height: calc(100% - 60px); /* below header */
    }
    .dashboard-main {
      flex: 1;
      padding: 20px;
      background: #f4f6f9;
    }
  </style>
</head>
<body>
  <header class="main-header">
    <div class="header-left">
      <img src="/MODERN_HMS/frontend/assets/images/logo.png" class="logo" style="height:40px;" alt="Logo">
      <span class="hospital-name" style="margin-left:10px; font-size:1.2rem;">MODERN HMS – Doctor</span>
    </div>
    <div class="header-right">
      <a href="/MODERN_HMS/frontend/views/home/index.php" class="logout-btn" style="
        padding:8px 16px; background:#ff5858; color:white; border-radius:4px; text-decoration:none;
      ">Logout</a>
    </div>
  </header>

  <div class="dashboard-wrapper">
    <?php include_once __DIR__ . '/doctor_sidebar.php'; ?>
    <main class="dashboard-main">
