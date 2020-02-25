<?php

require_once "Adapter.php";
require_once "User.php";
 
    $userData =[]; 
    function getFieldValue($fieldName) {
        global $userData;
        if(isset($userData[$fieldName])) {
            return $userData[$fieldName];
        }else {
            return "";
        }
    }
    if(isset($_GET['id'])) {
        $userData = getUserData($_GET['id']); 
        $btnValue = "UPDATE USER"; 
        $btnName = "update";
    }else {
        $btnValue = "ADD USER";
        $btnName = 'add';
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>Registraion</title>
      <link rel="stylesheet" type="text/css" href="css/registeration.css">
</head>
<body>
    <h2> REGISTER  </h2>
    <form method="POST" action ="User.php">
        <div id="register">
            <label>First Name</label>
            <input type="text" name="register[firstName]" value="<?= getFieldValue('firstName')?>">
            <br><br>
            <label>Last Name</label>
            <input type="text" name="register[lastName]" value="<?= getFieldValue('lastName')?>">
            <br><br>
            <label>Phone Number</label>
            <input type="number" name="register[phoneNumber]" value="<?= getFieldValue('phoneNumber')?>">
            <br><br>
            <label>Email Id</label>
            <input type="text" name="register[emailId]"  value="<?= getFieldValue('emailId')?>">
            <br><br>
            <label>Password</label>
            <input type="password" name="register[password]"  value="<?= getFieldValue('password')?>">
            <br><br>
            <input type="hidden" name="userId" value="<?= $userData['userId'] ?>">
            <input type="submit" name="<?= $btnName ?>" value="<?= $btnValue ?>">
    </form>
  
</body>
</html>
