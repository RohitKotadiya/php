<?php
    $numberOne = 20;
    $numberTwo = 10;
    $factors = [];
    if($numberOne <= $numberTwo){
        $number = $numberOne;
    }else {
        $number = $numberTwo;
    }
    for($i = 1; $i <= $number; $i ++){
        if($numberOne % $i == 0 && $numberTwo % $i == 0){
            array_push($factors, $i);
        }
    }
    $value = $numberOne * $numberTwo;
    $hcf = $factors[count($factors) - 1];
    echo "LCM is => ". $value / $hcf;
?>