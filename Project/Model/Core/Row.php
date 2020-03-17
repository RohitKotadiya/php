<?php

namespace Model\Core;

class Row {

    protected $data = [];
    protected $tableName;
    protected $primaryKey;
    protected $rowChanged = false;
    protected $adapter;

    public function __construct() {
        $this->setAdapter();
    }

    public function setAdapter($adapter = null) {
        if($adapter != null) {
            $this->adapter = $adapter;
        }
        $adapter = \Ccc::objectManager("\Model\Core\Adapter");
        $this->adapter = $adapter;        
        return $this;
    }

    public function getAdapter() {
        return  $this->adapter;
    }

    public function setData($data) {
        $this->setRowChanged(true);
        if(is_array($data)) {
            $this->data = array_merge($this->data, $data);
        }
        return $this;
    }

    public function getData() {
        return $this->data;
    }   

    public function __set($name, $value) {
        $this->setRowChanged(true);
        $this->data[$name] = $value;
        return $this;
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public function __get($name) {
        if(array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        else {
            return null;
        }
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName() {
        return $this->tableName;
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

    public function insert() {
        $primaryKey = $this->getPrimaryKey();
        if(array_key_exists($primaryKey, $this->getData())) {
            $this->__unset($primaryKey);
        }
        $data = $this->getData();
        $fieldNames = "`" . implode("`,`" , array_keys($data)) . "`";
        $fieldValues = "'" . implode("','", array_map('addslashes', array_values($data))) . "'";
        $insertQuery = "INSERT INTO `{$this->getTableName()}` ($fieldNames) VALUES ($fieldValues)";
        echo $insertQuery;
        $lastId = $this->getAdapter()->insert($insertQuery);
        if($lastId) {
            $this->setRowChanged(false);
            $primaryKey = $this->getPrimaryKey();
            $this->$primaryKey = $lastId;
            $this->load($lastId);
        }
        return $this;
    }

    public function update() {
        $primaryKey = $this->getPrimaryKey();
        if(!$this->$primaryKey) {
            throw new \Exception("Id Not Avaliable");
        }
        if($this->getRowChanged()) {
            $id = $this->$primaryKey;
            $this->__unset($primaryKey);
            $data = $this->getData();
            foreach($data as $key => &$value) {
                $value = $key . "=" . "'".addslashes($value)."'";
            }
            $fields = implode(",", $data);
            $updateQuery = "UPDATE `{$this->getTableName()}` SET $fields WHERE `{$this->getPrimaryKey()}` = $id";
            echo $updateQuery;   
            if($this->getAdapter()->update($updateQuery)) {
                $this->setRowChanged(false);
                $this->load($id);
                echo "updated!";
                return $this;
            }
        }else {
            echo "No Changes Found!";
        }
        
    }

    public function save() {
        if($this->__get($this->getPrimaryKey())) {
            return $this->update();
        }else {
            return $this->insert();
        }

    }

    public function load($id) {
        $selectQuery = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = $id";
        return $this->fetchRow($selectQuery);
    }

    public function fetchRow($query) {
        $row = $this->getAdapter()->fetchRow($query);
        if($row != null) {
            $this->setRowChanged(false);
            return $this->setData($row);
        }
        return null;
    }

    public function fetchAll($query = null) {
        if($query == null){
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);
        if($rows == null) {
            return null;
        }
        foreach($rows as $key => &$row) {
            $row = (new Row())->setData($row);
        }
        return $rows;
    }

    public function delete($query = null)
    {
        $id = $this->__get($this->getPrimaryKey());
        if($query == null) {
            $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = $id;";
        }
        echo $query;
        $this->getAdapter()->deleteRecord($query);
        return $this;
    }
}

?>