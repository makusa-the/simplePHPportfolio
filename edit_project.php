<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_project'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    // Update project in database
    $sql = "UPDATE projects SET title='$title', description='$description', link='$link' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$project = mysqli_query($conn, "SELECT * FROM projects WHERE id='$id'");
$project = mysqli_fetch_assoc($project);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Project</h1>
    </header>
    <section id="edit_project_form">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo $project['title']; ?>" required><br>
            <label for="description">Description:</label>
            <textarea name="description" rows="4" required><?php echo $project['description']; ?></textarea><br>
            <label for="link">Link:</label>
            <input type="text" name="link" value="<?php echo $project['link']; ?>" required><br>
            <button type="submit" name="update_project">Update Project</button>
        </form>
    </section>
</body>
</html>
