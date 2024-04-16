<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = 'M25872.db';
$database = 'my_portfolio';

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
