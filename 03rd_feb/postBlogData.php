<?php
    session_start();
    $flag = 1;
    date_default_timezone_set('Asia/kolkata'); //to set time zone

    function validateBlogField($section ,$fieldName) {
        echo "<pre>";    //to validate URL and File Extension
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
        echo "</pre>$section , $operation";
        $inserted = $updated = 0;
        switch($operation) {
            case 'insert'   :   if($section == 'addBlg'){
                                    $lastId = insertData($postData, "blog_post");
                                    echo $lastId;
                                    foreach($catData['cat'] as $cat) {
                                        $tmpArr['postId'] = $lastId;
                                        $tmpArr['categoryId'] = $cat; 
                                        $inserted = insertData($tmpArr, "post_category");
                                    }
                                    if($inserted != 0) {
                                        echo "<script> alert('Added Successfully! ');
                                                    window.location.href='blogPosts.php';
                                                    </script>";
                                    }
                                }else if($section == 'addCat') {
                                    echo insertData($cleanCatData, "category");
                                    $tmp['title'] = $cleanCatData['title'];
                                    $inserted = insertData($tmp,"parent_category");
                                    if($inserted != 0) {
                                        echo "<script> alert('Added Successfully! ');
                                                    window.location.href='blogCategories.php';
                                                    </script>";
                                    }
                                }
                                
                                break;
            case 'update'   :   if($section == 'addBlg'){
                                    echo "under update";
                                    $postData['updatedAt'] = date('Y-m-d H:i:s', time());
                                    echo updateRecord("blog_post",$postData,"postId = $editPostId");
                                    foreach($catData['cat'] as $cat) {
                                        $tmpArr['postId'] = $editPostId;
                                        $tmpArr['categoryId'] = $cat;
                                        deleteRecord("post_category","postId = $editPostId"); 
                                        $inserted = insertData($tmpArr, "post_category");
                                    }
                                    if($inserted != 0) {
                                        echo "<script> alert('updated! ');
                                                window.location.href='blogPosts.php';
                                                </script>";
                                    }
                                }else if($section == 'addCat') {
                                    $updated = updateRecord("category", $cleanCatData,"categoryId = $editCatId");
                                    if($updated == 1) {
                                        echo "<script> alert('updated! ');
                                                window.location.href='blogCategories.php';
                                                </script>";
                                    }
                                }
                                break;
        }
       
      
    }
    function cleanBlogInfo($section) {

        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'       :   $preparedData['title'] = $fieldValue;
                                        break;
                case 'url'         :   $preparedData['url'] = $fieldValue;
                                        break;
                case 'content'     :   $preparedData['content'] = $fieldValue;
                                        break;
                
                case 'publishedAt' :   $preparedData['publishedAt'] = $fieldValue;
                                        break;
                case 'category'    :   if(is_array($fieldValue)) {
                                            $preparedData['cat'] = implode(",",$fieldValue);
                                        }else {
                                            $preparedData['cat'] = $fieldValue;
                                        }
                                        break;  
                }
        }
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
        $preparedData['userId'] = $_SESSION['userId'];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile); 
        $preparedData['image'] = $uploadDir . $_FILES['image']['name'];
        return $preparedData;
    }
    function cleanCatInfo($section) {

        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'       :   $preparedData['title'] = $fieldValue;
                                        break;
                case 'URL'         :   $preparedData['url'] = $fieldValue;
                                        break;
                case 'content'     :   $preparedData['content'] = $fieldValue;
                                        break;
                case 'publishedAt' :   $preparedData['publishedAt'] = $fieldValue . " ". date('H:m:s',time());
                                        break;
                case 'cat'    :   $preparedData['parentCatId'] = $fieldValue;
                                       break;  
                case 'metaTitle'   :    $preparedData['metaTitle'] = $fieldValue;
                                        break;
                }
        }
        $preparedData['createdAt'] = date('Y-m-d H:i:s', time());
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile); 
        $preparedData['image'] = $uploadDir . $_FILES['image']['name'];
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


?>