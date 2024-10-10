<?php

namespace App\classes;

use App\classes\Database;
// use FTP\Connection;



class Category
{

    public function saveCategoryInfo($data)
    {
        $connection = (new Database)->databaseConnection();
        $query = "INSERT INTO categories(categoryName, categoryDescription,  publicationStatus) VALUES('$data[categoryName]', '$data[categoryDescription]', '$data[publicationStatus]')";
        if (mysqli_query($connection, $query)) {
            $message = "Category Info Added Successfully.";
            return $message;
        }
    }

    public function getAllCaregoryInfo()
    {
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM categories ORDER BY id DESC";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function selectCategoryInfoByCategoryId($categoryId)
    {
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM categories WHERE id = '$categoryId' ";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    // public function upateCategoryInfo($data, $blogId)
    // {
    //     $conenction = (new Database)->databaseConnection();
    //     $query = "UPDATE categories SET categoryName = '$data[categoryName]', categoryDescription = '$data[categoryDescription]', publicationStatus = '$data[publicationStatus]' WHERE id = '$blogId'";
    //     if (mysqli_query($conenction, $query)) {
    //         header("Location: view-blog.php");
    //     } else {
    //         die("Query Problem" . mysqli_error($conenction));
    //     }
    // }
    
    public function updateCategoryInfo($data, $categoryId) {
        $connection = (new Database) -> databaseConnection();
        $query = "UPDATE categories SET categoryName = '$data[categoryName]', categoryDescription = '$data[categoryDescription]', publicationStatus = '$data[publicationStatus]' WHERE id = '$categoryId' ";
        if (mysqli_query($connection, $query)) {
            if(header("Location: view-category.php")) {
                exit;
            }
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function deleteCategory($id)
    {
        $connection = (new Database)->databaseConnection();
        $query = "DELETE FROM categories WHERE id = $id ";
        if (mysqli_query($connection, $query)) {
            session_start();
            $deleteMassage = "Category ID $id: is deleted Successfully !!!";
            return $deleteMassage;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }

    public function getAllPublishedCategory()
    {
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM categories WHERE publicationStatus = 1";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }
}