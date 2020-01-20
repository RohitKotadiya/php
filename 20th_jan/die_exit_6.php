<?php
    class Person {
        public function __destruct() {
            echo "From Person Class <br>";
        }
    }
    class Animal {
        public function __destruct() {
            echo "From Animal Class <br>";
            exit;                           //prints this one desturct only
        }
    }

    $rohit = new Person;
    $cat = new Animal;    
?>