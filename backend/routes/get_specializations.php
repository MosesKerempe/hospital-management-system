<?php
require_once '../config/db.php';
$stmt = $conn->query("SELECT DISTINCT Specialization FROM Doctors");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='{$row['Specialization']}'>{$row['Specialization']}</option>";
}
