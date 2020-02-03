<?php
    require_once "postUserData.php";
    require_once "postBlogData.php";
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
    <form action="addCategory.php" method="POST" enctype="multipart/form-data">
    <div id="addCat" >
        Title : <input type="text" name="addCat[title]" value="<?= getFieldValue('addCat', 'title') ?>" ><br><br>
        Content :<input type="text" name="addCat[content]" value="<?= getFieldValue('addCat', 'content') ?>" ><br><br>
        URL : <input type="text" name="addCat[URL]"  value="<?= getFieldValue('addCat', 'URL') ?>"  ><br><br>
        <span> <?= validateBlogField('addCat','URL') ?> </span><br>
        Meta Title : <input type="text" name="addCat[metaTitle]" value="<?= getFieldValue('addCat', 'metaTitle') ?>" ><br><br>
        Parent Category : <select name="addCat[cat]">
                <?php foreach($catList as $cat) : ?>
                    <?php $selectedCat = array_intersect(getFieldValue('addCat', 'cat'),[$cat['parentCatId']] ) ? "selected" : "" ?>
                    <option value="<?= $cat['parentCatId'] ?>" <?= $selectedCat ?> ><?= $cat['title'] ?></option>
                <?php endforeach; ?>
                </select><br><br>
        Choose Image : <input type="file" name="postImg" accept="image/*" value="<?= getFieldValue('addCAt', 'postImg') ?>"><br><br>
        <span> <?= validateBlogField('addCat','postImg') ?> </span<br>

        <input type="submit" name="addNewCat" value="ADD Category">
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

?>