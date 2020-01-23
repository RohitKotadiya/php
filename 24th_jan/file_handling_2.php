<?php
    // read file and show records one by one by clicking NEXT & PREV
    $pName ="";
    $pCategory = "";
    $pPrice = "";
    $counter = 1;
    // while(($line = fgets($myFile)) !== false) {
    //     echo "$line <br>";
    //     }
    $myFile = fopen("Product_detail.csv", "r");
    //echo filesize("Product_detail.csv");
    if(isset($_POST['next'])) { 
        $line = fgets($myFile);
        $parts = explode(',', $line);
        $pName = $parts[1];
        $pCategory = $parts[2];
        $pPrice = $parts[3];
        $counter ++;
    }
    fclose($myFile); 

?>
<form action="file_handling_2.php" method="POST">
    <input type="text" name="pName" value="<?= $pName ?>"><br><br>
    <input type="text" name="pCategory" value="<?= $pCategory ?>"><br><br>
    <input type="text" name="pPrice" value="<?= $pPrice ?>"><br><br>
    <input type="button" name="previous" value="PREV">
    <input type="submit" name="next" value="NEXT">
</form>