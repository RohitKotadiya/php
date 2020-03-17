<?php  

namespace Controller\Product;
use \Model\Product\Product;
use \Model\Product\ProductImage;
use \Model\Core\Message; 
use \Controller\Core\Exception;

class Media extends \Controller\Core\BaseController{

    public function viewMediaGalleryAction() {

        try {
            $product = new Product(); 
            $productImage = new ProductImage();
            if(!($id = $this->getRequest()->getRequest('id'))) {
                throw new \Controller\Exception("id Not Avaliable.");
            }
            if(!$product->load($id)) {
                throw new \Controller\Exception("Record Not Found.");
            }
            $query = "SELECT *  FROM `product_image` WHERE `productId` = $id";
            $mediaGrid = new \Block\Product\MediaGrid();
            $mediaGrid->setProductMedia($productImage->fetchAll($query));                        
            $mediaGrid->setProduct($product);
            $content = $this->getLayout()->getChild('content');
            $content->addChild($mediaGrid,"mediaGrid");
            $this->renderLayout();
           } catch (Exception $e) {
                $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);        
           }   
    }

    public function saveImageAction() {
        try {
            $product = new Product();
            if(!$id = $this->getRequest()->getRequest('id')) {
                throw new \Controller\Exception("id Not Avaliable.");
            }

            if(!($product = $product->load($id))) {
                throw new \Controller\Exception("Record Not Found.");
            }
            if(!array_key_exists("image", $_FILES)) {
                throw new \Controller\Exception("image  not found yet.");    
            }

            if($product->uploadImage($_FILES['image'])) {
                $this->getMessage()->setMessage("image uploaded.", Message::MESSAGE_SUCCESS);  
                $this->redirect("viewMediaGallery", "product_media", ['id' => $product->id]);
            }else {
                echo "<script> alert('error') </script>";
            }
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);        
        }

    }

    public function updateMediaAction() {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new \Controller\Exception("Invalid Request");
            }
            $product = new Product();
            $productImage = new ProductImage();
            if(!$id = $this->getRequest()->getRequest('id')) {
                throw new \Controller\Exception("Id Not Avaliable");
            }
            if(!($product->load($id))) {
                throw new \Controller\Exception("No Record found.");
            }
            $product->setData($this->getRequest()->getPost('product'));
            $id = $product->id;
            $product->save();
            foreach ($this->getRequest()->getPost('excludeImage') as $imageId) {
                $productImage->load($imageId);
                $productImage->excludedImage = 1;
                $productImage->save();
            }
            $this->getMessage()->setMessage("image uploaded.", Message::MESSAGE_SUCCESS);  
            $this->redirect("viewMediaGallery", "product_media", ['id' => $id]);
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);        
        }
    }

    public function deleteMediaAction() {
        try {
            $productImage = new ProductImage();
            if(!$id = $this->getRequest()->getRequest('imageId')) {
                throw new \Controller\Exception("Id Not Avaliable");
            }
            if(!($productImage->load($id))) {
                throw new \Controller\Exception("No Record found.");
            }
            $deleteQuery = "DELETE FROM `product_image` WHERE `id` = $id";
            $productImage->getAdapter()->deleteRecord($deleteQuery);
            $productId = $this->getRequest()->getRequest('productId');
            $this->getMessage()->setMessage("image deleted.", Message::MESSAGE_SUCCESS);  
            $this->redirect("viewMediaGallery", "product_media", ['id' => $productId]);
        } catch (Exception $e) {
            $this->getMessage()->setMessage($e->getMessage(), Message::MESSAGE_FAILURE);        
        }
    }
}
?>