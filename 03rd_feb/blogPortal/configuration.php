<?php

    $connection = mysqli_connect('localhost:3307', 'root', '', 'blog_portal') or die("Connection Error !");
    echo "Connected <br>";

    function insertData($data, $tableName) {
        global $connection;
        $tablefields = implode(",", array_keys($data));
        $tableValues = "'" . implode("','", array_values($data)) . "'";

        $insertQuery = "insert into $tableName ($tablefields) values ($tableValues)";
        // echo "<br>" . $insertQuery;
        return (mysqli_query($connection, $insertQuery) == 1 ) ? mysqli_insert_id($connection) : mysqli_error($connection);
    } 
    function deleteRecord($tableName, $condition) {
        global $connection;
        $deleteQuery = "delete from $tableName where $condition";
        return (mysqli_query($connection, $deleteQuery) == 1 ) ? 1 : mysqli_error($connection);
    }
    function updateRecord($tableName, $data, $condition ="") {
        global $connection;
        $tempArr = [];
        foreach($data as $key => $value) {
            $tempArr[] = $key . "=" . "'$value'"; 
        }
        $fieldValue = implode(",", $tempArr);
        $updateQuery = (func_num_args() == 3 ) 
                        ? "update $tableName set $fieldValue where $condition" 
                        : "update $tableName set $fieldValue";
        // echo "$updateQuery<br><br>";
        return (mysqli_query($connection, $updateQuery) == 1 ) ? 1 : mysqli_error($connection);
    } 
    function fetchData($columnNames, $tableName , $condition ="") {
        global $connection;
        $resultSet = [];
        $err = "No Record Found";
        $searchQuery = (func_num_args() == 3 ) 
                        ? "select $columnNames from $tableName where $condition" 
                        : "select $columnNames from $tableName";
        // echo $searchQuery;
        $searchResult = mysqli_query($connection, $searchQuery);
        if(mysqli_num_rows($searchResult) > 0 ) {
            while($row = mysqli_fetch_assoc($searchResult)) {
                array_push($resultSet, $row);
            }
            return $resultSet;
        }else {
            return $err;
        }
    }   
    function getLastRecordId($columnName, $tableName) {
        $lastCust = fetchData($columnName, $tableName, "$columnName = (select max($columnName) from $tableName)");
        $lastCustId = $lastCust[0][$columnName];
        return $lastCustId;
    }
    function addLastId($arrData,$keyName, $lastId) {
        $arrData[$keyName] = $lastId;
        return $arrData;
    }
?>