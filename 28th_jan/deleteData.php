<?php 
//to delete record
    $resultDelete = deleteRecord('customers', "customerId = 5 ");
    echo ($resultDelete == 1 ) ? "Record Deleted <br>" : $resultDelete . "<br>";
    
    // deleteRecord('customers', "firstName = 'Shyam'");
?>