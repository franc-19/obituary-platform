<?php
require_once '../config/db.php';
require_once '../models/obituaryModel.php';

class ObituaryController {
    private $model;

    public function __construct() {
        $this->model = new ObituaryModel();
    }

    public function addObituary($data) {
        if ($this->model->insertObituary($data)) {
            header("Location: ../views/view.php?success=Obituary added successfully");
            exit();
        } else {
            header("Location: ../views/create.php?error=Failed to add obituary");
            exit();
        }
    }

    public function editObituary($id, $data) {
        if ($this->model->updateObituary($id, $data)) {
            header("Location: ../views/view.php?success=Obituary updated successfully");
            exit();
        } else {
            header("Location: ../views/edit.php?id=$id&error=Failed to update obituary");
            exit();
        }
    }

    public function deleteObituary($id) {
        if ($this->model->deleteObituary($id)) {
            header("Location: ../views/view.php?success=Obituary deleted successfully");
            exit();
        } else {
            header("Location: ../views/view.php?error=Failed to delete obituary");
            exit();
        }
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new ObituaryController();

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $controller->addObituary($_POST);
                break;
            case 'edit':
                $controller->editObituary($_POST['id'], $_POST);
                break;
            case 'delete':
                $controller->deleteObituary($_POST['id']);
                break;
        }
    }
}
