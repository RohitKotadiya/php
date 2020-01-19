<?php

	$no = 10;
	$i=1;
	$totalFactors =0;

	While($i<$no)
	{
		if($no % $i ==0)
		{
			echo "$i<br>";
			$totalFactors++;
		}	
		$i++;
	}
	echo "<br>Total numbers of Factors = $totalFactors";

?>