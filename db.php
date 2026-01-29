<?php
$conn = new mysqli("localhost", "rfiduser", "rfid123", "rfid_attendance");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>

