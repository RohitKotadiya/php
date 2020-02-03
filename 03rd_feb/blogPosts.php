<?php
    require_once "configuration.php";

    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
        die();
    }else {
        $userId = $_SESSION['userId'];
        $result = fetchData("firstName", "user", "userId = $userId");
        $userName = $result[0]['firstName'];
    }

    function showPosts() {
        // $query = "SELECT P.postId,P.title,P.publishedAt,C.title FROM blog_post 
        //             LEFT JOIN parent_category ON P."
    }
?>
<h1>Hello <?= $userName ?></h2>
<br>
<a href="logout.php"> logout </a><br><br>
<a href="register.php?userId=<?= $userId ?>"> My Profile </a><br><br>
<a href="addBlog.php"> Add New Blog Post </a><br><br>
<a href="manageCategory.php"> Manage Category </a><br><br>





