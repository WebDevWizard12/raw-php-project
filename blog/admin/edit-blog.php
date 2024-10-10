<?php

require "../vendor/autoload.php";

use App\classes\Login;
use App\classes\Category;
use App\classes\Blog;


error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

$blogId = $_GET["id"];

if (isset($_POST["btn"])) {
    (new Blog) -> updateBlogInfo($_POST, $blogId);
}

if ($_GET["status"]) {
    if ($_GET["status"] == "logout") {
        $message = (new Login)->adminLogout();
        $_SESSION["message"] = $message;
    }
}



$queryResult = (new Blog)->selectBlogInfoByBlogId($blogId);
$blogInfo = mysqli_fetch_assoc($queryResult);


$queryResult = (new Category)->getAllPublishedCategory();


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
    <br />

    <div class="container">
        <div class="row">
            <form action="" method="POST" name="editBlogInfo" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <h1 class="text-center text-primary">Edit Blog Info</h1>
                        <hr />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="blogTitle">Blog Title</label>
                                <input type="text" class="form-control" id="blogTitle" name="blogTitle" value="<?php echo $blogInfo["blogTitle"]; ?>" required>

                            </div>
                        </div>

                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="authorName">Author Name</label>
                                <input type="text" class="form-control" id="authorName" name="authorName" value="<?php echo $blogInfo["authorName"]; ?>" required>
                            </div>
                        </div>
                    </div> -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categoryId">Category Name</label>
                                <select class="form-control" name="categoryId" id="categoyId">
                                    <option value="">---Select Category Name---</option>
                                    <?php while ($publishedCategory = mysqli_fetch_assoc($queryResult)) { ?>
                                        <option value="<?php echo $publishedCategory["id"]; ?>"><?php echo $publishedCategory["categoryName"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="blogTitle">Blog Image</label>
                                <input type="file" class="form-control" id="blogImage" name="blogImage" accept="image/*" >
                                <img src="<?php echo $blogInfo["blogImage"]; ?>" alt="...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="blogDescription">Blog Description</label>
                                    <textarea class="form-control" id="blogDescription" name="blogDescription" rows="3" required><?php echo $blogInfo["blogDescription"]; ?></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="publicationStatus">Publication Status</label>
                                    <select class="form-control" id="publicationStatus" name="publicationStatus" aria-label="Large select example" required>
                                        <option value="">---Select one of the below---</option>
                                        <option value="1">published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center my-4">
                                <button type="submit" name="btn" class="btn btn-primary">UPDATE BLOG INFO</button>
                            </div>

                        </div>
                    </div>
            </form>
        </div>
    </div>


    <script>
        document.forms["editBlogInfo"].elements["publicationStatus"].value = "<?php echo $blogInfo["publicationStatus"]; ?>"
        document.forms["editBlogInfo"].elements["categoryId"].value = "<?php echo $blogInfo["categoryId"]; ?>"
    </script>
</body>

</html>