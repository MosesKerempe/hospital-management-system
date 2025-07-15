<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_query'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $message = $_POST['message'] ?? '';

    try {
        $stmt = $conn->prepare("INSERT INTO Contact (Name, Email, Contact, Message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $contact, $message]);
        header("Location: /MODERN_HMS/frontend/views/home/contact.php?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: /MODERN_HMS/frontend/views/home/contact.php?error=1");
        exit();
    }
}
