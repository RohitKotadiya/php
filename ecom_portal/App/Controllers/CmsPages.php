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
        View::renderTemplate("User/CmsPages/cmsIndex.html",['pageData' => $pageData[0],
                                                    'categoryList' => $categoryList,
                                                        'pageList' => $pageList]);
        
    }
}
?>