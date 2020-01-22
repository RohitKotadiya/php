<?php
    $number = 24;
    for($i = 1; $i <= $number; $i++) {
        if($number % $i == 0) {
            echo $i . " , ";
        }
    }
?>