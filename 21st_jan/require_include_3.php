<?php

    if(file_exists("arrays_4.php")) {
        include "arrays_4.php";
    }

    function includeAgainCheck() {
        include_once "arrays_4.php";
    }
    includeAgainCheck();

    function userName() {
        require_once 'require_include_Ex.php';
        return $userName;
    }
    echo "<br><br>";
    for($i =0; $i < 5; $i++) {
        echo "<br>" . userName();       //just prints once
    }


    function userCity() {
        require 'require_include_Ex.php';
        return $userCity;
    }
    echo "<br><br>";

    for($i =0; $i < 5; $i++) {
        echo "<br>" . userCity();       //prints 5 times bcaz require
    }
?>