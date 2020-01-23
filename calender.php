<?php
    extract($_POST);
    if(isset($month) && isset($year)) {
        echo "$month , $year <br><br>";
        $day = 1;
        $daysOfMonth = date('t', mktime(0, 0, 0, (int)$month , 1 , (int)$year));
        $startFrom = date('N',mktime(0, 0, 0, (int)$month , 1 , (int)$year));
        
        echo "day => ", $startFrom , "<br>";
        echo "total days = > $daysOfMonth";
        echo "<table border='1'>";
        echo "<tr> <th>Sun</th> <th>Mon</th> <th>Tues</th> <th>Wed</th> <th>Thu</th> <th>Fri</th> <th>Sat</th></tr>";
        echo "<tr>";
        for($i = 1; $i <= 6; $i++) {
            for($j=1; $j <= 7; $j ++) {
                if($j <= $startFrom && $i == 1) {
                    echo "<td>&nbsp;</td>";
                }
                else if($day <= $daysOfMonth) {
                    echo "<td>$day</td>";
                    $day++;
                }
            }
            echo "</tr>";
        }

        echo "</table>";
    }
    
?>

<form action="calender.php" method="POST">
    <input type="number" name="month" placeholder="Enter Month here" required><br><br>
    <input type="number" name="year" placeholder="Enter Year here" required><br><br>
    <input type="submit" name="submit" value="SUBMIT"><br><br>
</form>