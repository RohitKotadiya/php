<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\Home;

class CmsPages extends \Core\BaseController {
    
    public function indexAction() {
        $urlKey = $this->routeParams['urlkey'];
        $pageData = Home::getPageData($urlKey);
        $categoryList = Home::getCategoryList();
        $pageList = Home::getPageList();
        View::renderTemplate("Home/".$urlKey.".html",['pageData' => $pageData[0],
                                                    'categoryList' => $categoryList,
                                                        'pageList' => $pageList]);
    }
    
    protected function after() {    // why this two here and in controller also
        // echo " (After) <br> ";
    }
    protected function before() {
        // echo "<br>  (Before) ";
        // return false;   // if return false - actual action never performs
    }
}
?>