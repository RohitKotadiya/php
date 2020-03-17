<?php

namespace Controller\Core;
use \Model\Core\Request;

class BaseController {
	protected $request;
    protected $layout;
    protected $message;
    protected $response;

	public function __construct() {
		$this->setRequest();
        $this->setLayout();
        $this->setMessage();
        $this->setResponse();
	}

    public function getRequest() {
        return $this->request;
    }
    
    public function setRequest($request = null) {
        if($request == null) {
            $request = \Ccc::objectManager("\Model\Core\Request");
        }
       $this->request = $request;
       return $this;
    }
   
    public function setResponse($response = null)
    {
        if($response == null) {
            $response = \Ccc::objectManager('\Model\Core\Response');
        }
        $this->response = $response;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function redirect($action = null, $controller = null, $params = []) {
        header("Location:" . $this->getUrl($action, $controller, $params));
    }

    public function setLayout($layout = null)
    {
        if($layout == null) {
            $layout = new \Block\Core\Layout\Layout();
        }
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function renderLayout()
    {
        $this->getResponse()->setBody($this->getLayout()->toHtml());  
    }

    public function setMessage($message = null)
    {
        if($message == null) {
            $message = new \Model\Core\Message();
        }
        $message->getSession()->setNamespace("admin");
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function popup($msg) {
        return "<script> alert('$msg'); </script>";
    }

    public function getBaseUrl($url) {
    	return \Ccc::setBaseUrl($url);
    }

    public function getUrl($action = null, $controller = null, $params = []) {
    	$parameters = [
    			'c' => null,
    			'a' => null
    		];
    	if($action == null) {
    		$parameters['a'] = $this->getRequest()->getActionName();
    	}else {
    		$parameters['a'] = $action;
    	}

    	if($controller == null) {
    		$parameters['c'] = $this->getRequest()->getControllerName();
    	}else {
    		$parameters['c'] = $controller;
    	}

    	if(is_array($params)){
			$parameters = array_merge($parameters, $params);
    	}
    	$parameters = array_filter($parameters);

    	$queryString = http_build_query($parameters);
    	return $this->getBaseUrl("?$queryString");
    }

}

?>