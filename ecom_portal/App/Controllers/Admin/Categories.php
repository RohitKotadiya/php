<?php
namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Category;

class Categories extends \Core\BaseController {
    public $errList = [];

    public static function addAction() {
        // echo "ho";
        $categoryList = Category::getCategoryList();
        View::renderTemplate("Categories/showCategoryForm.html",['categoryList' => $categoryList,
                                                            'categoryData' => $_POST['category']]);
    }
    public function addCategoryAction() {
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            echo "hi";
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            $cleanCategoryData['createdAt'] = date('Y-m-d H:i:s', time());
            if(Category::insertCategoryData($cleanCategoryData)) {
                echo $this->displayPopup('Added Successfully','/cybercom/php/ecom_portal/Public/Admin/Categories');
            }
        }else {
            $categoryList = Category::getCategoryData();
            View::renderTemplate("Categories/showCategoryForm.html",['errList' => $this->errList,
                                                            'categoryList' => $categoryList,
                                                            'categoryData' => $_POST['category']]);     
        }
    }
    public function editCategoryAction() {
        $categoryList = Category::getCategoryList();
        $catId = $this->routeParams['id'];
        $singleCategory = Category::getSingleCategory($catId);
        View::renderTemplate("Categories/showCategoryForm.html",['categoryList' => $categoryList,
                                                                'edit' => 'edit',
                                                                'categoryData' => $singleCategory[0]]);
    }
    public function updateCategoryAction() {
        $categoryList = Category::getCategoryList();
        $catId = $this->routeParams['id'];
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            $cleanCategoryData['updatedAt'] = date('Y-m-d H:i:s', time());
            if(Category::updateCategoryData($cleanCategoryData, $catId)) {
                echo $this->displayPopup('Updated Successfully','/cybercom/php/ecom_portal/Public/Admin/Categories');
            }
        }else {
            View::renderTemplate("Categories/showCategoryForm.html", ['errList' => $this->errList,
                                                                    'categoryList' => $categoryList,
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
        $preparedData['categoryImage'] = $this->validateFile('categoryImage');
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
        if($this->validateFile('categoryImage') === false) {
            $this->errList['categoryImage'] = "Please select valid image";
        }
        return $this->errList;
    }
    public function validateFile($fieldName) {
        $uploadDir = '../Public/uploads/categories/';
        $uploadFile = $uploadDir . basename($_FILES[$fieldName]['name']);
        $acceptTypes = ['image/png', 'image/jpg', 'image/jpeg'];
        if(in_array($_FILES[$fieldName]['type'], $acceptTypes)) {
            move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile);
            return $uploadDir . $_FILES[$fieldName]['name'];
        }else {
            return false;
        } 
    }
    protected function before() { // why this two here and in Home also
        if($this->checkSession())
            return true;
        else {
            header('location:../login');
            return false;
        }
    }
}
?>