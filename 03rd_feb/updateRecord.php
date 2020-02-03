<?php
require_once "configuration.php";
    function getCatData($catId) {
        $data =[];
        $catInfo = fetchData("*", "category","categoryId = $catId");
        $data['addCat'] = $catInfo[0];
        return $data; 
    }
?>