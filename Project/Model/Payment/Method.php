<?php

namespace Model\Payment;

class Method extends \Model\Core\Row {

	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LABEL = "ACTIVE";
	const STATUS_INACTIVE = 0;
	const STATUS_INACTIVE_LABEL = "INACTIVE";

	protected $status = [
						self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL,
						self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL
					];
   
	public function __construct()
	{
        $this->setTableName("payment_method");
        $this->setPrimaryKey("id");
        $this->setAdapter();
	}

	public function getStatusOptions(){
        return $this->status;
    }
}

?>