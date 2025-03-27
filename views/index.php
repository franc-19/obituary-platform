<?php include 'config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Obituary Platform</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <h1>Welcome to the Obituary Platform</h1>
    <a href="views/create.php">Add Obituary</a>

    <h2>Recent Obituaries</h2>
    <ul>
        <?php
        $result = $conn->query("SELECT * FROM obituaries ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='views/view.php?id=" . htmlspecialchars($row['id']) . "'>" 
                    . htmlspecialchars($row['name']) . " (" 
                    . htmlspecialchars($row['birth_date']) . " - " 
                    . htmlspecialchars($row['death_date']) . ")</a></li>";
            }
        } else {
            echo "<li>No obituaries found.</li>";
        }
        ?>
    </ul>
</body>
</html>
