<?php

namespace App\classes;
use App\classes\Database;

class Application 
{
    public function getAllPublishedBlog() {
        $connection = (new Database) -> databaseConnection();
        $query = "SELECT * FROM blogs WHERE publicationStatus = 1";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            return $queryResult;
        } else {
            die("Query Problem" . mysqli_error($connection));
        }    
    }
}
