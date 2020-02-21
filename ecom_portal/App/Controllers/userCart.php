<?php

namespace App\Controllers;
use \App\Models\Cart;
use \App\Models\Home;
use \Core\View;

class userCart extends \Core\BaseController {
    
    public function addToCart() {
        $productId = $_POST['productId'];
        $userId = $_POST['userId'];
        $price = $_POST['productPrice'];
        $quantity = $_POST['quantity'];
        if(!empty($userId)) {
            $cartExist  = $this->cartExist($userId);
            $cartData['userId'] = $userId;
        }else {
            $cartExist  = $this->cartExist(session_id());
            $cartData['userId'] = "NULL";
        }
        if($cartExist == 1) {
            $cart = Cart::fetchCart(session_id());
            $totalAmount = $cart[0]['totalAmount'];
            $totalAmount += ($quantity * $price);
            $data['totalAmount'] = $totalAmount;
            $data['updatedAt'] = date('Y-m-d H:i:s', time());
            Cart::updateCart($data, $cart[0]['cartId']);
            $cartItemData = $this->prepareCartItem($cart[0]['cartId'], $productId, $price, $quantity);
            Cart::addCartItem($cartItemData);
        }else {
            $cartData['sessionId'] = session_id();
            $cartData['createdAt'] = date('Y-m-d H:i:s', time());
            $cartData['totalAmount'] =($quantity * $price);
            $lastCartId = Cart::addNewCart($cartData);
            $cartItemData = $this->prepareCartItem($lastCartId, $productId, $price, $quantity);
            Cart::addCartItem($cartItemData);
        }
    }
    public function prepareCartItem($cartId, $productId, $price, $quantity) {
        $cartItem = [];
        $cartItem['productId'] = $productId;
        $cartItem['price'] = $price;
        $cartItem['cartId'] = $cartId;
        $cartItem['quantity'] = $quantity;
        return $cartItem;
    }
    public function showCart() {
        if(!empty($_SESSION['userId'])) {
            $id = $_SESSION['userId'];
        }else {
            $id = session_id();
        }
        $cartItems = Cart::getCartItem($id); 
        echo json_encode($cartItems);
   
    }
    public function removeCartItem() {
        $pId = $_POST['productId'];
        $cartId = $_POST['cartId'];
        $price = $_POST['price'];
        // $cart = Cart::fetchCart(session_id());
        // $totalAmount = $cart[0]['totalAmount'];
        // $totalAmount -= ($quantity * $price);
        // $data['totalAmount'] = $totalAmount;
        // Cart::updateCart($data, $cart[0]['cartId']);

        if(Cart::removeProductFromCart($pId, $cartId)) {
            echo json_encode("Item Removed");
        }
    }
    public function itemExist() {
        $result = Cart::fetchItemData($_POST);
        if(is_array($result) && !empty($result)) {
            echo json_encode(1);
        }else {
            echo json_encode(0);
        }

    }
    public function cartExist($id) {
        $result = Cart::fetchCart($id);
        if(is_array($result) && !empty($result)) {
            return 1;
        }else {
            return 0;
        }
    }
}
?>