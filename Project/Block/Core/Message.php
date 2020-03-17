<?php  
namespace Block\Core;

class Message extends Template {

	public function __construct()
	{
		$this->setTemplate("core/message.php");
	}

	public function getMessage()
	{
		$message =  (new \Model\Core\Message())->getMessage();
		$this->clearMessage();
		return $message;
	}

	public function clearMessage()
	{
		(new \Model\Core\Message())->clearMessage();
	}
}


?>