<?php
    //Add data in csv line by line
    
    extract($_POST);
    if(isset($pId) && isset($pName) && isset($pCategory) && isset($pPrice)) {
        $myFile = fopen("Product_detail.csv", "a");
        fwrite($myFile, "$pId , $pName , $pCategory , $pPrice.\n");
        fclose($myFile);
        echo "<script> alert('Product Added Succesfully!'); </script>";
    }else {
        echo "<script> alert('Error Occured !'); </script>";
    }
?>
<form action="file_handling_1.php" method="POST">
    <input type="number" name="pId" placeholder="Product id"><br><br>
    <input type="text" name="pName" placeholder="Product Name"><br><br>
    <input type="text" name="pCategory" placeholder="Product Category"><br><br>
    <input type="number" name="pPrice" placeholder="Product Price"><br><br>
    <input type="submit" name="submit" value="ADD PRODUCT">
</form>