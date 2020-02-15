<?php

namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Product;

class Products extends \Core\BaseController {
    public $errList = [];

    public static function add() {
        $categoryList = Product::getCategoryData();
        View::renderTemplate("Products/showProductForm.html",['categoryList' => $categoryList,
                                                            'productData' => $_POST['product']]);
    }
    public function addProduct() {
        $productCatData = [];
        $this->validateForm($_POST['product']);
        if(empty($this->errList)) {
            $cleanProductData = $this->prepareProductData($_POST['product']);
            $lastProductId = Product::insertProductData($cleanProductData);
            $productCatData['productId'] = $lastProductId;
            $productCatData['categoryId'] = $_POST['product']['category'];
            
            if(Product::insertProductCatData($productCatData)){
                echo "<script> alert('Added Successfully') 
                        window.location.href = '/cybercom/php/ecom_portal/Public/Admin/Products';
                      </script>";
            }
        }else {
            $categoryList = Product::getCategoryData();
            View::renderTemplate("Products/showProductForm.html",['errList' => $this->errList,
                                                            'categoryList' => $categoryList,
                                                            'productData' => $_POST['product']]);     
        }
    }
    public function editProduct() {
        print_r($this->routeParams);
        // $productId = $this->routeParams['id'];
        // $singleProduct = Product::getSingleProduct($productId);
        // View::renderTemplate("Register/registrationForm.html",['edit' => 'edit','postData' => $singleUser[0]]);
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
                // case 'category'         : $preparedData['category'] = $fieldValue;
                //                             break;
                case 'status'           : $preparedData['status'] = $fieldValue;
                                            break;
                case 'stock'            : $preparedData['stock'] = $fieldValue;
                                            break;

            }
        }
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
        $preparedData['productImage'] = $this->validateFile('productImage');
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
                    case 'productName'    : if(!preg_match('/^[a-zA-Z]*$/', $fieldValue)) {
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
        if($this->validateFile('productImage') === false) {
            $this->errList['productImage'] = "Please select valid image";
        }
        return $this->errList;
    }
    public function validateFile($fieldName) {
        $uploadDir = '../Public/uploads/';
        $uploadFile = $uploadDir . basename($_FILES[$fieldName]['name']);
        $acceptTypes = ['image/png', 'image/jpg', 'image/jpeg'];
        if(in_array($_FILES[$fieldName]['type'], $acceptTypes)) {
            move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile);
            return $uploadDir . $_FILES[$fieldName]['name'];
        }else {
            return false;
        } 
    }
}
?>