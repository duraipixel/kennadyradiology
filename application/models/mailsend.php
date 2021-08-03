<?php
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


		
function emailTemplateMessageReplace($res_get,$TemplateMessage){
	foreach($res_get as $key => $value) {
		  $TemplateMessage = str_replace("{{".$key."}}", $value, $TemplateMessage);
		}
	return $TemplateMessage;
	//print_r($TemplateMessage); exit;
}


function send_mail($tomail,$bccmail,$mlsubject,$bdymsg,$head='',$isbcc='',$mailfor='')
{
	//1 - order mail
	if($mailfor == 1){
	$bccmail = ",ecom@kiran.in";	
	}else {
	$bccmail = ",support@kiran.in";	
	}
	
	//$bccmail = ",pravin@pixel-studios.com";
 
	$to=$tomail;
	$subject=$mlsubject;
	
	$headers  = 'MIME-Version: 1.0' . "\r\n"; 

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: kiran <support@kiran.com>' . "\r\n";

	$headers .= 'Bcc: kalaivani.pixel@gmail.com'.$bccmail.'' . "\r\n";

	if(@mail($to,$subject,$bdymsg,$headers)){
      //echo "jj";
	}

	else{
     //echo "pp";
	}	

}


function send_mail_smtp($tomail,$bccmail='',$mlsubject,$bdymsg,$header='',$isbcc='')
{
    //echo $bdymsg; exit; 
	$tomail='kalaivani.pixel@gmail.com';
	require __DIR__.'/PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "kalaivani.pixel@gmail.com";
	$mail->Password = "Vani@321";
	$mail->setFrom('kalaivani.pixel@gmail.com', '');
	$mail->Subject = $mlsubject;
	$mail->msgHTML($bdymsg);
	$mail->SMTPSecure = 'tls';
	$mail->addCustomHeader($header); 
	$emailarr=explode(",",$tomail);
	if($isbcc == 1){
	//	$mail->addBCC('kalaivani.pixel@gmail.com');
	}else if($isbcc == 2){
	//	$mail->addBCC('kalaivani.pixel@gmail.com');
	}
	else{
   //  $mail->addBCC('kalaivani.pixel@gmail.com');
	}
	//$mail->addBCC('qa@pixel-studios.com');
	
	foreach($emailarr as $e){
		$mail->addAddress($e);
	}
	//send the message, check for errors
	if (!$mail->send()) {
			// echo json_encode(array("rslt"=>"-1", "error_msg"=>$mail->ErrorInfo)); 
	} else {  
	
		 //echo json_encode(array("rslt"=>"1")); //success
	} 
}


function send_mail_attachment($tomail,$bccmail='',$mlsubject,$bdymsg,$header='',$attachment='')
{
// Recipient 
$to = $tomail; 
 
// Sender 
$from = 'kalaivani.pixel@gmail.com'; 
$fromName = 'kiran'; 
 
// Email subject 
$subject = 'Product Catalogue';  
 
// Attachment file 
$file = __DIR__."/../../uploads/".$attachment; 
 
// Email body content 
$htmlContent = $bdymsg;
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
// Send email 
$mail = @mail($to, $subject, $message, $headers, $returnpath); 
 
}

function send_mail_attachment_smtp($tomail,$bccmail='',$mlsubject,$bdymsg,$header='',$attachment='')
{
	$tomail=$tomail;
	require __DIR__.'/PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "aishwarya.pixel@gmail.com";
	$mail->Password = "pixel@123";
	$mail->setFrom('aishwarya.pixel@gmail.com', '');
	$mail->Subject = $mlsubject;
	$mail->msgHTML($bdymsg);
	$mail->SMTPSecure = 'tls';
	$mail->addCustomHeader($header); 
	$emailarr=explode(",",$tomail);
	$mail->addAttachment(__DIR__."/../../uploads/".$attachment);
	//$mail->addBCC('support@kiran.in');
	$mail->addBCC('kalaivani.pixel@gmail.com');
	//$mail->addBCC('qa@pixel-studios.com');
	
	foreach($emailarr as $e){
		$mail->addAddress($e);
	}
	//send the message, check for errors
	if (!$mail->send()) {
			echo json_encode(array("rslt"=>"-1", "error_msg"=>$mail->ErrorInfo)); 
	} else {  
	unlink(__DIR__."/../../uploads/".$attachment);
		//echo json_encode(array("rslt"=>"1")); //success
	} 
}


