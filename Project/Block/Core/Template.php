<?php

namespace Block\Core;

class Template {

	protected $template;
	protected $children = [];
	protected $layout;

	public function setTemplate($template)
	{
		$this->template = $template;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function toHtml()
	{
		ob_start();
		require "View" . DIRECTORY_SEPARATOR . $this->getTemplate();
		return $content = ob_get_clean();
	}

	public function getUrl($action = null, $controller = null, $params = [])
	{
		$url = new \Model\Core\Url();
		return $url->getUrl($action, $controller, $params);
	}

	public function addChild($class, $key)			
	{
		if(!is_object($class)) {
			$class = new $class();
		}
		$this->children[$key] = $class;
		return $this;
	}

	public function getChild($key)
	{
		if(!array_key_exists($key, $this->children)) {
			return null;
		}
		return $this->children[$key];
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function getChildHtml($className)
	{
		$class = $className();
		return $class->toHtml();
	}

	public function getMessage()
	{
		return new \Block\Core\Message();
	}

	public function setLayout($layout)	
	{
		$this->layout = $layout;
	}

	public function getLayout()
	{
		return $this->layout;
	}
}

?>