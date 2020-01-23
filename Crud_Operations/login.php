<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <form action="login.php" method="POST">   
            <input type="email" name="uEmail" placeholder="Enter Email Address" required><br>
            <input type="password" name="uPass" placeholder="Enter Password" required><br>
            <input type="submit" value="LOGIN">
        </form>
    </body>
<?php

    extract($_POST);

    include("connection.php");
    if(isset($uEmail) && !empty($uEmail) && isset($uPass) && !empty($uPass)) {
        
        $selectQuery = "select * from user where userEmail='$uEmail' AND userPassword='$uPass'";
        
        $result = mysqli_query($con,$selectQuery);
        $flag = false;
        if(mysqli_num_rows($result) == 1) {
            header('location:show_users.php');
        }else {
            echo "<SCRIPT> alert('username or password wrong!'); </SCRIPT>";
        }
    }

?>