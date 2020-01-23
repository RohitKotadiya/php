<?php

if(file_exists('fileToDelete.txt'))
{
	echo 'File Exists<br>';

	if(rename('fileToDelete.txt','RenamedFile.txt'));
	{
		echo "Renamed Successfuolly";
	}
}
else
{
	echo 'File not Exists <br>';
}

?>