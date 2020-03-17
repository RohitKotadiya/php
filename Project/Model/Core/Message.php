<?php

namespace Model\Core;

class Message {

	const MESSAGE_SUCCESS = "success";
	const MESSAGE_WARNING = "warning";
	const MESSAGE_FAILURE = "failure";
	const MESSAGE_NOTICE = "notice";

	protected $message = [
						self::MESSAGE_SUCCESS => null,
						self::MESSAGE_NOTICE => null,
						self::MESSAGE_FAILURE => null,
						self::MESSAGE_WARNING => null
					];

	protected $session = null;

	public function __construct()
	{
		$this->setSession();
	}

	public function setSession($session = null)
	{
		if($session == null) {
			$session = \Ccc::objectManager("\Model\Core\Session");
		}
		$this->session = $session;
	}

	public function getSession()
	{
		return $this->session;
	}

	public function setMessage($message, $key = self::MESSAGE_SUCCESS)
	{	
		$this->message[$key] = $message;
		$this->getSession()->setSession($this->message);
		return $this;
	}

	public function getMessage($key = null)
	{
		if($key == null) {
			$message =  $this->getSession()->getSession();
			if(is_array($message)) {
				if(array_key_exists("message", $message))
					return $message['message'];
				
				if(!array_key_exists($key, $message)) {
					return null;
			}
		}
		}
		
		
		$message =  $this->getSession()->getSession()["message"][$key];
		return $message;
	}
	public function clearMessage()
	{
		unset($_SESSION[$this->getSession()->getNamespace()]['message']);
	}

}


?>