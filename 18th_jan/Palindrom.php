<?php

	$no =53235;
	$no2 = $no;

	while ($no >0) {
		
		$digit = $no % 10;

		$reverse = $reverse * 10 + $digit;

		$no = $no / 10;
	}

	if($no2 == $reverse)
	{
		echo "Palindrom Number";
	}
	else
	{
		echo "Not a Palindrom Number";
	}
?>