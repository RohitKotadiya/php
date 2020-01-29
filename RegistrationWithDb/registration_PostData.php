<?php
    require_once "configuration.php";
    session_start();
    echo "<pre>";

    function getFieldValue($section, $fieldName , $returnType = "") {
        return (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : $returnType );
    }
    // function getSessionValues($sectionName) {
    //     return (isset($_SESSION[$sectionName]) ? $_SESSION[$sectionName] : [] );
    // }

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
        $fieldNames = [];
        $fieldValues = [];
        foreach($_POST[$section] as $key => $value) {
            if(!empty($value)) {
                if(validateForm($key , $value) == 0) {
                    echo "Enter valid $key <br>";
                    array_push($errList, $key);    
                }
            }else { 
                echo "Please fill $key";
            }
            if($key != 'confirmPass'){
                array_push($fieldNames , $key);
                array_push($fieldValues , $value);
            }
        }
        if(empty($errList)) {
            if($section == 'account') {
                echo insertData($fieldNames, $fieldValues, "customers");
            }else if($section == 'address') {
                $lastCustId = getLastRecordId("customerId","customers");
                echo "last id : " . $lastCustId;
                array_push($fieldNames, 'customerId');
                array_push($fieldValues, $lastCustId);
                echo insertData($fieldNames, $fieldValues, "customer_address");
            }
            else if($section == 'other') {
                $lastCustId = getLastRecordId("customerId", "customers");
                foreach($_POST[$section] as $key => $value) {
                    $fieldValue = $value;
                    if(is_array($value)) {
                        $fieldValue = implode(",", $value);
                    }
                    echo insertData(['fieldKey', 'fieldValue', 'customerId'], [$key, $fieldValue, $lastCustId], "cust_additional_info");
                }
            }
        }
    }
    if(isset($_POST['submit'])) {
        sectionToValidate('account');
        sectionToValidate('address');
        sectionToValidate('other');   
    } 
    echo "</pre>";
?>