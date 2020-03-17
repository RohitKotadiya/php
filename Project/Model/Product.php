<?php

namespace Model\Product;


class Product extends \Model\Core\Row{
    protected $categoryList;

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
    }

    public function getStatusOptions() {
        return $this->status;
    }

    public function getCategoryList() {
        return (new Category)->fetchAll();
    }

    public function uploadImage($image) {
        if(!$product->id) {
            throw new Exception("invalid Request.");
        }
        $uploadDir = \Ccc::getBaseDir("media/catalog/product");
        if(move_uploaded_file($image['tmp_name'], $uploadDir . $image['name'])) {
            throw new Exception("unable to upload image.");
        }

        $image = ProductImage();

    }

}

?>