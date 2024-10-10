<?php

require "../vendor/autoload.php";

use App\classes\Login;
use App\classes\Category;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET["status"])) {
    if ($_GET["status"] == "logout") {
        (new Login)->adminLogout();
    }
}

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}

$categoryId = $_GET["id"];

$queryResult = (new Category)->selectCategoryInfoByCategoryId($categoryId);
$categoryInfo = mysqli_fetch_assoc($queryResult);

// echo "<pre>";
// print_r($categoryInfo);
// echo "<pre/>";


if ($_POST["btn"]) {
    (new Category)->updateCategoryInfo($_POST, $categoryId);
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

    <div class="container " style="margin-top: 50px; border: 1px solid red">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <form class="form-horizontal" action="" method="POST" name=editCategoryInfo class="text-center">
                    <h1 class="text-center text-primary">Edit Category Info</h1>
                    <hr />
                    <h3 class="text-center text-success"></h3>

                    <div class="form-group">
                        <label for="categoryName" class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="categoryName" class="form-control" id="categoryName" value="<?php echo $categoryInfo["categoryName"]; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription" class="col-sm-2 control-label">Category Descrioption</label>
                        <div class="col-sm-10">
                            <textarea name="categoryDescription" cols="90" rows="10" id="categoryDescription" style="resize:none;" required><?php echo $categoryInfo["categoryDescription"]; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="publicationStatus" class="col-sm-2 control-label">Publication Status</label>
                        <div class="col-sm-10">
                            <select class="form-select form-select-lg mb-10" name="publicationStatus" id="publicationStatus" aria-label="Large select example" required>
                                <option>---Select Publication Status---</option>
                                <option value="1">published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3"> <!-- Add mt-3 for top margin -->
                        <div class="col-sm-10">
                            <button type="submit" name="btn" class="btn btn-success">Update Category Info</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>

    <script>
        document.forms["editCategoryInfo"].elements["publicationStatus"].value = "<?php echo $categoryInfo["publicationStatus"]; ?>"
    </script>

</body>

</html>


<!-- Full texts
	id 	categoryName 	categoryDescription -->