<?php
$host = 'localhost';
$dbname = 'mock_interview'; // Database name
$username = 'root'; // MySQL username
$password = ''; // MySQL password

// Create connection using MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
