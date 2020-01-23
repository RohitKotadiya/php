<?php
    $number = 10;
    $temp = 0;
    echo "<table border='1'>";
    for($i = 0; $i <= $number; $i ++) {
        echo "<tr>";
        for($j = 0; $j <= $number; $j ++) {
            if($j == $temp || $j == $number-$temp)  {
                echo "<td> </td>";
            }else {
                echo "<td>*</td>";
            }
        }
        $temp ++;
        echo "</tr>";
    }
    echo "</table>";
?>