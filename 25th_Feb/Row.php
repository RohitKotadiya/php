<?php

require_once "Adapter.php";

class Row extends Adapter{
  
    protected $data = [];
    protected $primaryKey;
    protected $tableName;
    protected $rowChanged;
    
    public function setTableName($tableName) {
        $this->tableName = $tableName;
        return $this;
    }
    
    public function getTableName() {
        return $this->tableName;
    }
    
    public function setData($data) {
        $this->data = $data;
        return $this;
    }
    
    public function getData() {
        return $this->data;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
        return $this;
    }

    public function __get($name) {
        return $this->data[$name];
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function setRowChanged($rowChanged) {
        $this->rowChanged = $rowChanged;
        return $this;
    }

    public function getRowChanged() {
        return $this->rowChanged;
    }

    public function insertData() {
        if($this->userId) {
            $this->__unset("userId");
        }
        $tableName = $this->getTableName();
        $data = $this->getData();
        $fieldNames = implode(",", array_keys($data));
        $fieldValues = "'" . implode("','", array_values($data)) . "'";  
        $insertQuery = "INSERT INTO `$tableName` ($fieldNames) VALUES ($fieldValues)";
        $lastId = $this->insert($insertQuery);
        if($lastId) {
            $this->setRowChanged(true);
            $this->userId = $lastId;
        }
    }

    public function updateData() {
        if(!$this->userId) {
            throw new Exception("Id not avaliable");
        }
        $tableName = $this->getTableName();
        $primaryKey = $this->getPrimaryKey();
        $id = $this->userId;
        $this->__unset("userId");
        $data = $this->getData();
        foreach($data as $key => $value) {
            $tmpArr [] = $key . "=" . "'$value'";
        }
        $fields = implode(",", $tmpArr);
        $updateQuery = "UPDATE `$tableName` SET $fields WHERE $primaryKey = $id";
        if($this->update($updateQuery)) {
            $this->setRowChanged(true);
        }
    }

    public function load($id) {
        $tableName = $this->getTableName();
        $primaryKey = $this->getPrimaryKey();
        $selectQuery = "SELECT * FROM `$tableName` WHERE $primaryKey = $id";
        $this->setData($this->fetchRow($selectQuery));
        print_r($this->getData());
    }
}


$row = new Row();

echo "<pre>";

print_r($row);

$row->setTableName("user");
$row->setPrimaryKey("userId");

// $row->firstName = "Keyur";
// $row->lastName = "Solanki";
// $row->emailId = "ritu@gmail.com";
// $row->password = "123";
// $row->phoneNumber = "973654521";
// $row->insertData();

$row->load(40);

// $row->firstName = "Keyur";
// $row->lastName = "Patel";
// $row->emailId = "kotadiya1998@gmail.com";
// $row->password = "123456";
// $row->phoneNumber = "9878541245";
// $row->updateData();


// $row->__set("firstName", "Rohit");

print_r($row);
echo "</pre>";


?>