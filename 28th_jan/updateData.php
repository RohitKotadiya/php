<?php
//to update Record / all records
    $resultUpdate = updateRecord('customers', "firstName ='Sam', lastName = 'Patel'", "firstName = 'Shyam' and lastName = 'Patidar'");
    echo ($resultUpdate == 1 ) ? "Record Updated! <br>" : $resultUpdate . "<br>";

    // updateRecord('customers', "firstName ='SAM'", "firstName = 'Shyam'")     // particualr record
    // updateRecord('customers', "lastName = 'Patidar'")                         // all records of table
?>