<?php  

namespace Block\Shipment\Method;

class Add extends \Block\Core\Template {

	protected $method;
	
	public function __construct()
	{
		$this->setTemplate("shipment/method/add.php");
	}

	public function getStatusOptions()
	{
		return (new \Model\Shipment\Method())->getStatusOptions();
	}

	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}
	public function getMethod()
	{
		return $this->method;
	}
}

?>