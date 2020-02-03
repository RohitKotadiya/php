<?php
    require_once "configuration.php";
    require_once "postBlogData.php";
    require_once "postUserData.php";

    $catList = [];
    function getCatList() {
        global $catList;
        $result = fetchData("parentCatId,title","parent_category");
        foreach($result as $key => $value) {
            echo "<br>";
            array_push($catList,$value);
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
    <form action="addBlog.php" method="POST" enctype="multipart/form-data">
    <div id="addBlg" >
        Title : <input type="text" name="addBlg[title]" value="<?= getFieldValue('addBlg', 'title') ?>" ><br><br>
        Content :<input type="text" name="addBlg[content]" value="<?= getFieldValue('addBlg', 'content') ?>" ><br><br>
        URL : <input type="text" name="addBlg[URL]"  value="<?= getFieldValue('addBlg', 'URL') ?>"  ><br><br>
        <span> <?= validateBlogField('adBlg','URL') ?> </span><br>
        published At : <input type="date" name="addBlg[publishedAt]" value="<?= getFieldValue('addBlg', 'publishedAt') ?>" ><br><br>
        Category : 
        <select name="addBlg[category][]" multiple>
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addBlg', 'category'),[$cat['parentCatId']] ) ? "selected" : "" ?>
                    <option value="<?= $cat['parentCatId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
                </select><br><br>
        Choose Image : <input type="file" name="postImg" accept="image/*" value="<?= getFieldValue('addBlg', 'postImg') ?>"><br><br>
        <span> <?= validateBlogField('addBlg','postImg') ?> </span<br>

        <input type="submit" name="addNewBlog" value="ADD BLOG">
    <div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['addNewBlog'])) {
        if($flag = 1){
            echo "Ready to insert";   //write code to preprocess and then insert
            prepareBlogData('insert');
        }else {
            echo "Error";
        }
    }
?>