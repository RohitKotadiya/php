<?php 

namespace App\Controllers;
use \Core\View;
use \App\Models\User;
use \App\Models\VehicleService;


class Users extends \Core\BaseController {
    public $errList = [];
    
    public function loginForm() {
        View::renderTemplate("User/Register/userLogin.html");
    }
    public function validateLogin() {
        $result = User::fetchUserData($_POST['user']);
        if(is_array($result) && !empty($result)) {
            $_SESSION['userId'] = $result[0]['userId'];
            $_SESSION['userloginTime'] = date('Y-m-d H:i:s', time());
            $_SESSION['userLoggedIn'] = true;
            $serviceData = VehicleService::getServiceData();
            View::renderTemplate("User/userHome.html",['serviceData' => $serviceData]); 
        }else {
            echo $this->displayPopup('Username or Password Wrong!','loginForm');
        }  
    }
    public function registerForm() {
        View::renderTemplate("User/Register/registrationForm.html");
    }
    public function addUser() {
        $this->validateForm($_POST['register']);
        if(empty($this->errList)) {
            $cleanUserData = $this->prepareUserData($_POST['register']);
            $addressData = $this->prepareAddData($_POST['address']);
            $lastUserId = User::insertUserData($cleanUserData);
            $addressData['userId'] = $lastUserId;
            if(User::insertAddressData($addressData)) {
                echo $this->displayPopup('Registered Succsfully!','/cybercom/php/vehicleRegistration/Public/Users/loginForm');
            }
        }else {
            View::renderTemplate("User/Register/registrationForm.html", ['errList' => $this->errList, 
                                                                    'postData' => $_POST['register']]);
        }
    }
    protected function prepareUserData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'firstName'    : $preparedData['firstName'] = $fieldValue;
                                        break;
                case 'lastName'    : $preparedData['lastName'] = $fieldValue;
                                    break;
                case 'emailId'      : $preparedData['emailId'] = $fieldValue;
                                    break;
                case 'phoneNumber'      : $preparedData['phoneNumber'] = $fieldValue;
                                        break;
                case 'pass'         : $preparedData['password'] = $fieldValue;
                                        break;                      
            }
        }
        return $preparedData;
    }
    protected function prepareAddData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'street'   : $preparedData['street'] = $fieldValue;
                                        break;
                case 'city'     : $preparedData['city'] = $fieldValue;
                                    break;
                case 'state'    : $preparedData['state'] = $fieldValue;
                                    break;
                case 'country'  : $preparedData['country'] = $fieldValue;
                                        break;
                case 'zipCode'  : $preparedData['zipCode'] = $fieldValue;
                                        break;                      
            }
        }
        return $preparedData;
    }
    protected function validateForm($formData) {
        $this->errList  = [];
        $errMsg = "please enter valid ";
        foreach($formData as $fieldName => $fieldValue) {
            if(empty($fieldValue)) {
                $emptyMsg = "Missing $fieldName";
                $this->errList[$fieldName] = $emptyMsg;
            }else {
                switch($fieldName) {
                    case 'firstName'    :
                    case 'lastName'     : if(!preg_match('/^[a-zA-Z ]*$/', $fieldValue)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    
                    case 'emailId'      : if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    case 'phoneNumber'  :   if(!preg_match('/[0-9]/', $fieldValue) || strlen($fieldValue) != 10) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    case 'confirmPass'  : if($fieldValue !== $_POST['register']['pass']) {
                                            $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                }
            }
        }
        return $this->errList;
    }
    public function userLogoutAction() {
        if(session_destroy()) {
            header('location:/cybercom/php/vehicleRegistration/Public');
            exit;
        }
    }
}


?>