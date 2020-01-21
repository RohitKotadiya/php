<?php

    //way of declare array and show array data 
    $numArray = [10, 20, 50, 60, 25, 85, 45, 50];
    print_r($numArray);

    
    $studentMarks = array(50, 60, 99, 85, 75, 45, 20, 65, 45);
    for($i = 0; $i < count($studentMarks); $i++) {
        echo "<br>" . $studentMarks[$i];
    }

    echo "<br>";

    $hadoopMarks = array(50, 60, 45, 85, 95, 65, 84);
    for($i = 0; $i < sizeOf($hadoopMarks); $i++) {
        echo "<br>" . $hadoopMarks[$i];
    }

    $userData = array(
            "id" => 1,
            "userName" => "Rohit", 
            "city" => "Palanpur"
        );
    
    echo "<br>";    
    foreach($userData as $key => $value) {
        echo "<br>" . $key . " = " . $value;
    }

    $products = array(
        array(
            "productId" => 1,
            "productName" => "Vivo s1",
            "productPrice" => 25000,
            "availbility" => 1
        ),
        array(
            "productId" => 2,
            "productName" => "samsung fold",
            "productPrice" => 180000,
            "availblity" => 1
        ),
        array(
            "productId" => 3,
            "productName" => "samsung A50s",
            "productPrice" => 21000,
            "availability" => 1            
        )
    );
    
    echo "<br>";

    foreach($products as $key => $value) {
        echo "<br>";
        foreach($value as $val => $productvalue) {
            echo "<br>" . $val . " => " . $productvalue; 
        }
    }
?>