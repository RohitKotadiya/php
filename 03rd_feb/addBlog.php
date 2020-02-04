<?php
    require_once "configuration.php";
    require_once "postBlogData.php";
    require_once "postUserData.php";
    require_once "updateRecord.php";

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('location:login.php');
    }

    $blogData =[]; // to store data of edit cat
    if(isset($_GET['postId'])) {
        $blogData = getBlogData($_GET['postId']);  //fun from updateRecord.php
        echo "Data :<br>";
        print_r($blogData);
    }

    $catList =  getCatList();   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Blog</title>
    <style>
            span{
                color : red;
            }
    </style>
</head>
<body>
    <a href="blogPosts.php" >BACK </a><br><br>

    <form action="addBlog.php" method="POST" enctype="multipart/form-data">
    <div id="addBlg" >
        Title : <input type="text" name="addBlg[title]" value="<?= getFieldValue('addBlg', 'title') ?>" ><br><br>
        Content :<input type="text" name="addBlg[content]" value="<?= getFieldValue('addBlg', 'content') ?>" ><br><br>
        URL : <input type="text" name="addBlg[url]"  value="<?= getFieldValue('addBlg', 'url') ?>"  >
        <span> <?= validateURLField('addBlg','url') ?> </span><br><br>
        published At : <input type="date" name="addBlg[publishedAt]" value="<?= getFieldValue('addBlg', 'publishedAt') ?>" ><br><br>
        <?print_r(getFieldValue('addBlg', 'category')) ?>

        Category : 
        <select name="addBlg[category][]" multiple>
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addBlg', 'category'),[$cat['categoryId']] ) ? "selected" : ""; ?>
                    <option value="<?= $cat['categoryId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
                </select><br><br>
        Choose Image : <input type="file" name="image" accept="image/*" value="<?= getFieldValue('addBlg', 'image') ?>"><br><br>
        <?php if(!isset($_GET['postId'])) : ?>
            <input type="submit" name="addNewBlog" value="ADD BLOG">
        <?php else : ?>
            <input type="hidden" value="<?= $_GET['postId'] ?>" name="postId">
            <input type="submit" name="updateBlog" value="UPDATE BLOG">
        <?php endif; ?>
    <div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['addNewBlog'])) {
        if($flagUrl == 1) { 
            prepareBlogData('insert','addBlg');
        }
    }
    if(isset($_POST['updateBlog'])) {
        if($flagUrl == 1){
            $editPostId = $_POST['postId'];
            prepareBlogData('update','addBlg');
        }
    }
?>