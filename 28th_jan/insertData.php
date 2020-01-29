<?php
require_once "config.php";
//to insert record
    $resultInsert = insertData(
                            ['prefix', 'firstName', 'lastName', 'dateOfBirth', 'phoneNumber', 'emailAddress', 'password'], 
                            ['Mr', 'Shyam', 'Patel', '1999-06-06', 9898958521, 'shyampatel@gmail.com', 'shyam123'],
                            'customers'
                        );
    echo ($resultInsert == 1) ? "Record Inserted <br>" : $resultInsert . "<br>";
?>