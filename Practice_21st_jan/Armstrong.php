<?php
    $number = 407;
    $numberOne = $number;
    while($number > 0) {
        $digit = $number % 10;
        $numberTwo += $digit * $digit * $digit;
        $number = $number / 10;
    }
    if($numberOne === $numberTwo) {
        echo "$numberOne is Armstrong";
    }else {
        echo "$numberOne is not a Armstrong Number"
    }
?>
