<?php
	$tomail="kalaivani.pixel@gmail.com";
	$mlsubject="test";
	$bdymsg="Test Message";
echo __DIR__.'/application/models/phpmailer/PHPMailerAutoload.php';
	require_once __DIR__.'/application/models/phpmailer/PHPMailerAutoload.php';
	
	 $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->isHTML(true);
	$mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = 'TLS';
    $mail->SMTPAuth = true;
	$mail->Username = 'aishwarya.pixel@gmail.com';
    $mail->Password = "pixel@123";
    $mail->From = 'aishwarya.pixel@gmail.com';
    $mail->AddReplyTo('aishwarya@pixel.com', 'GPS Link');
	//$mail->addBcc($bccmail);
    $mail->FromName ='enquiries@gpslink.co.uk';
    $mail->addAddress('kalaivani.pixel@gmail.com');
    $mail->Subject = $mlsubject;
	
    $mail->msgHTML($bdymsg);

    if (!$mail->send()) {
       $error = "Mailer Error: " . $mail->ErrorInfo;
         echo $error; exit;
       //return 0;
    } 
    else {
		 echo "success";
		//return 1;
    }
	


?> 