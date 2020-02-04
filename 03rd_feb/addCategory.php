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

    $catList = getCatList();
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Category</title>
    <style>
            span{
                color : red;
            }
    </style>
</head>
<body>
    <a href="blogCategories.php" >BACK </a><br><br>
    <form action="addCategory.php" method="POST" enctype="multipart/form-data">
    <div id="addCat" >
        Title : <input type="text" name="addCat[title]" value="<?= getFieldValue('addCat', 'title') ?>" ><br><br>
        Content :<input type="text" name="addCat[content]" value="<?= getFieldValue('addCat', 'content') ?>" ><br><br>
        URL : <input type="text" name="addCat[url]"  value="<?= getFieldValue('addCat', 'url') ?>"  >
        <span> <?= validateURLField('addCat','url') ?> </span><br><br>
        Meta Title : <input type="text" name="addCat[metaTitle]" value="<?= getFieldValue('addCat', 'metaTitle') ?>" ><br><br>
        Parent Category : <select name="addCat[cat]">
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addCat', 'cat'),[$cat['categoryId']] ) ? "selected" : "" ?>
                    <option value="<?= $cat['categoryId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
                </select><br><br>
        Choose Image : <input type="file" name="image" accept="image/*" value="<?= getFieldValue('addCAt', 'image') ?>"><br><br>
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
        if($flagUrl == 1){
            prepareBlogData('insert','addCat');
        }
    }
    if(isset($_POST['updateCat'])) {
        if($flagUrl == 1){
            $editCatId = $_POST['catId'];
            prepareBlogData('update','addCat');
        }else {
            echo "Error";
        }
    }
?>