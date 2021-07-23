<?php

function sendmailSMTP_doctor($tomail,$bccmail='',$mlsubject,$bdymsg,$header='',$doctorid=null)
{
	require __DIR__.'/PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "kalaivani.pixel@gmail.com";
	$mail->Password = "Kalai@321";
	$mail->setFrom('kalaivani.pixel@gmail.com', '');
	$mail->Subject = $mlsubject;
	$mail->msgHTML($bdymsg);
	$mail->SMTPSecure = 'tls';
	$mail->addCustomHeader($header); 
	$emailarr=explode(",",$tomail);
	foreach($emailarr as $e){
		$mail->addAddress($e);
	}
	//send the message, check for errors
	if (!$mail->send()) {
			echo json_encode(array("rslt"=>"-1", "error_msg"=>$mail->ErrorInfo)); 
	} else {  
	
		//echo json_encode(array("rslt"=>"1")); //success
	} 
}


function send_enquiry_confirmation_mail($db,$mailto,$bccmail,$mlsubject,$ccmail,$enquiryid){
  	
	function emailTemplateMessageReplace($res_get,$TemplateMessage){
	foreach($res_get as $key => $value) {
		  $TemplateMessage = str_replace("{{".$key."}}", $value, $TemplateMessage);
		}
	return $TemplateMessage;
	//print_r($TemplateMessage); exit;
}
}
  

function DoctorMailsend_registration($db,$lastinsert_id){ 

$MailTemplateMessage= $db->get_a_line("select *  from  ".TPLPrefix." where TempId = '16' ");
	$bodytempl=emailTemplateMessageReplace($template,$MailTemplateMessage['MailTemplateMessage']);
	
}

?>