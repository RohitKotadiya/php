<?php

namespace Model\Core;

class Adapter {

    protected $config = [
        'hostName' => 'localhost:3307',
        'userName' => 'root',
        'password' => '',
        'dbName' => 'project'
    ];
    protected $connect;
    protected $query;

    public function setConfig($config) {

        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function getConfig() {
        return $this->config;
    }

    public function setConnect($connect) {
        $this->connect = $connect;
        return $this;
    }

    public function getConnect() {
        return $this->connect;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function getQuery() {
        return $this->query;
    }

    public function connect() {
        $config = $this->getConfig();
        try{
            $connect = new \mysqli($config['hostName'], $config['userName'], $config['password'], $config['dbName']);
            $this->setConnect($connect);
        }catch(\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function isConnected() {
        if(!$this->getConnect()) {
            return false;
        }
        return true;
    }
    public function insert($query) {
        $result = $this->query($query);
        if($result) {
            return $this->getConnect()->insert_id;
        }
        return null;
    }

    public function update($query) {
        $result = $this->query($query);
        print_r($result);
        if($result) {
            return true;
        }    
        return false;
        
    }

    public function fetchRow($query) {
        $result = $this->query($query);
        if($result) {
            return $result->fetch_assoc();
        }
        return $this;
    }

    public function fetchAll($query) {
        $result = $this->query($query);
        if($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    public function fetchPairs($query) {
        $result = $this->query($query);
        if($result) {
            $data = [];
            while ($row = $result->fetch_row()) {
                $data[$row[0]] = $row[1];
            }
            return $data;
        }
        return null;
    }

    public function fetchOne($query) {
        $result = $this->query($query);
        if($result) {
            return $result->fetch_row()[0];
        }
        return null;
    }
    public function deleteRecord($query) {
        $result = $this->query($query);
        if($result) {
            return true;
        }
        return false;
    }
    public function query($query) {
        if(!$this->isConnected()) {
            $this->connect();
        }
        $this->setQuery($query);
        return $this->getConnect()->query($this->getQuery());
    }
}
?>