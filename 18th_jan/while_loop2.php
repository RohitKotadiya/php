<?php

	$digit =0;
	$no = 123456;
	$sum= 0;

	while($no>0)
	{
		$digit = $no % 10;
		$sum = $sum + $digit;
		$no = $no /10;
	}

	echo "Total sum = $sum";

?>