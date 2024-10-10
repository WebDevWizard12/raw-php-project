<?php

require "../vendor/autoload.php";

use App\classes\Login;

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

if (isset($_GET["status"])) {
    if ($_GET["status"] == "logout") {
        (new Login)->adminLogout();
    }
}

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
}


?>


<!DOCTYPE html> <!-- session is a memory name of a browser -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
</head>

<body>

    <?php include "./includes/header.php"; ?>



    <script src="../assets/admin/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</body>

</html>