<?php    
    require_once "config.php";
//to insert record
    // $resultInsert = insertData(
    //                         ['prefix', 'firstName', 'lastName', 'dateOfBirth', 'phoneNumber', 'emailAddress', 'password'], 
    //                         ['Mr', 'Shyam', 'Patel', '1999-06-06', 9898958521, 'shyampatel@gmail.com', 'shyam123'],
    //                         'customers'
    //                     );
    // echo ($resultInsert == 1) ? "Record Inserted <br>" : $resultInsert . "<br>";

//to delete record
    // $resultDelete = deleteRecord('customers', "customerId = 5 ");
    // echo ($resultDelete == 1 ) ? "Record Deleted <br>" : $resultDelete . "<br>";
    
    // deleteRecord('customers', "firstName = 'Shyam'");

//to update Record/ all records
    $resultUpdate = updateRecord('customers', "firstName ='Sam', lastName = 'Patel'", "firstName = 'Shyam' and lastName = 'Patidar'");
    echo ($resultUpdate == 1 ) ? "Record Updated! <br>" : $resultUpdate . "<br>";

    // updateRecord('customers', "firstName ='SAM'", "firstName = 'Shyam'")     // particualr record
    // updateRecord('customers', "lastName = 'Patidar'")                         // all records of table
?>