
<?php
	$to='kalaivani.pixel@gmail.com';
	$subject=$mlsubject = 'Inbase mail';
	$bdymsg ="Test";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n"; 

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: Inbase <kalaivani.pixel@gmail.com>' . "\r\n";

	//$headers .= 'Bcc: kalaivani.pixel@gmail.com' . "\r\n";

	@mail($to,$subject,$bdymsg,$headers);
?>
