<?php

namespace Block\Product;

class MediaGrid extends \Block\Core\Template{
	protected $productMedia;
	protected $product;

	public function __construct()
	{		
			$this->setTemplate("product/mediaGrid.php");
	}	

	public function setProductMedia($productMedia)
	{
		$this->productMedia = $productMedia;
	}

	public function getProductMedia()
	{
		return $this->productMedia;
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct()
	{
		return $this->product;
	}
}

?>