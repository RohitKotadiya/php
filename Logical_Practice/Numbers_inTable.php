<?php
    $number = 10;
    echo "<table border ='1'>";
    for($row = 1; $row <= $number; $row ++) {
        echo "<tr>";
        for($col = 1; $col <= $number; $col++) {
            echo "<td>" . $col * $row . "</td>"; 
        }
        echo "</tr>";
    }
    echo "</table>";
?>