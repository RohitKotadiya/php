<?php

    $studentNames = array("Rohit", "Divya", "Mittal", "Manish", "Ankit", "Vihar", "Ritu", "Binal");
    $userNames = array("Neha", "Riya", "Priyanka", "Khushbu", "Nirali");
    
    print_r($studentNames);

    sort($studentNames);            //sorts array
    echo "<br><br>";
    print_r($studentNames);

    rsort($studentNames);           //sorts the array in reverse order
    echo "<br><br>";
    print_r($studentNames);

    $personNames = array_merge($studentNames, $userNames);
    echo "<br><br>";
    print_r($personNames);

    echo "<br><br>";
    var_dump($personNames);
    echo "<br><br>";
    
    foreach($personNames as $person) {
        if(strlen($person) > 5 ) {
            echo "<br> $person";
        }
    }
?>