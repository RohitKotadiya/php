<?php

	$noOne =1;
	$noTwo =2;

	$noOne = $noTwo += 1;
	echo $noOne."<br>";
	echo $noTwo."<br>";

	$a = true ? 0:1;
	echo $a,"<br>";

	$b = true ? 0 : true ? 1 :2;		//calculate like (true ? 0 : true) ? 1 : 2 -> (0)?1:2 => 2
	echo $b."<br>";

	$c =1;
	$d =1;

	$e = $c + $d +=2;
	echo $e." ".$d."<br>";

	echo $c + $d +=2,"<br>";

	$bool = true && false; 		//false - && has higher priority then =
	echo $bool,"<br>";

	$boolNo = true and false;	//true - and has lower then =  ->same for || & OR
	echo $boolNo,"<br>";

	$boolVal = true || false;
	echo $boolVal,"<br>";

	$boolValue = true OR false;
	echo $boolValue,"<br>";

	if($c & $d == 1);
		echo "Great!";

	if(($c & $d) == 1)
		echo "oops!!!";
?>