<?php

    $connection = mysqli_connect('localhost:3307', 'root', '', 'customer_portal') or die("Connection Error !");
    echo "Connected <br>";

    function insertData($fields, $values, $tableName) {
        global $connection;
        $tablefields = implode(",", $fields);
        $tableValues = "'" . implode("','", $values) . "'";

        $insertQuery = "insert into $tableName ($tablefields) values ($tableValues)";
        $result = mysqli_query($connection, $insertQuery);
        if($result == 1)
            echo "<br> Record Inserted";
        else
            echo "<br>". mysqli_error($connection);
    }

    insertData(['prefix', 'firstName', 'lastName', 'dateOfBirth', 'phoneNumber', 'emailAddress', 'password'], 
                ['Mr', 'Shyam', 'Patel', '1999-06-06', 9898958521, 'shyampatel@gmail.com', 'shyam123'], 'customers');

?>