function send_mail_more($tomail,$bccmail,$mlsubject,$bdymsg)
{
	$to=$tomail;
	$subject=$mlsubject;
	$headers  = 'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:ERS <ers@thales.jatrack.com>' . "\r\n";
	$headers .= 'Bcc:'.$bccmail . "\r\n";
	;
	$res=mail($to, $subject, $bdymsg, $headers);
	
}

function randHash($len=32)
{
	return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
}


function ordermailfunction($db,$referanceid='',$type='3')
{
	$referanceid=$db->real_escape_string($referanceid);
	$type=$db->real_escape_string($type);
	$select_orderqry = "select t1.*,t2.product_id,t2.product_name,t2.order_product_id,t2.product_images,t2.product_qty,t2.product_price,t2.prod_attr_price,t2.prod_sub_total,t2.tax_type,t2.tax_value,t3.Attribute_Name,t3.Attribute_value_name,t4.countryname,t5.statename,t6.order_statusName from ".TPLPrefix."orders t1 inner join ".TPLPrefix."orders_products t2 on t1.order_id=t2.order_id and t2.IsActive=1 
	inner join  ".TPLPrefix."order_status t6 on t1.order_status_id=t6.order_statusId and t6.IsActive=1 
	left join ".TPLPrefix."orders_products_attribute t3 on t2.order_product_id=t3.order_product_id and t3.IsActive=1 left join ".TPLPrefix."country t4 on t1.payment_country_id=t4.countryid left join ".TPLPrefix."state t5 on t1.paymentStateId=t5.stateid where t1.order_reference=? and t1.IsActive=1 group by t2.order_product_id ";
	
	$prod_details=$db->get_rsltset_bind($select_orderqry,array($referanceid)); 
	
	//echo "<pre>"; print_r($prod_details); exit;
	
	$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = ? ";
	$res_ed = $db->get_a_line_bind($str_ed,array($type)); 
	
	require_once(APP_DIR .'helpers/common_function.php');
	
	$helper=new common_function;
		
	 $helper->getStoreConfig(); 
	 $helper->getStoreConfigvalue('ecomLogo'); 
	
		$orderstatus = "Order Status: ".$prod_details[0]['order_statusName'];
		$to =  $prod_details[0]['email'];
		$subject = $res_ed['mailsub'];
		$bccmail = $res_ed['mailbcc'];
		
		
		$message = '<div style="background-color:rgb(255,255,255);margin:0;font:12px/16px Arial,sans-serif"><img width="1" height="1" src=""> 
  <table id="m_4836535370212275732container" style="width:640px;color:rgb(51,51,51);margin:0 auto;border-collapse:collapse"> 
   <tbody> <tr> 
     <td class="m_4836535370212275732frame" style="padding:0 20px 20px 20px;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
      <table id="m_4836535370212275732main" style="width:100%;border-collapse:collapse"> 
       <tbody>
        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table id="m_4836535370212275732header" style="width:100%;border-collapse:collapse"> 
           <tbody>
            <tr> 
             <td rowspan="2" class="m_4836535370212275732logo" style="width:115px;padding:18px 0 0 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" title="Visit '.$helper->getStoreConfigvalue('store_name').'" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img alt="'.$helper->getStoreConfigvalue('store_name').'" src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px"> </a> </td> 

            </tr> 
            <tr> 
             <td colspan="3" class="m_4836535370212275732title" style="text-align:right;padding:7px 0 5px 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h2 style="font-size:20px;line-height:24px;margin:0;padding:0;font-weight:normal;color:rgb(0,0,0)!important">'.$orderstatus.'</h2> Order #<a href="" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer">'.$prod_details[0]['order_reference'].'</a> <br> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table id="m_4836535370212275732summary" style="width:100%;border-collapse:collapse"> 
           <tbody>
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(204,102,0);margin:15px 0 0 0;font-weight:normal">Hello'.' '. $prod_details[0]['firstname'].' '.$prod_details[0]['lastname'].',</h3>'. str_replace("||order_id||",$prod_details[0]['order_reference'],$res_ed['mailcontent']).'</td> 
            </tr> 
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 

        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table style="width:100%;border-top:3px solid rgb(45,55,65);border-collapse:collapse" id="m_4836535370212275732criticalInfo"> 
           <tbody>
            <tr> 
             <td style="font-size:14px;padding:11px 18px 18px 
             <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgb(239,239,239);width:50%;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> <p style="margin:2px 0 9px 0;font:12px/16px Arial,sans-serif"> <span style="color:rgb(102,102,102)">Shipping Address:</span> <br> <b> '. $prod_details[0]['firstname'].' '.$prod_details[0]['lastname'].' <br> '.$prod_details[0]['payment_address_1'].' <br> '.$prod_details[0]['payment_city'].','.$prod_details[0]['statename'].' '.$prod_details[0]['payment_postcode'].' <br> '.$prod_details[0]['countryname'].' </b> </p> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="border-bottom:1px solid rgb(204,204,204);vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(204,102,0);margin:15px 0 0 0;font-weight:normal">Order Details</h3> </td> 
        </tr> 

        <tr> 

         <td style="padding-left:32px;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table style="width:95%;border-collapse:collapse" id="m_4836535370212275732itemDetails" cellpadding="0" cellspacing="0" border="0"> 
		  	<thead>
				<tr>
				    <th>Image</th>
					<th>Product Name</th>					
					<th>Price(INR)</th>
					<th>Quantity</th>
					<th>GST(INR)</th>
					<th>Total(INR)</th>				
				</tr>
		    </thead>
           <tbody>';
		// echo "<pre>";  print_r($prod_details); exit;
		  foreach($prod_details as $prolist){
			    
			$select_pro_attri = "select Attribute_Name,Attribute_value_name from ".TPLPrefix."orders_products_attribute where order_product_id='".$prolist['order_product_id']."' ";
				$pro_attri_details=$db->get_rsltset($select_pro_attri); 
				
			    //$single_price = $helper->calculateproductPrice($prolist['product_price'],$prolist['tax_type'],$prolist['tax_value']);
				
				if($prolist['tax_type']=='P'){
					$tax = ($prolist['prod_attr_price']*$prolist['tax_value'])/100;
				}
				else
				{   
					$tax = $prolist['tax_value'];
				}
				
				
				$prodprice = ($prolist['prod_attr_price']*$prolist['product_qty']);
			    $discount=0;
				 if(!empty($prolist['discount_slab']) && $prolist['discount_slab']!=''){
					$discount =  ($prodprice*$prolist['discount_slab'])/100;
					$prodprice = $prodprice-$discount;
				 }
				 
				 if( strtoupper($prolist['tax_type'])=="P")
				 {											
					$totaprice = $prodprice + (($prodprice * $prolist['tax_value'])/100);
				 }	
				 else if(strtoupper($prolist['tax_type'])=="F"){
					$totaprice = $prodprice +  $prolist['tax_value'];
				 }
				else{
					$totaprice = $prodprice;
				}
				$total = $prolist['prod_sub_total'];
				
			  
            $message .='<tr> 
				 <td class="m_4836535370212275732photo" style="width:150px;text-align:center;padding:16px 0 10px 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img id="m_4836535370212275732asin" src="'.BASE_URL.$prolist['product_images'].'" style="border:0; width:60px;" > </a> </td> 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> 
				 '.$prolist['product_name'].' ';
				 if(count($pro_attri_details)>0){
				$payableamount=0;	 
				 foreach($pro_attri_details as $value) { 
 
		 $message .=' <div><p><small >'.$value['Attribute_Name'].': '.$value['Attribute_value_name'].'</small></p></div>';
				 } }
		$message .='</td> 		       
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> '.number_format($prolist['prod_attr_price'],2).'
				 </td> 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.$prolist['product_qty'].'
				 </td>
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.number_format($tax,2).'
				 </td>
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.number_format($prolist['prod_sub_total'],2).'
				 </td>
				
				 
            </tr>'; 
			$subtotal +=$total;
	    }
		$payableamount = $subtotal;
    $message .='</tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="padding-left:32px;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table style="width:95%;border-collapse:collapse" id="m_4836535370212275732costBreakdown"> 
           <tbody>
            <tr> 
             <td colspan="2" class="m_4836535370212275732divider" style="border-top:1px solid rgb(234,234,234);padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:12px;font-family:Arial,sans-serif"></td> 
            </tr> 
			
            <tr> 
             <td colspan="2" style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:12px;font-family:Arial,sans-serif"> <p style="margin:4px 0 0 0;font:12px/16px Arial,sans-serif"></p> </td> 
            </tr> 
            <tr> 
             <td colspan="2" style="text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-size:12px;font-family:Arial,sans-serif"> <p style="margin:4px 0 0 0;font:12px/16px Arial,sans-serif"></p> </td> 
            </tr> 
            <tr> 
             <td class="m_4836535370212275732total" style="font-size:14px;font-weight:bold;font:12px/16px Arial,sans-serif;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-family:Arial,sans-serif"> 
			 <span>Subtotal: </span><br>';
			 if($prolist['coupon_discount']>0){
			 $message .='<span>Coupon Amount(-) :</span><br>';
			 }
			 $message .='<span>Shipping Charge(+) :</span><br>
			 <strong>Amount Payable :</strong>
			 </td> 
             <td class="m_4836535370212275732total" style="font-size:14px;font-weight:bold;font:12px/16px Arial,sans-serif;text-align:right;line-height:18px;padding:0 10px 0 0;vertical-align:top;font-family:Arial,sans-serif"> INR'.number_format($subtotal,2).'<br>';
			 if($prolist['coupon_discount']>0){
				$payableamount = ($subtotal-$prolist['coupon_discount']);
				
  $message .='INR'.number_format($prolist['coupon_discount'],2).'<br>';				
			 }
			 $payableamount = ($payableamount+$prolist['shippint_cost']);
 $message .=' INR'.number_format($prolist['shippint_cost'],2).'<br>
              INR'.number_format($payableamount,2).'
              </td> 
			 
            </tr> 
            <tr> 
             <td colspan="2" class="m_4836535370212275732end" style="padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:12px;font-family:Arial,sans-serif"></td> 
            </tr> 
            <tr> 
             <td colspan="2" class="m_4836535370212275732divider" style="border-top:1px solid rgb(234,234,234);padding:0 0 16px 0;text-align:right;line-height:18px;vertical-align:top;font-size:12px;font-family:Arial,sans-serif"></td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
		 '.str_replace("||order_id||",$prod_details[0]['order_reference'],$res_ed['mailfooter']).'
           </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
   </tbody>
  </table>  
 <img width="1" height="1" src="">
 
 </div>';
		
		//$mailfunction = sendmailSMTP($to,'', $subject, $message,$headers); 
	//echo $message;	exit;
	
	
		send_mail($to,$bccmail,$subject,$message,'',2,1);	
	
}

