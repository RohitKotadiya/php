<?php

    $userNames = ['Rohit', 'Manish', 'Riya', 'Vaibhav', 'Divya'];
    $hadoopMarks = [100,85,60,95,45];

    $value = array_search('Riya',$userNames);   //returns position of value

    echo "Value which is searched => $value <br><br>";

    array_splice($userNames, 2 , 2, $hadoopMarks);      //replce values in array
    print_r($userNames);

    echo "<br><br>" . array_sum($hadoopMarks) . "<br><br>";           //returns sum of array values

    array_shift($hadoopMarks);
    print_r($hadoopMarks);                                // remove first ele of array

?>