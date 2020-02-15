<?php
namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Category;

class Categories extends \Core\BaseController {
    public $errList = [];

    public static function add() {
        $categoryList = Category::getCategoryList();
        View::renderTemplate("Categories/showCategoryForm.html",['categoryList' => $categoryList,
                                                            'categoryData' => $_POST['category']]);
    }
    public function addCategory() {
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            echo "hi";
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            if(Category::insertCategoryData($cleanCategoryData)) {
                echo "<script> alert('Added Successfully') 
                        window.location.href = '/cybercom/php/ecom_portal/Public/Admin/Categories';
                      </script>";
            }
        }else {
            $categoryList = Category::getCategoryData();
            View::renderTemplate("Categories/showCategoryForm.html",['errList' => $this->errList,
                                                            'categoryList' => $categoryList,
                                                            'categoryData' => $_POST['category']]);     
        }
    }
    public function editCategory() {
        $categoryList = Category::getCategoryList();
        $catId = $this->routeParams['id'];
        $singleCategory = Category::getSingleCategory($catId);
        View::renderTemplate("Categories/showCategoryForm.html",['categoryList' => $categoryList,
                                                                'edit' => 'edit',
                                                                'categoryData' => $singleCategory[0]]);
    }
    public function updateCategory() {
        $categoryList = Category::getCategoryList();
        $catId = $this->routeParams['id'];
        $this->validateForm($_POST['category']);
        if(empty($this->errList)) {
            $cleanCategoryData = $this->prepareCategoryData($_POST['category']);
            if(Category::updateCategoryData($cleanCategoryData, $catId)) {
                echo "<script> alert('Category Updated Successfully');
                                window.location.href = '/cybercom/php/ecom_portal/Public/Admin/Categories';
                      </script>";
            }
        }else {
            View::renderTemplate("Categories/showCategoryForm.html", ['errList' => $this->errList,
                                                                    'categoryList' => $categoryList,
                                                                    'edit' => 'edit', 
                                                                    'categoryData' => $_POST['category']]);
        }

    }
    public function deleteCategory() {
        $catId = $this->routeParams['id'];
        if(Category::removeCategoryData($catId) ) {
            echo "<script> alert('Category Removed Successfully') 
                            window.location.href = '/cybercom/php/ecom_portal/Public/Admin/Categories';
                  </script>";
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
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
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
}
?>