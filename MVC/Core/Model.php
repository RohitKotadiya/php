<?php
namespace Core;
use PDO;
use \App\Config;

abstract class Model {
    protected static function getDB(){
        static $db = null;
        if($db == null) {
            $db = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=utf8",
                            Config::DB_USER ,Config::DB_PASSWORD);
            
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
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