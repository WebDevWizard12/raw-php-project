<?php

namespace App\classes;

use App\classes\Database;

use mysqli;

class Login
{

    public function adminLoginCheck($data)
    {

        // echo "<pre>";
        //     print_r($data);
        // echo "<pre>";

        $email = $data["email"];
        $password = md5($data["password"]);
        $connection = (new Database)->databaseConnection();
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
        if (mysqli_query($connection, $query)) {
            $queryResult = mysqli_query($connection, $query);
            $userInfo = mysqli_fetch_assoc($queryResult);
            if ($userInfo) {
                session_start();

                $_SESSION["id"] = $userInfo["id"];
                $_SESSION["name"] = $userInfo["name"];

                header("Location: dashboard.php");
            } else {
                $msg = "Please use valid email address and password";
                return $msg;
            }
        } else {
            die("Query Problem" . mysqli_error($connection));
        }
    }
    public function adminLogout() {
        unset($_SESSION["id"]);
        unset($_SESSION["name"]);

        header("Location: index.php");

        session_start();
        $message = "You have successfully logged out";
        return $message;
    }

}