function Registermailfunction($db,$customerid)
{
	
	$today = date("Y-m-d H:i:s"); 
	if($customerid!=''){
		$customerid=$db->real_escape_string($customerid);
		$str_qtr = "select * from ".TPLPrefix."customers where customer_id=? and IsActive = '0' ";
		$res_customer = $db->get_a_line_bind($str_qtr,array($customerid));
			
		if($res_customer['customer_group_id']=='1'){	
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				$verificationcode = array(); 
				$alpha_length = strlen($alphabet) - 1; 
				for ($i = 0; $i < 15; $i++) 
				{
					$n = rand(0, $alpha_length);
					$verificationcode[] = $alphabet[$n];
				}
			$verificationcodes = implode($verificationcode);
			$verification = $verificationcodes.time();
			
			$strQry ="INSERT INTO  ".TPLPrefix."register_verification (cus_groupid, customerid, verification, IsActive, createddate,modifieddate ) VALUES ( '".$res_customer['customer_group_id']."', '".$res_customer['customer_id']."',  '".$verification."', '1','".$today."','".$today."')";
				//echo $strQry; exit;
			$str_qry=$db->insert($strQry);
		}	
		if($res_customer['customer_group_id']=='1'){
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive = '1' and masterid = '1' and lang_id='".$_SESSION['lang_id']."'";
		}else if($res_customer['customer_group_id']=='2'){
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive = '1' and masterid = '23' and lang_id='".$_SESSION['lang_id']."' ";	
		}
		$res_ed = $db->get_a_line($str_ed);
		
		require_once(APP_DIR .'helpers/common_function.php');
		
		$helper=new common_function;
			
		 $helper->getStoreConfig(); 
		 $helper->getStoreConfigvalue('ecomLogo');
			
					//$url = BASE_URL.'verification/'.$verification;
					$to =  $res_customer['customer_email'];
					$subject = $res_ed['mailsub'];
					$bccmail = $res_ed['mailbcc'];
					$link ='<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">
					
					<tr>
				   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
				   <td style="text-transform: capitalize;">&nbsp;</td>
				   </tr>
					
					<tr valign="top">
					<td>
					<p><span style="font-size:12.0pt;font-family:" times="" new="" roman="" ","serif="" ";=" " mso-fareast-font-family:calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language:=" " en-in;mso-fareast-language:en-in;mso-bidi-language:ar-sa"="">Hello '.$res_customer['customer_firstname'].',<span> </p>
					'.$res_ed['mailcontent'].' ';
					if($res_customer['customer_group_id']=='1'){
				     $link.='<br/>
					 <p><span style="font-size:11.0pt;font-family:" times="" new="" roman="" ","serif="" ";=" " mso-fareast-font-family:calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language:=" " en-in;mso-fareast-language:en-in;mso-bidi-language:ar-sa"="">Activation Link : <a target="" href="'.BASE_URL.'verification/'.$verification.'">Click</a> Here <span></p>';
					}
					if($res_customer['customer_group_id']=='2'){
						
					   $link.='
					   <p>We take this opportunity to welcome thank you for registering with your corporate gifting partner on your favourite online gifting brand.</p>
					   <p> Your Account will activate once our verification is completed.</p>';	
					}
				$link.=''.$res_ed['mailfooter'].'
					</td>
					</tr>
					
				<tr>
				   <td valign="top" style="background: #56514d;">
					<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' kiran </span>
					</td>					 
				</tr>

			</table>';
			 
 			 
		//send_mail($to,$bccmail,$subject,$link,'',1);	
		send_mail_smtp($to,$bccmail,$subject,$link,'','1');	
	}
	
}



