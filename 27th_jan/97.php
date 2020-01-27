<?php

	if(isset($_POST['pass']) && !empty($_POST['pass'])){

		$userPass = md5($_POST['pass']);
		echo $userPass.'<br>';
		//die();
		$handle =fopen('97_hash.txt','r');
		$filePass = fread($handle,filesize('97_hash.txt'));
		echo "$filePass<br>";
		
		if($filePass == $userPass){
			echo "Password Correct<br>";

		}else
		{
			echo "Incorrect Password";
		}

	}else
	{
		echo "<br>Enter a password";
	}

	
?>

<form action="97.php" method="POST">
	Enter Password : <input type="password" name="pass"><br><br>
	<input type="submit"> 
</form>
