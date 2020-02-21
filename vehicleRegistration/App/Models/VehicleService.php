<?php
  
namespace App\Models;
use PDO;
  
class VehicleService extends \Core\Model {
    
    public static function insertServiceData($data) {
        return parent::insertData('service_registration', $data);
    }
    public static function getServiceData() {
        $userId = $_SESSION['userId'];
        return parent::fetchData('*', 'service_registration', "userId = $userId");
    }
    public static function fetchNumbers($licenceId, $vehicleNumber) {
        $userId = $_SESSION['userId'];
        return parent::fetchData('*', 'service_registration', 
            "licenceNumber = '$licenceId' or vehicleNumber = '$vehicleNumber' and NOT userId = '$userId'");
    }   
    public static function fetchSlots($date, $timeSlot) {
        return parent::fetchData('count(*)>2 as count', 'service_registration', "date = '$date' and timeSlot = '$timeSlot'");
        
    }
    public static function allServiceRequest() {
        return parent::fetchData('*', 'service_registration');
    }
    public static function approveServiceRequest($id, $data) {
        return parent::updateRecord("service_registration", $data, "serviceId = $id");
    }
}   