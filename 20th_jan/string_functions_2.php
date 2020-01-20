<?php

    $str = "hello , this is an example of explode , function";

	$res = explode(" ", $str); //to split words

	$res2 = explode(",", $str); // to split words bt ,

	$res3 = str_split($str); // split char by char

	print_r($res);

	echo "<br>";

	print_r($res2);

	echo "<br>";

	print_r($res3);


	$join = implode(" ",$res); //to join 

	echo "<br>".$join;

	$join2 = implode(" : ", $res);

	echo "<br>".$join2;

	$join3 = join(" ",$res);

	echo "<br>".$join3;

	$wrap =wordwrap($str,10,"**<br>");
	echo "<br>Word Wrap : ";
	print_r(    $wrap);
?>