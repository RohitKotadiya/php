<?php
    class Customer {
        function __construct($custName, $custAge, $custEmail, $custMobileNo) {
            $this -> $custName = $custName;
            $this -> $custAge = $custAge;
            $this -> $custEmail = $custEmail;
            $this -> $custMobileNo = $custMobileNo;
        }
    }

    $customerData = array();

    $rohit = new Customer("Rohit", 21, "kotadiya1998@gmail.com", 9737964512);
    $customerData[0] = $rohit;
    
    $vaibhav = new Customer("Vaibhav", 23 , "vaibhav123@gmail.com", 8140530901);
    array_push($customerData, $vaibhav);

    $divya = new Customer("Divya", 21, "divya123@gmail.com", 5454854554);
    array_push($customerData, $divya);

    print_r($customerData);
    echo "<br><br>";
    
    unset($customerData[0]);    //to remove element of array

    print_r($customerData);
?>