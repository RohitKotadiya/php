<?php

namespace Model\Core;

class Request {

    public function getPost($fieldName = null, $fieldValue = null) {
        if($fieldName == null) {
            return $_POST;
        }else if(key_exists($fieldName, $_POST)) {
            return $_POST[$fieldName];
        }else {
            return $fieldValue;
        }
    }

    public function isPost() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }

    public function getRequest($fieldName = null, $fieldValue = null) {
        if($fieldName == null) {
            return $_REQUEST;
        }else if(!empty($_REQUEST[$fieldName])) {
            return $_REQUEST[$fieldName];
        }else {
            return $fieldValue;
        }
    }

    public function getControllerName() {
        return $this->getRequest('c', 'Index');
    }

    public function getActionName() {
        return $this->getRequest('a' , 'Index');
    }

}
?>
