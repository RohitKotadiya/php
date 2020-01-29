<?php

    echo $_FILES['f1']['name'];

?>

<html>
    <form action="fileUpload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="f1">
        <input type="submit">
</form>