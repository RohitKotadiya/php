<?php

namespace Block\Product;

class Grid extends \Block\Core\Template {
	protected $products;

	public function __construct()
	{		
			$this->setTemplate("product/show_products.php");
	}	

	public function getProducts()
	{
		return (new \Model\Product\Product)->fetchAll();
	}
}