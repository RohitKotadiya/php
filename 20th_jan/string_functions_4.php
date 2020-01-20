<?php

	$str = "Hello guys , This is the first tutorial of string functions";
	$str2 = "Hello guys , ThIs is the first tutorial of string functions";

	$pos = strpos($str,"is"); // position of first occurance of is word case sensitive
	echo $pos."<br>";

	$pos2 = strpos($str2,"is"); 
	echo $pos2."<br>";

	$pos3 = stripos($str2,"is"); //case insensitive
	echo $pos3."<br>";

	echo strrev($str)."<br>";

	echo strstr($str,"first")."<br>"; //return string from first word upto end of string

	echo strtok($str,",")."<br>"; //return string from start upto not found ","

	echo strtoupper($str)."<br>";
	echo strtolower($str);
?>