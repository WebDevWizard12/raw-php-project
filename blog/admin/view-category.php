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

$queryResult = (new Category)->getAllCaregoryInfo();

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>abc</title>
    <!-- <link href="../assets/admin/css/bootstrap.css" rel="stylesheet"> -->
</head>

<body>

    <?php include "./includes/header.php"; ?>
    <br/>

    <div class="container">
        <div class="row">
            <h3 class="text-center text-primary">View Category Information</h3>
            <hr />
            <br />
            <table class="table table-striped table-bordered table-responsive table-hover text-center">
                <thead>
                    <tr class="text-center" style="background-color: black; color: white">
                        <th>Sl. No</th>
                        <th>Category Name</th>
                        <th>CategoryDescription</th>
                        <th>Publication Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php while ($category = mysqli_fetch_assoc($queryResult)) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $category["id"]; ?></td>
                            <td><?php echo $category["categoryName"]; ?></td>
                            <td><?php echo $category["categoryDescription"]; ?></td>
                            <td><?php echo $category["publicationStatus"] == 1 ? "Published" : "Unpublished"; ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $category["id"]; ?>"><box-icon type='solid' name='edit-alt'></box-icon></a> ||
                                <a href="?status=delete&&id=<?php echo $category["id"]; ?>"onclick ="return confirm('Are you sure about deleting Blog ID: <?php echo $category["id"]; ?>')"><box-icon type='solid' name='message-square-minus'></box-icon></a>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>


    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>