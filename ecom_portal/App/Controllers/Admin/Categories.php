<?php
namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Category;

class Categories extends \Core\BaseController {
    public $errList = [];
    public function __construct($routeParams) {
        parent::__construct($routeParams);
        $catObj = new Category();
        $this->categoryList = $catObj->getCategoryList();
    }
    public function addAction() {
       View::renderTemplate("Admin/Categories/showCategoryForm.html",[
                                                            'categoryList' => $this->categoryList,
                                                            'categoryData' => $_POST['category']]);
    }
    public function addCategoryAction() {
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            $cleanCategoryData['createdAt'] = date('Y-m-d H:i:s', time());
            if(Category::insertCategoryData($cleanCategoryData)) {
                echo $this->displayPopup('Added Successfully','/cybercom/php/ecom_portal/Public/Admin/Categories');
            }
        }else {
            View::renderTemplate("Admin/Categories/showCategoryForm.html",['errList' => $this->errList,
                                                            'categoryList' => $this->categoryList,
                                                            'categoryData' => $_POST['category']]);     
        }
    }
    public function editCategoryAction() {
        $catId = $this->routeParams['id'];
        $singleCategory = Category::getSingleCategory($catId);
        View::renderTemplate("Admin/Categories/showCategoryForm.html",['categoryList' => $this->categoryList,
                                                                'edit' => 'edit',
                                                                'categoryData' => $singleCategory[0]]);
    }
    public function updateCategoryAction() {
        $catId = $this->routeParams['id'];
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            $cleanCategoryData['updatedAt'] = date('Y-m-d H:i:s', time());
            if(Category::updateCategoryData($cleanCategoryData, $catId)) {
                echo $this->displayPopup('Updated Successfully','/cybercom/php/ecom_portal/Public/Admin/Categories');
            }
        }else {
            View::renderTemplate("Admin/Categories/showCategoryForm.html", ['errList' => $this->errList,
                                                                    'categoryList' => $this->categoryList,
                                                                    'edit' => 'edit', 
                                                                    'categoryData' => $_POST['category']]);
        }

    }
    public function deleteCategoryAction() {
        $catId = $this->routeParams['id'];
        if(Category::removeCategoryData($catId) ) {
            echo $this->displayPopup('Removed Successfully','/cybercom/php/ecom_portal/Public/Admin/Categories');
        }
    }
    protected function prepareCategoryData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'categoryName'      : $preparedData['categoryName'] = $fieldValue;
                                            break;
                case 'description'      : $preparedData['description'] = $fieldValue;
                                            break;
                case 'urlKey'           : $preparedData['urlKey'] = $fieldValue;
                                            break;
                case 'parentCategoryId'         : $preparedData['parentCategoryId'] = $fieldValue;
                                            break;
                case 'status'           : $preparedData['status'] = $fieldValue;
                                            break;
            }
        }
        $preparedData['categoryImage'] = parent::validateFile('categoryImage', 'categories');
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
                    case 'categoryName'    : if(!preg_match('/^[a-zA-Z ]*$/', $fieldValue)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                }
            }
        }
        if(parent::validateFile('categoryImage') === false) {
            $this->errList['categoryImage'] = "Please select valid image";
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