<?php


// include('smtp/PHPMailerAutoload.php');
// function smtp_mailer($to, $subject, $msg)
// {
// 	$mail = new PHPMailer();
// 	// $mail->SMTPDebug  = 3;
// 	$mail->IsSMTP();
// 	$mail->SMTPAuth = true;
// 	$mail->SMTPSecure = 'tls';
// 	$mail->Host = "smtp.gmail.com";
// 	$mail->Port = 587;
// 	$mail->IsHTML(true);
// 	$mail->CharSet = 'UTF-8';
// 	$mail->Username = "trasaart1@gmail.com";
// 	$mail->Password = "P@ssw0rd0241";
// 	$mail->SetFrom("trasaart1@gmail.com");
// 	$mail->Subject = $subject;
// 	$mail->Body = $msg;
// 	$mail->AddAddress($to);
// 	$mail->SMTPOptions = array('ssl' => array(
// 		'verify_peer' => false,
// 		'verify_peer_name' => false,
// 		'allow_self_signed' => false
// 	));
// 	if (!$mail->Send()) {
// 		echo $mail->ErrorInfo;
// 	} else {
// 		return 'Sent';
// 	}
// }
