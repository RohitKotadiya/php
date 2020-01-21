<?php
    echo "<strong> First File </strong><br>";
    require "arrays_7.php";                 //emit FATAL ERROR and stop execution

    echo "<br><br><strong> Second File </strong><br><br>";
    include "arrays_5.php";                 //emit E_WARNING and continue

    //both works same
?>