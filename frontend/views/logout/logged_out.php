<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #2f3e9e, #00bfff);
            color: white;
            text-align: center;
            padding-top: 150px;
        }

        .logout-box {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            background: none;
            color: white;
            padding: 10px 20px;
            border: 1px solid white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="logout-box">You have logged out.</div>
    <a href="../auth/patient_login.php" class="btn">Back to Login Page</a>
</body>
</html>
