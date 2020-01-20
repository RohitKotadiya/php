<?php
    $i=0;
    while(true){
        if($i <= 10):
            echo $i."<br>";
        else:
            die("Page Ended!");
        endif;
        $i += 1;
    }

?>