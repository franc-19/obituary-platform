<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dob = $_POST['dob'];
    $dod = $_POST['dod'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $submission_date = date('Y-m-d H:i:s'); // Current timestamp
    
    // Generate slug
    $slug = strtolower(str_replace(' ', '-', $name)) . "-" . time();

    // SQL query to insert data
    $sql = "INSERT INTO obituaries (name, date_of_birth, date_of_death, content, author, submission_date, slug) 
            VALUES ('$name', '$dob', '$dod', '$content', '$author', '$submission_date', '$slug')";

    if (mysqli_query($conn, $sql)) {
        echo "Obituary successfully added!";
        header("Location: ../views/view_obituaries.php"); // Redirect after success
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
