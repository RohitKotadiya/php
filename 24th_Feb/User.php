<?php

require_once "Adapter.php";

    if(isset($_POST['add'])) {
        addUser($_POST['register']);
    }
    if(isset($_POST['update'])) {
        updateUser($_POST['register'], $_POST['userId']);
    }
    if(isset($_GET['userId'])) {
        deleteUser($_GET['userId']);
    }
    
    function addUser($data) {
        global $adapter;
        $fieldNames = implode(",", array_keys($data));
        $fieldValues = "'" . implode("','", array_values($data)) . "'"; 
        $insertQuery = "INSERT INTO `user` ($fieldNames) VALUES ($fieldValues)";

        if(!$adapter->insert($insertQuery)) {
            echo "Error!";
        }
        header("location:showUsers.php");
    }
    function getUserData($userId) {
        global $adapter;
        $selectQuery = "SELECT * FROM `user` WHERE userId = $userId";
        return $adapter->fetchRow($selectQuery);
    }
    function updateUser($data, $userId) {
        global $adapter;
        foreach($data as $key => $value) {
            $tempArr[] = $key . "=" . "'$value'";  
        }
        $fieldValues = implode(",", $tempArr);
        $updateQuery = "UPDATE `user` SET $fieldValues WHERE userId = $userId";
        if(!$adapter->update($updateQuery)) {
            echo "Error";
        }
        header("location:showUsers.php");        
    }
    function deleteUser($id) {
        global $adapter;
        $deleteQuery = "DELETE FROM `user` WHERE userId = $id";
        if(!$adapter->deleteRecord($deleteQuery)) {
            echo "Error";
        }
        header("location:showUsers.php");        
    }
   

?>