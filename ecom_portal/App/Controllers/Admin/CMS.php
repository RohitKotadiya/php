<?php

namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\CMSPage;

class Cms extends \Core\BaseController {
    
    public static function addAction() {
        View::renderTemplate("Admin/CMSPages/showPageForm.html",['pageData' => $_POST['page']]);
    }
    public function addPageAction() {
        $cleanPageData = $this->preparePageData($_POST['page']);
        $cleanPageData['createdAt'] = date('Y-m-d H:i:s', time());
        if(CMSPage::insertPageData($cleanPageData)) {
            echo $this->displayPopup('Added Successfully','/cybercom/php/ecom_portal/Public/Admin/cmsPages');
        }
    }
    public function editPageAction() {
        $pageId = $this->routeParams['id'];
        $singlePage = CMSPage::getSinglePage($pageId);
        View::renderTemplate("Admin/CMSPages/showPageForm.html",['edit' => 'edit',
                                                           'pageData' => $singlePage[0]]);
    }
    public function updatePageAction() {
        $catId = $this->routeParams['id'];
        $cleanPageData = $this->preparePageData($_POST['page']);
        $cleanPageData['updatedAt'] = date('Y-m-d H:i:s', time());
        if(CMSPage::updatePageData($cleanPageData, $catId)) {
            echo $this->displayPopup('Updated Successfully','/cybercom/php/ecom_portal/Public/Admin/cmsPages');
        }
    }
    public function deletePageAction() {
        $catId = $this->routeParams['id'];
        if(CMSPage::removePageData($catId) ) {
            echo $this->displayPopup('Removed Successfully','/cybercom/php/ecom_portal/Public/Admin/cmsPages');
        }
    }
    protected function preparePageData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'pageTitle'      : $preparedData['pageTitle'] = $fieldValue;
                                            break;
                case 'content'      : $preparedData['content'] = $fieldValue;
                                            break;
                case 'status'           : $preparedData['status'] = $fieldValue;
                                            break;
            }
        }
        $preparedData['urlKey'] = parent::generateUrl($_POST['page']['pageTitle']);
        return $preparedData;
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