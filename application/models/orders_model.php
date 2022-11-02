<?php
	 require_once(__DIR__.'/razorpay-php/Razorpay.php');
	 use \Razorpay\Api\Api;
class orders_model extends Model {
	
	function placeorderdetails()
	{
		
		$today = date("Y-m-d H:i:s");
		$addressid = $_SESSION['addressid'];
		$customerid =  $_SESSION['Cus_ID'];
		$order_type = 1;
		if($customerid =='')
		{
			$customerid =session_id();
			$order_type=2;
		}
		$cus_groupid =  $_SESSION['cus_group_id'];
		$checkout = $this->loadModel('checkout_model'); 
		$payinfo=$checkout->Paymentmethod($_SESSION['pay_code']);
	//print_r($_SESSION); 
	//echo "<pre>"; print_r($payinfo); exit;
	if(count($payinfo)==0 || count($payinfo)>1)
	{
		$this->redirect(gatewayerror);
		
	}
	
	if(count($payinfo)==0 || count($payinfo)>1)
	{
		$this->redirect(gatewayerror);
		
	}
	
	
		
		 $orderjoinfields=" ,img.img_path,c.cart_id,cpa.cart_product_attr_id,cpa.Attribute_id,cpa.Attribute_value_id,ca.firstname,ca.lastname,ca.address,ca.emailid,ca.city,ca.postalcode,ca.telephone,ca.stateid,ca.countryid,ca.landmark,ca.landmark,ca.gstno,ma.attributename,ma.attributecode,drp.dropdown_values ";
		 
		/* $orderjoinqry="  left join ".TPLPrefix."carts_products_attribute cpa on cpa.cart_product_id=cp.cart_product_id and cpa.IsActive=1 left join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  left join ".TPLPrefix."product_attr_combi pac on cp.product_id=pac.base_productId and pac.IsActive=1  and  pac.outofstock = 0   left join ".TPLPrefix."dropdown dp on cpa.Attribute_value_id=dp.dropdown_id and dp.isactive=1  inner join ".TPLPrefix."cus_address ca on ca.cus_addressid='".$addressid."' and ca.IsActive=1 ";  */
		
		 $orderjoinqry="  left join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  inner join ".TPLPrefix."cus_address ca on ca.cus_addressid='".$addressid."' and ca.IsActive=1 ";
		
		$cart=$this->loadModel('cart_model');
		$prod_details = $cart->cartProductList('',$orderjoinfields,$orderjoinqry,$isenableTax=1);
		
	
	 
		$granttotal=0;
		$carttotal =0;
		
	
		
			require_once(APP_DIR .'helpers/common_function.php');
	
	    $helper=new common_function;
		
		$childsid= $helper->getChildsId();
		$arrexcludecat=explode(",",$childsid);
		
		$disgranttotal=0;
	 foreach($prod_details as $productlist){
	        if(!in_array($productlist['categoryID'],$arrexcludecat)){
		$totaprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
		$disgranttotal+=$totaprice;
	        }
	 }	
	 
	 	
		$withoutdistotal=0;
	 foreach($prod_details as $productlist){
		$totaprice = ($productlist['price'] * $productlist['product_qty']);
		$withoutdistotal+=$totaprice;
	 }	
	 
	 
	$discount =0;
	$discountslap =  $checkout->chkDiscountSlap($disgranttotal);	
	$disgranttotal=0;
	$granttotal=0;
	
	 foreach($prod_details as $productlist){
		$prodprice = ($productlist['final_price'] * $productlist['product_qty']);
		$distprodprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
		$discount =0;
		
		if($productlist['product_qty']==0)
		{		
			$this->redirect(cart);
		}
		if($discountslap['DiscountAmount']!=''){
		       if(!in_array($productlist['categoryID'],$arrexcludecat)){
				if($discountslap['DiscountType']==1){
					$discount = (($productlist['final_prod_attr'] * $productlist['product_qty'])*$discountslap['DiscountAmount'])/100;
				$prodprice = $prodprice-$discount;
				$distprodprice =$distprodprice -$discount;
				}
				else{
					$discount = $discountslap['DiscountAmount'];
					$prodprice = $prodprice-$discount;
					$distprodprice =$distprodprice -$discount;
				} 
		       }
		}
		if( strtoupper($productlist['taxTyp'])=="P"){											
			$totaprice = $prodprice + (($prodprice * $productlist['taxRate'])/100);
		 }	
		 else if(strtoupper($productlist['taxTyp'])=="F"){
			$totaprice = $prodprice +  $productlist['taxRate'];
		 }
		else{
			$totaprice = $prodprice;
		}
	
		 $disgranttotal+= $distprodprice;	
	     $granttotal += $totaprice;	
		 $carttotal +=$totaprice;		 
	 }
		
	if($granttotal==0 || $disgranttotal==0)
	{		
			$this->redirect(cart);
	}	
		
	$granttotal=$granttotal;	
	
	
		
		$couopnamount=0;
		//Coupon Section Start
		if(isset($_SESSION['Couponcode']) && $_SESSION['Couponcode']!=''){ 
			
			$datass=$checkout->getcpdiscount($_SESSION['Couponcode']);
		    $arraydata = (json_decode($datass,true));
			//print_r($arraydata); die();
			
		if($arraydata['CouponCatType']=="3" || $arraydata['CouponCatType']=="4"){	
			if($arraydata['coupontype']=="1")
			{
				$couopnamount=($disgranttotal*$arraydata['couponvalue'])/100; 
			}
			else if($_SESSION['coupontype']=="2")
			{
				$couopnamount=$disgranttotal-$arraydata['couponvalue']; 			
			}
			
		}
		else{		
		//$couopnamount= $arraydata['Couponamount']-(($arraydata['Couponamount']*$discountslap['DiscountAmount'])/100);
		$couopnamount= $arraydata['couponamt'];
		//print_r($arraydata['couponamt']); die();
	}
			
			$couponcode = $arraydata['coupon'];
			$coupontitle = $arraydata['coupontit'];
			//$couopnamount = $arraydata['couponamt'];
			//$granttotal = $granttotal-$couopnamount;
		}	
		$couopnamount=$couopnamount;
		//Coupon Section End
   
		//Discount Slab Section Start
		
		if($discountslap['DiscountAmount']!=''){			
				$discounttitle = $discountslap['DiscountTitle'];
				$discountslab = $discountslap['DiscountAmount'];
		} 

		//Discount Slab Section End

		//Shipping charge Section Start
		
		if(isset($_SESSION['shippingCode'])){ 
			$data=$checkout->modelname($_SESSION['shippingCode']);
			$shipping = $this->loadModel($data['modelname']);//load dynamic model name
			$datas=$shipping->shippingfunction($data['shippingId']);
			// echo "<pre>";  print_r($datas); exit;
			
			if($datas['pricetype']==1){
				$shippingcode =  $_SESSION['shippingCode'];
				$shipiingtitle = $datas['shippingTitle'];
				$shippingcharge = ($disgranttotal*$datas['shippingCost'])/100;
				//$granttotal = $disgranttotal+$shippingcharge;
			}
			else{
				$shippingcode =  $_SESSION['shippingCode'];
				$shipiingtitle = $datas['shippingTitle'];
				$shippingcharge = $datas['shippingCost'];
				//$granttotal = $granttotal+$shippingcharge;
			}
		}
		$shippingcharge=$shippingcharge;
		$granttotal = $granttotal + $shippingcharge -$couopnamount;
		$granttotal =$granttotal;
		//Shipping charge Section End
		$strOrders = "INSERT INTO ".TPLPrefix."orders(order_reference,order_type,customer_id,customer_group_id,hsncode,email,firstname,lastname,payment_address_1,payment_landmark,payment_city,payment_postcode,payment_country_id,paymentStateId,payment_telephone,payment_method,payment_code,payment_gstno,shipping_firstname,shipping_lastname,shipping_address_1,shipping_landmark,shipping_city,shipping_postcode,shipping_country_id,shipping_state_id,shipping_telephone,shipping_method,shipping_code,shipping_gstno,total_products, total_paid_tax_incl ,cart_total,coupon_discount,couponcode,coupontitle,discount_slab,discounttitle, shippint_cost,schippingcode,shippingtitle,total_paid,total,grand_total, total_paid_tax_excl ,total_discounts,order_status_id ,UserId,IsActive, date_added,date_modified,lang_id)	values('','".$order_type."','".$customerid."','".$cus_groupid."','".$prod_details[0]['hsncode']."','".$prod_details[0]['emailid']."','".$prod_details[0]['firstname']."','".$prod_details[0]['lastname']."','".$prod_details[0]['address']."','".$prod_details[0]['landmark']."','".$prod_details[0]['city']."','".$prod_details[0]['postalcode']."','".$prod_details[0]['countryid']."','".$prod_details[0]['stateid']."','".$prod_details[0]['telephone']."','".$payinfo[0]['title']."','".$payinfo[0]['pay_code']."','".$prod_details[0]['gstno']."','".$prod_details[0]['firstname']."','".$prod_details[0]['lastname']."','".$prod_details[0]['address']."','".$prod_details[0]['landmark']."','".$prod_details[0]['city']."','".$prod_details[0]['postalcode']."','".$prod_details[0]['countryid']."','".$prod_details[0]['stateid']."','".$prod_details[0]['telephone']."','".$shipiingtitle."','".$shippingcode."','".$prod_details[0]['gstno']."','".count($prod_details)."','".$carttotal."','".$carttotal."','".$couopnamount."','".$couponcode."','".$coupontitle."','".$discountslab."','".$discounttitle."','".$shippingcharge."','".$shippingcode."','".$shipiingtitle."','".$granttotal."','".$granttotal."','".$granttotal."','".$disgranttotal."','".($withoutdistotal-$disgranttotal)."','1','".$customerid."','1','".$today."','".$today."','".$_SESSION['lang_id']."')";
		
		//echo $strOrders; exit;
		$this->insert($strOrders);
		$InsertId = $this->lastInsertId();
		$orderId=$InsertId ;
		//$order_reference = (100000+$InsertId);
		
	    $helper->getStoreConfig(); 
		$prefix = $helper->getStoreConfigvalue('invoicePrefix'); 
	    $startvalue = $helper->getStoreConfigvalue('invoiceStartingFrom'); 
		
		$order_qry = "select count(*) as cnt from ".TPLPrefix."orders where IsActive=1";
		$result = $this->get_a_line($order_qry);
		$ordercnt = $result['cnt'];
		
		$str = $startvalue+$ordercnt;
		$order_value = str_pad($str, 8, 0, STR_PAD_LEFT);
		$order_reference = $prefix.$order_value; 
		
		//update order reference id
		$update_qry = "update ".TPLPrefix."orders set order_reference='".$order_reference."' where order_id = ".$InsertId." and IsActive=1 ";
		$data=$this->insert($update_qry); 
			
		if($InsertId){
			//echo "<pre>";
						foreach($prod_details as $product){
				//print_r( $product);
				//die();	
							
			 	$imgurl = 'uploads/productassest/'.$product['product_id'].'/photos/thumb/'.$product['img_names'];
				
				
				$prodprice = ($product['final_price'] * $product['product_qty']);
		$distprodprice = ($product['attr_price'] * $product['product_qty']);
		$discount =0;
		
	
		if($discountslap['DiscountAmount']!=''){	
		       if(!in_array($product['categoryID'],$arrexcludecat)){
				if($discountslap['DiscountType']==1){
					$discount = (($product['attr_price'] * $product['product_qty'])*$discountslap['DiscountAmount'])/100;
				$prodprice = $prodprice-$discount;
				$distprodprice =$distprodprice -$discount;
				}
				else{
					$discount = $discountslap['DiscountAmount'];
					$prodprice = $prodprice-$discount;
					$distprodprice =$distprodprice -$discount;
				} 
		       }
		}
		if( strtoupper($product['taxTyp'])=="P"){											
			$totaprice = $prodprice + (($prodprice * $product['taxRate'])/100);
		 }	
		 else if(strtoupper($product['taxTyp'])=="F"){
			$totaprice = $prodprice +  $product['taxRate'];
		 }
		else{
			$totaprice = $prodprice;
		}
	
		
		
				
				//Insert order product table
			    $productInsert = "INSERT INTO ".TPLPrefix."orders_products(order_id,product_id,product_name,product_images,product_sku,product_qty,product_price,prod_attr_price,prod_sub_total,tax_type,tax_value,tax_name,    IsCustomtool ,CustomtoolImg, IsActive,CreatedDate,ModifiedDate,item_code) VALUES('".$InsertId."','".$product['product_id']."','".$product['product_name']."','".$imgurl."','".$product['sku']."','".$product['product_qty']."','".$product['finaldiscountamt']."','".$product['attr_price']."','".$totaprice."','".$product['taxTyp']."','".$product['taxRate']."','".$product['taxName']."','".$product['IsCustomtool']."','".$product['CustomtoolImg']."','1','".$today."','".$today."','".$product['item_code']."')"; 
			
				$this->insert($productInsert);
			
				$product_InsertId = $this->lastInsertId();
				
				//$STR_QTR = "select from ".TPLPrefix."carts_products_attribute inner join ".TPLPrefix."carts_products_attributecart_products";
				
				//Insert order product attribute table
				
					//$AttributeInsert = "INSERT INTO ".TPLPrefix."orders_products_attribute(order_id,order_product_id,Attribute_id,Attribute_Code,Attribute_Name,Attribute_value_id,Attribute_value_name,Attribute_price,IsActive,CreatedDate,ModifiedDate) VALUES('".$InsertId."','".$product_InsertId."','".$product['Attribute_id']."','".$product['attributecode']."','".$product['attributename']."','".$product['Attribute_value_id']."','".$product['dropdown_values']."','".$product['attprice']."','1','".$today."','".$today."')"; 
					
					
					 $AttributeInsert = "INSERT INTO ".TPLPrefix."orders_products_attribute(order_id,order_product_id,Attribute_id,Attribute_Code,Attribute_Name,Attribute_value_id,Attribute_value_name,Attribute_price,IsActive,CreatedDate,ModifiedDate) select '".$InsertId."','".$product_InsertId."',cpa.Attribute_id,ma.attributecode,ma.attributename,cpa.Attribute_value_id,dp.dropdown_values,pac.price,'1','".$today."','".$today."' from ".TPLPrefix."carts_products_attribute cpa inner join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  
					inner join ".TPLPrefix."cart_products cp on cp.cart_product_id=cpa.cart_product_id and cp.IsActive=1 inner join ".TPLPrefix."dropdown dp ON dp.dropdown_id=cpa.Attribute_value_id    
					AND dp.isactive = 1

					inner join ".TPLPrefix."product_attr_combi pac on cp.product_id=pac.base_productId AND find_in_set(dp.dropdown_id,
                           REPLACE(pac.attr_combi_id, '_', ',')) and pac.IsActive=1  and  pac.outofstock = 0   and pac.attr_combi_id=cp.attr_combi_id   where cpa.cart_product_id='".$product['cart_product_id']."' and cpa.IsActive=1 ";
					
					//die();
					
					$this->insert($AttributeInsert);
					
					 $customInsert = " INSERT INTO ".TPLPrefix."orders_customtool_images(order_id, order_product_id, customsimgpath, IsActive, CreatedDate, ModifiedDate)  select '".$InsertId."','".$product_InsertId."',cimg.customsimgpath,'1','".$today."','".$today."' from ".TPLPrefix."carts_customtool_images cimg 
					inner join ".TPLPrefix."cart_products cp on cp.cart_product_id=cimg.cart_product_id and cp.IsActive=1 
					 where cimg.cart_product_id='".$product['cart_product_id']."' and cimg.IsActive=1 ";
			
				  $this->insert($customInsert);
				
				 
			}
		
			
			require_once(APP_DIR .'models/mailsend.php');
		
			ordermailfunction($this,$order_reference);
		
			
			$update_qry = "update ".TPLPrefix."carts set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry); 
			
		
			$update_qry = "update ".TPLPrefix."cart_products set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry);
			
			
			$update_qry = "update ".TPLPrefix."carts_products_attribute set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry);
			
			$update_qry = "update ".TPLPrefix."carts_customtool_images set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
			
		    $data=$this->insert($update_qry);
			$_SESSION['addressid']='';
			
            $_SESSION['Couponcode'] = '';
            $_SESSION['Coupontitle'] = '';
            $_SESSION['Couponamount'] = '';
			$_SESSION['coupontype'] = '';
			$_SESSION['couponvalue'] = '';  
			$_SESSION['shippingid']=''; 
			$_SESSION['pricetype'] = '';
            $_SESSION['shippingCost'] = '';
			$_SESSION['pay_id'] = '';
			$_SESSION['pay_code']='';  
			
			
				
	
switch($payinfo[0]['pay_code'])
{	
  case "CCAV" : 		
	 $merchant_data='';
	 $working_key=trim($payinfo[0]['encrypt_key']);//Shared by CCAVENUES
	 $access_code=trim($payinfo[0]['access_code']);//Shared by CCAVENUES
	$_SESSION['reforderid']=$order_reference;
	
	$getOrderInfo=$this->get_a_line(" select (select c.currency_code from ".TPLPrefix."currency c
						inner join ".TPLPrefix."configuration cf on cf.value=c.currencyid and cf.IsActive=1
						where c.IsActive=1 and cf.`key`='defaultCurrency' limit 0,1) as currency_code,
						(select statename from ".TPLPrefix."state where IsActive=1 and stateid='".$prod_details[0]['stateid']."' ) as state,
						(select countryname from ".TPLPrefix."country where IsActive=1 and countryid='".$prod_details[0]['countryid']."' ) as country " );
		
	$merchant_data.="tid".'='.time().'&'; 
	$merchant_data.="merchant_id".'='.$payinfo[0]['merchant_id'].'&'; 
	$merchant_data.="order_id".'='.$order_reference.'&'; 
	$merchant_data.="amount".'='.$granttotal.'&'; 
	$merchant_data.="currency".'='.$getOrderInfo['currency_code'].'&';
	$merchant_data.="redirect_url".'='.BASE_URL.'/ccavpaymentprocess&'; 
	$merchant_data.="cancel_url".'='.BASE_URL.'/ccavpaymentprocess&'; 
	$merchant_data.="language=EN&"; 
	$merchant_data.="billing_name".'='.$prod_details[0]['firstname']." ".$prod_details[0]['lastname'].'&'; 
	$merchant_data.="billing_address".'='.$prod_details[0]['address'].'&'; 
	$merchant_data.="billing_city".'='.$prod_details[0]['city'].'&'; 
	$merchant_data.="billing_state".'='.$getOrderInfo['state'].'&'; 
	$merchant_data.="billing_zip".'='.$prod_details[0]['postalcode'].'&'; 
	$merchant_data.="billing_tel".'='.$prod_details[0]['telephone'].'&'; 
	$merchant_data.="billing_country".'='.$getOrderInfo['country'].'&'; 
	$merchant_data.="billing_email".'='.$prod_details[0]['emailid'].'&'; 
	$merchant_data.="delivery_name".'='.$prod_details[0]['firstname']." ".$prod_details[0]['lastname'].'&'; 
	$merchant_data.="delivery_address".'='.$prod_details[0]['address'].'&'; 
	$merchant_data.="delivery_city".'='.$prod_details[0]['city'].'&'; 
	$merchant_data.="delivery_state".'='.$getOrderInfo['state'].'&'; 
	$merchant_data.="delivery_zip".'='.$prod_details[0]['postalcode'].'&'; 
	$merchant_data.="delivery_country".'='.$getOrderInfo['country'].'&'; 
	$merchant_data.="delivery_tel".'='.$prod_details[0]['telephone'].'&'; 


	require_once(APP_DIR .'models/ccavenue/crypto.php');
	
 	$encrypted_data=encrypt($merchant_data,$working_key); 
	?>
	<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
		<?php
		echo "<input type=hidden name=encRequest value=$encrypted_data>";
		echo "<input type=hidden name=access_code value=$access_code>";
		?>
	</form>		
	<script language='javascript'>document.redirect.submit();</script>		
<?php	
	break; 
 case "COD" : 
	?>
	<form method="post" name="codpay" action="<?php echo BASE_URL ?>ordersuccess"> 
		<?php
		echo "<input type=hidden name='type' value='cod'>";
		echo "<input type=hidden name='oid' value='".$order_reference."'>";
		echo "<input type=hidden name='status' value='success'>";
		echo "<input type=hidden name='msg' value=''>";
		?>
	</form>		
	<script language='javascript'>document.codpay.submit();</script>		
<?php
     break;
	 
	  case "PAYU" : 		
	 $merchant_data='';
	 $MERCHANT_KEY=trim($payinfo[0]['merchant_id']);//Shared by Payu
	 $SALT=trim($payinfo[0]['encrypt_key']);//Shared by Payu
	 
	 
	$_SESSION['reforderid']=$order_reference;
	

	
	$getOrderInfo=$this->get_a_line(" select (select c.currency_code from ".TPLPrefix."currency c
						inner join ".TPLPrefix."configuration cf on cf.value=c.currencyid and cf.IsActive=1
						where c.IsActive=1 and cf.`key`='defaultCurrency' limit 0,1) as currency_code,
						(select statename from ".TPLPrefix."state where IsActive=1 and stateid='".$prod_details[0]['stateid']."' ) as state,
						(select countryname from ".TPLPrefix."country where IsActive=1 and countryid='".$prod_details[0]['countryid']."' ) as country " );
	

$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10|salt";
	$hashfields="";
	foreach( explode("|",$hashSequence) as $seq)
	{
		
		switch($seq)
		{
			case "key": 
					$hashfields.=$MERCHANT_KEY."|";
						break;
			case "txnid": 
						$hashfields.=$order_reference."|";
						break;
			case "amount": 
						$hashfields.=$granttotal."|";
						break;
			case "productinfo": 
						$hashfields.="|";
						break;
			case "firstname": 
						$hashfields.=$prod_details[0]['firstname']."|";
						break;
			case "email": 
						$hashfields.=$prod_details[0]['emailid']."|";
						break;
			case "udf1": 
						$hashfields.="|";
						break;
			case "udf2": 
						$hashfields.="|";
						break;
			case "udf3": 
						$hashfields.="|";
						break;
			case "udf4": 
						$hashfields.="|";
						break;
			case "udf5": 
						$hashfields.="|";
						break;
			case "udf6": 
						$hashfields.="|";
						break;
			case "udf7": 
						$hashfields.="|";
						break;
			case "udf8": 
						$hashfields.="|";
						break;
			case "udf9": 
						$hashfields.="|";
						break;						
			case "udf10": 
						$hashfields.="|";
						break;
			case "salt": 
						$hashfields.=$SALT."|";
						break;
						
			
			
		}
		
		
	}
	
	//require_once(APP_DIR .'models/ccavenue/crypto.php');
	
 	//$encrypted_data=encrypt($merchant_data,$working_key);

	
	//$PAYU_BASE_URL = "https://sandboxsecure.payu.in";
	$PAYU_BASE_URL = "https://test.payu.in/_payment";
	
	?>
	<form name="paysubmit" id="paysubmit" action="<?php echo $$PAYU_BASE_URL; ?>" method="POST">
			<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
			<input type="hidden" name="hash" value="<?php echo $MERCHANT_KEY; ?>"/>
			<input type="hidden" name="txnid" value="'.$txnid.'" />
				   <input type="hidden" name="surl" value="'.base_url().'Payment/paymentsuccess" />
			<input type="hidden" name="furl" value="'.base_url().'Payment/paymentfailure" />
	
			<input type="hidden" name="productinfo" id="productinfo" value="'.$productinfo.'" />
			<input type="hidden" name="firstname" value="'.$firstname.'" />
									<input type="hidden" name="lastname" value="'.$lastname.'" />
			<input type="hidden" name="email" value="'.$email.'" />
			<input type="hidden" name="phone" id="phone" value="'.$phone.'" />
			<input type="hidden" id="amount" name="amount" value="'.$amount.'">
	</form>		
	<script language='javascript'>document.paysubmit.submit();</script>		
<?php	
	break; 
	
 case "RAZORPAY" : 		
	 $merchant_data='';
	 $keyId=trim($payinfo[0]['encrypt_key']);//Shared by Payu
	 $keySecret=trim($payinfo[0]['secret_key']);//Shared by Payu
	 $_SESSION['reforderid']=$order_reference;
	 try{

	
	 $api = new Api($keyId, $keySecret);
	
	$getOrderInfo=$this->get_a_line(" select (select c.currency_code from ".TPLPrefix."currency c
						inner join ".TPLPrefix."configuration cf on cf.value=c.currencyid and cf.IsActive=1
						where c.IsActive=1 and cf.`key`='defaultCurrency' limit 0,1) as currency_code,
						(select statename from ".TPLPrefix."state where IsActive=1 and stateid='".$prod_details[0]['stateid']."' ) as state,
						(select countryname from ".TPLPrefix."country where IsActive=1 and countryid='".$prod_details[0]['countryid']."' ) as country " );
	
	//print_r($getOrderInfo); die();
	
	// 
	$orderData = [
			'receipt'         => $order_reference,
			'amount'          => $granttotal * 100, // 2000 rupees in paise
			'currency'        => $getOrderInfo['currency_code'],
			'payment_capture' => 1 // auto capture
		];

		$razorpayOrder = $api->order->create($orderData);

		$razorpayOrderId = $razorpayOrder['id'];

		$_SESSION['razorpay_order_id'] = $razorpayOrderId;
		
		$displayAmount = $amount = $orderData['amount'];
		$displayCurrency=$getOrderInfo['currency_code'];
		if ($getOrderInfo['currency_code'] !== 'INR')
		{
			$url = "https://api.fixer.io/latest?symbols=".$getOrderInfo['currency_code']."&base=INR";
			$exchange = json_decode(file_get_contents($url), true);

			$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
		}
		
				
		$data = [
			"key"               => $keyId,
			"amount"            => $amount,
			"name"              => $helper->getStoreConfigvalue('store_name'),
			"description"       => $helper->getStoreConfigvalue('storeMetaDesc'),
			"image"             =>  BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo'),
			"prefill"           => [
			"name"              => $prod_details[0]['firstname'],
			"email"             => $prod_details[0]['emailid'],
			"contact"           => $prod_details[0]['telephone'],
			],
			"notes"             => [
			"address"           => $prod_details[0]['address'],
			"merchant_order_id" => $order_reference,
			],
			"theme"             => [
			"color"             => "#F37254"
			],
			"order_id"          => $razorpayOrderId,
		];

		if ($displayCurrency !== 'INR')
		{
			$data['display_currency']  = $displayCurrency;
			$data['display_amount']    = $displayAmount;
		}
		
		$json = json_encode($data);
		
		

	// use Razorpay;
	 }catch(Exception $e)
	 {
		 
		
	 }
	
	
	?>
	<div>Please wait while your order is being processed...</div>
	
	
		<button id="rzp-button1">Pay with Razorpay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="<?php echo BASE_URL.'razorpaypaymentprocess' ?>" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

(function() {
   // your page initialization code here
   // the DOM will be available here
   rzp.open();
    e.preventDefault();
})();
document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
	
		
<?php	
	break; 
	
	 
	 
	
}
			
		
		}
		
		
	}
	
