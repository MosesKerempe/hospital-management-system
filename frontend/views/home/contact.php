<?php
$success = isset($_GET['success']);
$error = isset($_GET['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - MODERN HMS</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #2f3e9e;
            margin-bottom: 30px;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            resize: vertical;
        }

        .contact-form button {
            background: #2f3e9e;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact-form button:hover {
            background: #2196f3;
        }

        .message {
            text-align: center;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <!-- ✅ Include the same header/navbar as in the homepage -->
    <?php include_once '../../includes/header.php'; ?>
<?php include_once '../../includes/nav.php'; ?>
    <div class="contact-container">
        <h2>Contact Us</h2>

        <?php if ($success): ?>
            <div class="message success">Thank you! Your message has been sent.</div>
        <?php elseif ($error): ?>
            <div class="message error">Oops! Something went wrong. Please try again.</div>
        <?php endif; ?>

        <form action="/MODERN_HMS/backend/routes/submit_query.php" method="POST" class="contact-form">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="contact" placeholder="Your Phone Number" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit" name="submit_query">Send Message</button>
        </form>
    </div>

    <!-- ✅ Include the same footer as in the homepage -->
    <?php include_once '../../includes/footer.php'; ?>

</body>
</html>
