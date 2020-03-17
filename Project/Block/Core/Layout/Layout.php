<?php

namespace Block\Core\Layout;

class Layout extends \Block\Core\Template {

	public function __construct()			
	{
		$this->setTemplate("core\layout\one-column.php");
		$this->addChild("\Block\Core\Layout\Element\Header", "header");
		$this->addChild("\Block\Core\Layout\Element\Content", "content");
		$this->addChild("\Block\Core\Layout\Element\Footer", "footer");

	}

	public function createBlock($class)
	{
		$object = new $class();
		$object->setLayout($this);
		return $object;
	}
} 