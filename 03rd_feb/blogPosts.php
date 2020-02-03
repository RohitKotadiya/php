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

    function getData() {
        $postInfo = [];
        global $connection,$userId;
        $que = "SELECT P.title,P.publishedAt,C.title as CategoryName FROM blog_post P 
            LEFT JOIN  post_category PC 
            ON P.postId = PC.postId   
            LEFT JOIN category C
            ON C.categoryId = PC.categoryId where P.userId = $userId";
         $resultSet = mysqli_query($connection, $que);
        
         if(mysqli_num_rows($resultSet) > 0) {
             while($row = mysqli_fetch_assoc($resultSet)) {
                 array_push($postInfo, $row);
             }
         }else {
             echo mysqli_error($connection);
         }
         return $postInfo;
     }
     $postInfo = getData();
    
?>
<h1>Hello <?= $userName ?></h2>
<br>
<a href="logout.php"> logout </a><br><br>
<a href="register.php?userId=<?= $userId ?>"> My Profile </a><br><br>
<a href="addBlog.php"> Add New Blog Post </a><br><br>
<a href="blogCategories.php"> Manage Category </a><br><br>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Information</title>
</head>
<body>
    <table border="1">
        <tr>
            <?php foreach(array_keys($postInfo[0]) as $title) : ?>
                <th><?= $title ?></th>
            <?php endforeach;?>
            <th colspan="2">Actions</th>
        </tr>
            <?php foreach($postInfo as $singlInfo) : ?>
                <tr>
                    <?php foreach($singlInfo as $key => $value) : ?>
                        <td><?= $value ?></td>
                    <?php endforeach; ?>
                    <td><a href="addCategory.php?catId=<?=$queryResult['categoryId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?catId=<?= $queryResult['categoryId'] ?>" >delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</body>
</html>



