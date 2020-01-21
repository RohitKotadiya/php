<?php

    echo "Data at POST : ";
  
    print_r($_POST);        // from name . will change to _ in POST/GET

    echo "<br>" . $_POST['user_fName'];

?>
<form action="arrays_6.php" method="POST">
    <input type="text" name="user.fName"><br>
    <input type="text" name="user.lName"><br>
    <input type="submit" value="SUBMIT">
</form>