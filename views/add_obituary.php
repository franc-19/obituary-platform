<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Obituary</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Add an Obituary</h2>
    <form action="../routes/submit_obituary.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="dod">Date of Death:</label>
        <input type="date" id="dod" name="dod" required>

        <label for="content">Obituary:</label>
        <textarea id="content" name="content" rows="4" required></textarea>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
