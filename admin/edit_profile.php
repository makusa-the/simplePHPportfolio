<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once './database/db_connect.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form submission
    $password = $_POST['password'];
    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Update password in database
    $sql = "UPDATE users SET password=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $hashed_password, $username);
    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Password update failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Profile</h1>
    </header>
    <section id="edit_profile_form">
        <form action="" method="POST">
            <label for="password">New Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Update Password</button>
        </form>
        <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
        <?php endif; ?>
    </section>
</body>
</html>
