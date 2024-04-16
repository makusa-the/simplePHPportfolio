<?php
// Include database connection
include_once './database/db_connect.php';

// Initialize variables
$title = $description = $image = $link = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);
    $link = trim($_POST['link']);

    if (empty($title)) { $errors[] = 'Title is required'; }
    if (empty($description)) { $errors[] = 'Description is required'; }
    if (empty($image)) { $errors[] = 'Image URL is required'; }
    if (empty($link) || !filter_var($link, FILTER_VALIDATE_URL)) { $errors[] = 'Valid link URL is required'; }

    // If no errors, insert data into database
    if (empty($errors)) {
        $sql = "INSERT INTO projects (title, description, image, link) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $title, $description, $image, $link);

        if ($stmt->execute()) {
            header('Location: admin.php');
            exit;
        } else {
            $errors[] = 'Error adding project';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Add Project</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required><?php echo htmlspecialchars($description); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image URL:</label>
                    <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($image); ?>" required>
                </div>
                <div class="form-group">
                    <label for="link">Link URL:</label>
                    <input type="text" name="link" class="form-control" value="<?php echo htmlspecialchars($link); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Project</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