function productEnquiryquote($db,$enproductid)
{
	
	$today = date("Y-m-d H:i:s"); 
	if($enproductid!=''){
		$enproductid=$db->real_escape_string($enproductid);
		$str_qtr = "select * from ".TPLPrefix."prodenquire where EnquiryId=? and IsActive = 1 ";
		$res_ed_product = $db->get_a_line_bind($str_qtr,array($enproductid));
		
		 
		
		require_once(APP_DIR .'helpers/common_function.php');
		
		$helper=new common_function;
			
		 $helper->getStoreConfig(); 
		 $helper->getStoreConfigvalue('ecomLogo');
		 
		 
 					$template=array("username"=>$res_ed_product['firstname'].$res_ed_product['lastname'],
					 "organization"=>$res_ed_product['organization'],
					 "mobileno"=>$res_ed_product['MobileNo'],
					 "emailid"=>$res_ed_product['EmailId'],
					 "productname"=>$res_ed_product['productname'],
					 "query"=>$res_ed_product['Query']
				    );
 
 // echo "select *  from  ".TPLPrefix."mailtemplate where masterid = '24' and lang_id='".$_SESSION['lang_id']."' ";
					$MailTemplateMessage= $db->get_a_line("select *  from  ".TPLPrefix."mailtemplate where masterid = '24' and lang_id='".$_SESSION['lang_id']."' ");	
					 
					
			  		$TemplateMessage=emailTemplateMessageReplace($template,$MailTemplateMessage['mailcontent']);
					 
			
					//$url = BASE_URL.'verification/'.$verification;
					$to =  $res_ed['mailto'];
					$subject = $res_ed['mailsub'];
					$bccmail = $res_ed['mailbcc'];
					$link ='<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">
					
					<tr>
				   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
				   <td style="text-transform: capitalize;">&nbsp;</td>
				   </tr>
					
					<tr valign="top">
					<td>
					 
					'.$TemplateMessage.' ';
					
					
				$link.=''.$res_ed['mailfooter'].'
					</td>
					</tr>
					
				<tr>
				   <td valign="top" style="background: #56514d;">
					<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' kiran </span>
					</td>					 
				</tr>

			</table>';
			 
 			 
		//send_mail($to,$bccmail,$subject,$link,'',1);	
	send_mail_smtp($to,$bccmail,$subject,$link,'','1');	
	}
	
}


