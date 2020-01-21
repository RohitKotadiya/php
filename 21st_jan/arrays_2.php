<?php
$products = array();

class Product {
    function __construct($pId, $pName , $pCategory) {
        $this -> $pId = $pId;
        $this -> $pName = $pName;
        $this -> $pCategory = $pCategory;
    }
}
function addProduct($pId, $pName, $pCategory) {
    global $products;
    $product1 = new Product($pId, $pName, $pCategory);
    array_push($products,$product1);
}
if(isset($_POST['submitBtn'])) {
    echo "hello";
    extract($_POST);
    addProduct($productId, $productName, $productCat);    
}

// var_dump($products);

if(count($products) > 0) {
    foreach($products as $key => $values) {
        foreach($values as $pKey => $value) {
            echo "<br> $pKey => $value";
        }
        echo "<br>";
    }
}
?>
<form action="arrays_2.php" method="POST">
    <input type="text" name="productId" placeholder="product Id"><br><br>
    <input type="text" name="productName" placeholder="Product name"><br><br>
    <input type="text" name="productCat" placeholder="Product Category"><br><br>
    <input type="submit" value="Add Product" name="submitBtn"><br>
</form>
