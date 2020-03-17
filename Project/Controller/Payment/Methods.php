<?php

namespace Controller\Payment;
use \Model\Payment\Method;
use \Model\Core\Message; 
use \Controller\Core\Exception;

class Methods extends \Controller\Core\BaseController {

	public function addAction()
	{   
        try {
    		$method = new Method();
            $add = $this->getLayout()->createBlock("\Block\Payment\Method\Add");
    		$add->setMethod($method);
    		$content = $add->getLayout()->getChild('content');
    		$content->addChild($add,"add");
    		$this->renderLayout();	
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
        }
	}

	public function editAction()
	{
        try {
    		$method = new Method();
            if(!$id = $this->getRequest()->getRequest('id')) {
                throw new Exception("Id not avaliable.");
            }
            $row = $method->load($id);
            if(!$row) {
                throw new Exception("Record not found.");
            }
    		$add = $this->getLayout()->createBlock("\Block\Payment\Method\Add");
            $add->setMethod($method);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add,"add");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);            
        }

	}

	public function saveAction()
	{
		try {
            if(!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request");  
            }
            $method = new method();
            $methodData = $this->getRequest()->getPost('paymentMethod');
            if($id = (int)$this->getRequest()->getRequest('id')) {
                if(!$method->load($id)) {
                    throw new Exception("Record not found.");
                }
                $method->setData($methodData);
            }else {
                $method->setData($methodData);
            }
            $method->save();
            $this->getMessage()->setMessage("Method has been saved.", Message::MESSAGE_SUCCESS);  
            $this->redirect("show");
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);            
        }
	}

	public function deleteAction()
	{
  		try{
            $method = new Method();
            if($id = $this->getRequest()->getRequest('id')) {
                if(!$method->load($id)) {
                    throw new Exception("Record not found.");
                }
                $method->delete();
            }else {
                $methodIds = $this->getRequest()->getPost("methodIds");
                if($methodIds == null) {
                    throw new Exception("You have not selected any method");
                }
                foreach ($methodIds as $id) {
                    $method->load($id);
                    $method->delete();
                }
            }
            $this->getMessage()->setMessage("Method has been deleted.", Message::MESSAGE_SUCCESS);  
            $this->redirect("show");
        }catch(Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE); 
            $this->redirect("show");
        }
		
	}

	public function showAction()
	{
		try {
            $method = new Method();
            $grid = $this->getLayout()->createBlock("\Block\Payment\Method\Grid");
            $content = $grid->getLayout()->getChild('content');
    		$content->addChild($grid,"grid");
            $this->renderLayout();
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);            
        }
	}

}

?>