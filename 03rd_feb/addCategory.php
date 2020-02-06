<?php
    require_once "postUserData.php";
    require_once "postBlogData.php";
    require_once "updateRecord.php";
    session_start();
    checkSession();
    
    $catData =[]; // to store data of edit cat
    if(isset($_GET['catId'])) {
        $catData = getCatData($_GET['catId']);  //fun from updateRecord.php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Category</title>
    <link rel="stylesheet" type="text/css" href="css/registeration.css">
</head>
<body>
    <a href="blogCategories.php" >BACK </a><br><br>
    <h2> Add Category </h2>
    <form action="addCategory.php" method="POST" enctype="multipart/form-data">
    <div id="addCat" >
        <label> Title </label> 
        <input type="text" name="addCat[title]" value="<?= getFieldValue('addCat', 'title') ?>" required ><br><br>
        <label> Content </label>
        <input type="text" name="addCat[content]" value="<?= getFieldValue('addCat', 'content') ?>" required ><br><br>
        <label>URL  </label> 
        <input type="text" name="addCat[url]"  value="<?= getFieldValue('addCat', 'url') ?>" required  >
        <span> <?= validateURLField('addCat','url') ?> </span><br><br>
        <label>Meta Title  </label> 
        <input type="text" name="addCat[metaTitle]" value="<?= getFieldValue('addCat', 'metaTitle') ?>" required ><br><br>
        <label>Parent Category  </label> 
        <select name="addCat[cat]" required >
            <?php $catList = getCatList(); ?>    
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addCat', 'cat'),[$cat['categoryId']] ) ? "selected" : "" ?>
                    <option value="<?= $cat['categoryId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
        </select><br><br>
        <label>Choose Image </label> 
        <input type="file" name="image" accept="image/*" value="<?= getFieldValue('addCAt', 'image') ?>"required ><br><br>
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
            prepareBlogData('insert', 'addCat');
        }
    }
    if(isset($_POST['updateCat'])) {
        if($flagUrl == 1){
            $editCatId = $_POST['catId'];
            prepareBlogData('update', 'addCat');
        }
    }
?>