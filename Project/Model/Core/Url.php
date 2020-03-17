<?php

namespace Model\Core;

class Url {

	public function getBaseUrl($url) {
    	return \Ccc::setBaseUrl($url);
    }

    public function getUrl($action = null, $controller = null, $params = []) {
    	$request = \Ccc::objectManager("\Model\Core\Request");;
    	$parameters = [
    			'c' => null,
    			'a' => null
    		];
    	if($action == null) {
    		$parameters['a'] = $request->getActionName();
    	}else {
    		$parameters['a'] = $action;
    	}

    	if($controller == null) {
    		$parameters['c'] = $request->getControllerName();
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