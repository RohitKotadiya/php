<?php
namespace App\Models;
use PDO;

class Category extends \Core\Model {
    public function getCategoryList() {
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
        return parent::deleteRecord('category', "categoryId = $catId");
    }

    // for front end
    public static function viewCatData($url) {
        return parent::fetchData('*', 'category', "urlKey = '$url'");
    }
    public static function viewProductData($url) {
        $query = "SELECT
                    p.* 
                    FROM product as p 
                    INNER JOIN product_category as pc 
                    ON p.productId = pc.productId 
                    INNER JOIN category as c 
                    ON c.categoryId = pc.categoryId 
                    WHERE c.urlKey = '$url'";
        $db = static::getDB();
        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>