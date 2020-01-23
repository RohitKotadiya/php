<?php
    extract($_POST);
    session_start();

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header('location:session_4_success.php');
        exit;
    }

    if(isset($uEmail) && isset($uPass)) {
        if($uEmail === "kotadiya1998@gmail.com" && $uPass === '123') {
            $_SESSION['userName'] = $uEmail;
            $_SESSION['sId'] = 1;
            $_SESSION['loggedin'] = true;
            header('Location:session_4_success.php');
        }else {
            echo "<script> alert('Username or Password Wrong!'); </script>";
        }
    }
?>
<form action="session_3_loginPage.php"  method="POST">
    <input type="email" name="uEmail" placeholder="Enter Your Email" required><br><br>
    <input type="password"  name="uPass" placeholder="Enter Your Password" required><br><br>
    <input type="submit" value="submit" name="submit">
</form>