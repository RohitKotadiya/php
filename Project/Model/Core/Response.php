<?php 

namespace Model\Core;

class Response {
	
	public function setBody($html)
	{
		echo $html;
	}

	public function getJson($html)
	{
		$this->setHeader('application/json');
		echo $html;
	}

	public function setHeader($header)
	{
		header("Content-Type: {$header}");
	}
}

?>