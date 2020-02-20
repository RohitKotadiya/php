<?php

namespace App\Models;
use PDO;
class Cart extends \Core\Model {
    
    public static function addProductToCart($data) {
        return parent::insertData('cart', $data);
    } 
    public static function getCartItem($userId) {
        $query = "SELECT
                    P.*,
                    C.quantity
                FROM
                    cart as C
                LEFT JOIN 
                    product as P
                ON
                    C.productId = P.productId
                WHERE C.userId = $userId";
        $db = static::getDB();
        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function removeProductFromCart($productId, $userId) {
        return parent::deleteRecord('cart', "userId = '$userId' and productId = '$productId'");
    }
}

?>