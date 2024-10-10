<?php

namespace App\classes;

class Database{
    public function databaseConnection() {
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $databaseName = "blog";
        $link = mysqli_connect($hostName, $userName, $password, $databaseName);
        return $link;
    }

}