<?php

	$str = "Hello guys , This is the first tutorial of string functions";
	$str2  = "the first ";

	echo substr($str,18)."<br>";//from 18 position

	echo substr($str,10,18)."<br>";//from 10 to 18 

	echo substr_count($str,"is")."<br>"; //2 times is gets in $str

	echo substr_replace($str,"are",15),"<br>"; // replace string with are word from position 15

	echo substr_compare($str,$str2,5)."<br>";//Binary safe comparison of two strings from an offset, up to length characters

	

?>