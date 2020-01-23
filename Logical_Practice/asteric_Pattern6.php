<?php
    $number = 5;
    echo "<table>";
    for($i = 1; $i <= $number; $i ++) {
        echo "<tr>";
        for($j = 1; $j <= $number; $j ++) {
            if($j == 1 || $j == 5 || $i == 1 || $i ==5){
                echo "<td>*</td>";
            }else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
?>
