<?php

	if(isset($_POST['name'])&& isset($_POST['email']) && isset($_POST['msg']) && !empty($_POST['name'])
			&& !empty($_POST['email'])&& !empty($_POST['msg']))
	{
		$to ="kotadiya1998@gmail.com";
		$headers = 'From:'.$_POST['email'];
		$message = $_POST['msg'];
		$subject ='Contact form submitted';
		if(mail($to,$subject, $message,$headers))
		{
			echo "Thank you for contacting us, we\'ll reach you soon";
		}
		else
		{
			echo "<br>try Again";
		}

	}

?>

<form action ="100.php" method="POST">

	Enter Name :
		<input type="text" name="name"><br>
	Enter Email:
		<input type="email" name="email"><br>
	Enter Message :
		<textarea name="msg" cols="30" rows="10"></textarea>
		<br><br>
	<input type="submit" value="Send"> 
</form>