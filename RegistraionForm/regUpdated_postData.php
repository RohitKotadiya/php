<?php
    session_start();
    echo "<pre>";
  
  
    // print_r($_POST);
 
    // echo $_POST["accountfName"];
    echo "<br>";

    // function getValues($sectionName) {
    //     return (isset($_POST[$sectionName]) ? $_POST[$sectionName] : [] );
    // }

    // print_r($_SESSION);
    function getFieldValue($section, $fieldName) {
        return (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : "" );
    }

    function setSessionValues($sectionName) {
        (isset($_POST[$sectionName]) ? $_SESSION[$sectionName] = $_POST[$sectionName] : [] );
    }

    function getSessionValues($sectionName) {
        return (isset($_SESSION[$sectionName]) ? $_SESSION[$sectionName] : [] );
    }

    function validateForm($fieldName, $fieldValue) {
        switch($fieldName) {
            case 'fName':
            case 'lName' :
                            if(!preg_match('/^[a-zA-Z]*$/', $fieldValue)) 
                                return 0; 
                            else
                                return 1;
                            break; 
            case 'phoneNumber':
                            if(!preg_match('/[0-9]/', $fieldValue) || strlen($fieldValue) != 10)
                                return 0;
                            else
                                return 1;
                            break;
            case 'emailId':
                            if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL))
                                return 0;
                            else
                                return 1;
                            break;
            default :
                            return 1;
        }
    }
    function sectionToValidate($section) {
        $errList = [];
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
            // setSessionValues('address');
    }
    print_r(getSessionValues('account'));
    // print_r(getValues('account'));
    // echo "<br>";
    // // echo getFieldValue('fName');
    // print_r($_POST[['account']['fName']]);
    echo "</pre>";
?>