function Registermailfunction_bck($db,$customerid)
{
	
	$today = date("Y-m-d H:i:s"); 
	if($customerid!=''){
		echo $customerid=$db->real_escape_string($customerid);
echo 		 $str_qtr = "select * from ".TPLPrefix."customers where customer_id=? and IsActive = '1' ";
		$res_customer = $db->get_a_line_bind($str_qtr,array($customerid));
		
		
		
		/*if($res_customer['customer_group_id']=='1'){	
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				$verificationcode = array(); 
				$alpha_length = strlen($alphabet) - 1; 
				for ($i = 0; $i < 15; $i++) 
				{
					$n = rand(0, $alpha_length);
					$verificationcode[] = $alphabet[$n];
				}
			$verificationcodes = implode($verificationcode);
			$verification = $verificationcodes.time();
			
			$strQry ="INSERT INTO  ".TPLPrefix."register_verification (cus_groupid, customerid, verification, IsActive, createddate,modifieddate ) VALUES ( '".$res_customer['customer_group_id']."', '".$res_customer['customer_id']."',  '".$verification."', '1','".$today."','".$today."')";
				//echo $strQry; exit;
			$str_qry=$db->insert($strQry);
		}	*/
		if($res_customer['customer_group_id']=='1'){
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive = '1' and masterid = '1' ";
		}else if($res_customer['customer_group_id']=='2'){
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive = '1' and masterid = '23' ";	
		}
		$res_ed = $db->get_a_line($str_ed);
		
		require_once(APP_DIR .'helpers/common_function.php');
		
		$helper=new common_function;
			
		 $helper->getStoreConfig(); 
		 $helper->getStoreConfigvalue('ecomLogo');
			
					//$url = BASE_URL.'verification/'.$verification;
					$to =  $res_customer['customer_email'];
					$subject = $res_ed['mailsub'];
					$bccmail = $res_ed['mailbcc'];
					$link ='<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">
					
					<tr>
				   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
				   <td style="text-transform: capitalize;">&nbsp;</td>
				   </tr>
					
					<tr valign="top">
					<td>
					<p><span style="font-size:12.0pt;font-family:" times="" new="" roman="" ","serif="" ";=" " mso-fareast-font-family:calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language:=" " en-in;mso-fareast-language:en-in;mso-bidi-language:ar-sa"="">Hello '.$res_customer['customer_firstname'].',<span> </p>
					'.$res_ed['mailcontent'].' ';
					/*if($res_customer['customer_group_id']=='1'){
				     $link.='<br/>
					 <p><span style="font-size:11.0pt;font-family:" times="" new="" roman="" ","serif="" ";=" " mso-fareast-font-family:calibri;mso-fareast-theme-font:minor-latin;mso-ansi-language:=" " en-in;mso-fareast-language:en-in;mso-bidi-language:ar-sa"="">Activation Link : <a target="" href="'.BASE_URL.'verification/'.$verification.'">Click</a> Here <span></p>';
					} */
					if($res_customer['customer_group_id']=='2'){
						
					   $link.='
					   <p>We take this opportunity to welcome thank you for registering with your corporate gifting partner on your favourite online gifting brand.</p>
					   <p> Your Account will activate once our verification is completed.</p>';	
					}
				$link.=''.$res_ed['mailfooter'].'
					</td>
					</tr>
					
				<tr>
				   <td valign="top" style="background: #56514d;">
					<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
					</td>					 
				</tr>

			</table>';
			//echo $link; die();
			
			
		send_mail($to,$bccmail,$subject,$link,'',1);	
	}
	
}




