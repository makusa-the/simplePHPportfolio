<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once './database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare a delete statement
    $sql = "DELETE FROM skills WHERE id=?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Skill deleted successfully, redirect back to admin page
            header("Location: admin.php");
            exit;
        } else {
            echo "Error deleting skill.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing delete statement.";
    }
} else {
    echo "Invalid request.";
}
?>
