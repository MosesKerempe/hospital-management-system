<?php
// frontend/includes/patient_layout.php
require_once 'header.php';
require_once 'nav.php';
require_once 'sidebar.php'; // optional
?>

<link rel="stylesheet" href="../../assets/css/dashboard.css">

<div class="dashboard-wrapper">
    <!-- Sidebar (if not already included in sidebar.php) -->
    <?php
    // If sidebar.php outputs the sidebar, you can remove the next line.
    // require_once 'sidebar.php';
    ?>
    <!-- Main Content Area -->
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
