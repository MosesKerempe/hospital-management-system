<?php
session_start();
require_once '../../../backend/config/db.php';
require_once '../../includes/header.php';
require_once '../../includes/nav.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM doctors WHERE UserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();

    if ($doctor && $password === $doctor['Password']) {
        $_SESSION['doctor_username'] = $doctor['UserName'];
        $_SESSION['doctor_id'] = $doctor['id'];
        header("Location: ../doctor/dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!-- ✅ Internal CSS styles -->
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
        min-height: 80vh;
        background-color: #f0f4f7;
    }

    .login-form-box {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 35px;
        max-width: 420px;
        width: 100%;
    }

    .form-title {
        text-align: center;
        margin-bottom: 25px;
        font-size: 26px;
        color: #2c3e50;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 15px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0069d9;
    }

    .error-message {
        color: red;
        margin-bottom: 15px;
        text-align: center;
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
    }

    .back-link {
        color: #007bff;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<!-- ✅ Doctor Login Form -->
<div class="login-container">
    <div class="login-form-box">
        <h2 class="form-title">Doctor Login</h2>

        <?php if ($error): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn-submit">Login</button>
        </form>

        <div class="form-footer">
            <a href="../../views/home/index.php" class="back-link">← Back to Home</a>

        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
