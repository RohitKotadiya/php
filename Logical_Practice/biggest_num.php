<?php
    $numberArray = array(10, 50, 90, 45, 62, 85, 75);

    for($i = 0; $i < count($numberArray); $i++) {
        for($j = $i + 1; $j < count($numberArray); $j++) {
            if($numberArray[$i] > $numberArray[$j])
            {
                $temp = $numberArray[$j];
                $numberArray[$j] = $numberArray[$i];
                $numberArray[$i] = $temp;
            }
        }
    }
    echo "The biggest Number in array is => " . $numberArray[count($numberArray) - 1];
?>