<?php

require "../vendor/autoload.php";

use App\classes\Blog;
use App\classes\Login;
use App\classes\Category;


error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}


if ($_GET["status"]) {
    if ($_GET["status"] == "logout") {
        $message = (new Login)->adminLogout();
        $_SESSION["message"] = $message;
    }
}

$msg = "";

if (isset($_POST["btn"])) {
    $blog = new Blog();
    $msg = $blog->saveBlogInfoToDatabase($_POST);
}

$queryResult = (new Category)->getAllPublishedCategory();

// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Blog - YourSiteName</title>
    <meta name="description" content="Add a new blog post to YourSiteName. Fill in the blog title, description, and choose a category to publish your content.">
    <meta name="keywords" content="blog, add blog, blog post, blog management, YourSiteName">
    <meta name="author" content="Abdullah Al Munir">
    <!-- <link href="../assets/admin/css/bootstrap.css" rel="stylesheet"> -->
</head>

<body>

    <?php include "./includes/header.php"; ?>

    <div class="container">
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <h1 class="text-center text-primary">Add Blog</h1>
                        <hr />
                        <h3 class="text-center text-success"><?php echo $msg; ?></h3>
                        <br />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="blogTitle">Blog Title</label>
                                <input type="text" class="form-control" id="blogTitle" name="blogTitle" placeholder="Blog Title" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="blogTitle">Blog Image</label>
                                <input type="file" class="form-control" id="blogImage" name="blogImage" accept="image/*" required>
                            </div>
                        </div>

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

                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="authorName">Author Name</label>
                                <input type="text" class="form-control" id="authorName" name="authorName" placeholder="Author Name" required>
                            </div>
                        </div>
                    </div> -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="blogDescription">Blog Description</label>
                                    <textarea class="form-control" id="blogDescription" name="blogDescription" rows="3" placeholder="Blog Description" required></textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="publicationStatus">Publication Status</label>
                                    <select class="form-select" id="publicationStatus" name="publicationStatus" required>
                                        <option value="">---Select one of the below---</option>
                                        <option value="1">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center my-4">
                                <button type="submit" name="btn" class="btn btn-primary btn-block">SAVE BLOG INFO</button>
                            </div>

                        </div>
                    </div>
            </form>
        </div>
    </div>



</body>

</html>