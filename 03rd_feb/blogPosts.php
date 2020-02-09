<?php
    require_once "configuration.php";
    require_once "postBlogData.php";
    require_once "postUserData.php";
    session_start();
    checkSession();
    $userId = $_SESSION['userId'];
    $result = fetchData("firstName, lastLoginAt", "user", "userId = $userId");
    $userName = $result[0]['firstName'];
    $lastLogin = $result[0]['lastLoginAt'];
    // $postInfo = fetchData("postId,title,publishedAt","blog_post", "userId = $userId");
    $joinQuery = "SELECT
                        B.postId,
                        GROUP_CONCAT(C.title) CategoryName,
                        B.title AS Title,
                        B.publishedAt AS Published_Date
                    FROM
                        blog_post B 
                    LEFT JOIN
                        post_category PC ON 
                        B.postId = PC.postId
                    LEFT JOIN
                        child_parent_cat C ON
                        PC.categoryId = C.categoryId
                    WHERE B.userId = $userId
                    GROUP BY PC.postId";
    $postInfo = getData($joinQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Post Information</title>
    <link rel="stylesheet" type="text/css" href="css/blogPost_blogCat.css">
</head>
<body>
    <h3>Welcome <?= $userName ?></h3>
    <?php if($lastLogin != null) : ?>
    <h5>Last Logged in : <?= date('M,D,Y h:i:s A' , strtotime($lastLogin))  ?></h5>
    <?php endif; ?>
    <br>
    <ul>
        <li><a href="logout.php"> logout </a></li>
        <li><a href="register.php?userId=<?= $userId ?>"> My Profile </a></li>
        <li><a href="addBlog.php"> Add New Blog Post </a></li>
        <li><a href="blogCategories.php"> Manage Category </a></li>
    </ul>
    <h2>BLOG POSTS</h2>
    <?php if(is_array($postInfo) && !empty($postInfo)) : ?>
    <table border="1">
        <tr>
            <?php foreach(array_keys($postInfo[0]) as $title) : ?>
                <th><?= $title ?></th>
            <?php endforeach;?>
            <th colspan="2">Actions</th>
        </tr>
            <?php foreach($postInfo as $singlInfo) : ?>
                <tr>
                    <td><?= $singlInfo['postId'] ?></td>
                    <td><?= $singlInfo['CategoryName'] ?></td>
                    <td><?= $singlInfo['Title'] ?></td>
                    <td><?= $singlInfo['Published_Date'] ?></td>
                    <td><a href="addBlog.php?postId=<?=$singlInfo['postId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?postId=<?= $singlInfo['postId'] ?>" >delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>



