<?php
    for($row = 1; $row <= 2; $row ++) {
        for($col = 1;$col <=5; $col ++) {
            if($col == 2 && $row == 2){
                for($sp = $row; $sp <= 4; $sp ++) {
                    for($sp2 = $col; $sp2 <= 4; $sp2 ++){
                        echo "&nbsp ";
                    }
                    echo " *<br>*";
                }
            }
            echo "*";  
        }
        echo "<br>";
    }
?>