<?php
    $numArray = array(10, 50, 20, 60, 80, 100, 120);
    function sumOfNumbers($numArray) {
        for($i = 0; $i < count($numArray); $i++) {
            $total += $numArray[$i];
        }
        return $total;
    }

    echo sumOfNumbers($numArray);
?>