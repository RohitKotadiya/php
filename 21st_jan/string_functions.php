<?php

    $binNum = 110001;

	echo bin2hex($binNum)."<br>";


	$greeting = " hello , how are you ?  ";

	echo chop($greeting); // similar to rTrim
	echo "Are You Ok ? ";

	$str3 =" hiiii";
	echo $greeting." ".ltrim($str3);

	echo "<br>".rtrim($greeting);
	echo "Hello  ";

	
	$greeting1 ="HELLO , HOW ARE YOU ? ";
	$greeting2 = "hello, how are you ";
	echo lcfirst("<br>" . $greeting) . "<br>"; //lower the first char of whole String

	echo ucfirst($greeting2)."<br>";

    echo ucwords($greeting2)."<br>";
    

    $strName ="Rohit";
    echo "<br>" . md5($strName) . "<br>";
    $myFile = md5_file("time_sheet.txt");
    echo $myFile;


    
	$strMsg = "Hello guys , This is the first tutorial of string functions";
	$strMsg2  = "the first ";

	echo "<br>" . substr($strMsg, 18) . "<br>";//from 18 position

	echo substr($strMsg, 10, 18) . "<br>";//from 10 to 18 

	echo substr_count($strMsg, "is") . "<br>"; //2 toimes is gets in $str

	echo substr_replace($strMsg, "are", 15)  , "<br>"; // replace string with are word from position 15

	echo substr_compare($strMsg, $strMsg2, 5) . "<br>";//Binary safe comparison of two strings from an offset, up to length characters


?>