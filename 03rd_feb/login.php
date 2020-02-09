<?php
    require_once "loginValidation.php";
    if(isset($_POST['login'])) {
        authenticateUser($_POST['userEmail'],md5($_POST['password']));
    }
    if(isset($_POST['register'])) {
        header('location:register.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <h2> LOGIN </h2>
    <form action="login.php" method="POST">
        <div id="lgn">
            <input type="email" name="userEmail" placeholder = "enter email"><br><br>
            <input type="password" name="password" placeholder ="passwprd password"><br><br>
            <input type="submit" name="login" value="LOGIN">
            <input type="submit" name="register" value="REGISTER">
        </div>
    </form>
</body>
</html>