<?php
    require_once "configuration.php";
    require_once "postUserData.php";

    session_start();
    function authenticateUser($username,$password) {
        $result = fetchData("userId", "user", "emailAddress= '$username' and password = '$password'");
        if(is_array($result)) {
            $_SESSION['userId'] = $result[0]['userId'];
            $_SESSION['loginTime'] = date('Y-m-d H:i:s', time());
            $_SESSION['loggedin'] = true;
            header('Location:blogPosts.php');
        }else {
            echo displayPopup('Username or Password Wrong!');
        }  
    }

?>