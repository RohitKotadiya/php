<?php
    $number = 5;
    $counter =1;
    for($row = 1; $row <= $number;  $row ++) {
        for($col = 1; $col <= $row; $col ++) {
            echo " $counter ";
            $counter ++; 
        }
        echo "<br>";
    }
?>