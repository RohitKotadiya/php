<?php

namespace App\Models;
use PDO;

class Post extends \Core\Model {
    public static function getData() {
    try {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM blog_post");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
    }
}
?>