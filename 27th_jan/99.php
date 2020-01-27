<?php

$to = 'kotadiya1998@gmail.com';
$body = 'hello , How are you';
$subject ='Test Email';
$headers = 'From:Rohit Kotadiya  <kotadiya1998@gmail.com>';

if(mail($to, $subject, $body,$headers))
{
	echo 'Mail sent<br>';
}
else
{
	echo 'Something wrong here';
}


?>