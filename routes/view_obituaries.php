<?php
require '../database/db_connection.php';

// Pagination settings
$limit = 10; // Number of obituaries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page number is at least 1
$offset = ($page - 1) * $limit;

// Fetch total count for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM obituaries";
$totalStmt = $conn->prepare($totalQuery);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $limit);

// Fetch obituaries with pagination using prepared statements
$sql = "SELECT name, date_of_birth, date_of_death, content, author FROM obituaries ORDER BY date_of_death DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View obituaries and remember loved ones.">
    <meta name="keywords" content="obituaries, memorials, remembrance">
    <meta property="og:title" content="View Obituaries">
    <meta property="og:description" content="View and remember loved ones through obituaries.">
    <title>View Obituaries</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Obituaries",
        "itemListElement": [
            <?php $count = 0; while ($row = $result->fetch_assoc()): ?>
            {
                "@type": "Person",
                "name": "<?php echo htmlspecialchars($row['name']); ?>",
                "birthDate": "<?php echo htmlspecialchars($row['date_of_birth']); ?>",
                "deathDate": "<?php echo htmlspecialchars($row['date_of_death']); ?>"
            }<?php echo (++$count < $result->num_rows) ? ',' : ''; ?>
            <?php endwhile; ?>
        ]
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Obituaries</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Date of Death</th>
                    <th>Obituary Content</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $stmt->execute(); 
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_death']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="btn">Previous</a>
            <?php endif; ?>
            <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="btn">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php 
$stmt->close();
$conn->close();
?>
