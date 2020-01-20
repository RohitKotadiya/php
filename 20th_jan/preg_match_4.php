<?php
    $str = "Welcome to The Cybercom Creation";

    if(preg_match('/n$/', $str, $arr)) {                //find for last char n
        echo "Word  Found where last char is n => ";
        print_r($arr);
    }else {
        echo "Word not Found where last char is n";
    }

    if(preg_match('/C/', $str )){
        echo "<br> Word found which  strats with C ";
    }else {
        echo "<br> Word not found which is starts with C";
    }

    $str2 = "hiii , <br> Hello World </br>";

    if(preg_match('/<br>.</br>/', $str2, $arr)){    
        echo "String found which enclosed with <br> => ";
        print_r($arr);
    }else {
        echo "String Not Found";
    }
?>