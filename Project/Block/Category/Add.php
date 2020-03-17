<?php

namespace Block\Category;

class Add extends \Block\Core\Template {
	protected $category;

	public function __construct()
	{
		$this->setTemplate("category/add_category.php");
	}

	public function setCategory($category = null)
	{
		if($category == null) {
			$category = new \Model\Category();
		}
		$this->category = $category;
		return $this;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function getParentCategories()
	{
		$category = new \Model\Category();
		$categories = $category->getAdapter()->fetchPairs("SELECT `id`,`name` FROM `category` ORDER BY `path`;");

		$rows = $category->getAdapter()->fetchPairs("SELECT `id`,`path` FROM `category` ORDER BY `path`");
		
		foreach ($rows as $key => &$path) {
			$currentPath = explode("_", $path);
			foreach ($currentPath as $key => $value) {
				if(array_key_exists($value, $categories)) {
					$currentPath[$key] = $categories[$value];
				}
			}
			$path = implode(" > ", $currentPath);
		}
		return $rows;
	}

}

?>