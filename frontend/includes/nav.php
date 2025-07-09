<!-- /frontend/includes/nav.php -->
<nav style="background-color: #007bff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <div class="logo" style="color: white; font-weight: bold; font-size: 22px;">
        <img src="../../assets/images/logo.png" alt="Logo" style="height: 40px; vertical-align: middle; margin-right: 10px;">
        Modern Hospital
    </div>

    <ul style="list-style: none; display: flex; gap: 25px; margin: 0;">
        <li><a href="../../views/home/index.php" style="color: white; font-size: 18px; text-decoration: none;">Home</a></li>
        <li><a href="../../views/home/about.php" style="color: white; font-size: 18px; text-decoration: none;">About</a></li>
        <li><a href="../../views/home/services.php" style="color: white; font-size: 18px; text-decoration: none;">Services</a></li>
        <li><a href="../../views/home/contact.php" style="color: white; font-size: 18px; text-decoration: none;">Contact</a></li>
    </ul>

    <div class="nav-buttons" style="display: flex; gap: 15px;">
        <a href="../../views/auth/patient_register.php">
            <button style="background-color: #28a745; color: white; padding: 8px 16px; border: none; border-radius: 5px;">Patient</button>
        </a>
        <a href="../../views/auth/doctor_login.php">
            <button style="background-color: #ffc107; color: white; padding: 8px 16px; border: none; border-radius: 5px;">Doctor</button>
        </a>
        <a href="../../views/auth/admin_login.php">
            <button style="background-color: #dc3545; color: white; padding: 8px 16px; border: none; border-radius: 5px;">Receptionist</button>
        </a>
    </div>
</nav>
