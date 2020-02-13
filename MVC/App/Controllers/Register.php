<?php 

namespace App\Controllers;
use \Core\View;
use \App\Models\User;

class Register extends \Core\BaseController {
    public $errList = [];

    public function registerForm() {
        View::renderTemplate("Register/registrationForm.html");
    }
    public function addUser() {
        $this->validateForm($_POST['register']);
        if(empty($this->errList)) {
            $cleanUserData = $this->prepareUserData($_POST['register']);
            if(User::insertUserData($cleanUserData) ) {
                echo "<script> alert('Registered Successfully') 
                                window.location.href = 'showUser';
                      </script>";
            }
        }else {
            View::renderTemplate("Register/registrationForm.html", ['errList' => $this->errList, 
                                                                    'postData' => $_POST['register']]);
        }
    }
    public function showUser() {
        $allUser = User::getUserData(); 
        View::renderTemplate("Register/showUsers.html",['allUser' => $allUser]);
    }
    public function editUser() {
        $userId = $this->routeParams['id'];
        $singleUser = User::getSingleUser($userId);
        View::renderTemplate("Register/registrationForm.html",['edit' => 'edit','postData' => $singleUser[0]]);
    }
    public function updateUser() {
        $userId = $this->routeParams['id'];
        $this->validateForm($_POST['register']);
        if(empty($this->errList)) {
            $cleanUserData = $this->prepareUserData($_POST['register']);
            if(User::updateUserData($cleanUserData, $userId)) {
                echo "<script> alert('User Updated Successfully');
                                window.location.href = 'showUser';
                      </script>";
            }
        }else {
            View::renderTemplate("Register/registrationForm.html", ['errList' => $this->errList,
                                                                    'edit' => 'edit', 
                                                                    'postData' => $_POST['register']]);
        }

    }
    public function deleteUser() {
        $userId = $this->routeParams['id'];
        if(User::removeUserData($userId) ) {
            echo "<script> alert('User Removed Successfully') 
                            window.location.href = 'showUser';
                  </script>";
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
    protected function validateForm($formData) {
        $this->errList  = [];
        $errMsg = "please enter valid ";
        foreach($formData as $fieldName => $fieldValue) {
            if(empty($fieldValue)) {
                $emptyMsg = "Missing $fieldName";
                $this->errList[$fieldName] = $emptyMsg;
            }else {
                switch($fieldName) {
                    case 'firstName'    : if(!preg_match('/^[a-zA-Z]*$/', $fieldValue)) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    case 'emailId'      : if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
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
}


?>