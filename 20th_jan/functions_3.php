<?php
    class Person {
        public function showData($name, $city, $designation) {
            echo "$name  is $designation and he/she is from $city";
        }
    }
    $person1 = new Person();
    $person1->showData("Rohit", "Palanpur", "Intern");
?>