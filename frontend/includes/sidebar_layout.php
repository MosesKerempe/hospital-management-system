<?php
// Minimal layout with only the sidebar and main content area
?>
<link rel="stylesheet" href="../../assets/css/dashboard.css">

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <?php require_once 'sidebar.php'; ?>
    <!-- Main Content Area -->
    <main class="dashboard-main">
        <?php
        // This will include the main content for each page.
        // Example usage: set $content_view = 'views/patient/book_appointment_content.php';
        if (isset($content_view)) {
            include $content_view;
        }
        ?>
    </main>
</div>