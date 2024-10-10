<?php

require "../vendor/autoload.php";
use App\classes\Login;

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION["id"])) {
    header("Location: dashboard.php");
}

$message = "";

if (isset($_POST["btn"])) {
    $message = (new Login())->adminLoginCheck($_POST);
}

$message = "";

if (isset($_GET["status"])) {
    if ($_GET["status"] == "logout") {
        $message = (new Login) -> adminLogout();
        $_SESSION["message"] = $message;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>abc</title>
    <link href="../assets/admin/css/style.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <h1>Admin Login</h1>
        <hr />
        <br/>
        <h1 style="font-size: 20px; color: red;"><?php echo $message; ?></h1>
        
        <form action="" method="POST">
            <div class="input-box">
                <input type="email" placeholder="Email address" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forget">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password</a>
            </div>
            <button type="submit" name="btn" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="#">Regester</a></p>
            </div>
        </form>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../assets/admin/js/bootstrap.js"></script>
</body>

</html>