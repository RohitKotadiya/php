<?php
    //all About date only 

    echo "Full Date => ", date('c'), "<br><br>";

    echo "full date Formatted => ", date('r'), "<br><br>";

    echo "Current day & Month leading Zero => " , date('d - m - Y', 2020/1/1) , "<br><br>";

    echo "Current day & Month without leading Zero => ", date('j - n - Y', 2020/01/01), "<br><br>";

    echo "Full day & Full Month => ", date('l - F - y'), "<br><br>";

    echo "Leap Year Or Not ? => ", date('L'), "<br><br>"; //returns 0 or 1

    echo "Number of days in month => ", date('t') , "<br><br>";

    echo "Day of the year = > ", date('z'), "<br><br>"; //starts from 0

    echo "English Ordinal Suffix on day of month => ", date('d S - M - Y'), "<br><br>";
?>