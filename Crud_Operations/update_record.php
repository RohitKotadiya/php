<?php
    extract($_POST);

    include "connection.php";
    if(isset($hobbyOne) && !empty($hobbyOne) && isset($hobbyTwo) && !empty($hobbyTwo))
            $hobby = $hobbyOne . " , " . $hobbyTwo;
    else if(isset($hobbyOne) && !empty($hobbyOne))
            $hobby = $hobbyOne;
    else if(isset($hobbyTwo) && !empty($hobbyTwo))
            $hobby = $hobbyTwo;
    else
            $hobby = NULL;

    $update_record = "update user set userName='$uName' , userEmail='$email' , mobileNumber ='$mobileNo' , gender= '$gender' ,
                     hobby = '$hobby' , city = '$city' where userId = $uId";

    $result = mysqli_query($con, $update_record);
    if($result == 1) {
        echo "<script> alert('Record Updated !'); </script>";
        header('location:show_users.php');
    }
    else{
        echo "<script> alert('Error Occured !'); </script>";
        header('location:show_users.php');
    }                 
?>