	function getorder_referenceid($id)
	{
		$id=$this->real_escape_string($id);
		$shipping_Qtr = "select t1.order_reference,t2.product_name, count(t2.product_name) as cnt from ".TPLPrefix."orders t1  inner join ".TPLPrefix."orders_products t2 on t1.order_id=t2.order_id and t2.IsActive=1 where t1.order_reference =? and t1.IsActive=1 ";
		//echo $shipping_Qtr; exit;
		$resulst=$this->get_a_line_bind($shipping_Qtr,array($id));	
		return $resulst;
	}


	function placePaypalOrder( $djModel )
	{
		
		$today 			= date("Y-m-d H:i:s");
		$addressid 		= $_SESSION['addressid'];
		$customerid 	= $_SESSION['Cus_ID'];
		$order_type 	= 1;
		if($customerid == '')
		{
			$customerid = session_id();
			$order_type = 2;
		}
		$cus_groupid 	= $_SESSION['cus_group_id'];
		$checkout 		= $this->loadModel('checkout_model'); 
		$payinfo 		= $checkout->Paymentmethod($_SESSION['pay_code']);
		
		if(count($payinfo)==0 || count($payinfo)>1)
		{
			$this->redirect('gatewayerror');
		}
		
		$orderjoinfields 	= " ,img.img_path,c.cart_id,cpa.cart_product_attr_id,cpa.Attribute_id,cpa.Attribute_value_id,ca.firstname,ca.lastname,ca.address,ca.emailid,ca.city,ca.postalcode,ca.telephone,ca.stateid,ca.countryid,ca.landmark,ca.landmark,ca.gstno,ma.attributename,ma.attributecode,drp.dropdown_values ";
		$orderjoinqry 		= "  left join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  inner join ".TPLPrefix."cus_address ca on ca.cus_addressid='".$addressid."' and ca.IsActive=1 ";
		
		$cart 				= $this->loadModel('cart_model');
		$prod_details 		= $cart->cartProductList('',$orderjoinfields,$orderjoinqry,$isenableTax=1);
		
		$granttotal 		= $carttotal = 0;
		require_once(APP_DIR .'helpers/common_function.php');
	
	    $helper 			= new common_function;
		$childsid 			= $helper->getChildsId();
		$arrexcludecat 		= explode(",",$childsid);
		
		$disgranttotal = 0;
		foreach($prod_details as $productlist){
			if(!in_array($productlist['categoryID'],$arrexcludecat)){
				$totaprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
				$disgranttotal+=$totaprice;
			}
		}	
	 	
		$withoutdistotal=0;
		foreach($prod_details as $productlist){
			$totaprice = ($productlist['price'] * $productlist['product_qty']);
			$withoutdistotal+=$totaprice;
		}	
	 
		$discount =0;
		$discountslap =  $checkout->chkDiscountSlap($disgranttotal);	
		$disgranttotal=0;
		$granttotal=0;
	
		foreach($prod_details as $productlist){
			$prodprice = ($productlist['final_price'] * $productlist['product_qty']);
			$distprodprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
			$discount = 0;
			
			if($productlist['product_qty']==0)
			{		
				$this->redirect('cart');
			}
			
			if( strtoupper($productlist['taxTyp'])=="P"){											
				$totaprice = $prodprice + (($prodprice * $productlist['taxRate'])/100);
			}	
			else if(strtoupper($productlist['taxTyp'])=="F"){
				$totaprice = $prodprice +  $productlist['taxRate'];
			}
			else{
				$totaprice = $prodprice;
			}
		
			$disgranttotal += $distprodprice;	
			$granttotal += $totaprice;	
			$carttotal += $totaprice;		 
		}	
	
		$granttotal 		= $granttotal;	
		$couopnamount 		= 0;
		//Coupon Section Start
		if(isset($_SESSION['Couponcode']) && $_SESSION['Couponcode']!=''){ 
			$couponcode 	= $_SESSION['Couponcode'];
			$coupontitle 	= $_SESSION['Coupontitle'];
			$couopnamount 	= $_SESSION['Couponamount'];
		}	
		
		if($discountslap['DiscountAmount']!=''){			
			$discounttitle 	= $discountslap['DiscountTitle'];
			$discountslab 	= $discountslap['DiscountAmount'];
		} 

		if(isset($_SESSION['shippingCode'])) {

			$data=$checkout->modelname($_SESSION['shippingCode']);
			$shipping = $this->loadModel($data['modelname']);//load dynamic model name
			$datas=$shipping->shippingfunction($data['shippingId']);
			if($datas['pricetype']==1) {
				$shippingcode =  $_SESSION['shippingCode'];
				$shipiingtitle = $datas['shippingTitle'];
				$shippingcharge = ($disgranttotal*$datas['shippingCost'])/100;
			} else {
				$shippingcode =  $_SESSION['shippingCode'];
				$shipiingtitle = $datas['shippingTitle'];
				$shippingcharge = $datas['shippingCost'];
			}
		}
		$shippingcharge=$shippingcharge;
		$granttotal = $granttotal + $shippingcharge -$couopnamount;

		$granttotal 	= $_SESSION['granttotal'];
		$total_products_wt 	= $_SESSION['total_product_amount'];
		$granttotal = round($granttotal);
		$payPalResponse['amount'] = $granttotal;
		//Shipping charge Section End
		if($granttotal==0)
		{		
			$this->redirect('cart');
		}	
		$insParams = array(
						'order_type' 		=> $order_type,
						'customer_id' 		=> $_SESSION['Cus_ID'],
						'customer_group_id' => $cus_groupid,
						'hsncode' 			=> $prod_details[0]['hsncode'],
						'email' 			=> $prod_details[0]['emailid'],
						'firstname' 		=> $prod_details[0]['firstname'],
						'lastname' 			=> $prod_details[0]['lastname'],
						'payment_address_1' => $prod_details[0]['address'],
						'payment_landmark' 	=> $prod_details[0]['landmark'],
						'payment_city' 		=> $prod_details[0]['city'],
						'payment_postcode' 	=> $prod_details[0]['postalcode'],
						'payment_country_id'=> $prod_details[0]['countryid'],
						'paymentStateId' 	=> $prod_details[0]['stateid'],
						'payment_telephone' => $prod_details[0]['telephone'],
						'payment_method' 	=> $payinfo[0]['title'],
						'payment_code' 		=> $payinfo[0]['pay_code'],
						'payment_gstno' 	=> $prod_details[0]['gstno'],
						'shipping_firstname'=> $prod_details[0]['firstname'], 
						'shipping_lastname'	=> $prod_details[0]['lastname'],
						'shipping_address_1'=> $prod_details[0]['address'],
						'shipping_landmark' => $prod_details[0]['landmark'],
						'shipping_city' 	=> $prod_details[0]['city'],
						'shipping_postcode' => $prod_details[0]['postalcode'],
						'shipping_country_id'=> $prod_details[0]['countryid'],
						'shipping_state_id' => $prod_details[0]['stateid'],
						'shipping_telephone'=> $prod_details[0]['telephone'],
						'shipping_method' 	=> $shipiingtitle,
						'shipping_code' 	=> $shippingcode,
						'shipping_gstno' 	=> $prod_details[0]['gstno'],
						'total_products' 	=> count($prod_details),
						'total_paid_tax_incl'=> $carttotal,
						'cart_total' 		=> $carttotal,
						'coupon_discount' 	=> $couopnamount,
						'couponcode' 		=> $couponcode ?? '',
						'coupontitle' 		=> $coupontitle ?? '',
						'discounttitle' 	=> $discounttitle,
						'shippint_cost' 	=> $shippingcharge,
						'schippingcode' 	=> $shippingcode,
						'shippingtitle' 	=> $shipiingtitle,
						'total_paid' 		=> $granttotal,
						'total' 			=> $granttotal,
						'grand_total' 		=> $granttotal,
						'total_paid_tax_excl' => $disgranttotal,
						'total_discounts' 	=> ($withoutdistotal-$disgranttotal),
						'total_products_wt' => $total_products_wt,
						'order_status_id' 	=> 1,
						'UserId' 			=> $customerid,
						'IsActive' 			=> 1,
						'date_added' 		=> $today,
						'date_modified' 	=> $today,
						'lang_id' 			=> $_SESSION['lang_id'],
						'session_id' 		=> session_id()
					);
		
		$InsertId 			= $djModel->insertCommon( $insParams, 'kr_orders' );
		$orderId 			= $InsertId;
	    $helper->getStoreConfig(); 
		$prefix 			= $helper->getStoreConfigvalue('invoicePrefix'); 
	    $startvalue 		= $helper->getStoreConfigvalue('invoiceStartingFrom'); 
		
		$order_qry 			= "select count(*) as cnt from ".TPLPrefix."orders where IsActive=1";
		$result 			= $this->get_a_line($order_qry);
		$ordercnt 			= $result['cnt'];
		
		$str 				= $startvalue+$ordercnt;
		$order_value 		= str_pad($str, 8, 0, STR_PAD_LEFT);
		$order_reference 	= $prefix.$order_value; 
		$payPalResponse['order_reference'] = $order_reference;
		
		//update order reference id
		$update_qry 			= "update ".TPLPrefix."orders set order_reference='".$order_reference."' where order_id = ".$InsertId." and IsActive=1 ";
		$data 					= $this->insert($update_qry); 
			
		if($InsertId) {

			foreach($prod_details as $product) {
			
				$productImage 	= getCartProductImages( $product['cart_product_id'] );
				$imgurl 		= 'uploads/productassest/'.$product['product_id'].'/photos/'.$productImage->img_path; 
			 	// $imgurl 		= 'uploads/productassest/'.$product['product_id'].'/photos/thumb/'.$product['img_names'];
				$prodprice 		= ($product['attr_price'] * $product['product_qty']);
				$distprodprice 	= ($product['attr_price'] * $product['product_qty']);
				$discount 		= 0;
				$totaprice 		= $prodprice;
				
				//Insert order product table
			    $productInsert = "INSERT INTO ".TPLPrefix."orders_products(order_id,product_id,product_name,product_images,product_sku,product_qty,product_price,prod_attr_price,prod_sub_total,tax_type,tax_value,tax_name,    IsCustomtool ,CustomtoolImg, IsActive,CreatedDate,ModifiedDate,item_code) VALUES('".$InsertId."','".$product['product_id']."','".$product['product_name']."','".$imgurl."','".$product['sku']."','".$product['product_qty']."','".$product['attr_price']."','".$product['attr_price']."','".$totaprice."','".$product['taxTyp']."','".$product['taxRate']."','".$product['taxName']."','".$product['IsCustomtool']."','".$product['CustomtoolImg']."','1','".$today."','".$today."','".$product['product_code']."')"; 
				$this->insert($productInsert);
			
				$product_InsertId = $this->lastInsertId();
					
				$AttributeInsert = "INSERT INTO ".TPLPrefix."orders_products_attribute(order_id,order_product_id,Attribute_id,Attribute_Code,Attribute_Name,Attribute_value_id,Attribute_value_name,Attribute_price,IsActive,CreatedDate,ModifiedDate) select '".$InsertId."','".$product_InsertId."',cpa.Attribute_id,ma.attributecode,ma.attributename,cpa.Attribute_value_id,dp.dropdown_values,pac.price,'1','".$today."','".$today."' from ".TPLPrefix."carts_products_attribute cpa inner join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  
				inner join ".TPLPrefix."cart_products cp on cp.cart_product_id=cpa.cart_product_id and cp.IsActive=1 inner join ".TPLPrefix."dropdown dp ON dp.dropdown_id=cpa.Attribute_value_id    
				AND dp.isactive = 1

				inner join ".TPLPrefix."product_attr_combi pac on cp.product_id=pac.base_productId AND find_in_set(dp.dropdown_id,
					REPLACE(pac.attr_combi_id, '_', ',')) and pac.IsActive=1  and  pac.outofstock = 0   and pac.attr_combi_id=cp.attr_combi_id   where cpa.cart_product_id='".$product['cart_product_id']."' and cpa.IsActive=1 ";
				
				$this->insert($AttributeInsert);
				
				$customInsert = " INSERT INTO ".TPLPrefix."orders_customtool_images(order_id, order_product_id, customsimgpath, IsActive, CreatedDate, ModifiedDate)  select '".$InsertId."','".$product_InsertId."',cimg.customsimgpath,'1','".$today."','".$today."' from ".TPLPrefix."carts_customtool_images cimg 
				inner join ".TPLPrefix."cart_products cp on cp.cart_product_id=cimg.cart_product_id and cp.IsActive=1 
					where cimg.cart_product_id='".$product['cart_product_id']."' and cimg.IsActive=1 ";
		
				$this->insert($customInsert);
				 
			}
		
			
			require_once(APP_DIR .'models/mailsend.php');
			ordermailfunction($this,$order_reference);
			$update_qry = "update ".TPLPrefix."carts set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry); 

			$update_qry = "update ".TPLPrefix."cart_products set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry);
			
			$update_qry = "update ".TPLPrefix."carts_products_attribute set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
		    $data=$this->insert($update_qry);
			
			$update_qry = "update ".TPLPrefix."carts_customtool_images set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
			
		    $data = $this->insert($update_qry);
			$_SESSION['addressid']='';
            $_SESSION['Couponcode'] = '';
            $_SESSION['Coupontitle'] = '';
            $_SESSION['Couponamount'] = '';
			$_SESSION['coupontype'] = '';
			$_SESSION['couponvalue'] = '';  
			$_SESSION['shippingid'] = ''; 
			$_SESSION['pricetype'] = '';
            $_SESSION['shippingCost'] = '';
			$_SESSION['pay_id'] = '';
			$_SESSION['pay_code']='';  
		
		}
		$_SESSION['PAYPAL'] = $payPalResponse;
		return $payPalResponse;
	}

	public function getOrderInfoByOrderReference( $order_reference ) {
		$order_qry 			= "select * from ".TPLPrefix."orders where order_reference='".$order_reference."'";
		$result 			= $this->get_a_line($order_qry);
		return $result;
	}

	function update_orders($order_id, $order_status ) {
		$del_qry 		= "update ".TPLPrefix."orders set order_status_id=".$order_status." where order_id ='".$order_id."'";
		return $this->insert($del_qry); 		
	}

	public function insertPayment($pay) {
		$column = "tracking_id, order_id, data, CustomerId, order_status, payment_mode, CreatedDate, ModifiedDate";
		$values = "('".$pay['tracking_id']."', '".$pay['order_id']."', '".$pay['data']."', '".$pay['CustomerId']."', '".$pay['order_status']."', '".$pay['payment_mode']."', '".$pay['CreatedDate']."', '".$pay['ModifiedDate']."')";
		$payInsert = " INSERT INTO kr_ccav_transaction(".$column.") values ".$values.""; 
		return $this->insert($payInsert);
	}

	function ordermailfunction($refid,$id='3')
	{
	    require_once(APP_DIR .'models/mailsend.php');
		
	    ordermailfunction($this,$refid,$id);
		// echo 'success';
	}
}
?>