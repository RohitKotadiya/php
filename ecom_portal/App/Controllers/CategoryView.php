<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\Home;
use \App\Models\Category;

class CategoryView extends \Core\BaseController {

    public function viewAction() {
        $urlKey = $this->routeParams['urlkey'];
        $catData = Category::viewCatData($urlKey);
        $productData = Category::viewProductData($urlKey);
        $categoryList = Home::getCategoryList();
        $pageList = Home::getPageList();    
        View::renderTemplate("User/Categories/categoriesIndex.html",['categoryList' => $categoryList,
                                                'pageList' => $pageList,
                                                'catData' => $catData[0],
                                                'productData' => $productData]);
    }

}

?>