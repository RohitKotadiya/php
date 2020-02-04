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
     $postInfo = fetchData("postId,title,publishedAt","blog_post", "userId = $userId");
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
    <title>Post Information</title>
</head>
<body>
    <h2>BLOG POSTS</h2>
    <?php if(!empty($postInfo)) : ?>
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
                            $arr = [];
                    ?>
                    <?php foreach($results as $res) :
                                array_push($arr,$res['title']); 
                                endforeach; 
                    ?>
                <tr>
                        <td><?= $singlInfo['postId'] ?></td>
                        <td><?= $singlInfo['title'] ?></td>
                        <td><?= $singlInfo['publishedAt'] ?></td>
                        <td><?= implode(",", $arr) ?></td>
                    <td><a href="addBlog.php?postId=<?=$singlInfo['postId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?postId=<?= $singlInfo['postId'] ?>" >delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>



