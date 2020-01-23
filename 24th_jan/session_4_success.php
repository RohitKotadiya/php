<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:session_3_loginPage.php');
        die();
    }
?>
<h1>Hello <?= $_SESSION['userName'] ?></h2>
<br>
<a href="session_5_logout.php"> logout </a>