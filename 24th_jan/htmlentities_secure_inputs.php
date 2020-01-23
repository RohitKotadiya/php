<?php
    $userName = htmlentities($_POST['uName']);      // prevent to append any tag given by user in page script
    echo "$userName";
?>
<hr>
<form action="htmlentities_secure_inputs.php" method="POST">
    <input type="text" name="uName"><br>
    <input type="submit" name="submit">
</form>