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
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        <div>
            <input type="email" name="userEmail" placeholder = "enter email"><br><br>
            <input type="password" name="password" placeholder ="passwprd password"><br><br>
            <input type="submit" name="login" value="LOGIN">
            <input type="submit" name="register" value="REGISTER">
        </div>
    </form>
</body>
</html>