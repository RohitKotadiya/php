<html>
    <head>
        <title> Calender </title>
        <link href="calender.css" type="text/css" rel="stylesheet">
    </head>
<hr>
<div id="firstFrame">
    <h2>One Month Calender</h2>
    <form action="calender.php" method="POST">
        <input type="number" name="month" placeholder="Enter Month here" required><br><br>
        <input type="number" name="year" placeholder="Enter Year here" required><br><br>
        <input type="submit" name="submit" value="SUBMIT"><br><br>
    </form>
</div>
<?php
    extract($_POST);
    session_start();
    if(isset($month) && isset($year)) {
        $_SESSION['month'] = $month;
        $_SESSION['year'] = $year;
        showCalender($month, $year);
    }else if($_SESSION['month'] != null && $_SESSION['year'] != null) {
            showCalender($_SESSION['month'],$_SESSION['year']);
    }else {
        echo "<script> alert('Please fill Form First');</script>";
        die();   
    }
    function showCalender($userMonth, $userYear) {
            $day = 1;
            $daysOfMonth = date('t', mktime(0, 0, 0, (int)$userMonth , 1 , (int)$userYear));
            $dayOfWeek = date('N',mktime(0, 0, 0, (int)$userMonth , 1 , (int)$userYear));
            $monthName = date('F Y',mktime(0, 0, 0, (int)$userMonth , 1 , (int)$userYear));
            echo "<table border='1'>";
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
    }
      
?>
