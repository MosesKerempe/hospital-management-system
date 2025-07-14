<?php
include_once '../../includes/header.php';
include_once '../../includes/nav.php';
?>

<style>
    .login-container {
        width: 400px;
        margin: 100px auto;
        padding: 30px;
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #f5f5f5;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .login-container label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #999;
        border-radius: 5px;
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #2e86de;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #2e86de;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h2>Login as Admin</h2>
    <form method="POST" action="../../../backend/auth/admin_login.php">
        <label>Username</label>
        <input type="text" name="username" required />

        <label>Password</label>
        <input type="password" name="password" required />

        <button type="submit">Login</button>
    </form>

    <a href="/MODERN_HMS/frontend/views/home/index.php" class="back-link">← Back to Home</a>
</div>

<?php
include_once '../../includes/footer.php';
?>
