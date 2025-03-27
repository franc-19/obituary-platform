<?php
include '../config/db.php';

$result = $conn->query("SELECT id, name, date_of_birth, date_of_death FROM obituaries");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Obituaries</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Obituaries</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Date of Death</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo $row['date_of_birth']; ?></td>
                <td><?php echo $row['date_of_death']; ?></td>
                <td>
                    <a href="view.php?id=<?php echo $row['id']; ?>">View</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br><a href="../index.php">Back to Home</a>
</body>
</html>
