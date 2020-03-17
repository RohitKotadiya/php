<?php

namespace Model;


class Address extends \Model\Core\Row{

    public function __construct() {
       
        $this->setTableName("address");
        $this->setPrimaryKey("id");
        $this->setAdapter();
    }
}

?>