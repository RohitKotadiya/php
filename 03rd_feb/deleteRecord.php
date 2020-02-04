<?php
    require_once "configuration.php";
    if(isset($_GET['catId'])) {
        $catId = $_GET['catId'];
        $deleted = 0;
        $deleted = deleteRecord("category", "categoryId = $catId");
        $deleted = deleteRecord("post_category", "categoryId = $catId");
        if($deleted == 1) {
            echo "<script> alert('deleted! ');
                    window.location.href='blogCategories.php';
                    </script>";
        }else {
            echo $deleted;
        }
    }
    if(isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $deleted = 0;
        $deleted = deleteRecord("blog_post", "postId = $postId");
        if($deleted == 1) {
            echo "<script> alert('deleted! ');
                    window.location.href='blogPosts.php';
                    </script>";
        }else {
            echo $deleted;
        }
    }
?>