<?php
    require_once "configuration.php";
    session_start();
    $data['lastLoginAt'] = $_SESSION['loginTime'];
    $userId = $_SESSION['userId'];
    updateRecord('user', $data, "userId = $userId");
    if(session_destroy()) {
        header('location:login.php');
        exit;
    }
?>