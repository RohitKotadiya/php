<?php
    // Which is faster require OR require_once ?

    $startTime = microtime(true);

    //require 'C:/xampp/htdocs/cybercom/php/21st_jan/arrays_1.php';
    // require 'arrays_1.php';
    // require_once 'C:/xampp/htdocs/cybercom/php/21st_jan/arrays_1.php';
    require_once 'arrays_1.php';
    
    $endTime = microtime(true);
    $timeDiff = $endTime - $startTime . " , ";
    
    $myFile = fopen("time_sheet.txt", "a");
    fwrite($myFile, $timeDiff);
    fclose($myFile);
?>