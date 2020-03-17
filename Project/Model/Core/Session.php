<?php

namespace Model\Core;

class Session {
	protected $namespace;

	public function __construct()
	{
		$this->setNamespace();
	}
	public function setNamespace($namespace = "admin")
	{
		$this->namespace = $namespace;
		return $this;
	}

	public function getNamespace()
	{
		return $this->namespace;
	}

	public function setSession($session)
	{
		$_SESSION[$this->getNamespace()]['message']= $session;
		return $this;
	}

	public function getSession()
	{
		if(!array_key_exists($this->getNamespace(), $_SESSION))  {
			return null;
		}
		return $_SESSION[$this->getNamespace()];
	}
}

?>