<?php
require '../database/db_connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $dod = $_POST['dod'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "INSERT INTO obituaries (name, dob, dod, content, author) 
            VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $name, $dob, $dod, $content, $author);
        if ($stmt->execute()) {
            echo "<script>alert('Obituary submitted successfully!'); window.location.href='../views/view.php';</script>";
        } else {
            echo "<script>alert('Submission failed. Please try again.'); history.back();</script>";
        }
        $stmt->close();
    }
    $conn->close();
} else {
    header("Location: ../views/create.php");
    exit();
}
?>
