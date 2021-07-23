<?php
class payment_model extends Model {
	
	function checkresponse($filter)
	{
		
		$today = date("Y-m-d H:i:s");
		require_once(APP_DIR .'models/ccavenue/crypto.php');
		$checkout = $this->loadModel('checkout_model'); 
		$payinfo=$checkout->Paymentmethod("CCAV");
	
		$workingKey='272F4230CDFD05F10BD2FB290B73072C';	
		
		$encResponse=$filter["encResp"];			//This is the response sent by the CCAvenue Server
		$encResponse='6eaa88bd0481331bd5602dcbeec51bc2b333dae13ca19d645273c67a1de40676b0156a11b3b0b570325430aa9097d1b6abf7f61489a7429a22385efc49a94edefc71fc5cad4543f3789463b714b121e53d7c28a9cd864cb2f3ab204ac9d2d37c6a4db1b882b1038539c211de328d651c1dbf4f4a822eda5ba2031d1aac966b7f3cd4099b166fcdfa45232151173e83652bf1696fb645ed21acedaceb7048e7eeef3dfac882bc362e3bd890070393f4f6ee1eb4dce99e3e9c0c39b8d36d3c634bc82c002c8ecfb0a6ace8fbe88d2134e71480161c8298f879e9eb237663c3c95f44d278204ae419186e3f1a6026df7620b9e40d095caf6c9739001b9a3953c1065b12cabb407c9300b33084db142b48f53153133defeb147c60635e2557a56b727ee75d7b83d436e1b30da92625247fa7ec364f5d02203d60c59466fc95b2cbbdbe110009e96f091de050d2f727b6c762115c60ba4305df018668cf00d11b1328474d9876cddca6d732635f9ed97039e8fcd317277fed62f119d0c83535941d7e781d9d7b2a52770fdd1b9c5ac659f65ba4f58ad62e28090f8b84fc18f954f3eb41e06dda2cc0fbc7c052cba25a2395bb0ed0639593a29eb0e07b59ce9708bec8c59fdb7f0541bb38c31710d9df84851bd7f76810e04d4cfb3fe57f0cfdd5dd0aa94b7dfa1349870fb860a57241b4e211efe204fcbb3d1a74eaec6c8ab2bf449b7a9006984bf6695193f96a5bfaf239885ba24c9400b5566d95016a3592087f76fb3949829450bb7d5cba4df7ffa683103cbd98ffbae31e7624cb9b80e5aa4294ac90274b9e7edb9b482633ed86459c243f92d6f9095824cff510e4a618f756e182e471e0a69f83c173b9f4fcfb30ea79e1d6d358a64e5c626ff363d62701ef141c67ce200ef51fc245baa8411378afca1f6609765c3c47c4f9fd7883d1f4c4c4c26521c5ae70b91c6e02b6f8f60aed0fc6465a68fc299250177e988b0fe699aec3e59cd974f5e7e1825399d07832a197fcdf6b9120a03f8bdb5fabf6fd227984fb335ec280601ca2c446e8fc8a888b3d1cdc9fc62aab4b28f328ba327508bc90aa89e319b591e64ef5c58a69c06173ebd70a040e4d8549afe0a25ec12764b1aaa5fca90d32278b84633770819773773f8a7787d8fef7eceb876980e98b2dace2634bbe5443e72731fdbdd0425edce55a9c842904bf9a3396990bc896af8bd16e6a78c8171eb2990229df2978f5cb1baff931dcbe06f00262fce69fa9ff86f130cd58d77b1b8768a39daf5f1cb5d3a9551c35ca1c82262e326cfd2af44b7c7cea6b09df7a504c6d513496ccf6134cbcfd';


	echo $rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	die();
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		
		print_r($decryptValues); die();
	
			
		for($i = 0; $i < $dataSize; $i++) 
		{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
		}	
		print_r($order_status); die();
		switch(strtolower($order_status))
		{
			
			case "success":
							$addressid = $_SESSION['addressid'];
							$customerid =  $_SESSION['Cus_ID'];
							$cus_groupid =  $_SESSION['cus_group_id'];	
			
							 $orderjoinfields=" ,img.img_path,c.cart_id,cpa.cart_product_attr_id,cpa.Attribute_id,cpa.Attribute_value_id,ca.firstname,ca.lastname,ca.address,ca.emailid,ca.city,ca.postalcode,ca.telephone,ca.stateid,ca.countryid,ca.landmark,ma.attributename,ma.attributecode,pac.price as attprice,dp.dropdown_values ";
							 
							 $orderjoinqry="  left join ".TPLPrefix."carts_products_attribute cpa on cpa.cart_product_id=cp.cart_product_id and cpa.IsActive=1 left join ".TPLPrefix."m_attributes ma on cpa.Attribute_id=ma.attributeid and ma.IsActive=1  left join ".TPLPrefix."product_attr_combi pac on cp.product_id=pac.base_productId and pac.IsActive=1  left join ".TPLPrefix."dropdown dp on cpa.Attribute_value_id=dp.dropdown_id and dp.isactive=1  inner join ".TPLPrefix."cus_address ca on ca.cus_addressid='".$addressid."' and ca.IsActive=1 ";
							
							$cart=$this->loadModel('cart_model');
							$prod_details = $cart->cartProductList('',$orderjoinfields,$orderjoinqry,$isenableTax=1);
							
							
							$update_qry = "update ".TPLPrefix."carts set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
							$data=$this->insert($update_qry); 
							
						
							$update_qry = "update ".TPLPrefix."cart_products set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
							$data=$this->insert($update_qry);
							
							
							$update_qry = "update ".TPLPrefix."carts_products_attribute set IsActive=2 where cart_id = ".$prod_details[0]['cart_id']." and IsActive=1 ";
							
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
			
			
							require_once(APP_DIR .'models/mailsend.php');
							
							ordermailfunction($this,$order_reference);
	
							
							break;
							
			case "aborted":
							break;
							
			case "failure":

							break;
							
			default:
							
							break;
			
			
		}
	 	
	}	
	
	function savetransaction($data)
	{
		 $insqry= " insert into ".TPLPrefix."ccav_transaction (tracking_id, order_id, data, CustomerId, order_status, payment_mode,  CreatedDate, ModifiedDate ) value('".$this->getRealescape($data['tracking_id'])."','".$this->getRealescape($data['order_id'])."','".$this->getRealescape($data['data'])."','".$this->getRealescape($_SESSION['Cus_ID'])."','".$this->getRealescape($data['order_status'])."','".$this->getRealescape($data['payment_mode'])."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."');"; 
		$this->insert($insqry);
		
	}
	
	function updateorderstatus($orderid,$status_id)
	{
	   
		 $updateqry= " update ".TPLPrefix."orders set order_status_id='".$this->getRealescape($status_id)."',date_modified='".date("Y-m-d H:i:s")."' where order_reference='".$this->getRealescape($orderid)."' ;"; 
		 $this->insert($updateqry);
	
	}
	function ordermailfunction($refid,$id='3')
	{
	     require_once(APP_DIR .'models/mailsend.php');
	     ordermailfunction($this,$refid,$id);
	}
	
}	