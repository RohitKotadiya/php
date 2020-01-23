<?php
    include('connection.php');

    $selectQuery = "select * from user";

    $queryResult = mysqli_query($con,$selectQuery);
?>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>mobile Number</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th colspan="2">Actions</th>
        </tr>
<?php
    if(mysqli_num_rows($queryResult) > 0 ) {
        while($row = mysqli_fetch_assoc($queryResult)) {
            ?>
            <tr>
                <td><?= $row['userName']?></td>
                <td><?= $row['userEmail']?></td>
                <td><?= $row['city']?></td>
                <td><?= $row['mobileNumber']?></td>
                <td><?= $row['gender']?></td>
                <td><?= $row['hobby']?></td>
                <td><a href="show_users.php?id=<?= $row['userId']?>">edit</a></td>
                <td><a href="delete_record.php?uId=<?= $row['userId'] ?>">delete</a></td>
            </tr>
<?php            
        }?>
        </table>
        <div>
            <a href="">Logout</a>
        </div>
<?php    
    }
    else {
        echo "Record not Found";
    }

        $uId = $_GET['id'];
        $selectRecord = "select * from user where userId = $uId";

        $result = mysqli_query($con,$selectRecord);
        
        if(mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                // echo $row['userName'];
                $hobbies = explode(",",$row['hobby']);
                $reading = "";
                $sports = "";
                $both = "";
                if(count($hobbies) == 1 && $hobbies[0]=="Reading")
                    $reading = "checked";
                else if(count($hobbies) == 1 && $hobbies[0] == "Sports")
                    $sports = "checked";
                else if(count($hobbies) == 2)
                    $both = "checked";
                    echo $row['userName'];
                    print_r($row);
            ?>
                    <br>
                    <form method="POST" action="update_record.php">
                        <input type="hidden" name="uId" value=<?=$row['userId'] ?>>
                        <input type="text" name="uName" placeholder="Enter User name" value="<?= $row['userName'] ?>" required><br>     
                        <input type="email" name="email" placeholder="Enter Email" value="<?= $row['userEmail'] ?>" required><br>
                        <input type="number" name="mobileNo" placeholder="Enter Mobile No" value="<?= $row['mobileNumber'] ?>" required><br>
                        Gender : <input type="radio" value="Male" name="gender" required <?php if($row['gender']==='Male') echo "checked"; ?>>Male
                                <input type="radio" value="Female" name="gender" required <?php if($row['gender']==='Female') echo "checked"; ?>>Female<br>
                        Hobbies : <input type="checkbox" name="hobbyOne" value="Reading" <?= $reading,$both ?> >Reading
                                <input type="checkbox" name="hobbyTwo" value="Sports" <?= $sports,$both ?> > Sports<br>
                        <select name="city" required>
                            <option  value="Ahmedabad" <?php if($row['city'] === 'Ahmedabad') echo "selected"; ?> >Ahmedabad</option>
                            <option value="Palanpur" <?php if($row['city'] === 'Palanpur') echo "selected"; ?> >Palanpur</option>
                            <option value="Surat" <?php if($row['city'] === 'Surat') echo "selected"; ?> >Surat</option>
                        </select><br><br>
                        <input type="submit" value="UPDATE USER">
                    </form>
    <?php
            
        }
    }
?>
