<?php
require '../config/db.php';
require '../models/obituaryModel.php';

// Check if obituary ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];
$obituary = getObituaryById($id);

if (!$obituary) {
    die("Obituary not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $dod = $_POST['dod'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    
    if (updateObituary($id, $name, $dob, $dod, $content, $author)) {
        header("Location: ../routes/view_obituaries.php?success=Obituary updated successfully");
        exit();
    } else {
        echo "Error updating obituary.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Obituary</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Edit Obituary</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($obituary['name']); ?>" required>
        
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo htmlspecialchars($obituary['dob']); ?>" required>
        
        <label>Date of Death:</label>
        <input type="date" name="dod" value="<?php echo htmlspecialchars($obituary['dod']); ?>" required>
        
        <label>Content:</label>
        <textarea name="content" required><?php echo htmlspecialchars($obituary['content']); ?></textarea>
        
        <label>Author:</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($obituary['author']); ?>" required>
        
        <button type="submit">Update</button>
    </form>
    <a href="../routes/view_obituaries.php">Back to List</a>
</body>
</html>