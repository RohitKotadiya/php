<?php

use \Controller\Core\Front;

spl_autoload_register(function($class) {
    $file =  Ccc::getBaseDir($class) . ".php";
    require_once $file;
});

class Ccc {

    public function register($key, $value)
    {
        if(is_null($key)) {
            throw new Exception("key can not be null");
        }
        $GLOBALS[$key] = $value;
    }

    public function getRegistry($key)
    {
        if(!array_key_exists($key, $GLOBALS)) {
            return null;
        }
        return $GLOBALS[$key];
    }

    public function objectManager($class, $ton = false)
    {
        if(!$ton) {
            return new $class();
        }
        if(!$object = self::getRegistry($class)) {
            $object = new $class();
            self::register($class, $object);
            return $object;
        }
        return $object;
    }

    public static function getBaseDir($path = null) {
        if($path == null) {
            return getcwd();
        }
        return getcwd() . DIRECTORY_SEPARATOR . $path;
    }
    
    public static function init() {
        Front::init();
    }

    public static function setBaseUrl($url) {
        return $_SERVER['PHP_SELF'] . $url;
    }

}
session_start();
// echo "<pre>";
// print_r(Ccc::getRegistry("\Model\Core\Request"));
Ccc::init();

?>