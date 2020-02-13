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
    public function fetchData($columnNames, $tableName , $condition ="") {
        $searchQuery = (func_num_args() == 3 ) 
                        ? "select $columnNames from $tableName where $condition" 
                        : "select $columnNames from $tableName";
        try {
            $db = static::getDB();
            $stmt = $db->query($searchQuery);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }   
    public function updateRecord($tableName, $data, $condition ="") {
        $tempArr = [];
        foreach($data as $key => $value) {
            if($value != 'NULL')
                $tempArr[] = $key . "=" . "'$value'"; 
            else 
                $tempArr[] = $key . "=" . "$value"; 
        }
        $fieldValue = implode(",", $tempArr);
        $updateQuery = (func_num_args() == 3 ) 
                        ? "update $tableName set $fieldValue where $condition" 
                        : "update $tableName set $fieldValue";
        // echo "$updateQuery<br><br>";
        try {
            $db = static::getDB();
            return $db->exec($updateQuery);
        } catch(PDOException $e) {
            echo "Error : " . $e->getMessage();
        }    
    }
    public function deleteRecord($tableName, $condition) {
        $deleteQuery = "delete from $tableName where $condition";
        // echo "$deleteQuery";
        try {
            $db = static::getDB();
            return $db->exec($deleteQuery);
        } catch(PDOException $e) {
            echo "Error : " . $e->getMessage();
        }     
    } 
}

?>