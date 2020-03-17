<?php

namespace Block\Payment\Method;

class Add extends \Block\Core\Template {
	protected $method;

	public function __construct()
	{
		$this->setTemplate("payment/method/add_method.php");
	}

	public function setMethod($method = null)
	{
		if($method == null) {
			$method = new \Model\Payment\Method();
		}
		$this->method = $method;
		return $this;
	}

	public function getMethod()
	{
		return $this->method;
	}

}

?>