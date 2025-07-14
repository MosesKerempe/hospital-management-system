<?php
// ✅ Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Start session
session_start();

// ✅ Include DB
require_once '../config/db.php'; // assumes $conn is a PDO instance

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // ✅ Prepare PDO query
        $stmt = $conn->prepare("SELECT * FROM Admin WHERE Username = :username AND Password = :password");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $_SESSION['admin'] = $admin['Username'];

            echo "<script>
                alert('✅ Login Successful!');
                window.location.href = '../../frontend/views/admin/dashboard.php';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('❌ Invalid username or password!');
                window.location.href = '../../frontend/views/auth/admin_login.php';
            </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "❌ Database Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: ../../frontend/views/auth/admin_login.php");
    exit();
}
