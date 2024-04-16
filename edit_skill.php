<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_skill'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    // Update skill in database
    $sql = "UPDATE skills SET name='$name', level='$level' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$skill = mysqli_query($conn, "SELECT * FROM skills WHERE id='$id'");
$skill = mysqli_fetch_assoc($skill);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Skill</h1>
    </header>
    <section id="edit_skill_form">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $skill['name']; ?>" required><br>
            <label for="level">Level:</label>
            <input type="number" name="level" value="<?php echo $skill['level']; ?>" min="1" max="10" required><br>
            <button type="submit" name="update_skill">Update Skill</button>
        </form>
    </section>
</body>
</html>
