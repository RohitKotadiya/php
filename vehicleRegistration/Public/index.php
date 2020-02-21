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
	$router->add('admin', ['controller' => 'Admin', 'action' => 'dashboard']);
	$router->add('{controller}/{action}');
	$router->add('{controller}/{id:\d+}/{action}');
	
	$url = $_SERVER['QUERY_STRING'];
	$router->dispatch($url);

?>