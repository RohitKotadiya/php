<?php
    $userIp = $_SERVER['REMOTE_ADDR'];

    function showUserIp() {
        global $userIp;
        echo "User Ip Address = > $userIp";
    }

    showUserIp();


    
    $numArray = array(100,150,100,50,60,80,90,75);

    function calcSum() {
        global $numArray;
        for($i = 0; $i < count($numArray); $i++) {
            $total += $numArray[$i];
        }
        return $total;
    } 

    echo "This sum of array => " . calcSum();
?>