<?php
	$tomail="johnpaul@pixel-studios.com";
	$mlsubject="test";
	$bdymsg="Test Message";

	require 'application/models/PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 3;
	$mail->Debugoutput = 'html';
//	$mail->Host = "smtp-mail.outlook.com";
    $mail->Host =	"smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	//$mail->Username = "technicalsupport@gpshealthonline.com";
	//$mail->Password = "Sky@2019";
	//$mail->setFrom('gpshealthonline', 'technicalsupport@gpshealthonline.com');
	$mail->Username = "aishwarya.pixel@gmail.com";
	$mail->Password = "pixel@123";
	$mail->setFrom('aishwarya.pixel@gmail.com', '');
	$mail->Subject = $mlsubject;
	$mail->msgHTML($bdymsg);
	$mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
	 $emailarr=explode(",",$tomail);
	foreach($emailarr as $e){
		$mail->addAddress($e);
		
	}
	//send the message, check for errors
	if (!$mail->send()) {
			echo json_encode(array("rslt"=>"-1", "error_msg"=>$mail->ErrorInfo)); 
	} else {  
	
		echo json_encode(array("rslt"=>"1")); //success
	}


?>
?>