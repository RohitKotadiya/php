<?php
    $a = '1';
    echo $b = &$a , "<br>";
    var_dump($b);
    echo $c = "2$b" , "<br>";
    var_dump($c);
?>