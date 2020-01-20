<?php
    $str = "hello , welcome to cybercom creation to ";

    $pattern = '/to/';
    if(preg_match($pattern, $str, $arrMatches, PREG_OFFSET_CAPTURE, 3)){
        print_r($arrMatches);
    }else {
        echo "Not Found <br>";
    }

    $pattern2 = '/^creation/';          // ^ means NOT
    if(preg_match($pattern2,$str)){
        echo " Found";
    }
    else{
        echo "Not Found <br>";
    }
?>