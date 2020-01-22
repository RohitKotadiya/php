<?php
    $numberOne = 24;
    $numberTwo = 30;
    $factors =[];
    if($numberOne < $numberTwo):
        $smallNum = $numberOne;
    else:
        $smallNum = $numberTwo;
    endif;
    for($i = 1; $i <= $smallNum; $i++) {
        if($numberOne % $i == 0 && $numberTwo % $i == 0) {
            array_push($factors, $i);
        }
    }
    echo "<br><br> HCF of $numberOne and $numberTwo is => ";
    print_r($factors[count($factors)-1]);
?>