function contactusform($db,$contactid){
	$today = date("Y-m-d H:i:s");
	if($contactid!=''){
		$contactid=$db->real_escape_string($contactid);
		$str_qtr = "select * from ".TPLPrefix."contactform where contactid=? and isactive = '1' ";
		$res_contact = $db->get_a_line_bind($str_qtr,array($contactid));
	 
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '2' ";
		$res_ed = $db->get_a_line($str_ed);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		//$to =  'ayanvsa007@gmail.com';
		$to = $res_contact['contactemail'];
		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
		      
			 <p>Thank you for your query. <br> Our team would get in touch with you shortly. </p> 
		 
		  <tr>
                                    <td valign="top">
                                      <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td width="74%" valign="top">
                                              <table cellspacing="0" cellpadding="0" border="0" align="center" width="98%">
                                                <tbody>             
                                                 
                                                  
  <tr>
                                                    <td height="30">
                                                      <table cellspacing="0" cellpadding="0" border="0" width="100%" style="">
                                                        <tbody>
                                                          <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Name</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactname"].'</td>
                                                          </tr>   
  
  <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Email ID</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactemail"].'</td>
                                                          </tr>   
  
   <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Mobile No</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactmobile"].'</td>
                                                          </tr>   
<tr>
                                                     <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Message</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactmessage"].'</td>
                                                          </tr>   

                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
  
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                        
                                                  <tr>
                                                    <td height="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;"> </td>
                                                  </tr>
                                         
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
			
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
	 
		 	$bccmail="";
		send_mail($to,$bccmail,$subject,$message,'',1); 
	 
	}
	
	
	
}



