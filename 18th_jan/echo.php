<?php

	$marksR = 50;
	$marksHadoop = 90;

	echo "Hello World!<br>";

	echo 'Hello World<br>';

	echo 'The marks of R is'.$marksR.'<br>';

	echo "The marks of Hadoop is $marksHadoop <br>";

	echo "Hello","How are You"," ? <br>"; 	//multiple parameters

	echo $marksHadoop+$marksR."<br>";	// sum of two

	echo $marksHadoop.$marksR."<br>";	// concate

	echo "$marksR+$marksHadoop\n";	//here \n not working  - this will just concat 

	echo nl2br("\n Hello ,\n How are you");	// function for new line \n OR \r

	echo nl2br("\n Hello Rohit You have got $marksHadoop \r marks in hadoop....\n");

	$value = 0;

	// ($value)? echo "true":echo 'false';          // not working bcaz echo is not a function - not return value

	($value)?print "true": print "false";			//works bcaz prints is function

	echo "<br>",1+2;

	echo "<br>",2+10/2;								// no paranthisis required for operator precedence

	echo "<br>The sum is ". 1 | 2;				//prints 2 bcaz . used here

	echo "<br>The sum is ". (1 | 2);			//pritns 3 - must use  () to perform operation

	echo "<br>The sum is ",1|2;					//prints 3 - sum bcaz ',' - take as parameter

	echo "<br>Hello 
			how are You, 
			Where are you from ?";				//in single line

	// while (true) {
	// 	echo "Loop started!\n",sleep(1000);
	// }

	// while (true) {
	// 	echo "This is the loop\n".sleep(1);
	// }

?>