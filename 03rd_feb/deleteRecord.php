<?php
    require_once "configuration.php";
    $catId = $_GET['catId'];
    $deleted = 0;
    $deleted = deleteRecord("category", "categoryId = $catId");
    if($deleted == 1) {
        echo "<script> alert('deleted! ');
                window.location.href='blogCategories.php';
                </script>";
    }else {
        echo $deleted;
    }
?>