<?php

	$xml = simplexml_load_file('105.xml');


	echo $xml->Student[1]->name.' is '.$xml->Student[1]->age;

	foreach ($xml->Student as $Stud) {
		# code...
		echo $Stud->name.' is of '.$Stud->age.'<br>';
	}
?>