<?php
    $current = 0;
    $next = 1;
    $sum =0;
    
    echo $current ." " . $next . " ";

    for($i = 0; $i <= 10; $i++) {
        $sum = $current + $next;      
        echo $sum . " "; 
        $current = $next;
        $next = $sum;
    }

?>