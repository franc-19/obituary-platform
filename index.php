<?php
include 'config/db.php';

// Fetch obituaries from the database
$sql = "SELECT * FROM obituaries ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obituary Listings</title>
    <link rel="stylesheet" href="public/style.css"> <!-- Ensure this file exists -->
</head>
<body>
    <div class="container">
        <h1>Obituary Listings</h1>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="obituary">
                        <h2><?= htmlspecialchars($row['name']) ?></h2>
                        <p><strong>Born:</strong> <?= htmlspecialchars($row['date_of_birth']) ?></p>
                        <p><strong>Died:</strong> <?= htmlspecialchars($row['date_of_death']) ?></p>
                        <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                        
                        <?php if (!empty($row['img_path']) && file_exists($row['img_path'])): ?>
                            <img src="<?= htmlspecialchars($row['img_path']) ?>" alt="Obituary Image" width="200">
                        <?php else: ?>
                            <img src="public/default.jpg" alt="Default Image" width="200">
                        <?php endif; ?>
                        
                        <p><em>Submitted by: <?= htmlspecialchars($row['author']) ?></em></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No obituaries found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
