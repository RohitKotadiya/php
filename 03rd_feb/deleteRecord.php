<?php
    require_once "configuration.php";
    require_once "postUserData.php";
    $deleted = 0;

    if(isset($_GET['catId'])) {
        $catId = $_GET['catId'];
        $deleted = deleteRecord("category", "categoryId = $catId");
        $deleted = deleteRecord("post_category", "categoryId = $catId");
        if($deleted == 1) {
            echo displayPopup('deleted! ', 'blogCategories.php');
        }else {
            echo $deleted;
        }
    }
    if(isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $deleted = deleteRecord("blog_post", "postId = $postId");
        if($deleted == 1) {
            echo displayPopup('deleted! ', 'blogPosts.php');
        }else {
            echo $deleted;
        }
    }
?>