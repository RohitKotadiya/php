
<div id="secondFrame">
    <h2>Monthly Calender</h2>
    <form action="calFromTo.php" method="POST">
        <input type="number" name="fromMonth" placeholder="From Month " required><br><br>
        <input type="number" name="toMonth" placeholder="To Month " required><br><br>
        <input type="number" name="year" placeholder="Enter Year " required><br><br>
        <input type="submit" name="submit" value="SUBMIT"><br><br>
    </form>
</div> 

<?php
    extract($_POST);
    if(isset($fromMonth) && isset($toMonth) && isset($year)) {
        
        while($fromMonth <= $toMonth) {
            $day = 1;
            $daysOfMonth = date('t', mktime(0, 0, 0, (int)$fromMonth , 1 , (int)$year));
            $dayOfWeek = date('N',mktime(0, 0, 0, (int)$fromMonth , 1 , (int)$year));
            $monthName = date('F Y',mktime(0, 0, 0, (int)$fromMonth , 1 , (int)$year));
            echo "<table border='1' style='float:left; margin:20px; height:200px; width:200px'>";
            echo "<caption><strong>$monthName</strong></caption>";
            echo "<tr> <th>Sun</th> <th>Mon</th> <th>Tues</th> <th>Wed</th> <th>Thu</th> <th>Fri</th> <th>Sat</th></tr>";
            echo "<tr>";
            for($i = 1; $i <= 6; $i++) {
                for($j=1; $j <= 7; $j ++) {
                    if($j <= $dayOfWeek && $i == 1 && $dayOfWeek != 7) {
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
            $fromMonth ++;
        }
    
    
    
    }
?>