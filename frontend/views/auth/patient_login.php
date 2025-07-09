<?php
// frontend/views/auth/patient_login.php
session_start();
require_once '../../includes/header.php';
require_once '../../includes/nav.php';
?>

<link rel="stylesheet" href="../../assets/css/forms.css">

<div class="form-container">
    <h2>Patient Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="../../../backend/auth/patient_login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required />

        <label>Password:</label>
        <input type="password" name="password" required />

        <button type="submit">Login</button>
    </form>

    <p style="text-align:center;">Don't have an account? <a href="patient_register.php">Register here</a></p>
</div>

<?php require_once '../../includes/footer.php'; ?>
