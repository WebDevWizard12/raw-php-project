<?php

require "../vendor/autoload.php";

use App\classes\Category;
use App\classes\Login;

error_reporting(E_ALL);
ini_set('display_errors', 1);



session_start();


if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

$message = "";

if (isset($_POST["btn"])) {
    $message = (new Category)->saveCategoryInfo($_POST);
}


if ($_GET["status"]) {
    if ($_GET["status"] == "logout") {
        $message = (new Login)->adminLogout();
        $_SESSION["message"] = $message;
    }
}   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include "./includes/header.php"; ?>

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-primary">Add Category</h1>
        <hr />
        <h3><?php echo $message; ?></h3>
        <br />
        <form action="" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Category Description</label>
                <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Enter category description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="publicationStatus" class="form-label">Select Category Type</label>
                <select class="form-select" id="publicationStatus" name="publicationStatus" required>
                    <option>---Select Publication Status---</option>
                    <option value="1">published</option>
                    <option value="0">Unpublished</option>
                </select>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="btn">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>