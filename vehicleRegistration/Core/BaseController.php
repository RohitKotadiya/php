<?php

namespace Core;

abstract class BaseController {    
    protected $routeParams = [];  

    public function __construct($routeParameters) {
        $this->routeParams = $routeParameters;
        session_start();
    }

    public function __call($methodName, $args) {   
        $methodName = $methodName . 'Action';
        if(method_exists($this, $methodName)) {
            if($this->before() !== false) {
                   call_user_func_array([$this, $methodName] , $args);
                $this->after();
            }
        }else {
            throw new \Exception("$methodName not found in class " . get_class($this));
        }
    }
    protected function before() { 
        
    }               //called before action performed
    protected function after() {

    }               //called after action performed
    protected function displayPopup($msg, $redirect = "") {
        return ($redirect != "") 
                ? "<script> alert('$msg'); window.location.href = '$redirect'; </script>" 
                : "<script> alert('$msg'); </script>";
    }
    protected function checkSession() {
        if($_SESSION['loggedIn'] == true) {
            return true;
        }
    }
    // public function validateFile($fieldName, $dirName = '') {
    //     $uploadDir = "../Public/uploads/";
    //     $uploadFile = $uploadDir . basename($_FILES[$fieldName]['name']);
    //     $acceptTypes = ['image/png', 'image/jpg', 'image/jpeg'];
    //     if(in_array($_FILES[$fieldName]['type'], $acceptTypes)) {
    //         move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile);
    //         return $uploadDir . $_FILES[$fieldName]['name'];
    //     }else {
    //         return false;
    //     } 
    // }
    // public static function generateUrl($name) {
    //     return str_replace(' ', '-', $name);
    // }
}

?>