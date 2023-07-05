<?php
// Database Connection
$conn = new mysqli('localhost', 'root', '1234', 'foodengine');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
?>
