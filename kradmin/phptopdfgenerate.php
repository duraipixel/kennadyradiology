<?php

include "session.php"; 
extract($_REQUEST);

if($_SERVER['HTTP_HOST'] == 'localhost'){
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/kiranus/kradmin/';
}else{
	$docroots=$_SERVER['DOCUMENT_ROOT'].'/';
}
define('docroots',$docroots);
 require_once('tcpdf_include.php');	
 class TOC_TCPDF extends TCPDF {

	/**
 	 * Overwrite Header() method.
	 * @public
	 */
	public function Header() {
		if ($this->tocpage) {
			// *** replace the following parent::Header() with your code for TOC page
			parent::Header();
		} else {
			// *** replace the following parent::Header() with your code for normal pages
			parent::Header();
		}
	}
	

	/**
 	 * Overwrite Footer() method.
	 * @public
	 */
	public function Footer() {
		if ($this->tocpage) {
			// *** replace the following parent::Footer() with your code for TOC page
			parent::Footer();
		} else {
			// *** replace the following parent::Footer() with your code for normal pages
			parent::Footer();
		}
	}

} // end of class



	
if($action=='pdffile'){
 $pdf = new TOC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('kiran');
$pdf->SetTitle('kiran Purchase Order');
$pdf->SetSubject('kiran Purchase Order');
$pdf->SetKeywords('kiran Purchase Order, PDF, Purchase Order');

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

// set margins
//$pdf->SetMargins(10, 20, 10, true);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(10,40, 10, true);


// set JPEG quality
//$pdf->setJPEGQuality(75);


//$pdf->Image('images/riyara-logo-pdf.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
$pdf->setPrintHeader(false);
// set font
$pdf->SetFont('helvetica', '', 8);
$strhtml = '';
// ---------------------------------------------------------

 
// add a page
$pdf->AddPage();


   $str_all= " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.payment_method='COD' then 'Unsuccess' else 'Success' end) as paymentstatus,t4.order_product_id,t4.product_name,t4.product_qty,t4.product_price,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool, t4.CustomtoolImg  FROM  ".TPLPrefix."orders t1  left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive=1
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where  t1.IsActive=1 and t1.order_id= '".$orderid."' group by t4.order_product_id "; 
//echo $str_all; exit;	 
$res_ed = $db->get_rsltset($str_all);
//echo "<pre>"; print_r($res_ed); exit;

$edit_id = $res_ed['order_id'];
	
		 $qryconfig="SELECT  *  FROM ".TPLPrefix."configuration 
					WHERE IsActive <>2 and uniCode = 'store_address_for_invoice_pdf'  ";

     $resinfo=$db->get_a_line($qryconfig);
	 $htmlbinddata='';
	
	 
$htmlbinddata .= '<table align="left" border="0" cellpadding="0"  style="border-collapse: collapse; width: 100%;">
      <tbody>
         
            <tr>
              <td>
                <table align="left" border="0" cellpadding="8"  style="border-collapse: collapse; width: 100%;">
             
               
                <tbody>
                  <tr>
                    <td><img src="'.public_url.'assets/img/logo-3.png" width="180" /></td>
                 
                    <td>
                    <table align="right" border="0" cellpadding="0"  style="border-collapse: collapse; width: 100%;">
                  <tbody>
                    <tr>
                      <td style="padding: 8px 0; text-align:right">
                       
                          <b>Order Id :</b> #'.$res_ed[0]['order_reference'].'
                       
                      </td>
                     </tr>
                    <tr>
                  <td style="padding: 8px 0; text-align:right">
                       <b>Order Date :</b> '.$res_ed[0]['date'].', '.$res_ed[0]['time'].'	
                        </td>
                    </tr>';
                    if($res_ed[0]['payment_gstno']!=''){
                     $htmlbinddata .= '<tr>
                      <td style="padding: 8px 0; text-align:right">
                       
                          <b>GST No :</b> #'.$res_ed[0]['payment_gstno'].'
                        
                      </td>
                     </tr>';
                     }
                     
                     
                  $htmlbinddata .= '</tbody>
                </table>
                
                
                
                    </td>
                  
                  </tr>
                </tbody>
              </table>
              </td>

            </tr>';
            
            
            $htmlbinddata .= '<tr>
              <td>
                <table align="left" border="1" cellpadding="8"  style="border-collapse: collapse; width: 100%;">
             
                <thead>
                  <tr>
                    <th align="left" style="background-color: #ededed; width:50%;">Shipping Address</th>
                
                    <th align="left" style="background-color: #ededed;width:50%;">Billing Address</th>
                  
                  </tr>
                </thead>
                <tbody>
                  <tr>';
				  
			 $htmlbinddata .= '<td><b>'.trim($res_ed[0]['firstname'].'&nbsp;'.$res_ed[0]['lastname']).'</b><br>'.$res_ed[0]['payment_address_1'].'<br>'.$res_ed[0]['payment_city'].','.$res_ed[0]['payment_postcode'].','.$res_ed[0]['billingstate'].','.$res_ed[0]['billingcountry'].'.<br>Email: '.$res_ed[0]['email'].'<br>Mobile: '.$res_ed[0]['payment_telephone'].'
                    </td>';
					
					 $htmlbinddata .= '<td><b>'.trim($res_ed[0]['shipping_firstname'].'&nbsp;'.$res_ed[0]['shipping_lastname']).'</b><br>'.$res_ed[0]['shipping_address_1'].'<br>'.$res_ed[0]['shipping_city'].','.$res_ed[0]['shipping_postcode'].','. $res_ed[0]['shippingstate'].','. $res_ed[0]['shippingcountry'].'.<br>Email: '.$res_ed[0]['email'].'<br>Mobile: '.$res_ed[0]['shipping_telephone'].'
                    </td>';
                 
    
                  $htmlbinddata .= '</tr>
                </tbody>
              </table>
              </td>

            </tr>';
			
		
            $htmlbinddata .= '<tr>
              <td>
                <table class="table" id="" border="1" cellpadding="8"  style="border-collapse: collapse; width: 100%;">
                  <thead>
                    <tr>
                      <th colspan="8" align="left" style="background-color: #ededed;"> <b>Items Ordered</b></th>
                    </tr>
                    <tr>
                     	<th>Image</th>
											<th>Product Name</th>
											<th>HSN Code</th>
											<th>Price</th>
											<th>Quantity</th>											
											<th>GST</th>
											<th>Subtotal</th>
											<th>Discount</th>
                    </tr>
                  </thead>
                  <tbody>';
				  
                   $tax=0;
										$subtotal=0;
										$price_total =0;
										$tax_total=0;
										$grant_total=0;
								
									  foreach($res_ed as $vieworder) { 
									
									
									$select_pro_attri = "select Attribute_Name,Attribute_value_name from ".TPLPrefix."orders_products_attribute where order_product_id='".$vieworder['order_product_id']."' ";
                                    $pro_attri_details=$db->get_rsltset($select_pro_attri);

									 
								$htmlbinddata .= '<tr>
												<td>
													<a class="cartprd-image" href="javascript:void(0);">';
								if($vieworder['IsCustomtool']==1) { 
								 
								$htmlbinddata .= '<img  style="width:55px; heigth:55px;" class="img-responsive center-block" src="'.IMG_BASE_URL.'finalcustomimg/'.$vieworder['CustomtoolImg'].'" alt="'.$vieworder['product_name'].'">';
								 } 
								 else { 
 										$htmlbinddata .= '<img style="width:55px; heigth:55px;" alt="product" class="img-responsive center-block" src="'.IMG_BASE_URL.'productassest/'.$vieworder['product_id'].'/photos/'.$vieworder['img_path'].'">';
												} 
								$htmlbinddata .='</a>
												</td>
												<td>';
													 if($vieworder['IsCustomtool']==1) { 
							    $htmlbinddata .='<div class="tdsingle-row">
														'.$vieworder['product_name'].'
														<br/> Customized
														
													</div>
													<div>';
								                    if(count($pro_attri_details)>0){
				                                     foreach($pro_attri_details as $value) { 
										  $htmlbinddata .=''.$value['Attribute_Name'].': '.$value['Attribute_value_name'].'
													 <br/>';
                                                     } }
													$htmlbinddata .='</div>.';
													 } else { 
													
													$htmlbinddata .='<div class="tdsingle-row">
														'.$vieworder['product_name'].'
														
													</div>
													<div>';
													 if(count($pro_attri_details)>0){
				                                     foreach($pro_attri_details as $value) { 
													 $htmlbinddata .=''.$value['Attribute_Name'].': '.$value['Attribute_value_name'].'
													 <br/>';
                                                     } }
												$htmlbinddata .='</div>';
													
													 } 
												$htmlbinddata .='</td>
												<td class="price_col"> '.$vieworder['hsncode'].'</td>
												<td class="price_col"><span><i class="fa fa-inr"></i></span> <span class="price">'.number_format(round($vieworder['product_price']),2).'</span></td>
												<td><span class="price">'. $vieworder['product_qty'].'</span></td>
												
												
												
												<td class="tax_col"><span><i class="fa fa-inr"></i></span> <span class="taxes" id="taxs0">';
												if($vieworder['tax_type']=='P'){
													$tax = ($vieworder['product_price']*$vieworder['tax_value'])/100;
												}
												else
												{   
											        $tax = $vieworder['tax_value'];
												}
												
												
												$htmlbinddata .=''. number_format(round($tax),2).'</span></td>
												
												<td class="total_col"><span><i class="fa fa-inr"></i></span> <span><span class="total_price">';
												  $prodprice = ($vieworder['product_price'] * $vieworder['product_qty']);
												  
												$discount =0;
												if(!empty($res_ed['discount_slab']) && $res_ed['discount_slab']!="")
												{
														$discount = ($prodprice*$res_ed['discount_slab'])/100;
														$prodprice = $prodprice-$discount;
												}
											  
												if( strtoupper($vieworder['tax_type'])=="P"){											
													$totaprice = $prodprice + (($prodprice * $vieworder['tax_value'])/100);
												 }	
												 else if(strtoupper($vieworder['tax_type'])=="F"){
													$totaprice = $prodprice +  $vieworder['tax_value'];
												 }
												else{
													$totaprice = $prodprice;
												}	
												
												
												$htmlbinddata .=''. number_format(round($totaprice),2).'</span></span></td>
												<td>';
												 if($vieworder['discount_slab']!="" && !empty($vieworder['discount_slab']))
												{
												 $htmlbinddata .='You Saved  <i class="fa fa-inr"></i>'.number_format(round($discount),2).'('.$vieworder['discount_slab'].'%)';
												
												} else {	
												
												$htmlbinddata .='N/A';
												} 
												$htmlbinddata .='</td>
											</tr>';
									 
                                         
										
									  } 
											
								     $htmlbinddata .=' 
                                      <tr>
                      <td colspan="7" align="right"> Total :</td>
                      <td  class="cart-ttl">&nbsp;<i class="fa fa-inr"></i>'.number_format(round($res_ed[0]['cart_total']),2).'</td>
                    </tr>
                    <tr>
                      <td colspan="7" align="right"> Price ('.$res_ed[0]['total_products'].' items):</td>
                      <td  class="cart-ttl">&nbsp;<i class="fa fa-inr"></i> '.number_format(round($res_ed[0]['cart_total']),2).'</td>
                    </tr> ';
                    
                     if($res_ed[0]['coupon_discount']>0){ 
                       $htmlbinddata .='<tr>
                      <td colspan="7" align="right"> Coupon Discount(-)</td>
                      <td  class="cart-ttl">&nbsp; <i class="fa fa-inr"></i> '. number_format(round($res_ed[0]['coupon_discount']),2).'</td>
                    </tr>';
                     }
                    
                    $htmlbinddata .='<tr>
                      <td colspan="7" align="right"> Shipping On Product Price(+)</td>
                      <td  class="cart-ttl">&nbsp; <i class="fa fa-inr"></i> '. number_format(round($res_ed[0]['shippint_cost']),2).'</td>
                    </tr>
                     <tr>
                      <td colspan="7" align="right">Grand Total</td>
                      <td  class="cart-ttl">&nbsp; <i class="fa fa-inr"></i> '.number_format(round($res_ed[0]['grand_total']),2).'</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>';
			
      $htmlbinddata .= '</tbody>
</table>';


	//echo "<pre>"; print_r($htmlbinddata); exit;	
		define('CAADMIN_DIR',realpath('../'));
		
	$rslt_dc_det['invoice_id']='invoice_'.$orderid.'';
		
	$pdf_file_name=$rslt_dc_det['invoice_id'].'.pdf';
	$pdf->writeHTML($htmlbinddata, true, 0, true, 0);
	$pdf->lastPage();
		
		
		
	$file_loc ="../uploads/purchaseinvoice/".$pdf_file_name;
	
	$pdfsavefile = $pdf->Output($file_loc, 'F');
    
	send_mail_attachment($pdf_file_name);

}


