<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\Category;
use \App\Models\Product;
use \App\Models\CMSPage;

class Admin extends \Core\BaseController {

    public function login() {
        View::renderTemplate("Admin/loginForm.html");
    } 
    public function dashboard() {
        if(!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
            echo $this->displayPopup('Invalid Email Address!','login');
        }else {
            if($_POST['userEmail'] == 'kotadiya1998@gmail.com' && $_POST['password'] == '123') {
                $_SESSION['loggedIn'] = true;
                View::renderTemplate("Admin/dashboard.html");
            }else {
                echo $this->displayPopup('Invalid username or password!','login');
            }
        }
    }
    public function adminIndexAction() {
        View::renderTemplate('Admin/dashboard.html');
    }
    public function productsAction() {
        $allProducts = Product::getProductData(); 
        View::renderTemplate("Admin/Products/showProducts.html",['allProduct' => $allProducts]);   
    } 
    public function categoriesAction() {
        $allCategories = Category::getCategoryData(); 
        View::renderTemplate("Admin/Categories/showCategories.html",['allCategories' => $allCategories]);   
    }
    public function cmsPagesAction() {
        $allPages = CMSPage::getPageData(); 
        View::renderTemplate("Admin/CMSPages/showPages.html",['allPages' => $allPages]);   
    } 
    public function logoutAction() {
        if(session_destroy()) {
            header('location:login');
            exit;
        }
    }
    protected function before() {
        if($this->checkSession())
            return true;
        else {
            header('location:login');
            return false;
        }
    }
   
}
?>