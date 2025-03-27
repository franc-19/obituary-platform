<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize inputs
    $name = trim(htmlspecialchars($_POST['name']));
    $birth_date = trim($_POST['birth_date']);
    $death_date = trim($_POST['death_date']);
    $biography = trim(htmlspecialchars($_POST['biography']));
    $author = trim(htmlspecialchars($_POST['author']));
    
    // Generate a slug
    $slug = strtolower(str_replace(" ", "-", $name)) . "-" . uniqid();

    // Handle file upload securely
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowedTypes)) {
            $newFileName = uniqid() . "." . $imageFileType;
            $image = "uploads/" . $newFileName;
            move_uploaded_file($_FILES['image']['tmp_name'], "../" . $image);
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO obituaries (name, date_of_birth, date_of_death, content, author, img_path, slug) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error in SQL preparation: " . $conn->error);
    }
    
    $stmt->bind_param("sssssss", $name, $birth_date, $death_date, $biography, $author, $image, $slug);

    // Execute query and handle response
    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
