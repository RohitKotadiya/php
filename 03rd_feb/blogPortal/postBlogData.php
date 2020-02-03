<?php
    session_start();
    $flag = 1;
    date_default_timezone_set('Asia/kolkata'); //to set time zone

    function validateBlogField($section ,$fieldName) {
        echo "<pre>";    //to validate URL and File Extension
    }
    function prepareBlogData($operation) {
        $cleanBlogData = cleanBlogInfo('addBlg');
        $postData = [];
        foreach($cleanBlogData as $key => $value) {
            if($key != 'cat')
                $postData[$key] = $value;
            else
                $catData[$key] = explode(",",$value);
        }
        echo "</pre>";
        $inserted = $updated = 0;
        switch($operation) {
            case 'insert'   :   $lastId = insertData($postData, "blog_post");
                                foreach($catData['cat'] as $cat) {
                                    $tmpArr['postId'] = $lastId;
                                    $tmpArr['categoryId'] = $cat; 
                                    insertData($tmpArr, "post_category");
                                }
                                break;
            case 'update'   :   updateRecord("customers", $cleanAccountData,"customerId = $editUserId");
                                break;
        }
        if($inserted != 0) {
            echo "<script> alert('Added Successfully! ');
                        window.location.href='blogPosts.php';
                        </script>";
        }
        if($updated == 1) {
            echo "<script> alert('updated! ');
                    window.location.href='blogPosts.php';
                    </script>";
        }
    }
    function cleanBlogInfo($section) {

        $preparedData = [];
        foreach($_POST[$section] as $fieldName => $fieldValue) {
            switch($fieldName) {
                case 'title'       :   $preparedData['title'] = $fieldValue;
                                        break;
                case 'URL'         :   $preparedData['blogURL'] = $fieldValue;
                                        break;
                case 'content'     :   $preparedData['content'] = $fieldValue;
                                        break;
                case 'postImg'     :   $preparedData['image'] = $fieldValue;
                                        break;
                case 'publishedAt' :   $preparedData['publishedAt'] = $fieldValue . " ". date('H:m:s',time());
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
        $uploadFile = $uploadDir . basename($_FILES['postImg']['name']);
        move_uploaded_file($_FILES['postImg']['tmp_name'], $uploadFile); 
        $preparedData['image'] = $uploadDir . $_FILES['postImg']['name'];
        return $preparedData;
    }


?>