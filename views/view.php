<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM obituaries WHERE id = $id");
    $obituary = $result->fetch_assoc();
} else {
    die("Obituary not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $obituary['name']; ?></title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2><?php echo $obituary['name']; ?></h2>
    <p><strong>Born:</strong> <?php echo $obituary['birth_date']; ?></p>
    <p><strong>Died:</strong> <?php echo $obituary['death_date']; ?></p>
    <p><strong>Biography:</strong> <?php echo nl2br($obituary['biography']); ?></p>
    <?php if (!empty($obituary['image'])) { ?>
        <img src="../<?php echo $obituary['image']; ?>" width="300">
    <?php } ?>
    <br><a href="../index.php">Back</a>
</body>
</html>
