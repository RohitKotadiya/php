<?php

require_once "Adapter.php";
require_once "User.php";

$allData = $adapter->fetchAll("SELECT * FROM `user`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>firstName</th>
            <th>emailId </th>
            <th>Phone Number</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php foreach($allData as $key => $value) { ?>
            <tr>
                <td><?php echo $value['firstName']; ?></td>
                <td><?php echo $value['emailId']; ?></td>
                <td><?php echo $value['phoneNumber']; ?></td>
                <td><a href="register.php?id=<?php echo $value['userId']?> "> edit </a></td>
                <td><a href="User.php?userId=<?php echo $value['userId']?> "> delete </a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
