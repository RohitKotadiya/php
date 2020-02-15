<?php
namespace App\Models;

class Category extends \Core\Model {
    public static function getCategoryList() {
        return parent::fetchData('*', 'category', "parentCategoryId IS NULL");
    }
    public static function getCategoryData() {
        return parent::fetchData('*', 'category');
    }
    public static function insertCategoryData($data) {
        return parent::insertData('category', $data);
    }
    public static function getSingleCategory($catId) {
        return parent::fetchData('*', 'category', "categoryId = $catId");
    }
    public static function updateCategoryData($data, $catId) {
        return parent::updateRecord('category', $data, "categoryId = $catId");
    }
    public static function removeCategoryData($catId) {
        $productIds = parent::fetchData('productId', 'product_category', "categoryId = $catId");
        foreach($productIds as $key) {
            foreach($key as $id) {
                parent::deleteRecord('product', "productId = $id");
            }
        }
        return parent::deleteRecord('category', "categoryId = $catId");
    }
}
?>