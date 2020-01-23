<?php
    error_reporting('E_NOTICE');
	if(isset($_POST['userInput']) && !empty($_POST['userInput']))
	{
		$userData = $_POST['userInput'];
	}
	if(isset($_POST['search']) && !empty($_POST['search']))
	{
		$searchData = $_POST['search'];
	}	
	if(isset($_POST['replacement']) && !empty($_POST['replacement']))
	{
		$replacemetData = $_POST['replacement'];
	}
	$new_user_data = str_replace($searchData, $replacemetData, $userData);
	echo "new Data : $new_user_data";
?>
<form action="find_replace.php" method="POST">
	<textarea name="userInput" cols="30" rows = "6"></textarea><br><br>
	Search For :
	<input type="text" name="search"><br><br>
	Replace By :
	<input type="text" name="replacement"><br><br>
	<input type="submit" value="SUBMIT">
</form>