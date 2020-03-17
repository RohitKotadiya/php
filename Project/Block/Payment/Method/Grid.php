<?php

namespace Block\Payment\Method;

class Grid extends \Block\Core\Template {
	protected $methods;

	public function __construct()
	{		
			$this->setTemplate("payment/method/show_method.php");
	}	

	public function getMethods()
	{
		return (new \Model\Payment\Method())->fetchAll();
	}
}