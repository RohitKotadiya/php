<?php

	// require("PHPMailer-master/src/PHPMailer.php");
 //    require("PHPMailer-master/src/SMTP.php");
 //    require("PHPMailer-master/src/Exception.php");


	use PHPMailer\PHPMailer;
	use PHPMailer\SMTP;
	use PHPMailer\Exception;
	
	$mail = new PHPMailer(true);
	//$mail =new PHPMailer\PHPMailer\PHPMailer();
	
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->Username="kotadiya1998@gmail.com";
		$mail->Password="RAjpatel@143143";

	

	$mail->AddAddress("9ritspatel5@gmail.com");
	$mail->SetFrom("kotadiya1998@gmail.com");
	$mail->Subject ="Test Mail";
	$mail->Body="Hello World";

	try {
		$mail->Send();
		echo "Mail Sent!";
	} catch (Exception $e) {
		echo "Failed";
	}

//hr@cybercom.co.in

?>