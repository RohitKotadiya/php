<?php
    require_once "configuration.php";
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
        die();
    }else {
        $userId = $_SESSION['userId'];
        $currentUser = fetchData("firstName", "user", "userId = $userId");
        $userName = $currentUser[0]['firstName'];
        $result = fetchData("categoryId,image,title,createdAt","category");
    }
?>
<h3>Welcome <?= $userName ?></h3>
<br>
<a href="logout.php"> logout </a><br><br>
<a href="register.php?userId=<?= $userId ?>"> My Profile </a><br><br>
<a href="addCategory.php"> Add New Category </a><br><br>
<a href="blogPosts.php"> Manage Blog Posts </a><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Information</title>
</head>
<body>
<h2>BLOG CATEGORY</h2>

    <table border="1">
        <tr>
            <?php foreach(array_keys($result[0]) as $title) : ?>
                <th><?= $title ?></th>
            <?php endforeach;?>
            <th colspan="2">Actions</th>
        </tr>
            <?php foreach($result as $singlInfo) : ?>
                <tr>
                    <?php foreach($singlInfo as $key => $value) : ?>
                        <?php if($key == 'image') : ?>
                            <td><img src="<?= $value ?>" height="40px" width="50px"></td>
                        <?php else : ?>
                            <td><?= $value ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td><a href="addCategory.php?catId=<?=$singlInfo['categoryId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?catId=<?= $singlInfo['categoryId'] ?>" >delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</body>
</html>