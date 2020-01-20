<?php

    function calculateAge($name, $birthDate) {
        $birthYear = date('Y', strtotime($birthDate)); 
        $age = date('Y') - $birthYear; 
        echo "$name is $age years old <br>";
    }

    calculateAge("Rohit", "1998-09-23");

    function spiltDate($name, $birthDate) {
        $parts = explode("/", $birthDate);
        $birthDay = $parts[0];
        $birthMonth = $parts[1];
        $birthYear = $parts[2];
        
        echo "date of Birth " . $birthDay . " " . $birthMonth . " " . $birthYear; 

    }

    spiltDate("Manish", "21/10/1997");
?>