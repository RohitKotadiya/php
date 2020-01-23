<?php

//User Details
if(isset($_POST['submit'])) {
    $remoteIp = $_SERVER['REMOTE_ADDR'];
    echo "Remote Ip from which user viewing page  => " . $remoteIp . "<br><br>";
    
    $remoteHost = $_SERVER['REMOTE_HOST'];                  // needs to be configured in httpd.config
    echo "Host name of User => " . $remoteHost . "<br><br>";     

    $reqPort = $_SERVER['REMOTE_PORT'];
    echo "Port from where user Requesting => " . $reqPort . "<br><br>";
}

?>
<hr>
<form method="POST" action="SERVER_vars_2.php">
    <input type="submit" value="SUBMIT" name="submit">
</form>