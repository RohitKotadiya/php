<?php

	$directory = 'FolderToOpen';

	if($handle = opendir($directory))
	{
		while ($file = readdir($handle)) {
			echo "$file<br>"; //shows . and .. also that shows back to directory nd forward directory
			echo "<br>";
			echo "<a href='$directory/$file'> $file </a>";//with link to open it from browser
		}
	}

?>