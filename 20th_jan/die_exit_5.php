<?php
    class Student {
        public function __destruct() {
            echo "Student Class <br>";
        }
        public function greetings() {
            echo "Hello ! <br>";
        }
    }
    class Animal {
        public function __destruct() {
            echo "Animal Class <br>";
        }
    }
    $rohit = new Student;
    $dog  = new Animal;
    exit;                           //prints both destructors before exit
?>