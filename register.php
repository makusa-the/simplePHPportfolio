<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: admin.php');
    exit;
}

include_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate registration form
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Check if username already exists
    $sql = "SELECT id FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error = 'Username already exists';
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            $error = 'Registration failed';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <section id="register_form">
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
        <?php endif; ?>
    </section>
</body>
</html>
