<?php
// Include database connection
include_once './admin/database/db_connect.php';

// Check if project ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch project details from the database
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        echo "Project not found.";
        exit;
    }
} else {
    echo "Project ID not provided.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project['title']; ?></title>
    <!-- Add your CSS styles here -->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2><?php echo $project['title']; ?></h2>
                </div>
                <div class="card-body">
                    <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>" class="img-fluid mb-3">
                    <p><?php echo $project['description']; ?></p>
                    <p><strong>Link:</strong> <a href="<?php echo $project['link']; ?>" target="_blank"><?php echo $project['link']; ?></a></p>
                </div>
                <div class="card-footer">
                    <a href="index.php" class="btn btn-secondary">Back to Projects</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
