<?php
// Include database connection
include_once 'db_connect.php';

// Fetch projects
$projects = mysqli_query($conn, "SELECT * FROM projects ORDER BY created_at DESC");

// Fetch skills
$skills = mysqli_query($conn, "SELECT * FROM skills");

// Display projects and skills
// HTML and PHP mixed for brevity
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to My Portfolio</h1>
    </header>
    <section id="projects">
        <h2>Projects</h2>
        <?php while($project = mysqli_fetch_assoc($projects)): ?>
        <div class="project">
            <h3><?php echo $project['title']; ?></h3>
            <p><?php echo $project['description']; ?></p>
            <a href="<?php echo $project['link']; ?>">View Project</a>
        </div>
        <?php endwhile; ?>
    </section>
    <section id="skills">
        <h2>Skills</h2>
        <ul>
            <?php while($skill = mysqli_fetch_assoc($skills)): ?>
            <li><?php echo $skill['name']; ?> (Level: <?php echo $skill['level']; ?>)</li>
            <?php endwhile; ?>
        </ul>
    </section>
    <footer>
        <p>&copy; 2024 My Portfolio</p>
    </footer>
</body>
</html>
