<?php

namespace App\Controllers;
use \App\Models\Cart;
use \App\Models\Home;
use \Core\View;

class userCart extends \Core\BaseController {
    
    public function addToCart() {
        $cartData['productId'] = $_POST['productId'];
        $cartData['userId'] = $_POST['userId'];
        $cartData['quantity'] = $_POST['quantity'];
        if(Cart::addProductToCart($cartData)) {
            echo json_encode("Added to cart!");
        }
    }
    public function showCart() {
        $cartItems = Cart::getCartItem($_SESSION['userId']); 
        echo json_encode($cartItems);
   
    }
    public function removeCartItem() {
        $pId = $_POST['productId'];
        if(Cart::removeProductFromCart($pId, $_SESSION['userId'])) {
            echo json_encode("Item Removed");
        }
    }
}
?>