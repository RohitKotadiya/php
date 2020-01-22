<?php
    $number = 6;
    echo "<table border ='1'>";
    for($row = 1; $row <= $number; $row ++) {
        echo "<tr>";
        for($col = 1; $col <= $number-1; $col++) {
            echo "<td> $row x $col = " . $row * $col . "</td>"; 
        }
        echo "</tr>";
    }
    echo "</table>";
?>