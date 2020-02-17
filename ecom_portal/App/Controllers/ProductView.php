<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\Home;
use \App\Models\Product;

class ProductView extends \Core\BaseController {

    public function viewAction() {
        $urlKey = $this->routeParams['urlkey'];
        $bodyData = Product::viewProductData($urlKey);
        $categoryList = Home::getCategoryList();
        $pageList = Home::getPageList();        
        View::renderTemplate("User/Products/productIndex.html",['categoryList' => $categoryList,
                                                'pageList' => $pageList,
                                                'singleProduct' => $bodyData[0]]);
        
    }

}

?>