<?php

require('phpmailer/class.phpmailer.php');

function sendMail($host = 'smtp.tlc.com.ph', $port = '587', $username = 'anthony.moreno@tlc.com.ph',
			  $password = 'password', $attachment = '', $fromname = 'support', $to = '', $subject = '', 
			  $body = '', $alt_body = ''){
	$mail = new PHPMailer();

	$mail->IsSMTP();                                 
	
	$mail->SMTPDebug  = 1;                     
	$mail->SMTPAuth   = true;                  

	if (ISGMAIL) {
		$mail->SMTPSecure = 'tls'; 
		$mail->Host = $host;  
		$mail->Port = 465;  
		$mail->Username = $username;  
		$mail->Password = $password;   
	} else {
		$mail->Host = $host;
		$mail->Username = $username;  
		$mail->Password = $password;
		$mail->Port = $port;
	}        

	$mail->Username = $username;  // SMTP username
	$mail->Password = $password; // SMTP password
	$mail->Port = $port;
	
	
	$mail->From = $username;
	$mail->FromName = SMTP_ALIAS;
	$mail->AddAddress($to);
	$mail->AddReplyTo($username, "Information");
	
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->AddAttachment($attachment);         // add attachments
	$mail->IsHTML(true);                                  // set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->AltBody = $alt_body;
	
	if(!$mail->Send())
	{
	   //var_dump("Mailer Error: " . $mail->ErrorInfo);
	   return false;
	}	
	
	return true;
}

?>