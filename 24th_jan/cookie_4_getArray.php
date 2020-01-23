<?php
    if(isset($_COOKIE['cookie'])) {
        foreach($_COOKIE['cookie'] as $key => $value) {
            echo $key . " ==>  " . $value . "<br>"; 
        }
    }

?>