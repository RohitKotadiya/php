<?php 

namespace App\Controllers;
use \Core\View;
use \App\Models\User;

class Register extends \Core\BaseController {

    public function registerForm() {
        View::renderTemplate("Register/registrationForm.html");
    }
    public function addUser() {
        print_r($_POST['register']);
        $cleanUserData = $this->prepareUserData($_POST['register']);
        if(User::insertUserData($cleanUserData) ) {
            echo "<script> alert('Registered Successfully') </script>";
        }

    }
    protected function prepareUserData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'firstName'    : $preparedData['firstName'] = $fieldValue;
                                        break;
                case 'emailId'      : $preparedData['emailId'] = $fieldValue;
                                        break;
                case 'pass'         : $preparedData['password'] = $fieldValue;
                                        break;
            }
        }
        return $preparedData;
    }
}


?>