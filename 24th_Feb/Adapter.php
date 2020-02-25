<?php

class Adapter {

    protected $config = [
        'hostName' => 'localhost:3307',
        'userName' => 'root',
        'password' => '',
        'dbName' => 'vehicle_service_portal'
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
            $connect = new mysqli($config['hostName'], $config['userName'], $config['password'], $config['dbName']);
            $this->setConnect($connect);
        }catch(Exception $ex) {
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
        return null;
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
            print_r($data);
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

$adapter = new Adapter();

$config = [
    'host' => 'localhost:3307',
    'userName' => 'root',
    'password' => '',
    'dbName' => 'vehicle_service_portal'
];
echo "<pre>";
// print_r($adapter);

$adapter->setConfig($config)->connect();

// $adapter->insert("INSERT INTO `user` (firstName) VALUES ('Keyur')");

// $adapter->update("UPDATE `user` SET firstName = 'Kishan' WHERE userId = 23");

// $result = $adapter->fetchRow("SELECT * FROM `user` WHERE userId = 23");

// $allData = $adapter->fetchAll("SELECT * FROM `user`");

$pairData = $adapter->fetchPairs("SELECT userId, firstName FROM `user`");

// $oneValue = $adapter->fetchOne("SELECT count(userId) FROM `user`");

// echo $oneValue;
// // print_r($result);
// // print_r($allData);
// print_r($pairData);
// print_r($adapter);
echo "</pre>";
?>