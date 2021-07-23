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

function sendmailSMTP($tomail,$bccmail='',$mlsubject,$bdymsg,$header='')
{
	$tomail = 'kalaivani.pixel@gmail.com';
	
	require 'PHPMailer/PHPMailerAutoload.php';
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



function send_mail($tomail,$bccmail,$mlsubject,$bdymsg,$mailfor='')
{
	
	//1 - order mail
	if($mailfor == 1){
	$bccmail = ",ravi.a.pixel@gmail.com";	
	}else {
	$bccmail = ",kalaivani.pixel@gmail.com";	
	}
	
	//$bccmail = ",pravin@pixel-studios.com";
 
	$to=$tomail;
	$to='kalaivani.pixel@gmail.com';
	$subject=$mlsubject;
	
	$headers  = 'MIME-Version: 1.0' . "\r\n"; 

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: KiranUS <kalaivani.pixel@gmail.com>' . "\r\n";

	$headers .= 'Bcc: kalaivani.pixel@gmail.com'.$bccmail.'' . "\r\n";

	if(@mail($to,$subject,$bdymsg,$headers)){
      //echo "jj";
	}

	else{
     //echo "pp";
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

function orderstatusmailfunction($db,$order_id='',$status_id='')
{  
    
     $select_orderqry= " SELECT * FROM  ".TPLPrefix."orders where IsActive=1 and order_id= '".$order_id."' "; 
	 
	
	$prod_details=$db->get_a_line($select_orderqry); 
	
	
	
	if($status_id==1 && $prod_details['lang_id']=='1'){
	    $mail_tempid=5;
	}else if($status_id==1 && $prod_details['lang_id']=='2'){
	    $mail_tempid=31;
	}else if($status_id==1 && $prod_details['lang_id']=='3'){
	    $mail_tempid=32;
	}else if($status_id==2 && $prod_details['lang_id']=='1'){
	    $mail_tempid=6;
	}else if($status_id==2 && $prod_details['lang_id']=='2'){
	     $mail_tempid=33;
	}else if($status_id==2 && $prod_details['lang_id']=='3'){
	     $mail_tempid=34;
	}else if($status_id==3 && $prod_details['lang_id']=='1'){
	    $mail_tempid=7;
	}else if($status_id==3 && $prod_details['lang_id']=='2'){
	    $mail_tempid=35;
	}else if($status_id==3 && $prod_details['lang_id']=='3'){
	    $mail_tempid=36;
	}else if($status_id==5 && $prod_details['lang_id']=='1'){
	    $mail_tempid=17;
	}else if($status_id==5 && $prod_details['lang_id']=='2'){
	    $mail_tempid=48;
	}else if($status_id==5 && $prod_details['lang_id']=='3'){
	    $mail_tempid=49;
	}else if($status_id==14 && $prod_details['lang_id']=='1'){
	    $mail_tempid=14;
	}else if($status_id==14 && $prod_details['lang_id']=='2'){
	    $mail_tempid=50;
	}else if($status_id==14 && $prod_details['lang_id']=='3'){
	    $mail_tempid=51;
	}
    $str_ed = "SELECT m.* FROM ".TPLPrefix."mailtemplate m inner join  ".TPLPrefix."mailtemplate_master mm on m.masterid=mm.masterid and mm.IsActive=1 where m.isactive=1 and m.mtemid=".$mail_tempid;
	$res_ed = $db->get_a_line($str_ed);
	
	$to =  $prod_details['email'];
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
             <td rowspan="2" class="m_4836535370212275732logo" style="width:115px;padding:18px 0 0 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" title="kiranxray.us" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img alt="kiranxray.us" src="'.image_replace_url.'uploads/logo/'.searchkeyvalue("ecomLogo",$GLOBALS['allcon']).'" style="border:0;width:115px"> </a> </td> 

            </tr> 
            
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table id="m_4836535370212275732summary" style="width:100%;border-collapse:collapse"> 
           <tbody>
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(204,102,0);margin:15px 0 0 0;font-weight:normal">Hello'.' '. $prod_details['firstname'].' '.$prod_details['lastname'].',</h3>'. str_replace("||order_id||",$prod_details['order_reference'],$res_ed['mailcontent']).'</td> 
            </tr> 
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 

        
       <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
		 '.str_replace("||order_id||",$prod_details['order_reference'],$res_ed['mailfooter']).'
           </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
   </tbody>
  </table>  
 <img width="1" height="1" src="">
 
 </div>';
		//echo $message; exit;
		//$mailfunction = sendmailSMTP($to,'', $subject, $message,$headers); 

		send_mail($to,$bccmail,$subject,$message,1);
}

function paymentmailfunction($db,$order_id='',$status_id='')
{  
    
     $select_orderqry= " SELECT * FROM  ".TPLPrefix."orders where IsActive=1 and order_id= '".$order_id."' "; 
	 
	
	$prod_details=$db->get_a_line($select_orderqry); 
	
	
	
	if($status_id==1 && $prod_details['lang_id']=='1'){
	    $mail_tempid=37;
	}else if($status_id==1 && $prod_details['lang_id']=='2'){
	    $mail_tempid=38;
	}else if($status_id==1 && $prod_details['lang_id']=='3'){
	    $mail_tempid=39;
	}else if($status_id==34 && $prod_details['lang_id']=='1'){
	    $mail_tempid=40;
	}else if($status_id==34 && $prod_details['lang_id']=='2'){
	     $mail_tempid=41;
	}else if($status_id==34 && $prod_details['lang_id']=='3'){
	     $mail_tempid=42;
	}else if($status_id==37 && $prod_details['lang_id']=='1'){
	    $mail_tempid=43;
	}else if($status_id==37 && $prod_details['lang_id']=='2'){
	    $mail_tempid=44;
	}else if($status_id==37 && $prod_details['lang_id']=='3'){
	    $mail_tempid=45;
	}
    $str_ed = "SELECT m.* FROM ".TPLPrefix."mailtemplate m inner join  ".TPLPrefix."mailtemplate_master mm on m.masterid=mm.masterid and mm.IsActive=1 where m.isactive=1 and m.mtemid=".$mail_tempid;
	$res_ed = $db->get_a_line($str_ed);
	
	$to =  $prod_details['email'];
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
             <td rowspan="2" class="m_4836535370212275732logo" style="width:115px;padding:18px 0 0 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" title="kiranxray.us" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img alt="kiranxray.us" src="'.image_replace_url.'uploads/logo/'.searchkeyvalue("ecomLogo",$GLOBALS['allcon']).'" style="border:0;width:115px"> </a> </td> 

            </tr> 
            
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
          <table id="m_4836535370212275732summary" style="width:100%;border-collapse:collapse"> 
           <tbody>
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(204,102,0);margin:15px 0 0 0;font-weight:normal">Hello'.' '. $prod_details['firstname'].' '.$prod_details['lastname'].',</h3>'. str_replace("||order_id||",$prod_details['order_reference'],$res_ed['mailcontent']).'</td> 
            </tr> 
            <tr> 
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 

        
       <tr> 
         <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> 
		 '.str_replace("||order_id||",$prod_details['order_reference'],$res_ed['mailfooter']).'
           </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
   </tbody>
  </table>  
 <img width="1" height="1" src="">
 
 </div>';
		//echo $message; exit;
		//$mailfunction = sendmailSMTP($to,'', $subject, $message,$headers); 

		send_mail($to,$bccmail,$subject,$message,1);
}


function ordermailfunction($db,$order_id='',$order_text='')
{  
/*	
	  $select_orderqry = "select t1.*,t2.product_id,t2.product_name,t2.order_product_id,t2.product_images,t2.product_qty,t2.product_price,t2.tax_type,t2.tax_value,t3.Attribute_Name,t3.Attribute_value_name,t4.countryname,t5.statename,t6.order_statusName from ".TPLPrefix."orders t1 inner join ".TPLPrefix."orders_products t2 on t1.order_id=t2.order_id and t2.IsActive=1 left join ".TPLPrefix."orders_products_attribute t3 on t2.order_product_id=t3.order_product_id and t3.IsActive=1 left join ".TPLPrefix."country t4 on t1.payment_country_id=t4.countryid left join ".TPLPrefix."state t5 on t1.paymentStateId=t5.stateid inner join  ".TPLPrefix."order_status t6 on t1.order_status_id=t6.order_statusId and t6.IsActive=1 where t1.order_id='".$order_id."' and t1.IsActive=1 group by t2.order_product_id ";*/
	  
	   $select_orderqry= " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.payment_method='COD' then 'Unsuccess' else 'Success' end) as paymentstatus,t4.product_sku,t4.order_product_id,t4.product_name,t4.product_qty,t4.product_price,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool, t4.CustomtoolImg  FROM  ".TPLPrefix."orders t1  left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive=1
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where  t1.IsActive=1 and t1.order_id= '".$order_id."' group by t4.order_product_id "; 
	 
	
	$prod_details=$db->get_rsltset($select_orderqry); 
	
	  
	
	  $str_ed = "SELECT m.* FROM ".TPLPrefix."mailtemplate m inner join  ".TPLPrefix."mailtemplate_master mm on m.masterid=mm.masterid and mm.templatename='".$order_text."' and mm.IsActive=1 where m.isactive=1 ";
	$res_ed = $db->get_a_line($str_ed);
	   
        $ordermode=''; 
		if($order_text=='Shipped'){
			$ordermode=$prod_details[0]['shippingtitle'];
		}
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
             <td rowspan="2" class="m_4836535370212275732logo" style="width:115px;padding:18px 0 0 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" title="kiranxray.us" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img alt="kiranxray.us" src="'.image_replace_url.'uploads/logo/'.searchkeyvalue("ecomLogo",$GLOBALS['allcon']).'" style="border:0;width:115px"> </a> </td> 

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
             <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:rgb(204,102,0);margin:15px 0 0 0;font-weight:normal">Hello'.' '. $prod_details[0]['firstname'].' '.$prod_details[0]['lastname'].',</h3>'. str_replace("||order_id||",$prod_details[0]['order_reference'],$res_ed['mailcontent']).$ordermode.'</td> 
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
             <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgb(239,239,239);width:50%;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> <p style="margin:2px 0 9px 0;font:12px/16px Arial,sans-serif"> <span style="color:rgb(102,102,102)">Your order will be sent to:</span> <br> <b> '. $prod_details[0]['firstname'].' '.$prod_details[0]['lastname'].' <br> '.$prod_details[0]['payment_address_1'].' <br> '.$prod_details[0]['payment_city'].','.$prod_details[0]['statename'].' '.$prod_details[0]['payment_postcode'].' <br> '.$prod_details[0]['countryname'].' </b> </p> </td> 
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
					<th>HSN</th>
					<th>Price(INR)</th>
					<th>Quantity</th>
					<th>GST(INR)</th>
					<th>Total(INR)</th>
					<th>Discount(INR)</th>
				</tr>
		    </thead>
           <tbody>';
		// echo "<pre>";  print_r($prod_details); exit;
		  foreach($prod_details as $prolist){
			    
			$select_pro_attri = "select Attribute_Name,Attribute_value_name from ".TPLPrefix."orders_products_attribute where order_product_id='".$prolist['order_product_id']."' ";
				$pro_attri_details=$db->get_rsltset($select_pro_attri); 
				
			    //$single_price = $helper->calculateproductPrice($prolist['product_price'],$prolist['tax_type'],$prolist['tax_value']);
				
				if($prolist['tax_type']=='P'){
					$tax = ($prolist['product_price']*$prolist['tax_value'])/100;
				}
				else
				{   
					$tax = $prolist['tax_value'];
				}
				
				
				$prodprice = ($prolist['product_price']*$prolist['product_qty']);
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
				$total = $totaprice;
				
			  
            $message .='<tr> 
				 <td class="m_4836535370212275732photo" style="width:150px;text-align:center;padding:16px 0 10px 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <a href="" style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif" target="_blank" rel="noreferrer"> <img id="m_4836535370212275732asin" src="'.image_replace_url.'uploads/productassest/'.$prolist['product_id'].'/photos/'.$prolist['img_path'].'" style="border:0; width:60px;" > </a> </td> 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> 
				 '.$prolist['product_name'].' ';
				 if(count($pro_attri_details)>0){
				$payableamount=0;	 
				 foreach($pro_attri_details as $value) { 
 
		 $message .=' <div><p><small >'.$value['Attribute_Name'].': '.$value['Attribute_value_name'].'</small></p></div>';
				 } }
		$message .='</td> 
		         <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 	10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> '.$prolist['hsncode'].'
				 </td> 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif"> '.number_format($prolist['product_price'],2).'
				 </td> 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.$prolist['product_qty'].'
				 </td>
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.number_format($tax,2).'
				 </td>
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 '.number_format($total,2).'
				 </td>
				 
				 <td class="m_4836535370212275732price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
				 You Saved <br> '.number_format($discount,2).'('.round($prolist['discount_slab']).'%)
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

		send_mail($to,$bccmail,$subject,$message,1);	
	
}







?>