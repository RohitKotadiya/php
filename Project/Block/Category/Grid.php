<?php

namespace Block\Category;

class Grid extends \Block\Core\Template {
	protected $Categories;

	public function __construct()
	{		
			$this->setTemplate("category/show_Category.php");
	}	

	public function getCategories()
	{
		return (new \Model\Category)->fetchAll();	
	}

	public function loadParents($category)
	{
		$rows = (new Add())->getParentCategories();
		if (array_key_exists($category->id, $rows)) {
			return $rows[$category->id];
		}
	}
}