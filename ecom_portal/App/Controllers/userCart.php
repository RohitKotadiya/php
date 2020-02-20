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
            $cartItems = Cart::getCartItem($_SESSION['userId']); 
            // print_r($cartItems);
            echo json_encode($cartItems);
        }
    }
    public function showCart() {
        $cartItems = Cart::getCartItem($_SESSION['userId']); 
        $categoryList = Home::getCategoryList();
        $pageList = Home::getPageList();
        View::renderTemplate("User/Cart/showCart.html",['categoryList' => $categoryList,
                                                                'pageList' => $pageList,
                                                                'cartItems' => $cartItems]);
    }
}
?>