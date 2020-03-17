<?php

namespace Controller;
use \Model\Core\Message; 
use \Controller\Core\Exception;

class Customers extends Core\BaseController {
    
    public function addAction() {
        try {
            $customer = \Ccc::objectManager("\Model\Customer"); 
            $add = $this->getLayout()->createBlock("\Block\Customer\Add");
            $add->setCustomer($customer);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add, "add");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
        }        
    }

    public function editAction() {
        try {
            $customer = \Ccc::objectManager("\Model\Customer"); 
            if(!$id = $this->getRequest()->getRequest('id')) {
                throw new Exception("Id not avaliable.");
            }
            $query = "SELECT 
                        * 
                        FROM `customer` 
                        LEFT JOIN `address` 
                        ON customer.id = address.customerId 
                        WHERE customer.id = {$this->getRequest()->getRequest('id')}";
            $row = $customer->fetchRow($query);

            if(!$row) {
                throw new Exception("Record not found.");
            }

            $add = $this->getLayout()->createBlock("\Block\Customer\Add");
            $add->setCustomer($customer);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add, "add");
            $this->renderLayout();    
            
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
    }

    public function saveAction() {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request");  
            }
            $customer = \Ccc::objectManager("\Model\Customer"); 
            $address = \Ccc::objectManager("\Model\Address");       
            $customerData = $this->getRequest()->getPost("customer");
            $addressData = $this->getRequest()->getPost("address");
            if($customerId = (int)$this->getRequest()->getRequest('customerId')) {
                if(!$customer->load($customerId)) {
                    throw new Exception("Record not found.");
                }
                $customer->setData($customerData);
                $customer->save();
                $addressId = (int)$this->getRequest()->getRequest('addressId');
                $address->load($addressId);
                $address->setData($addressData); 
                $address->save();
            }else{
                $customer->setData($customerData);
                $addressData['customerId'] = $customer->save()->id;
                $address->setData($addressData); 
                $address->save();
            }
            $this->getMessage()->setMessage("Customer saved.", Message::MESSAGE_SUCCESS);  
            $this->redirect("showCustomer");
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }     
    }

    public function showCustomerAction() {
        try {
            $customer = \Ccc::objectManager("\Model\Customer"); 
            $grid = $this->getLayout()->createBlock("\Block\Customer\Grid");
            $content = $grid->getLayout()->getChild('content');
            $content->addChild($grid, "grid");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
    }

    public function deleteAction() {
        try {
            $customer = \Ccc::objectManager("\Model\Customer"); 
               
            if($id = $this->getRequest()->getRequest('id')) {
                if(!$customer->load($id)) {
                    throw new Exception("Record not found.");
                }
                $customer->delete();
            }else {
                $customerIds = $this->getRequest()->getPost('customerIds');
                if($customerIds == null) {
                    throw new Exception("You have not selected any method");
                }else {
                    foreach ($customerIds as $id) {
                        $customer->load($id);
                        $customer->delete();
                    }
                }
            }
            $this->getMessage()->setMessage("Customer deleted.", Message::MESSAGE_SUCCESS);  
            $this->redirect("showCustomer"); 
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
            $this->redirect("showCustomer"); 
        }      
    }
}