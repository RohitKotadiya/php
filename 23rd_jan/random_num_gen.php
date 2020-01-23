<?php
    $number = rand(1, 6);    //generate random num
    echo "Number is => " . $number . "<br><br>"; 

    $max = getrandmax();   
    echo "Maximum Random number value is => " . $max . "<br><br>";

    $secureNumber = random_int(1, 10);
    echo "Cryptographically secure number => " . $secureNumber . "<br><br>";

    $uId = uniqid();
    echo "Unique id is => " . $uId . "<br><br>";
?>