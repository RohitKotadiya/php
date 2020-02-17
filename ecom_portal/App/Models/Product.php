<?php

namespace App\Models;

class Product extends \Core\Model {
    public static function getCategoryData() {
        return parent::fetchData('categoryId,categoryName', 'category');
    }
    public static function getProductData() {
        return parent::fetchData('*', 'product'); 
    }
    public static function insertProductData($data) {
        return parent::insertData('product', $data);
    }
    public static function insertProductCatData($data) {
        return parent::insertData('product_category', $data);
    }
    public static function getSingleProduct($productId) {
        $productData[] = parent::fetchData('*', 'product', "productId = $productId");
        $catData[] = parent::fetchData('categoryId', 'product_category', "productId = $productId");
        $productData = $productData[0][0];
        $productData['categoryId'] = $catData[0][0]['categoryId'];
        return $productData;
    }
    public static function updateProductData($data, $productId) {
        return parent::updateRecord('product', $data, "productId = $productId");
    }
    public static function updateProductCatData($data, $productId) {
        return parent::updateRecord('product_category', $data, "productId = $productId");
    }
    public static function removeProductData($productId) {
        return parent::deleteRecord('product', "productId = $productId");
    }


    //frontend

    public static function viewProductData($url) {
        return parent::fetchData('*', 'product', "urlKey = '$url'");
    }
}
?>
