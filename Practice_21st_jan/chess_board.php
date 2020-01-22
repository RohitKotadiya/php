<?php
    $number = 8;
    for($row = 1; $row <= $number; $row ++) {
        for($col = 1; $col <= $number; $col ++) {
            $sum = $row+$col;
            if($sum % 2 != 0 ){
                echo "<spam style='background-color:black;'>&nbsp;&nbsp;&nbsp;</span>";
            }else {
                echo "<spam style='background-color:white;'>&nbsp;&nbsp;&nbsp;</span>";
            }
        }
        echo "<br>";
    }

?>