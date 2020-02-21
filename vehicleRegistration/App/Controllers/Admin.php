<?php

namespace App\Controllers;
use \Core\View;
use \App\Models\VehicleService;

class Admin extends \Core\BaseController {

    public function dashboard() {
        $requestData = VehicleService::allServiceRequest();
        View::renderTemplate('Admin/dashboard.html',['requestData' => $requestData]);
    }
    public function approveRequest() {
        $serviceId = $this->routeParams['id'];
        $data['status'] = 1;
        VehicleService::approveServiceRequest($serviceId, $data);
        $requestData = VehicleService::allServiceRequest();
        View::renderTemplate('Admin/dashboard.html',['requestData' => $requestData]);
    }
    public function approveChecked() {
        $checkedData = $_POST['chekedData'];
        $data['status'] = 1;
        foreach($checkedData as $serviceId) {
            VehicleService::approveServiceRequest($serviceId, $data);
        }
    }
   
}
?>