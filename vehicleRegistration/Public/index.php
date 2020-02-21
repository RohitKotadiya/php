<?php
	
	require_once '../vendor/autoload.php';

	spl_autoload_register(function ($class) {
		$root = dirname(__DIR__);  //parent dir
		$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
		if(is_readable($file)) {
			require_once $root .'/' . str_replace('\\', '/', $class) . '.php';
		}
	});
	error_reporting('E_ALL');
	set_error_handler('Core\Error::errorHandler');
	set_exception_handler('Core\Error::exceptionHandler');

	$router = new Core\Router();
	
	$router->add('', ['controller' => 'Users', 'action' => 'loginForm']);
	// $router->add('admin', ['controller' => 'User', 'action' => 'home']);

	// $router->add('{urlkey:[a-zA-Z0-9-]+}', ['controller' => 'CmsPages', 'action' => 'index']); //for cms pages
	$router->add('{controller}/{action}');
	$router->add('{controller}/{id:\d+}/{action}');
	// $router->add('admin/', ['controller' => 'Admin', 'action' => 'adminIndex']); //working here
	// $router->add('admin/{controller}/{action}', ['namespace' =>'Admin']); //workiing here
	// $router->add('admin/{controller}/{id:\d+}/{action}', ['namespace' =>'Admin']);
	// $router->add('{controller}/{action}/{urlkey:[a-zA-Z0-9-]+}'); //working for view cat & product
	
	$url = $_SERVER['QUERY_STRING'];
	$router->dispatch($url);

?>