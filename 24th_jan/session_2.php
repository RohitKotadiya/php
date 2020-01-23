<?php
    session_start();

    if(isset($_SESSION['uName'])) {
        echo "WELCOME" . $_SESSION['uName'];
    }
?>