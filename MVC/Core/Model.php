<?php
namespace Core;
use PDO;

abstract class Model {
    protected static function getDB(){
        static $db = null;
        if($db == null) {
            $host = "localhost:3307";
            $userName = "root";
            $dbName = "ecom_mvc";
            $password = "";
            try {
                $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$userName,$password);
                return $db;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    public function insertData($tableName , $data) {
        $tablefields = implode(",", array_keys($data));
        $tableValues = [];
        foreach(array_values($data) as $value) {
            if($value != 'NULL') {
                $tableValues[] = "'" . $value . "'";
            }else {
                $tableValues[] = $value; 
            }
        }
        $tableValues = implode(",", $tableValues);
        $insertQuery = "insert into $tableName ($tablefields) values ($tableValues)";
        try {
            $db = static::getDB();
            return $db->exec($insertQuery);
        } catch(PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }
}

?>