function reachusform($db,$contactid){
	$today = date("Y-m-d H:i:s");
	if($contactid!=''){
		$contactid=$db->real_escape_string($contactid);
		$str_qtr = "select * from ".TPLPrefix."reachusform where contactid=? and isactive = '1' ";
		$res_contact = $db->get_a_line_bind($str_qtr,array($contactid));
	 
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '21' ";
		$res_ed = $db->get_a_line($str_ed);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		//$to =  'ayanvsa007@gmail.com';
		$to = res_contact['contactemail'];
		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
		      
			 <p>Thank you for your query. <br> Our team would get in touch with you shortly. </p> 
		 
		  <tr>
                                    <td valign="top">
                                      <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td width="74%" valign="top">
                                              <table cellspacing="0" cellpadding="0" border="0" align="center" width="98%">
                                                <tbody>             
                                                 
                                                  
  <tr>
                                                    <td height="30">
                                                      <table cellspacing="0" cellpadding="0" border="0" width="100%" style="">
                                                        <tbody>
                                                          <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Name</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactname"].'</td>
                                                          </tr>   
  
  <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Email ID</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactemail"].'</td>
                                                          </tr>   
  
   <tr>
                                                            <td width="34%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">Mobile No</td>
                                                            <td width="2%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">:</td>
                                                            <td width="64%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;vertical-align: top;">'.$res_contact["contactmobile"].'</td>
                                                          </tr>   
 
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
  
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                        
                                                  <tr>
                                                    <td height="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#000;"> </td>
                                                  </tr>
                                         
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
			
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
		 	$bccmail="";
		send_mail($to,$bccmail,$subject,$message,'',1); 
		 
	}
	
	
	
}

function forgetpasswordmailfunction($db,$email,$verification){
	
	$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '4' ";
	$res_ed = $db->get_a_line($str_ed);
	
	require_once(APP_DIR .'helpers/common_function.php');
	
	$helper=new common_function;
	$email=$db->real_escape_string($email);	
	$verification=$db->real_escape_string($verification);	
	$helper->getStoreConfig(); 
	$helper->getStoreConfigvalue('ecomLogo');
				
	$url = BASE_URL.'resetpassword/'.$verification;
	$to =  $email;
	$subject = $res_ed['mailsub'];
	$bccmail = $res_ed['mailbcc'];
	
	$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">
   <tr>
   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
   <td style="text-transform: capitalize;">&nbsp;</td>
   </tr>
	<tr valign="top">
	<td>
	'.$res_ed['mailcontent'].'
	<p>To get a new password, Click the following link : <a href='.$url.'>Reset Password</a></p>
	'.$res_ed['mailfooter'].'
	</td>
	</tr>
	<tr>
	<td valign="top" style="background: #56514d;">
	<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
	</td>					 
	</tr>

	</table>';
		$bccmail="";
   //send_mail($to,$bccmail,$subject,$message,'',1); 
   send_mail_smtp($to,$bccmail,$subject,$message,'',1); 
	
}

function subscribmailsendfunction($db,$insertid)
{
	$today = date("Y-m-d H:i:s");
	if($insertid!=''){
		
		$str_qtr = "select * from ".TPLPrefix."subscribe where subscribeid='".$insertid."' and isactive = '1' ";
		$res_contact = $db->get_a_line($str_qtr);
	 
		$str_ed = "select * from ".TPLPrefix."mailtemplate where lang_id = '".$_SESSION['lang_id']."' and isactive != '2' and masterid = '16' ";
		$res_ed = $db->get_a_line($str_ed);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		$to = $res_contact['emailid'];
		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
			<td>
			'.$res_ed['mailcontent'].$res_ed['mailfooter'].'
			
			</td>
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
	    	$bccmail="";
		send_mail($to,$bccmail,$subject,$message,'',1); 
	}
}

