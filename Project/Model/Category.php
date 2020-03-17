<?php

namespace Model;

class Category extends \Model\Core\Row {

    const STATUS_ONE = 0;
    const STATUS_LABEL_ONE = "INACTIVE";
    const STATUS_TWO = 1;
    const STATUS_LABEL_TWO = "ACTIVE";

    protected  $status = [ 
                    Category::STATUS_ONE => Category::STATUS_LABEL_ONE , 
                    Category::STATUS_TWO => Category::STATUS_LABEL_TWO 
                ];

    public function __construct() {
        $this->setTableName("category");
        $this->setPrimaryKey("id");
        $this->setAdapter();
    }

    public function getStatusOptions(){
        return $this->status;
    }

    public function getParentCategory()
    {
        $category = new Category();
        $parentCategory = $category->load($this->parentId);
        return $parentCategory;
    }

    public function getChildCategoryPaths($category)
    {
        $categoryId = $category->id;
        $categories = $this->getAdapter()->fetchPairs("SELECT `id`,`path` FROM `category` ORDER BY `path`");
        $childPaths = [];
        foreach ($categories as $key => $path) {
            $currentPath = explode("_", $path);
            foreach ($currentPath as $key => $value) {
                if(count($currentPath) > 1 && $categoryId ==  $value) {
                    $childPaths[] = $path;
                }
            }
        }
        $finalChildPaths = [];
        if($childPaths) {
            foreach ($childPaths as $key => $childPath) {
                $pathLast = substr($childPath, strpos($childPath, $categoryId));
                if($parent = $this->getParentCategory()) {
                    $finalChildPaths[] = $parent->path . "_" . $pathLast;
                }else {
                    $finalChildPaths[] = $pathLast;
                }
            }
        }
        return $finalChildPaths;
    }
}
?>