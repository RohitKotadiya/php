<?php
 
    $numArray = array(10,50,60,45,25,92,75);
    echo count($numArray);
    for($i = 0; $i < count($numArray) - 1; $i ++) {
        for($j = 0; $j < count($numArray) - 1; $j++){
            if($numArray[$j] > $numArray[$j + 1]) {
                $temp = $numArray[$j];
                $numArray[$j] = $numArray[$j + 1];
                $numArray[$j + 1] = $temp;
            }
        }
    }
    print_r($numArray);

?>