function dealersmailsendfunction($db,$tablename,$insertid)
{
	$today = date("Y-m-d H:i:s");
	if($insertid!=''){
		
		$str_qtr = "select * from ".TPLPrefix."fb_".$tablename." where id='".$insertid."' and IsActive = '1' ";
		$res_contact = $db->get_a_line($str_qtr);
		
		$subcate_qry = "select * from ".TPLPrefix."category where categoryID='".$res_contact['sub_category']."' and IsActive = '1'";
		$res_subcat = $db->get_a_line($subcate_qry);
		$cond=" and masterid = '22' ";
		$to = $res_contact['order_email'];
	 
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' $cond ";
		$res_ed = $db->get_a_line($str_ed);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
			<td>'.$res_ed['mailcontent'].'
			<p> Name : '.$res_contact['order_name'].'</p>
			<p> Email : '.$res_contact['order_email'].'</p>
			<p> Mobile No : '.$res_contact['order_mobile'].'</p>
			<p>City : '.$res_contact['order_city'].'</p>
			<p>Purpose and Remarks : '.$res_contact['purpose_and_remarks'].'</p> 
			<p>Sub Category : '.$res_subcat['categoryName'].'</p>';
			if($res_contact['order_quantity']){
			$message .= '<p>Quantity : '.$res_contact['order_quantity'].'</p>';
			}
			$message .= $res_ed['mailfooter'].'
			
			</td>
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
		 
	 	$bccmail="";
		send_mail($to,$bccmail,$subject,$message,'',1); 
	}
}




function Downloadproforma($db)
{

		$today = date("Y-m-d H:i:s");
		
		
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '17' ";
		$res_ed = $db->get_a_line($str_ed);
		
		$str_eds = "select customer_firstname,customer_lastname,customer_email from ".TPLPrefix."customers where IsActive != '2' and customer_id = '".$_SESSION['Cus_ID']."' ";
		$res_eds = $db->get_a_line($str_eds);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		$to = $res_eds['customer_email'];
		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
			<td>
			<p>Mr/Ms '.$res_eds['customer_firstname'].' '.$res_eds['customer_lastname'].' has downloaded a Proforma Invoice.</p>
			<p>Please assist him/her for order completion.</p>
			</td>
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
		 	$bccmail="";
		send_mail($to,$bccmail,$subject,$message,'',1); 
	
}


function Downloadproformasend($db,$tablid,$pdfname)
{
		$today = date("Y-m-d H:i:s");
		
		
		$str_ed = "select * from ".TPLPrefix."mailtemplate where isactive != '2' and masterid = '17' ";
		$res_ed = $db->get_a_line($str_ed);
		
		$str_eds = "select * from ".TPLPrefix."catalogue_enquiry where IsActive != '2' and enquiryid = '".$tablid."' ";
		$res_eds = $db->get_a_line($str_eds);

		require_once(APP_DIR .'helpers/common_function.php');

		$helper=new common_function;
			
		$helper->getStoreConfig(); 
		$helper->getStoreConfigvalue('ecomLogo');

		$to = $res_eds['emailid'];
		$subject = $res_ed['mailsub'];
        $bccmail = $res_ed['mailbcc'];
		$message = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
			<td>
			<p>Mr/Ms '.$res_eds['firstname'].'</p>
			<p>Please find the attachment of catalogue pdf</p>
			</td>
		</tr>
	 
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
		 
		 
		 $message1 = '<table cellpadding="0" cellspacing="0" style="border:6px solid #56514d ;width: 600px;">

		<tr>
		   <td  style="padding: 8px;"><img src="'.BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo').'" style="border:0;width:115px" ></td>
		   <td style="text-transform: capitalize;">&nbsp;</td>
		 </tr>
		 
		 <tr valign="top">
			<td>
			<p>Mr/Ms '.$res_eds['firstname'].'</p>
			<p>Please find the attachment of catalogue pdf</p>
			</td>
		</tr>
		
		<tr>
			<td>First Name</td><td>'.$res_eds['firstname'].'</td>
		</tr>
		
		<tr>
			<td>Emailid</td><td>'.$res_eds['emailid'].'</td>
		</tr>
		
		<tr>
			<td>Contact No</td><td>'.$res_eds['contactno'].'</td>
		</tr>
		<tr>
			<td>Company Name</td><td>'.$res_eds['companyname'].'</td>
		</tr>
		
		<tr>
			<td>Message</td><td>'.$res_eds['additionalmsg'].'</td>
		</tr>
		 
		<tr>
		   <td valign="top" style="background: #56514d;">
			<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; line-height:18px; color:#fff;">&copy; Copyrights Reserved   '.date('Y').' '.$helper->getStoreConfigvalue('store_name').' </span>
			</td>					 
		</tr>
		 </table>';
		 
		 	$bccmail="";
			send_mail('kalaivani.pixel@gmail.com',$bccmail,'Product Catalogue Request',$message1,'',1); 
		send_mail_attachment($to,$bccmail,$subject,$message,'','catalogue/'.$pdfname); 
	
}


?>

 