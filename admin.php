<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once 'db_connect.php';

// Handle form submissions to add new project
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    // Add project to database
    $sql = "INSERT INTO projects (title, description, link) VALUES ('$title', '$description', '$link')";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Handle form submissions to add new skill
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_skill'])) {
    $name = $_POST['name'];
    $level = $_POST['level'];
    // Add skill to database
    $sql = "INSERT INTO skills (name, level) VALUES ('$name', '$level')";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Fetch projects
$projects = mysqli_query($conn, "SELECT * FROM projects ORDER BY created_at DESC");

// Fetch skills
$skills = mysqli_query($conn, "SELECT * FROM skills");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <a href="edit_profile.php">edit profile</a>
    </header>
    <section id="add_project">
        <h2>Add Project</h2>
        <a href="./add_project.php">Add p</a>
        <form action="" method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br>
            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea><br>
            <label for="link">Link:</label>
            <input type="text" name="link" required><br>
            <button type="submit" name="add_project">Add Project</button>
        </form>
    </section>
    <section id="add_skill">
        <h2>Add Skill</h2>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            <label for="level">Level:</label>
            <input type="number" name="level" min="1" max="10" required><br>
            <button type="submit" name="add_skill">Add Skill</button>
        </form>
    </section>
    <section id="manage_projects">
        <h2>Manage Projects</h2>
        <ul>
            <?php while($project = mysqli_fetch_assoc($projects)): ?>
            <li><?php echo $project['title']; ?> - <a href="edit_project.php?id=<?php echo $project['id']; ?>">Edit</a></li>
            <?php endwhile; ?>
        </ul>
    </section>
    <section id="manage_skills">
        <h2>Manage Skills</h2>
        <ul>
            <?php while($skill = mysqli_fetch_assoc($skills)): ?>
            <li><?php echo $skill['name']; ?> (Level: <?php echo $skill['level']; ?>) - <a href="edit_skill.php?id=<?php echo $skill['id']; ?>">Edit</a></li>
            <?php endwhile; ?>
        </ul>
    </section>
    <footer>
        <a href="logout.php">Logout</a>
    </footer>
</body>
</html>
