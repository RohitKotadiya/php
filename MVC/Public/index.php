<?php
	
	// require_once '../Core/Router.php';
	// require_once '../App/Controllers/Posts.php';   // replaced with below spl_autoloader
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
	$router->add('', ['controller' => 'Home', 'action' => 'index']);
	// $router->add('posts', ['controller' =>'Posts', 'action' => 'index']);
	// $router->add('posts/new', ['controller' =>'Posts', 'action' => 'new']);

	$router->add('{controller}/{action}');
	// $router->add('admin/{action}/{controller}');
	
	$router->add('{controller}/{id:\d+}/{action}');
	$router->add('admin/{controller}/{action}', ['namespace' =>'Admin']);

	// echo '<pre>' . "<br>Routers : ";
	// var_dump($router->getRoutes());
	// echo "</pre>";
	// echo htmlspecialchars(print_r($router->getRoutes(),true));

	$url = $_SERVER['QUERY_STRING'];
	// echo "URL : " . $url . "<br><br>";
	// echo "class : " . get_class($router);
	
	
	// if($router->matchUrl($url)) {
	// 	echo "<br> <br> Paramteters : ";
	// 	var_dump($router->getParams());
	// }else {
	// 	echo "no Route found $url";
	// }					// now this is replaced with dispatch()

	$router->dispatch($url);

?>