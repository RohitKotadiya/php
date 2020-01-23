<?php

// Server Details

if(isset($_POST['submit'])) {
    
    $serverIp = $_SERVER['SERVER_ADDR'];
    echo "Server Ip under which file executing => " . $serverIp . "<br><br>";

    $serverName = $_SERVER['SERVER_NAME'];
    echo "Server Name => " . $serverName . "<br><br>";
    
    $gatewayInterface = $_SERVER['GATEWAY_INTERFACE'];
    echo "Gateway Interface => " . $gatewayInterface . "<br><br>";

    $protocol = $_SERVER['SERVER_PROTOCOL'];
    echo "Server Protocol => " . $protocol . "<br><br>";

    $serverSoftware = $_SERVER['SERVER_SOFTWARE'];
    echo "Server Software => " . $serverSoftware . "<br><br>";

    $method = $_SERVER['REQUEST_METHOD'];
    echo "Request Method => " . $method . "<br><br>";

    $reqTime = $_SERVER['REQUEST_TIME'];
    echo "Request Time => " . $reqTime . "<br><br>";

    $phpPage = $_SERVER['PHP_SELF'];
    echo "Php Page currently executing => " . $phpPage . "<br><br>";

    $serverPort = $_SERVER['SERVER_PORT'];
    echo "Port of server => " . $serverPort . "<br><br>";

}

?>
<hr>
<form method="POST" action="SERVER_vars.php">
    <input type="submit" value="SUBMIT" name="submit">
</form>