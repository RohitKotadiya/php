<?php
    $str = "This is the First tutorial of the expression matching";

    if(preg_match('/the/',$str)){
        echo "Match Found";
    }else{
        echo "Word Not Found";
    }
?>