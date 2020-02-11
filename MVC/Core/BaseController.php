<?php

namespace Core;

abstract class BaseController {    //abstract bcaz will not create obj directly of this class
    protected $routeParams = [];   // to store route paramters

    public function __construct($routeParameters) {
        $this->routeParams = $routeParameters;
    }

    public function __call($methodName, $args) {   // to call unaccsible methods 
                                                    // also used to call before and after of each action -
                                        // before/after for chk session, lang chang 
        $methodName = $methodName . 'Action';
        if(method_exists($this, $methodName)) {
            if($this->before() !== false) {
                call_user_func_array([$this, $methodName] , $args);
                $this->after();
            }
        }else {
            echo "$methodName not found in class " . get_class($this);
        }
    }
    protected function before() { // why this two here and in Home also

    }               //called before action performed
    protected function after() {

    }               //called after action performed
}

?>