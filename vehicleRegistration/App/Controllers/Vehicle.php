<?php 

namespace App\Controllers;
use \Core\View;
use \App\Models\VehicleService;

class Vehicle extends \Core\BaseController {
    public $errList = [];
    
    public function serviceRegistration() {
        View::renderTemplate("User/Service/serviceRegistration.html",['errList' => $this->errList, 
        'postData' => $_POST['service']]);
    }
    public function addService() {
        $this->validateForm($_POST['service']);
        if(empty($this->errList)) {
            $cleanServiceData = $this->prepareServiceData($_POST['service']);
            if($this->validateData($cleanServiceData)) {
                if(VehicleService::insertServiceData($cleanServiceData)) {
                    echo $this->displayPopup('Registered Succsfully!');
                    $serviceData = VehicleService::getServiceData();
                    View::renderTemplate("User/userHome.html",['serviceData' => $serviceData]);                    }
            }
        }else {
            $this->serviceRegistration();
        }
    }
    public function editService() {
        
    }
    protected function prepareServiceData($data) {
        $preparedData = [];
        foreach($data as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'    : $preparedData['title'] = $fieldValue;
                                        break;
                case 'vehicleNumber'    : $preparedData['vehicleNumber'] = $fieldValue;
                                    break;
                case 'licenceNumber'      : $preparedData['licenceNumber'] = $fieldValue;
                                    break;
                case 'date'      : $preparedData['date'] = $fieldValue;
                                        break;
                case 'timeSlot'         : $preparedData['timeSlot'] = $fieldValue;
                                        break;
                case 'vehicleIssue'      : $preparedData['vehicleIssue'] = $fieldValue;
                                    break;
                case 'serviceCenter'         : $preparedData['serviceCenter'] = $fieldValue;
                                    break;
            }
        }
        $preparedData['status'] = 0;
        $preparedData['createdDate'] = date('Y-m-d', time());
        $preparedData['userId'] = $_SESSION['userId'];
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
                $now = date('Y-m-d',strtotime('+1 day'));
                switch($fieldName) {
                    case 'date' : if($fieldValue < $now) {
                                        $this->errList[$fieldName] = $errMsg . $fieldName;
                                        }
                                    break;
                    case 'vehicleNumber'     : if(!preg_match('/^[a-zA-Z0-9 ]*$/', $fieldValue) || strlen($fieldValue) != 10) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                    
                    case 'licenceNumber'      : if(!preg_match('/^[a-zA-Z0-9 ]*$/', $fieldValue)  || strlen($fieldValue) != 16) {
                                                $this->errList[$fieldName] = $errMsg . $fieldName;
                                            }
                                            break;
                   
                }
            }
        }
        return $this->errList;
    }
    public function validateLicenceNumber($licenceNumber,$vehicleNumber) {
        $result = VehicleService::fetchNumbers($licenceNumber, $vehicleNumber);
        if(is_array($result) && !empty($result)) {
            return 0;
        }else {
            return 1;
        }
    }
    public function validateSlot($date, $timeSlot) {
        $result = VehicleService::fetchSlots($date, $timeSlot);
        if($result[0]['count']) {
            return 0;
        }else {
            return 1;
        }
    }
    public function validateData($cleanServiceData) {
        $licenceNumber = $cleanServiceData['licenceNumber'];
        $vehicleNumber = $cleanServiceData['vehicleNumber'];
        $serviceDate = $cleanServiceData['date'];
        $serviceTime = $cleanServiceData['timeSlot'];
        $licenceValidate =  $this->validateLicenceNumber($licenceNumber, $vehicleNumber);
        $slotValidate = $this->validateSlot($serviceDate, $serviceTime);
        
        if($licenceValidate == 1 && $slotValidate == 1) {
            return 1;
        }elseif($licenceValidate == 0) {
            echo $this->displayPopup('Please Enter Valid licenceId and Vehice Numbber');
            $this->serviceRegistration();
        }else {
            echo $this->displayPopup('Please Enter Valid Slot');
            $this->serviceRegistration();
        }
    }
}

?>