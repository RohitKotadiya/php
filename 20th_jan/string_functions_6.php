<?php


	$str = "Hello , i'll give you small introduction about 'php' tomorrow.";
	$num =  100;

	echo $result = htmlentities(addslashes($str)).'<br>';

	echo htmlentities(addcslashes($str,'ebw')).'<br>';

	echo htmlentities(highlight_string($str))."<br>";

	echo htmlentities(is_string($str))."<br>";

	echo htmlentities(is_string($num))."<br>";

	

?>