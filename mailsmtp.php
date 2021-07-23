<?php
	$tomail="";
	$mlsubject="test";
	$bdymsg="Test Message";

	require 'application/models/PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 3;
	$mail->Debugoutput = 'html';
	$mail->Host = "";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "";
	$mail->Password = "";
	$mail->setFrom('', '');
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