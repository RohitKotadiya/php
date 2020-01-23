<?php
    echo "Get Default time zone => ", date_default_timezone_get(), "<br><br>";

    date_default_timezone_set('Asia/kolkata'); //to set time zone

    echo "Get Default time zone => ", date_default_timezone_get(), "<br><br>";

    echo "current time => ", date('H : i : s : a'), "<br><br>";
?>