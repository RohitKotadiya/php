<?php

namespace Controller\Core;
use \Model\Core\Request;

class Front {

    public static function init() {
        $request = new Request();
    
        // $controllerName = "\\Controller\\" . ucfirst($request->getControllerName());
        $controllerName = self::getControllerClassName();
        $actionName = $request->getActionName() . 'Action';

        if(!class_exists($controllerName)) {
            throw new Exception("{$controllerName} class does not exists");
        }

        $controller = new $controllerName();

        if(!method_exists($controller, $actionName)) {
            throw new Exception("{$actionName} does not exists");
        }

        $controller->$actionName();
    }

    public static function getControllerClassName()
    {
        $request = new Request();
        $controllerClassName = "\Controller_" . ucfirst($request->getControllerName());
        $controllerClassName = ucwords(str_replace("_", " " , $controllerClassName));
        $controllerClassName = str_replace(" ", "\\", $controllerClassName);
        return $controllerClassName;
    }
}