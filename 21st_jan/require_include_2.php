<?php
    
    
    require "arrays_6.php";

    require_once "arrays_6.php";    //prevent file to be include again

    
    include "arrays_7.php";

    if(defined('arrays_7.php')) {
        include "arrays_7.php";
    }                                  // works  as include_once
?>