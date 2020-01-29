<?php
    session_start();
    echo "<pre>";

    function getFieldValue($section, $fieldName , $returnType = "") {
        return (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : $returnType );
    }

    function setSessionValues($sectionName) {
        (isset($_POST[$sectionName]) ? $_SESSION[$sectionName] = $_POST[$sectionName] : [] );
    }

    function getSessionValues($sectionName) {
        return (isset($_SESSION[$sectionName]) ? $_SESSION[$sectionName] : [] );
    }

    function validateForm($fieldName, $fieldValue) {
        switch($fieldName) {
            case 'fName' :
            case 'lName' :
            case 'city'  :
            case 'state' :
                            return (!preg_match('/^[a-zA-Z]*$/', $fieldValue)) ? 0 : 1;
                            break; 
            case 'phoneNumber':
                            return (!preg_match('/[0-9]/', $fieldValue) || strlen($fieldValue) != 10) ? 0 : 1;
                            break;
            case 'emailId':
                            return (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) ? 0 : 1;
                            break;
            case 'postalCode' :
                            return (!preg_match('/[0-9]/', $fieldValue) || strlen($fieldValue) != 6) ? 0 : 1 ;
                            break;
            case 'pass'   :
                            return ($fieldValue !== $_POST['account']['confirmPass']) ? 0 : 1 ;
                            break; 
            default :
                            return 1;
        }
    }
    $errList = [];

    function sectionToValidate($section) {
        global $errList;
        foreach($_POST[$section] as $key => $value) {
            if(!empty($value)) {
                if(validateForm($key , $value) == 0) {
                    echo "Enter valid $key <br>";
                    array_push($errList, $key);    
                }
            }else { 
                echo "Please fill $key";
            }
        }
        if(empty($errList)) {
            setSessionValues($section);
        }
    }
    if(isset($_POST['submit'])) {
        sectionToValidate('account');
        sectionToValidate('address');
        sectionToValidate('other');   
    } 
    echo "</pre>";
?>