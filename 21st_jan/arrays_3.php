<?php
    $userCart = array(
        array(
            "pId" => 1,
            "pName" => "Samsung Galaxy Fold",
            "pPrice" => 150000
        ),
        array(
            "pId" => 2,
            "pName" => "Dell laptop",
            "pPrice" => 50000
        )
    );

    function showData() {    
        global $userCart;
        foreach($userCart as $values) {
            foreach($values as $key => $val) {
                echo "<br> $key ==> $val";
            }
            echo "<br>";
        }
    }

    $userCart[2] = array(
                    "pId" => 3,
                    "pName" => "Vivo S1",
                    "pPrice" => 25000
                );
    showData();
    
?>