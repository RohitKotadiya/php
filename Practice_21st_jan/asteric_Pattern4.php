<?php
    $number = 5;
    $counter = 0;

    for($row = 1; $row <= $number; $row ++) {
        for($col = 1; $col <= $row + $counter; $col ++) {
            echo " * ";
        }
        for($sign = 1; $sign <= $row; $sign ++) {
            echo " 0 ";
        }
        echo "<br>";
        $counter += $row;
    }

?>