<?php
    session_start();
    
    if(session_destroy()) {
        header('location:session_3_loginPage.php');
        exit;
    }
?>