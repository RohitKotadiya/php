<?php

namespace Controller;
use \Model\Core\Message; 
use \Controller\Core\Exception;

class Categories extends Core\BaseController {

    public function addAction() {
        try {
            $category = \Ccc::objectManager("\Model\Category");
            $add = $this->getLayout()->createBlock("\Block\Category\Add");
            $add->setCategory($category);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add,"add");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);             
        }    
    }

    public function editAction() {
        try {
            $category = \Ccc::objectManager("\Model\Category");
            if(!$id = $this->getRequest()->getRequest('id')) {
                throw new Exception("Id not avaliable.");
            }
            $row = $category->load($id);
            if(!$row) {
                throw new Exception("Record not found.");
            }
            $add = $this->getLayout()->createBlock("\Block\Category\Add");
            $add->setCategory($category);
            $content = $add->getLayout()->getChild('content');
            $content->addChild($add,"add");
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
            $category = \Ccc::objectManager("\Model\Category");
            $categoryData = $this->getRequest()->getPost('category');
            if($id = (int)$this->getRequest()->getRequest('id')) {
                if(!$category->load($id)) {
                    throw new Exception("Record not found.");
                }
                $category->setData($categoryData);
                $category->updatedAt = date("Y-m-d H:i:s");
            }else {
                $category->setData($categoryData);
                $category->createdAt = date("Y-m-d H:i:s");
            }
            $category = $category->save();
            $category->path = $this->getCategoryPath($category);
            $category->save();
            $this->updateChilds($category);
            $this->getMessage()->setMessage("Category saved.", Message::MESSAGE_SUCCESS); 
            $this->redirect("showCategory");
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
        }
    }

    public function showCategoryAction() {
        try {
            $category = \Ccc::objectManager("\Model\Category");
            $grid = $this->getLayout()->createBlock("\Block\Category\Grid");
            $content = $grid->getLayout()->getChild('content');
            $content->addChild($grid,"grid");
            $this->renderLayout();    
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
        }
    }

    public function deleteAction() {
        try {
            $category = \Ccc::objectManager("\Model\Category");
            if($id = (int)$this->getRequest()->getRequest('id')) {
                if(!$category->load($id)) {
                    throw new Exception("Record not found.");
                }
                $category->delete();
                $this->deleteChilds($category);
            }else {
                $categoryIds = $this->getRequest()->getPost('categoryIds');
                if($categoryIds == null) {
                    throw new Exception("You have not selected any method");
                }else {
                    foreach ($categoryIds as $id) {
                        $category->load($id);
                        $category->delete();
                        $this->deleteChilds($category);
                    }
                }
            }
            $this->getMessage()->setMessage("Category deleted.", Message::MESSAGE_SUCCESS);  
            $this->redirect("showCategory");
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);
            $this->redirect("showCategory");
        }
    }

    public function getCategoryPath($category)
    {
        if(!$category->parentId) {
            return $category->id;
        }

        if($parent = $category->getParentCategory()) {
            return $parent->path . "_" . $category->id;
        }
    }

    public function updateChilds($category)
    {
        $finalChildPaths = $category->getChildCategoryPaths($category);
        if($finalChildPaths) {
            foreach ($finalChildPaths as $key => $childPath) {
               $childId = substr($childPath, strrpos($childPath, "_")+1);
               $category = $category->load($childId);
               $category->path = $childPath;
               $category->save();
            }
        }
    }

    public function deleteChilds($category)
    {
        $finalChildPaths = $category->getChildCategoryPaths($category);
        if($finalChildPaths) {
            foreach ($finalChildPaths as $key => $childPath) {
               $childId = substr($childPath, strrpos($childPath, "_")+1);
               $category = $category->load($childId);
               // $category->status = 0;
               // $category->save();
               $category->delete();
            }
        }
    }
}
?>