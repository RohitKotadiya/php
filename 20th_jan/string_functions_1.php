<?php

	$str = "Hello , today we will discuss about 'php' ";

	$res =htmlentities(addslashes($str));
	echo $res."<br>";

	$res2 = htmlentities(addcslashes($res, "des"));
	echo $res2."<br>";

	echo "<br>";

	$res3 = htmlentities(stripcslashes($res2));//will strip both types of slashes
	echo $res3."<br>";


	$res4 = htmlentities(stripslashes($res2)); //will strip both types of slashes
	echo $res4."<br>";

	$str2 = "Hello , <br> how are you <strong> Rohit <br>";
	echo strip_tags($str2)."<br>";
	
?>