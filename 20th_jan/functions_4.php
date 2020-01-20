<?php
    class Person {
        function __construct($name, $city) {
            $this->name = $name;
            $this->city =$city;
        }
    }
    class Student extends Person {
        function __construct($name, $city, $marksR, $marksHadoop, $marksNOSQL) {
            parent::__construct($name, $city);
            $this->marksR = $marksR;
            $this->marksHadoop = $marksHadoop;
            $this->marksNOSQL = $marksNOSQL;
        }
        function calcTotal() {
            $totalMarks = $this->marksR + $this->marksHadoop + $this->marksNOSQL;
            return $totalMarks;
        }
    }
    $stud1 = new Student("Rohit", "Palanpur", 99, 100, 100);
    echo "Total Marks = > " . $stud1->calcTotal();
?>