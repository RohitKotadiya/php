<?php

namespace Model;

class Customer extends \Model\Core\Row{

    public function __construct() {
         $this->setTableName("customer");
        $this->setPrimaryKey("id");
        $this->setAdapter();
    }
}

?>