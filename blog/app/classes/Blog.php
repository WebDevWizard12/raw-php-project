<?php

namespace App\classes;

use App\classes\Database;
use App\classes\Category;

class Blog
{

    protected function  saveBlogImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $directory = "../assets/blogImages/";
            $pictureName = $_FILES["blogImage"]["name"];
            $destination = $directory . $pictureName;
            $tmpName = $_FILES["blogImage"]["tmp_name"];

            $imageType = pathinfo($pictureName, PATHINFO_EXTENSION); // Get the extension
            $check = getimagesize($tmpName); // Check if the uploaded file is an image

            // echo "<pre>";
            // print_r($check);

            if ($check) {
                if (!file_exists($destination)) {
                    // Corrected variable from $fileType to $imageType
                    if ($imageType == "jpg" || $imageType == "png" || $imageType == "jpeg") {
                        // Check file size (should be less than 2MB)
                        if ($_FILES["blogImage"]["size"] < 2048 * 1024) {
                            if (move_uploaded_file($tmpName, $destination)) {
                                return $destination;
                            } else {
                                echo "Error moving the uploaded file.";
                            }
                        } else {
                            echo "Please use a file smaller than 2MB. Thanks!";
                        }
                    } else {
                        echo "Please use jpg or png formatted images. Thanks!";
                    }
                } else {
                    echo "File already exists.";
                }
            } else {
                echo "Please upload a valid image. Thanks!";
            }
        }
    }

    public function saveBlogInfoToDatabase($data)
    {

        $destination = (new Blog)->saveBlogImage();
        $connection = (new Database)->databaseConnection();
        $query = "INSERT INTO blogs(categoryId , blogTitle, authorName, blogDescription, blogImage, publicationStatus) 
            VALUES('$data[categoryId]', '$data[blogTitle]', '$_SESSION[name]', '$data[blogDescription]', '$destination', '$data[publicationStatus]')";
        if (mysqli_query($connection, $query)) {
            $message = "Blog info added successfully.";
            return $message;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function getAllBlogInfo()
    {
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM blogs ORDER BY id DESC";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function selectBlogInfoByBlogId($blogId)
    {
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM blogs WHERE id = '$blogId' ";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function updateBlogInfo($data, $blogId)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // echo "<pre/>";
        // exit();

        $imageName = $_FILES["blogImage"]["name"];
        $connection = (new Database)->databaseConnection();
        
        if ($imageName) {
            
            $blogQuery = "SELECT * FROM blogs WHERE id = '$blogId' ";
            $queryResult = mysqli_query($connection, $blogQuery);
            $blogInfo = mysqli_fetch_assoc($queryResult);
            unlink($blogInfo["blogImage"]);

            $destination = (new Blog)->saveBlogImage();
            $query = "UPDATE blogs SET  blogTitle = '$data[blogTitle]', categoryId = '$data[categoryId]',  blogDescription = '$data[blogDescription]', blogImage = '$destination', publicationStatus = '$data[publicationStatus]' WHERE id = '$blogId' ";
            if (mysqli_query($connection, $query)) {
                header("Location: view-blog.php");
            } else {
                die("Query Problem" . mysqli_error($connection));
            }
        } else {
            $query = "UPDATE blogs SET blogTitle = '$data[blogTitle]', categoryId = '$data[categoryId]',  blogDescription = '$data[blogDescription]', publicationStatus = '$data[publicationStatus]' WHERE id = '$blogId' ";
            if (mysqli_query($connection, $query)) {
                header("Location: view-blog.php");
            } else {
                die("Query Problem" . mysqli_error($connection));
            }
        }

        // $connection = (new Database)->databaseConnection();
        // $query = "UPDATE blogs SET blogTitle = '$data[blogTitle]', authorName = '$_SESSION[name]', blogDescription = '$data[blogDescription]', publicationStatus = '$data[publicationStatus]' WHERE id = '$blogId'";
        // if (mysqli_query($connection, $query)) {
        //     header("Location: view-blog.php");
        // } else {
        //     die("Query Problem" . mysqli_error($connection));
        // }    
    }

    public function deleteBlog($id)
    {
        $connection = (new Database)->databaseConnection();
        $query = "DELETE FROM blogs WHERE id = $id ";
        if (mysqli_query($connection, $query)) {
            $deleteMassage = "Blog ID $id: is deleted Successfully !!!";
            return $deleteMassage;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function getBlogInfoByBlogId($id)
    {
        $connection = (new Database)->databaseConnection();
        // $query = "SELECT * FROM blogs WHERE id = '$id' ";
        $query = "SELECT b.*, c.categoryName FROM blogs as b, categories as c WHERE b.categoryId = c.id AND b.id = '$id' ";   // creates virtual table
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function unpublishedBlogById($id)
    {
        $connection = (new Database)->databaseConnection();
        $query = "UPDATE blogs SET publicationStatus = 0 WHERE id = '$id' ";
        if (mysqli_query($connection, $query)) {
            $massage = "Blog info unpublished successfully";
            return $massage;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function publishedBlogByBlogId($id)
    {
        $connection = (new Database)->databaseConnection();
        $query = "UPDATE blogs SET publicationStatus = 1 WHERE id = '$id' ";
        if (mysqli_query($connection, $query)) {
            $massage = "Blog info published successfully";
            return $massage;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }
}
