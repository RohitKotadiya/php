<?php

namespace Model;

class ProductCategory extends \Model\Core\Row{

	public function __construct() {
        $this->setTableName("product_category");
        $this->setPrimaryKey("productCatId");
        $this->setAdapter();
	}
}

?>