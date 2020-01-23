<?php
    include "connection.php";

    $uId = $_GET['uId'];

    $delete_record = "delete from user where userId = $uId";

    $result = mysqli_query($con, $delete_record);

    if($result == 1) {
        echo "<script> alert('Record Deleted ! ');</script>";
        header('location:show_users.php');
    }
    else {
        echo "<script> alert('Error Occured !'); </script>";
    }
?>