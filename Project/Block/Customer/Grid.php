<?php

namespace Block\Customer;

class Grid extends \Block\Core\Template {
	protected $customers;

	public function __construct()
	{		
			$this->setTemplate("customer/show_customers.php");
	}	

	public function getCustomers()
	{
		$query = "SELECT
                    C.id AS customerId,
                    C.firstName,
                    C.lastName,
                    C.emailId,
                    C.phoneNumber,
                    A.city
                FROM
                    `customer` AS C
                LEFT JOIN `address` AS A
                ON
                    C.id = A.customerId";
		return (new \Model\Customer())->fetchAll($query);
	}
}