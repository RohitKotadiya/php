<?php
    require_once "configuration.php";
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
        die();
    }else {
        $userId = $_SESSION['userId'];
        $result = fetchData("categoryId,image,title,createdAt","category");
    }
?>

<a href="logout.php"> logout </a><br><br>
<a href="register.php?userId=<?= $userId ?>"> My Profile </a><br><br>
<a href="addCategory.php"> Add New Category </a><br><br>
<a href="blogCategories.php"> Manage Category </a><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Information</title>
</head>
<body>
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
                            <td><?= $value ?></td>
                    <?php endforeach; ?>
                    <td><a href="registrationForm.php?userId=<?=$singlCustInfo['customerId'] ?>"> edit </a></td>
                    <td><a href="deleteRecord.php?userId=<?=$singlCustInfo['customerId'] ?>"> delete </a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</body>
</html>