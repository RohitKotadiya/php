<?php

	$str = " hello , how are you ?";

	echo str_repeat($str, 5)."<br>";

	echo str_shuffle($str)."<br>";

	echo str_replace("are","is",$str)."<br>";

	echo strcasecmp("Hello","HELLO");//binary safe case insensitive - return 0 if match

    echo "<br>".strcasecmp("hello ","hello How are you")."<br>";

	echo strcmp("hello how are you ? ? ? ?","hello how are you ? ? ?")."<br>"; //binary safe case sensitive - return 0 if match

	echo strlen($str);

?>