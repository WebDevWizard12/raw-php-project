<?php

require "../vendor/autoload.php";

use App\classes\Login;
use App\classes\Blog;


session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$id = $_GET["id"];


if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

$queryResult = (new Blog)->getBlogInfoByBlogId($id);

$blogInfo = mysqli_fetch_assoc($queryResult);

// echo "<pre>";
// print_r($blogInfo);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>abc</title>
    <!-- <link href="../assets/admin/css/bootstrap.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.css">
</head>

<body>
    <?php include "./includes/header.php"; ?><br />


    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 text-center text-primary">View All Blog</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <tr class="table-black">
                                    <th scope="col">Blog ID</th>
                                    <td><?php echo $blogInfo["id"]; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Category ID</th>
                                    <td><?php echo $blogInfo["categoryId"] ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Category Name</th>
                                    <td><?php echo $blogInfo["categoryName"]; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Blog Title</th>
                                    <td><?php echo $blogInfo["blogTitle"]; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Author Name</th>
                                    <td><?php echo $blogInfo["authorName"]; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Blog Description</th>
                                    <td><?php echo $blogInfo["blogDescription"]; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Publication Status</th>
                                    <td><?php echo $blogInfo["publicationStatus"] == 1 ? 'Published' : 'Unpublished'; ?></td>
                                </tr>
                                <tr class="table-black">
                                    <th scope="col">Blog Image</th>
                                    <td><img src="<?php echo $blogInfo["blogImage"]; ?>" alt=""></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>