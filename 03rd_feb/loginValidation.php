<?php
    require_once "configuration.php";
    session_start();
    function authenticateUser($username,$password) {
        $result = fetchData("userId", "user", "emailAddress= '$username' and password = '$password'");
        if(is_array($result)) {
            $_SESSION['userId'] = $result[0]['userId'];
            $_SESSION['sId'] = 1;
            $_SESSION['loggedin'] = true;
            header('Location:blogPosts.php');
        }else {
            echo "<script> alert('Username or Password Wrong!'); </script>";
        }  
    }

?>