function send_mail_attachment($pdf_file_name)
{	
 
$bdymsg = 'kiran Invoice Attachment.';

$tomail='kalaivani.pixel@gmail.com'; 
$bccmail ='';

	
  $fileurl =  docroots.'uploads/purchaseinvoice/'.$pdf_file_name.'';   

//echo $fileurl; exit;
// boundary 

    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

// headers for attachment 
$headers  = 'MIME-Version: 1.0'. "\r\n";	
$headers .= "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\" \r\n"; 

$headers .= 'From:Kalai <kalaivani.pixel@gmail.com>'. "\r\n";
$headers .= 'Bcc:'.$bccmail.''."\r\n";	 	

// multipart boundary 
$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $bdymsg . "\n\n"; 
$message .= "--{$mime_boundary}\n";	



$fp =    @fopen($fileurl,"rb");
$data =  @fread($fp,filesize($fileurl));
@fclose($fp);
$data = chunk_split(base64_encode($data));

$message .= "Content-Type: application/octet-stream; name=\"".basename($fileurl)."\"\n" . 
                "Content-Description: ".basename($fileurl)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($fileurl)."\"; size=".filesize($fileurl).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
$message .= "--{$mime_boundary}\n";	

	 if(@mail($tomail, "kiran Invoice Attachment", $message, $headers))
	 {
		echo json_encode(array('rslt'=>1));
	 }
	 else{
		echo json_encode(array('rslt'=>2));
	 }
  
 
 	
}

?>