<?php
require "../vendor/autoload.php";

use App\classes\Blog;
use App\classes\Login;

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}


$id = $_GET["id"];

if (isset($_GET["status"])) {
    if ($_GET["status"] == "unpublished") {
        $massage = (new Blog)->unpublishedBlogById($id);
    } else if ($_GET["status"] == "published") {
        $massage = (new Blog)->publishedBlogByBlogId($id);
    } else if ($_GET["status"] == "logout") {
        $message = (new Login)->adminLogout();
    }
}


// $deleteBlog = "";
// if (isset($_GET["status"])) {
//     $id = $_GET["id"];
//     $deleteMassage = (new Blog)->deleteBlog($id);
//     $_SESSION["deleteMassage"] = $deleteMassage;
// }

if ($_GET["status"]) {
}

$queryResult = (new Blog)->getAllBlogInfo();


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
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Sl. No</th>
                                        <th scope="col">Category ID</th>
                                        <th scope="col">Blog Title</th>
                                        <th scope="col">Author Name</th>
                                        <th scope="col">Blog Description</th>
                                        <th scope="col">Publication Status</th>
                                        <th scope="col" style="width: 170px">Action</th>
                                    </tr>
                                </thead>
                                <?php while ($blog = mysqli_fetch_assoc($queryResult)) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $blog["id"]; ?></td>
                                            <td><?php echo $blog["categoryId"] ?></td>
                                            <td><?php echo $blog["blogTitle"]; ?></td>
                                            <td><?php echo $blog["authorName"]; ?></td>
                                            <td><?php echo $blog["blogDescription"]; ?></td>
                                            <td><?php echo $blog["publicationStatus"] == 1 ? "Published" : "Unpublished"; ?></td>
                                            <td>
                                                <a href="blog-description.php?id=<?php echo $blog["id"]; ?>"><box-icon name='book-open' type='solid'></box-icon></a> ||
                                                <a href="edit-blog.php?id=<?php echo $blog["id"]; ?>"><box-icon type='solid' name='edit-alt'></box-icon></a> ||
                                                <a href="?status=delete&&id=<?php echo $blog["id"]; ?>" onclick="return confirm('Are you sure about deleting the Blog ID: <?php echo $blog['id']; ?> ')"><box-icon type='solid' name='message-square-minus'></box-icon></a> ||
                                                <?php if ($blog["publicationStatus"] == 1) { ?>
                                                    <a href="?status=unpublished&id=<?php echo $blog['id'] ?>"><box-icon name='cloud-upload' type='solid'></box-icon></a>
                                                <?php } else { ?>
                                                    <a href="?status=published&id=<?php echo $blog['id'] ?>"><box-icon name='cloud-download' type='solid'></box-icon></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
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