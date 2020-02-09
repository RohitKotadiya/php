<?php
require_once "configuration.php";
require_once "postBlogData.php";
    function getCatData($catId) {
        $data =[];
        $catInfo = fetchData("*", "child_parent_cat","categoryId = $catId");
        $data['addCat'] = $catInfo[0];
        return $data; 
    }
    function getBlogData($postId) {
        $query = "SELECT C.categoryId FROM  post_category PC LEFT JOIN child_parent_cat C ON 
                            PC.categoryId = C.categoryId WHERE postId = $postId";
        $results = getData($query);         //from postBlogData
        $data =[];
        $postInfo = fetchData("*", "blog_post","postId = $postId");
        $data['addBlg'] = $postInfo[0];
        $catArr = [];
        foreach($results as $res) {
            array_push($catArr,$res['categoryId']);
        }
        $data['addBlg']['category'] = $catArr;
        return $data; 
    }
    function getUserData($userId) {
        $data =[];
        $userInfo = fetchData("*", "user","userId = $userId");
        unset($userInfo[0]['password']);
        $data['register'] = $userInfo[0];
        return $data; 
    }
?>