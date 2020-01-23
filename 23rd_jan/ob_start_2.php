<?php
  //Works on recuresive structure also

    ob_start();              // start buffer 1
    echo "Rohit ";                // add 1
       
        ob_start();              // start buffer 2
        echo "Kotadiya ";                // add 2
        $s1 = ob_get_contents(); // read 2 - "Kotadiya"
        ob_end_flush();          // flush 2 to 1
       
    echo "Palanpur ";            // continue adiing 1
    $s2 = ob_get_contents(); // read 1  -> "Rohit"  "Kotadiya "  "Palanpur"
    ob_end_flush();          // flush 1 to browser
   
    // echoes "kotadiya" followed by "3 parameters", as supposed to:
    echo "<HR>$s1<HR>$s2<HR>";
   
?>