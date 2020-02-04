<?php
    require_once "configuration.php";
    require_once "postBlogData.php";
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
        die();
    }else {
        $userId = $_SESSION['userId'];
        $result = fetchData("firstName", "user", "userId = $userId");
        $userName = $result[0]['firstName'];
    }

    
     
    //  $que = "SELECT P.title,P.publishedAt,C.title as CategoryName FROM blog_post P 
    //  LEFT JOIN  post_category PC 
    //  ON P.postId = PC.postId   
    //  LEFT JOIN category C
    //  ON C.categoryId = PC.categoryId where P.userId = $userId";
  
     $que = "SELECT postId,title,publishedAt FROM blog_post where userId = $userId";    
     $postInfo = getData($que);
     
    //  die();
?>
<h3>Welcome <?= $userName ?></h3>
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
            <th>Category Name</th>
            <th colspan="2">Actions</th>
        </tr>
            <?php foreach($postInfo as $singlInfo) : ?>
                <?php $postId = $singlInfo['postId'];?>
                    <?php $query = "SELECT C.title FROM  post_category PC LEFT JOIN category C ON 
                            PC.categoryId = C.categoryId WHERE postId = $postId"; 
                            $results = getData($query);
                             ?>
                <tr>
                        <td><?= $singlInfo['postId'] ?></td>
                        <td><?= $singlInfo['title'] ?></td>
                        <td><?= $singlInfo['publishedAt'] ?></td>
                        <td><?php foreach($results as $res) :
                                echo $res['title']; endforeach; ?></td>
                    <td><a href="addBlog.php?postId=<?=$singlInfo['postId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?postId=<?= $singlInfo['postId'] ?>" >delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</body>
</html>



