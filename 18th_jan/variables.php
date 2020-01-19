<?php

	$rollNo = 11;
	$name = "Rohit";

	echo $rollNo," ",$name."<br>";

	$marksR  = 100;
	$marksHadoop = $marksR;

	echo $marksR," ",$marksHadoop."<br>";

	$marksHadoop = &$marksR;
	echo $marksHadoop;

	// $marksSQL = &(25); //invalid - only named varibles can refer

	function test(){
		echo "This is test";
	}
	$tst = &test();		//invalid - shows warning

	echo var_dump($name)."<br>";
	echo var_dump($marksR)."<br>";
	echo var_dump($marksHadoop)."<br>";

	echo "isset".isset($marksHadoop)."<br>";	//true

	echo "First set".isset($var)."<br>";		//false

	$arr = array();
	echo "Second set ".isset($arr)."<br>";		//true
	echo "Second Empty ".empty($arr)."<br>";	//true

	$var =null;
	echo "Third set".isset($var)."<br>";	//false
	echo "Third Empty ".empty($var)."<br>";	//true

	$num =0;
	echo "fifth set".isset($num)."<br>";	//true
	echo "Third Empty ".empty($num);	//true - consider 0 as empty also

	// $this = 100;  // invalid

	$floatNo = 10.54;
	echo "<br>".(int)$floatNo;
?>