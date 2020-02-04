<?php
    require_once "configuration.php";
    $flag = true;
    function getFieldValue($section, $fieldName, $returnType = "") {
        global $catData, $blogData, $userData;
        if(isset($_POST[$section][$fieldName]))
            return $_POST[$section][$fieldName];
        else if(!empty($catData[$section][$fieldName]))
            return $catData[$section][$fieldName];
        else if(!empty($blogData[$section][$fieldName]))
            return $blogData[$section][$fieldName];
        else if(!empty($userData[$section][$fieldName]))
            return $userData[$section][$fieldName];
        else
            return $returnType;
    }
    function validateField($section,$fieldName) {
        global $flag;
        $emptyMsg = "Missing $fieldName";
        $errMsg = "please enter valid ";
        if(isset($_POST[$section][$fieldName]) && empty($_POST[$section][$fieldName])) {
            $flag = false;
            return $emptyMsg;
        }elseif(isset($_POST[$section][$fieldName])) {
            $fieldValue = $_POST[$section][$fieldName];
            switch($fieldName) {
                case 'firstName'    :
                case 'lastName'     :
                                       if(!preg_match('/^[a-zA-Z]*$/', $fieldValue)) {
                                            $flag = false;
                                            return $errMsg . $fieldName;
                                        }    
                                        break;
                case 'confirmPass'     :   if($fieldValue !== $_POST['register']['password']){
                                            $flag = false;
                                            return $errMsg . $fieldName;
                                        }
                                        break;
                case 'emailAddress' :   if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)){
                                            $flag = false; 
                                            return $errMsg . $fieldName;
                                        }
                                        break;
                case 'phoneNumber'  :   if(!preg_match('/[0-9]/', $fieldValue) || strlen($fieldValue) != 10){
                                            $flag = false;
                                            return $errMsg . $fieldName;
                                        }
                                        break;
            }
        }
    }
    function prepareUserData($operation) {
        global $editUserId;
        $cleanData = prepareAccountData('register');
        $inserted = $updated = 0;
        $exists = userExist($cleanData['emailAddress']);
        switch($operation) {
        case 'insert'   :       if($exists == 1)
                                    $inserted = insertData($cleanData, "user");
                                else {
                                    echo "<script> alert('User Already exists! ');
                                    window.location.href='register.php';
                                    </script>";
                                }
                                break;
            case 'update'   :   $updated = updateRecord("user", $cleanData,"userId = $editUserId");
                                break;
        }
        if($inserted != 0) {
            echo "<script> alert('Registered Successfully! ');
                        window.location.href='login.php';
                        </script>";
        }
        if($updated == 1) {
            echo "<script> alert('updated! ');
                    window.location.href='blogPosts.php';
                    </script>";
        }
    }
    function prepareAccountData($section) {
        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'prefix'       :   $preparedData['prefix'] = $fieldValue;
                                        break;
                case 'firstName'    :   $preparedData['firstName'] = $fieldValue;
                                        break;
                case 'lastName'     :   $preparedData['lastName'] = $fieldValue;
                                        break;
                case 'password'     :   $preparedData['password'] = md5($fieldValue);
                                        break;
                case 'emailAddress' :   $preparedData['emailAddress'] = $fieldValue;
                                        break;
                case 'phoneNumber'  :   $preparedData['phoneNumber'] = $fieldValue;
                                        break;
                case 'selfInfo'     :   $preparedData['selfInfo'] = $fieldValue;
                                        break;
                }
        }
        date_default_timezone_set('Asia/kolkata'); //to set time zone
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
        return $preparedData;
    }
    function userExist($email) {
        $allUser = fetchData("emailAddress","user");
        foreach($allUser as $singleUser) {
            return ($singleUser['emailAddress'] != $email) ? 1 : 0;
        }
    }
    ?>