<?php
    $strOne = "JOHN";
    $strTwo = "SMITH";
    error_reporting('E_NOTICE');

    if(strlen($strOne) > strlen($strOne)){
        $length = strlen($strOne);
    }else {
        $length = strlen($strTwo);
    }
    for($ch = 0; $ch < $length; $ch ++) {
        echo $strOne{$ch} . $strTwo{$ch};
    }

?>