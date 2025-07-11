<?php
// filepath: /opt/lampp/htdocs/MODERN_HMS/frontend/includes/patient_layout.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page_title) ? $page_title : 'Patient Dashboard' ?> | MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="dashboard-wrapper">
        <?php require_once 'sidebar.php'; ?>
        <main class="dashboard-main">
            <?php
            // This will include the main content for each page.
            // Example usage in your page: set $content_view = 'views/patient/book_appointment_content.php';
            if (isset($content_view)) {
                include $content_view;
            }
            ?>
        </main>
    </div>
</body>
</html>
