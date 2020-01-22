<?php
    $number = 8;
    echo "<table border='1'>";
    for($row = 1; $row <= $number; $row ++) {
        echo "<tr>";
        for($col = 1; $col <= $number; $col ++) {
            $sum = $row+$col;
            if($sum % 2 != 0 ){
                echo "<td style='background-color:black;'>&nbsp;&nbsp;&nbsp;</td>";
            }else {
                echo "<td style='background-color:white;'>&nbsp;&nbsp;&nbsp;</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
?>