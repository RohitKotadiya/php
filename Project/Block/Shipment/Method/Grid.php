<?php  

namespace Block\Shipment\Method;

class Grid extends \Block\Core\Template {

	public function __construct()
	{
		$this->setTemplate("shipment/method/grid.php");
	}

	public function getMethods()
	{	
		$shipment = new \Model\Shipment\Method();
		$query = "SELECT * FROM {$shipment->getTableName()}";
		return $shipment->fetchAll($query);
	}
	
	public function getStatusOptions()
	{
		return (new \Model\Shipment\Method())->getStatusOptions();
	}
}

?>