<?php
// to Fetch Record / all Records
    $selectResult = fetchData("firstName, lastName","customers");
    echo "<pre>";
    print_r($selectResult);
    echo "</pre>";
    
    // fetchData("firstName, lastName, emailAddress", "customers", "customerId = 1")
    // fetchData("firstName, lastName, emailAddress", "customers", "prefix = 'Mrs'")
    // fetchData("*","customers")
    // fetchData("firstName, lastName","customers")

?>