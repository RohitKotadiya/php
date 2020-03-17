<?php

namespace Block\Product;

class Add extends \Block\Core\Template {
	protected $product;
	protected $productCategory;

	public function __construct()
	{
		$this->setTemplate("product/add_product.php");
	}

	public function setProduct($product = null)
	{
		if($product == null) {
			$product = new \Model\Product();
		}
		$this->product = $product;
		return $this;
	}

	public function getProduct()
	{
		return $this->product;
	}

	public function setProductCategory($productCategory)
	{
		$this->productCategory = $productCategory;
	}

	public function getProductCategory()
	{
		return $this->productCategory;
	}

	public function getCategoryList() {
        return (new \Model\Category)->fetchAll();
    }

}

?>