<?php

namespace Block\Customer;

class Add extends \Block\Core\Template {
	protected $customer;

	public function __construct()
	{
		$this->setTemplate("customer/add_customer.php");
	}

	public function setCustomer($customer = null)
	{
		if($customer == null) {
			$customer = new \Model\Customer();
		}
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer()
	{
		return $this->customer;
	}

}

?>