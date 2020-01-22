<?php
    $number = 12345;

    while($number >= 1) {
        $digit = $number % 10;
        echo $digit;
        $number = $number / 10;
    }
?>