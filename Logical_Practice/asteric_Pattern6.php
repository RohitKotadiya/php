<?php
    $number = 5;
    for($i = 1; $i <= $number; $i ++) {
        for($j = 1; $j <= $number; $j ++) {
            if($j == 1 || $j == 5 || $i == 1 || $i ==5){
                echo "*";
            }else {
                echo "&nbsp;&nbsp;";
            }
        }
        echo "<br>";
    }
?>
