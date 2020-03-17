<?php

namespace Controller;
use \Model\Product\ProductImage;
use \Model\Core\Message; 
use \Controller\Core\Exception;

class Products extends Core\BaseController {
    
    public function addAction() {
        try {
            $product = \Ccc::objectManager("\Model\Product\Product");
            $add = $this->getLayout()->createBlock("\Block\Product\Add");
            $add->setProduct($product);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add, "add");
            $this->renderLayout();    
            
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
    }

    public function editAction() {
        try {
            $product = \Ccc::objectManager("\Model\Product\Product");
            $productCategory = \Ccc::objectManager("\Model\ProductCategory");
            if(!$id = $this->getRequest()->getRequest('id')) {
               throw new Exception("Id Not Avaliable", 1);
            }
            $row = $product->load($id);
            if(!$row) {
                throw new Exception("Product Not Found");
            }
            $query = "SELECT * FROM product_category WHERE `productId` = $row->id";
            $productCategory->fetchRow($query);
            $add = $this->getLayout()->createBlock("\Block\Product\Add");
            $add->setProduct($product);
            $add->setProductCategory($productCategory);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add, "add");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
    }

    public function saveProductAction() {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.");
            }
            $productData = $this->getRequest()->getPost("product");
            $product = \Ccc::objectManager("\Model\Product\Product");
            $productCategory = \Ccc::objectManager("\Model\ProductCategory");
            if($id = (int)$this->getRequest()->getRequest('id')) {
                if(!$product->load($id)) {
                    throw new Exception("Record Not Found.");
                }
                $query = "SELECT * FROM product_category WHERE `productId` = $product->id";
                $productCategory->fetchRow($query);
                $product->setData($productData);
                $productCategory->categoryId = $this->getRequest()->getPost("category");
                $product->updatedAt = date('Y-m-d H:i:s');
                $product->save();
            }else {
                $product->setData($productData);
                $product->createdAt = date("Y-m-d H:i:s");
                $productCategory->categoryId = $this->getRequest()->getPost("category");
                $productCategory->productId = $product->save()->id;
            }
            $productCategory->save();
            $this->getMessage()->setMessage("Product saved.", Message::MESSAGE_SUCCESS); 
            $this->redirect("showProduct");
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
       
    }

    public function showProductAction() {
        try {
            $product = \Ccc::objectManager("\Model\Product\Product");
            $grid = $this->getLayout()->createBlock("\Block\Product\Grid");
            $content = $grid->getLayout()->getChild('content');
            $content->addChild($grid, "grid");
            $this->renderLayout();    
            
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);  
        }
    }

    public function deleteAction() {
        try{
            $product = \Ccc::objectManager("\Model\Product\Product");
            if($id = $this->getRequest()->getRequest('id')) {
                if(!$product->load($id)) {
                    throw new Exception("Record not found.");
                }
                $product->delete();
            }else {
                $productIds = $this->getRequest()->getPost("productIds");
                if($productIds == null) {
                    throw new Exception("You have not selected any product");
                }
                foreach ($productIds as $id) {
                    $product->load($id);
                    $product->delete();
                }
            }
            $this->getMessage()->setMessage("Product deleted.", Message::MESSAGE_SUCCESS);
            $this->redirect("showProduct");
        }catch(Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
            $this->redirect("showProduct");
        }
    }
}