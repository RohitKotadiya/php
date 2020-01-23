<?php
    extract($_POST);

    include('connection.php');

    $hobby="";
    if(isset($email) && !empty($email)) {
        if(isset($hobbyOne) && !empty($hobbyOne) && isset($hobbyTwo) && !empty($hobbyTwo))
            $hobby = $hobbyOne . " , " . $hobbyTwo;
        else if(isset($hobbyOne) && !empty($hobbyOne))
            $hobby = $hobbyOne;
        else if(isset($hobbyTwo) && !empty($hobbyTwo))
            $hobby = $hobbyTwo;
        else
            $hobby = NULL;

        $query = "insert into user (userName,userEmail,userPassword,mobileNumber,gender,hobby,city) 
                    values('$uName','$email','$uPass','$mobileNo','$gender','$hobby','$city')";

        $recordInsert = mysqli_query($con,$query);
        
        if($recordInsert){
            header('location:show_users.php');
        }else {
            echo "Error occured",mysqli_error($con) ;
        }
    }
?>
