<?php
    require_once "postUserData.php";
    $flagUrl = 1;
    function validateURLField($section ,$fieldName) {
         if(isset($_POST[$section][$fieldName])) {
             $fieldValue = $_POST[$section][$fieldName];
            if($section == 'addBlg') {
                return getUrl('blog_post',$fieldValue);
            }
            if($section == 'addCat') {
                return getUrl('category',$fieldValue);
            }
        }
    }
    function getUrl($tableName, $fieldValue) {
        global $flagUrl;
        $allUrl = fetchData("url", "$tableName" , "url = '$fieldValue'");
        if(is_array($allUrl)) {
            $flagUrl = 0;
            return  "URL Exisits";
        } 
    }     
    function prepareBlogData($operation,$section) {
        $cleanBlogData =$cleanCatData = [];
        global $editCatId, $editPostId;
        if($section == 'addBlg')
            $cleanBlogData = cleanBlogInfo($section);
        else
            $cleanCatData = cleanCatInfo($section);
        $postData = [];
        if($cleanBlogData != null){
            foreach($cleanBlogData as $key => $value) {
                if($key != 'cat')
                    $postData[$key] = $value;
                else
                    $catData[$key] = explode(",",$value);
            }
        }
        $inserted = $updated = 0;
        switch($operation) {
            case 'insert'   :   if($section == 'addBlg') {
                                    $lastId = insertData($postData, "blog_post");
                                    echo $lastId;
                                    foreach($catData['cat'] as $cat) {
                                        $tmpArr['postId'] = $lastId;
                                        $tmpArr['categoryId'] = $cat; 
                                        $inserted = insertData($tmpArr, "post_category");
                                    }
                                    if($inserted != 0) {
                                        echo displayPopup('Added Successfully! ', 'blogPosts.php');
                                    }
                                }else if($section == 'addCat') {
                                    echo insertData($cleanCatData, "category");
                                    $tmp['title'] = $cleanCatData['title'];
                                    $inserted = insertData($tmp,"parent_category");
                                    if($inserted != 0) {
                                        echo displayPopup('Added Successfully! ', 'blogCategories.php');
                                    }
                                }
                                break;
            case 'update'   :   if($section == 'addBlg') {
                                    $postData['updatedAt'] = date('Y-m-d H:i:s', time());
                                    updateRecord("blog_post",$postData,"postId = $editPostId");
                                    foreach($catData['cat'] as $cat) {
                                        $tmpArr['postId'] = $editPostId;
                                        $tmpArr['categoryId'] = $cat;
                                        deleteRecord("post_category","postId = $editPostId"); 
                                        $inserted = insertData($tmpArr, "post_category");
                                    }
                                    if($inserted != 0) {
                                        echo displayPopup('Updated !', 'blogPosts.php');
                                    }
                                }else if($section == 'addCat') {
                                    $updated = updateRecord("category", $cleanCatData,"categoryId = $editCatId");
                                    if($updated == 1) {
                                        echo displayPopup('Updated ! ', 'blogCategories.php');
                                    }
                                }
                                break;
            }
    }
    function cleanBlogInfo($section) {
        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'        :   $preparedData['title'] = $fieldValue;
                                        break;
                case 'url'          :   $preparedData['url'] = $fieldValue;
                                        break;
                case 'content'      :   $preparedData['content'] = $fieldValue;
                                        break;
                
                case 'publishedAt'  :   $preparedData['publishedAt'] = $fieldValue;
                                        break;
                case 'category'     :   if(is_array($fieldValue)) {
                                            $preparedData['cat'] = implode(",", $fieldValue);
                                        }else {
                                            $preparedData['cat'] = $fieldValue;
                                        }
                                        break;  
                }
        }
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
        $preparedData['userId'] = $_SESSION['userId'];
        $preparedData['image'] = validateFile('image');
        return $preparedData;
    }
    function cleanCatInfo($section) {

        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'       :   $preparedData['title'] = $fieldValue;
                                        break;
                case 'url'         :   $preparedData['url'] = $fieldValue;
                                        break;
                case 'content'     :   $preparedData['content'] = $fieldValue;
                                        break;
                case 'publishedAt' :   $preparedData['publishedAt'] = $fieldValue . " ". date('H:m:s',time());
                                        break;
                case 'cat'    :         $preparedData['parentCatId'] = $fieldValue;
                                        break;  
                case 'metaTitle'   :    $preparedData['metaTitle'] = $fieldValue;
                                        break;
                }
        }
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time()); 
        $preparedData['image'] = validateFile('image');
        return $preparedData;
    }


    function getData($que) {
        $postInfo = [];
        global $connection,$userId;
        $resultSet = mysqli_query($connection, $que);
        if(mysqli_num_rows($resultSet) > 0) {
             while($row = mysqli_fetch_assoc($resultSet)) {
                 array_push($postInfo, $row);
             }
        }else {
             echo mysqli_error($connection);
        }
        return $postInfo;
     }

    function getCatList() {
        $catList = [];
        $result = fetchData("categoryId,title","category");
        if(is_array($result)) {
            foreach($result as $key => $value) {
                array_push($catList,$value);
            }
        }
        return $catList;
    }
    function validateFile($fieldName) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES[$fieldName]['name']);
        $acceptTypes = ['image/png', 'image/jpg', 'image/jpeg'];
        if(in_array($_FILES[$fieldName]['type'], $acceptTypes)) {
            move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile);
            return $uploadDir . $_FILES[$fieldName]['name'];
        }else
            echo displayPopup('please enter valid image'); 
    }
?>