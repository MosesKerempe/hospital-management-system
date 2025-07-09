<?php
// Database configuration
$host = "localhost";
$dbname = "modern_hms";
$username = "root";        // Default for XAMPP
$password = "";            // Default is empty

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set charset
    $conn->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
