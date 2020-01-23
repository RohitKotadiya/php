<?php
    //to on output buffering
    ob_start();
?>
<h1> Hello </h1>
<h3> This is My Page</h3>
<a href="SERVER_vars.php" > click_here </a>

<?php
    $redirect = false;
    if($redirect === true) {
        header('Location:http://google.com');   
    }
    echo "<br>Ob Contents : " . ob_get_contents();
?>