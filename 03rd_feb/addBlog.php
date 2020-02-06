<?php
    require_once "configuration.php";
    require_once "postBlogData.php";
    require_once "postUserData.php";
    require_once "updateRecord.php";
    session_start();
    checkSession();
    
    $blogData =[]; // to store data of edit cat
    if(isset($_GET['postId'])) {
        $blogData = getBlogData($_GET['postId']);  //fun from updateRecord.php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Blog</title>
    <link rel="stylesheet" type="text/css" href="css/registeration.css">
</head>
<body>
    <a href="blogPosts.php" >BACK </a><br><br>
    <h2>Add Blog</h2>
    <form action="addBlog.php" method="POST" enctype="multipart/form-data">
        <div id="addBlg">
            <label> Title </label>
            <input type="text" name="addBlg[title]" value="<?= getFieldValue('addBlg', 'title') ?>" required><br><br>
            <label> Content </label>
            <input type="text" name="addBlg[content]" value="<?= getFieldValue('addBlg', 'content') ?>" required><br><br>
            <label> URL </label> 
            <input type="text" name="addBlg[url]"  value="<?= getFieldValue('addBlg', 'url') ?>" required>
            <span> <?= validateURLField('addBlg', 'url') ?> </span><br><br>
            <label> published At </label> 
            <input type="date" name="addBlg[publishedAt]" value="<?= getFieldValue('addBlg', 'publishedAt') ?>" required><br><br>
            <label> Category </label> 
            <select name="addBlg[category][]" multiple required>
                <?php     $catList =  getCatList();   ?>
                    <?php foreach($catList as $cat) : ?>
                        <?php $selectedCat = array_intersect(getFieldValue('addBlg', 'category'), [$cat['categoryId']] ) 
                                            ? "selected" 
                                            : ""; ?>
                        <option value="<?= $cat['categoryId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                    <?php endforeach; ?>
                    </select><br><br>
            <label> Choose Image </label> 
            <input type="file" name="image" accept="image/*" value="<?= getFieldValue('addBlg', 'image') ?>" required><br><br>
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
            prepareBlogData('insert', 'addBlg');
        }
    }
    if(isset($_POST['updateBlog'])) {
        if($flagUrl == 1){
            $editPostId = $_POST['postId'];
            prepareBlogData('update', 'addBlg');
        }
    }
?>