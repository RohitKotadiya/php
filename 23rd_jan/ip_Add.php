<?php


require 'ip_Address.php';

foreach ($blocked_ip as $ip) {

	if($ip == $ip_address)
	{
		echo 'your id address '.$ip_address.'has been blocked<br>';
    }
}
?>


<h1>hello World</h1>