<?php

    $connection = mysqli_connect('localhost:3307', 'root', '', 'customer_portal') or die("Connection Error !");
    echo "Connected <br>";

    function insertData($fields, $values, $tableName) {
        global $connection;
        $tablefields = implode(",", $fields);
        $tableValues = "'" . implode("','", $values) . "'";

        $insertQuery = "insert into $tableName ($tablefields) values ($tableValues)";
        return (mysqli_query($connection, $insertQuery) == 1 ) ? 1 : mysqli_error($connection);
    } 
    function deleteRecord($tableName, $condition) {
        global $connection;
        $deleteQuery = "delete from $tableName where $condition";
        return (mysqli_query($connection, $deleteQuery) == 1 ) ? 1 : mysqli_error($connection);
    }    
?>