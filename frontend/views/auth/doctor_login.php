<?php
session_start();
require_once '../../../backend/config/db.php';

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']); // clear after use
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/forms.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <style>
        .login-container {
            width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #3a0ca3;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-login {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #3a0ca3;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #2f3e9e;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        main {
            padding-bottom: 50px;
        }
    </style>
</head>
<body>

    <!-- ✅ Include Navbar/Header -->
    <?php include_once '../../includes/nav.php'; ?>
    <?php include_once '../../includes/header.php'; ?>

    <!-- Login Form -->
    <main>
        <div class="login-container">
            <h2>Doctor Login</h2>

            <form action="../../../backend/auth/doctor_login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <?php if (!empty($error)) : ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <a href="../home/index.php" class="back-link">← Back to Home</a>
        </div>
    </main>

    <!-- ✅ Include Footer -->
    <?php include_once '../../includes/footer.php'; ?>

</body>
</html>
