<?php

namespace Model\Product;

class ProductImage extends \Model\Core\Row{
    
    public function __construct() {
        $this->setTableName("product_image");
        $this->setPrimaryKey("id");
        $this->setAdapter();
    }
}

?>