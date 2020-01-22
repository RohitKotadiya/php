<?php
    $numOne = 25;
    $numTwo = 75;
    echo "Before Swaping = >$numOne , $numTwo <br>";

    $numOne = $numOne + $numTwo;
    $numTwo = $numOne - $numTwo;
    $numOne = $numOne - $numTwo;
    echo "After Swaping = >$numOne , $numTwo";
?>
