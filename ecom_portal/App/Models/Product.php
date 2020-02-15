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
}
?>
