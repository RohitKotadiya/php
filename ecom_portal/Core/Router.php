<?php 

namespace Core;

class Router {
	protected $routes =  [];
	protected $params = [];

	public function add($route, $params = []) {
		
		$route = preg_replace('/\//', '\\/', $route);

		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		$route = '/^' . $route . '$/i'; 

		$this->routes[$route] = $params;

	}

	public function getRoutes() {
		return $this->routes;
	}
	public function dispatch($url) {
		$url = $this->removeQueryStringVariables($url);

		if($this->matchUrl($url)) {
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);

			// $controller = "App\Controllers\\$controller";   //replced with below line after adding subdirectories in 
																// Controllers to manage dynamically
			$controller = $this->getNamespace() . $controller;
			
			if(class_exists($controller)) {
				// $controllerObj =new $controller(); // replaced with below line after adding BaseController
				$controllerObj =new $controller($this->params);
				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);

				if(is_callable([$controllerObj, $action])) {
					$controllerObj->$action();
				}else {	
					throw new \Exception("$action method not found in class $controller");
				}		
			}else {
				throw new \Exception("$controller class not found!");
			}
		}else {
			throw new \Exception("Route Not Found!", 404);
		}
	}
	public function matchUrl($url) {
		foreach ($this->routes as $route => $params) {
			// if($url == $route) {
			// 	$this->params = $params;
			// 	return true;
			// }					//replace with below code for reg ex matching
			if(preg_match($route, $url , $matches)) {
				foreach ($matches as $key => $value) {
					if(is_string($key)) {
						$params[$key] = $value;
					}
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}
	protected function convertToStudlyCaps($string) {
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
	}
	protected function convertToCamelCase($string) {
		return lcfirst($this->convertToStudlyCaps($string));
	}
	protected function removeQueryStringVariables($url) {
		if($url != '') {
			$urlParts = explode('&', $url, 2);
			if(strpos($urlParts[0], '=') === false) {
				$url = $urlParts[0];
			}else {
				$url = '';
			}
		}
		return $url;
	}
	protected function getNamespace() {
		$namespace = 'App\Controllers\\';
		if(array_key_exists('namespace', $this->params)) {
			$namespace .= $this->params['namespace'] . '\\';
		}
		return $namespace;
	}
	public function getParams() {
		return $this->params;
	}
}
?>