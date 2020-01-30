<?php
    require_once "configuration.php";
    session_start();
    echo "<pre>";

    function getFieldValue($section, $fieldName , $returnType = "") {
        return (isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : $returnType );
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
    $lastId = 0;

    function sectionToValidate($section) {
        global $errList;
        global $lastId;    
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
            if($section == 'account') {
                $cleanAccountData = prepareAccountData($section);
                $lastId = insertData($cleanAccountData, "customers");
                print_r($cleanAccountData);
            }else if ($section == 'address') {
                $cleanAddressData = prepareAddressData($section);
                $finalAddressData = addLastId($cleanAddressData, "customerId", $lastId);
                insertData($finalAddressData, "customer_address");
                print_r($finalAddressData);
            }else if($section == 'other') {
                $cleanOtherData = prepareOtherData($section);
                // $finalOtherData = addLastId($cleanOtherData, "customerId", $lastId);
                // echo insertData($finalOtherData, "cust_additional_info");
                // print_r($finalOtherData);
                foreach($cleanOtherData as $key => $value) {
                    $tempArr['fieldKey'] = $key;
                    $tempArr['fieldValue'] = $value; 
                    $finalToInsert = addLastId($tempArr, "customerId", $lastId);   
                    insertData($finalToInsert, "cust_additional_info");
                }
            }
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
                case 'password'     :   $preparedData['password'] = $fieldValue;
                                        break;
                case 'emailAddress' :   $preparedData['emailAddress'] = $fieldValue;
                                        break;
                case 'dateOfBirth'  :   $preparedData['dateOfBirth'] = $fieldValue;
                                        break;
                case 'phoneNumber'  :   $preparedData['phoneNumber'] = $fieldValue;
                                        break;
                }
        }
        return $preparedData;
    }
    function prepareAddressData($section) {
        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'addressLineOne' : $preparedData['addressLineOne'] = $fieldValue;
                                        break;
                case 'addressLineTwo' : $preparedData['addressLineTwo'] = $fieldValue;
                                        break;
                case 'company'        : $preparedData['company'] = $fieldValue;
                                        break;
                case 'city'           : $preparedData['city'] = $fieldValue;
                                        break;
                case 'state'          : $preparedData['state'] = $fieldValue;
                                        break;
                case 'country'        : $preparedData['country'] = $fieldValue;
                                        break;
                case 'postalCode'     : $preparedData['postalCode'] = $fieldValue;
                                        break;
                }
        }
        return $preparedData;
    }
    function prepareOtherData($section) {
        $preparedData = [];
        $finalArr = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'selfInfo'     :   $preparedData['selfInfo'] = $fieldValue;
                                        break;
                case 'exp'          :   $preparedData['exp'] = $fieldValue;
                                        break;
                case 'uniqueClient' :   $preparedData['uniqueClient'] = $fieldValue;
                                        break;
                case 'chkTouch'     :   if(is_array($fieldValue))
                                            $preparedData['chkTouch'] = implode(",", $fieldValue);
                                        else
                                            $preparedData['chkTouch'] = $fieldValue;
                                        break;
                case 'hobby'        :   if(is_array($fieldValue))
                                            $preparedData['hobby']  = implode(",", $fieldValue);
                                        else
                                            $preparedData['hobby'] = $fieldValue;
                                        break;
            }
        }
        $finalArr['fieldKey'] = array_keys($preparedData);
        $finalArr['fieldValue'] = array_values($preparedData);
        return $preparedData;
        return $finalArr;
    }
    if(isset($_POST['submit'])) {
        sectionToValidate('account');
        sectionToValidate('address');
        sectionToValidate('other');   
    } 
    echo "</pre>";
?>