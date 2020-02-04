<?php
   
    require_once "postUserData.php";
    require_once "postBlogData.php";
    require_once "updateRecord.php";
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
    }

    $catData =[]; // to store data of edit cat
    if(isset($_GET['catId'])) {
        $catData = getCatData($_GET['catId']);  //fun from updateRecord.php
        print_r($catData);
    }

    $catList = [];
    function getCatList() {
        global $catList;
        $result = fetchData("categoryId,title","category");
        if(is_array($result)) {
            foreach($result as $key => $value) {
                echo "<br>";
                array_push($catList,$value);
            }
        }
    }
    getCatList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Add Blog</title>
</head>
<body>
    <form action="addCategory.php" method="POST" enctype="multipart/form-data">
    <div id="addCat" >
        Title : <input type="text" name="addCat[title]" value="<?= getFieldValue('addCat', 'title') ?>" ><br><br>
        Content :<input type="text" name="addCat[content]" value="<?= getFieldValue('addCat', 'content') ?>" ><br><br>
        URL : <input type="text" name="addCat[url]"  value="<?= getFieldValue('addCat', 'url') ?>"  ><br><br>
        <span> <?= validateBlogField('addCat','url') ?> </span><br>
        Meta Title : <input type="text" name="addCat[metaTitle]" value="<?= getFieldValue('addCat', 'metaTitle') ?>" ><br><br>
        Parent Category : <select name="addCat[cat]">
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addCat', 'cat'),[$cat['parentCatId']] ) ? "selected" : "" ?>
                    <option value="<?= $cat['parentCatId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
                </select><br><br>
        Choose Image : <input type="file" name="image" accept="image/*" value="<?= getFieldValue('addCAt', 'image') ?>"><br><br>
        <span> <?= validateBlogField('addCat','image') ?> </span<br>
        <?php if(!isset($_GET['catId'])) : ?>
        <input type="submit" name="addNewCat" value="ADD Category">
        <?php else : ?>
            <input type="hidden" value="<?= $_GET['catId'] ?>" name="catId">
            <input type="submit" name="updateCat" value="UPDATE">
        <?php endif; ?>
    <div>
    </form>
</body>
</html>


<?php
    if(isset($_POST['addNewCat'])) {
        if($flag = 1){
            echo "Ready to insert";   
            prepareBlogData('insert','addCat');
        }else {
            echo "Error";
        }
    }
    if(isset($_POST['updateCat'])) {
        if($flag = 1){
            $editCatId = $_POST['catId'];
            prepareBlogData('update','addCat');
        }else {
            echo "Error";
        }
    }

?>