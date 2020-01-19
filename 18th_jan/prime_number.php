<?php

	$no = 12;
	$i=1;
	$factors =0;

	while($i <= $no)
	{
		if($no % $i ==0)
		{
			$factors++;
		}
		$i++;
	}

	if($factors == 2)
	{
		echo "Number $no is a Prime number";
	}
	else
	{
		echo "Number $no is not a prime number";
	}
?>