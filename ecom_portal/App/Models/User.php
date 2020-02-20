<?php
  
namespace App\Models;
use PDO;

class User extends \Core\Model {
    public static function insertUserData($data) {
        return parent::insertData('user', $data);
    }
    public static function getUserData() {
        return parent::fetchData('*', 'user');
    }
    public static function getSingleUser($userId) {
        return parent::fetchData('*', 'user', "userId = $userId");
    }
    public static function updateUserData($data, $userId) {
        return parent::updateRecord('user', $data, "userId = $userId");
    }
    public static function removeUserData($userId) {
        return parent::deleteRecord('user', "userId = $userId");
    }
    public static function fetchUserData($data) {
        $username = $data['userEmail'];
        $password = $data['password'];
        return parent::fetchData('userId', 'user', "emailId = '$username' and password = '$password'");
    }
}
?>