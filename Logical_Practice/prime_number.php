<?php
    $number = 11;
    $factors =0;
    for($i = 1; $i <= $number; $i++) {
        if($number % $i == 0) {
            $factors++;
        }
    }
    if($factors === 2) {
        echo "Prime Number";
    }else {
        echo "Not a prime Number";
    }
?>