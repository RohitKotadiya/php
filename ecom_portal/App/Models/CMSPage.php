<?php
namespace App\Models;

class CMSPage extends \Core\Model {
    public static function getPageData() {
        return parent::fetchData('*', 'cms_pages'); 
    }
    public static function insertPageData($data) {
        return parent::insertData('cms_pages', $data);
    }
    public static function getSinglePage($pageId) {
        return parent::fetchData('*', 'cms_pages', "pageId = $pageId");
    }
    public static function updatePageData($data, $pageId) {
        return parent::updateRecord('cms_pages', $data, "pageId = $pageId");
    }
    public static function removePageData($pageId) {
        return parent::deleteRecord('cms_pages', "pageId = $pageId");
    }
}
?>