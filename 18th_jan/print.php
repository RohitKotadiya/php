<!-- differences to echo are that print only accepts a single argument and always returns 1. -->
<?php

	print("hello<br>"); 

	print "hello";	//both are same

	// print("hello","how are You");     //not allowed - takes 1 parameter only

	print "<br>This is an
			example of 
			multiple lines in print()";  //as a single line

	$name = "Rohit";
	
	print '<br>$name'; 			//var name
	print "<br>$name";			//value



	print <<<END
	This uses the "here document" syntax to output
	multiple lines with $name interpolation. Note
	that the here document terminator must appear on a
	line with just a semicolon no extra whitespace!
END;

	$arr = array('name' =>'Rohit','city'=>palanpur);
	print_r($arr);

	print "<br>The name is {$arr['name']}";
	
	print "<br>".key($arr);

	print_r(array_keys($arr));
?>