<?php include '../config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Obituary</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Add a New Obituary</h2>
    <form action="../routes/obituaryRoutes.php" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Birth Date:</label>
        <input type="date" name="birth_date" required><br>

        <label>Death Date:</label>
        <input type="date" name="death_date" required><br>

        <label>Biography:</label>
        <textarea name="biography" required></textarea><br>

        <label>Image:</label>
        <input type="file" name="image"><br>

        <button type="submit" name="submit">Add Obituary</button>
    </form>
</body>
</html>
