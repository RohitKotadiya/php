<?php
  
namespace App\Models;
use PDO;

class User extends \Core\Model {
    public static function insertUserData($data) {
        return parent::insertData('user',$data);
    }
}
?>