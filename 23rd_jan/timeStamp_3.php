<?php
    // All About time only

    echo "Current time in Numeric value => ", date('H : i : s'), "<br><br>";

    echo "Lower case am & pm => ", date('H : i : s : a'), "<br><br>";

    echo "Upper case AM & PM => ", date('H : i : s : A'), "<br><br>";

    echo "TimeZone identifier => ", date('H : i : s : e'), "<br><br>";

    echo "TimeZone Abbrevation => ", date('H : i : s : T'), "<br><br>";

    echo "Swatch Internet time => ", date('B'), "<br><br>"; //000 to 999

    echo "12 Hour Format without leading zero => ", date('H : i : s : g'), "<br><br>"; // leading zero - h

    echo "24 Hour Format without leading zero => ", date('H : i : s : G'), "<br><br>"; // leading zero - H

    echo "diff to GMT format (HHMM) => ", date('H : i : s : O'), "<br><br>";

    echo "diff to GMT format (HH:MM) => ", date('H : i : s : P'), "<br><br>";

?>