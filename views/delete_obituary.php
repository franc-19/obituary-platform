<?php
require '../config/db.php';
require '../models/obituaryModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $obituaryModel = new ObituaryModel($conn);
    
    if ($obituaryModel->deleteObituary($id)) {
        header('Location: ../views/view.php?success=Obituary deleted');
        exit();
    } else {
        echo "<p>Error deleting obituary. Please try again.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
