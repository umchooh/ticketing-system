<?php
//require '../model/Nav.php';
$navListItems = '';
if (!isset($_SESSION['isLoggedIn'])) {
    $navLinks = array('About Us' => 'about-us.php', 'Program & Services' => 'programs-services.php', 'Login' => 'login.php', 'Sign Up' => 'signup-page.php');
} else if (isset($_SESSION['isLoggedIn'])) {
    $navLinks = array('About Us' => 'about-us.php', 'Program & Services' => 'programs-services.php', 'Logout' => 'logout.php');
}
foreach ($navLinks as $linkName => $page) {
    $navListItems .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"$page\">$linkName</a></li>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to HS's Transport Inc.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
            integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script data-require="moment.js@2.10.2" data-semver="2.10.2"
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/script.css">
    <!--script type="text/javascript" src="..//js/script.js"></script-->
</head>
<body class="bg-light d-flex flex-column h-100">
<header class="modal-header bg-light">
    <div class="page-wrapper">
        <h1 class="text-center">
            <span class="hidden">Task Management</span>
            <a class="nav-link" href="./index.php">HS Tech Services</a>
        </h1>
        <nav class="navbar-expand-lg ">
            <ul class="nav justify-content-end ">
                <?php
                echo $navListItems;
                ?>
            </ul>
        </nav>
    </div>
</header>
