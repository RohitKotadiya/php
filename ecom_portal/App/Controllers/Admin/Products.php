<?php

namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Product;

class Products extends \Core\BaseController {
    public $errList = [];

    public static function addAction() {
        $categoryList = Product::getCategoryData();
        View::renderTemplate("Admin/Products/showProductForm.html",['categoryList' => $categoryList,
                                                            'productData' => $_POST['product']]);
    }
    public function addProductAction() {
        $productCatData = [];
        $this->validateForm($_POST['product']);
        if(empty($this->errList)) {
            $cleanProductData = $this->prepareProductData($_POST['product']);
            $cleanProductData['createdAt'] = date('Y-m-d H:i:s', time());
            $lastProductId = Product::insertProductData($cleanProductData);
            $productCatData['productId'] = $lastProductId;
            $productCatData['categoryId'] = $_POST['product']['category'];
            
            if(Product::insertProductCatData($productCatData)){
                echo $this->displayPopup('Added Successfully','/cybercom/php/ecom_portal/Public/Admin/Products');
            }
        }else {
            $categoryList = Product::getCategoryData();
            View::renderTemplate("Admin/Products/showProductForm.html",['errList' => $this->errList,
                                                            'categoryList' => $categoryList,
                                                            'productData' => $_POST['product']]);     
        }
    }
    public function editProductAction() {
        $categoryList = Product::getCategoryData();
        $productId = $this->routeParams['id'];
        $singleProduct = Product::getSingleProduct($productId);
        View::renderTemplate("Admin/Products/showProductForm.html",['categoryList' => $categoryList,
                                                                'edit' => 'edit',
                                                                'productData' => $singleProduct]);
    }
    public function updateProductAction() {
        $categoryList = Product::getCategoryData();
        $productId = $this->routeParams['id'];
        $this->validateForm($_POST['product']);
        if(empty($this->errList)) {
            $cleanProductData = $this->prepareProductData($_POST['product']);
            $cleanProductData['updatedAt'] = date('Y-m-d H:i:s', time());
            $productCatData['categoryId'] = $_POST['product']['category'];
            Product::updateProductCatData($productCatData, $productId);
            if(Product::updateProductData($cleanProductData, $productId)) {
                echo $this->displayPopup('Updated Successfully','/cybercom/php/ecom_portal/Public/Admin/Products');
            }
        }else {
            View::renderTemplate("Admin/Products/showProductForm.html", ['errList' => $this->errList,
                                                                    'categoryList' => $categoryList,
                                                                    'edit' => 'edit', 
                                                                    'productData' => $_POST['product']]);
        }

    }
    public function deleteUserAction() {
        $productId = $this->routeParams['id'];
        if(Product::removeProductData($productId) ) {
            echo $this->displayPopup('Removed Successfully','/cybercom/php/ecom_portal/Public/Admin/Products');
        }
    }
    protected function prepareProductData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'productName'      : $preparedData['productName'] = $fieldValue;
                                            break;
                case 'productDesc'      : $preparedData['productDesc'] = $fieldValue;
                                            break;
                case 'shortDesc'        : $preparedData['shortDesc'] = $fieldValue;
                                            break;
                case 'price'            : $preparedData['price'] = $fieldValue;
                                            break;
                case 'urlKey'           : $preparedData['urlKey'] = $fieldValue;
                                            break;
                case 'SKU'              : $preparedData['SKU'] = $fieldValue;
                                            break;
                case 'status'           : $preparedData['status'] = $fieldValue;
                                            break;
                case 'stock'            : $preparedData['stock'] = $fieldValue;
                                            break;

            }
        }
        $preparedData['productImage'] = parent::validateFile('productImage');
        return $preparedData;
    }
    protected function validateForm($formData) {
        $this->errList  = [];
        $errMsg = "please enter valid ";
        foreach($formData as $fieldName => $fieldValue) {
            if(empty($fieldValue)) {
                $emptyMsg = "Missing $fieldName";
                $this->errList[$fieldName] = $emptyMsg;
            }else {
                switch($fieldName) {
                    case 'productName'    : if(!preg_match('/^[a-zA-Z ]*$/', $fieldValue)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    case 'stock'          : if(!preg_match('/^[0-9]*$/', $fieldValue)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                }
            }
        }
        if(parent::validateFile('productImage') === false) {
            $this->errList['productImage'] = "Please select valid image";
        }
        return $this->errList;
    }
    protected function before() { 
        if($this->checkSession())
            return true;
        else {
            header('location:../login');
            return false;
        }
    }
}
?>