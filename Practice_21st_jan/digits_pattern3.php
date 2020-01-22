<?php
    $number = 12;

    for($i = 1;$i <= 4; $i++) {
        for($j = $i; $j <= $number; $j += 4) {
            echo " $j ";
        }
        echo "<br>";
    }
?>