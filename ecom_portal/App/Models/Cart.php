<?php

namespace App\Models;
use PDO;
class Cart extends \Core\Model {
    
    public static function addProductToCart($data) {
        return parent::insertData('cart', $data);
    } 
    public static function getCartItem($id) {
        $query = "SELECT .
                    P.productId,
                    P.productName,
                    P.productImage,
                    I.price,
                    I.quantity,
                    C.totalAmount,
                    C.cartId
                FROM
                    cart as C
                LEFT JOIN 
                    cartItem as I
                ON C.cartId = I.cartId
                LEFT JOIN
                    product as P
                ON P.productId = I.productId 
                WHERE C.userId = '$id' OR C.sessionId = '$id'";
        $db = static::getDB();
        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function removeProductFromCart($productId, $cartId) {
        return parent::deleteRecord('cartItem', "cartId = '$cartId' and productId = '$productId'");
    }
    public static function  fetchItemData($data){
        $pId = $data['productId'];
        $sessionId = session_id();
        $userId = $_SESSION['userId'];
        if(!empty($userId)) {
            return parent::fetchData('cartId', 'cart', "productId = '$productId' and userId = '$userId'");
        }else {
            return parent::fetchData('cartId', 'cart', "productId = '$productId' and sessionId = '$sessionId'");
        }
    }


    public static function fetchCart($id) {
        return parent::fetchData('*', 'cart', "sessionId = '$id' OR  userId = '$id'");
    }
    public static function updateCart($data, $cartId) {
        return parent::updateRecord('cart', $data, "cartId = $cartId");
    }
    public static function addCartItem($data) {
        return parent::insertData('cartItem', $data);
    }
    public static function addNewCart($data) {
        return parent::insertData('cart', $data);
    }
}

?>