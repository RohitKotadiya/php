<?php

    $studNames = ['Rohit','Ritu','Vaibhav','Mihir','Divya','Karan','Kevin','Devansh'];

    for($i = 0; $i <= sizeof($studNames); $i++){
        
        rsort($studNames);
        print_r($studNames);
        if($i == 2){
            exit("Page Closed !");
        }
        else{
            echo $studNames[$i];
        }
    }


?>