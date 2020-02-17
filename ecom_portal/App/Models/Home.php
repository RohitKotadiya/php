<?php

namespace App\Models;
use PDO;
class Home extends \Core\Model {

    public static function getPageData($urlKey) {
        return parent::fetchData('*', 'cms_pages', "urlKey = '$urlKey'"); 
    }
    public static function getCategoryList() {
        $query = "SELECT
                    p.categoryId,
                    p.urlKey AS parentUrlKey,
                    p.categoryName AS parentCatName,
                    GROUP_CONCAT(c.categoryName) childCatName,
                    GROUP_CONCAT(c.urlKey) childUrlKey
                FROM
                    category AS p
                LEFT JOIN category AS c
                ON
                    p.categoryId = c.parentCategoryId
                WHERE
                    p.parentCategoryId IS NULL
                GROUP BY
                    p.categoryName";
        $db = static::getDB();
        $stmt = $db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getPageList() {
        return parent::fetchData('*', 'cms_pages');
    }
}
?>  