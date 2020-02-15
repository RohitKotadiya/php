<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\Product;

class Admin extends \Core\BaseController {
    public function login() {
        View::renderTemplate("Admin/loginForm.html");
    } 
    public function dashboard() {
        if(!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert('please Enter valid email');
                            window.location.href = 'login';
                 </script>";
        }else {
            if($_POST['userEmail'] == 'kotadiya1998@gmail.com' && $_POST['password'] == '123') {
                View::renderTemplate("Admin/dashboard.html");
            }else {
                echo "<script> alert('Invalid username or password!');
                                window.location.href = 'login';
                    </script>";
            }
        }
    }
    public function products() {
        $allProducts = Product::getProductData(); 
        View::renderTemplate("Products/showProducts.html",['allProduct' => $allProducts]);    } 
}


?>