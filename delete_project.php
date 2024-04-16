<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once 'db_connect.php';

$id = $_GET['id'];
// Delete project from database
$sql = "DELETE FROM projects WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    header('Location: admin.php');
    exit;
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
