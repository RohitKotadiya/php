<?php

namespace Model\Product;

class Product extends \Model\Core\Row{
    protected $uploadDir;

    const STATUS_ENABLE = 1;
    const STATUS_ENABLE_LABEL = "ENABLE";
    const STATUS_DISABLE = 0;
    const STATUS_DISABLE_LABEL = "DISABLE";

    protected $status = [
                self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
                self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
            ];

    public function __construct() {
        $this->setTableName("product");
        $this->setPrimaryKey("id");
        $this->setAdapter();
        $this->setUploadDir("media\catalog\product\\");
    }

    public function getStatusOptions() {
        return $this->status;
    }

    public function setUploadDir($uploadDir) {
        $this->uploadDir = \Ccc::getBaseDir($uploadDir);
        return $this;
    }

    public function getUploadDir() {
        return $this->uploadDir;
    }

    public function uploadImage($image) {
        print_r($image);
        if(!$this->id) {
            throw new \Exception("invalid Request.");
        }

        if(!move_uploaded_file($image['tmp_name'], $this->getUploadDir() . $image['name'])) {
            throw new \Exception("unable to upload image.");
        }

        $productImage = new ProductImage();
        $productImage->image = $image['name'];
        $productImage->productId = $this->id;
        if($productImage->save()) {
            return true;
        }
        return false;
    }

}

?>