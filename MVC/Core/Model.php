<?php
namespace Core;
use PDO;

abstract class Model {
    protected static function getDB(){
        static $db = null;
        if($db == null) {
            $host = "localhost:3307";
            $userName = "rohit";
            $dbName = "blog_portal";
            $password = "";
            try {
                $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$userName,$password);
                return $db;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}

?>