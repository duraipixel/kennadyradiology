<?php
class cart_model extends Model {
	################## Cart Page ###############
	function updateallcartproduct($langid){
		$today = date("Y-m-d H:i:s");
        if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id']; 
			$cond = " and c.customer_id='".$customerid."' ";
		}
		else{
			$sessionId=session_id();
			$customerid = '0';
			$cus_groupid = '0'; 	
			$cond = " and c.sessionId='".$sessionId."' ";			
		}
		
		$strqry = "select cp.product_id,p.lang_id,cp.cart_product_id,p.parent_id from ".TPLPrefix."cart_products cp 
		inner join ".TPLPrefix."carts c on c.cart_id = cp.cart_id
		inner join ".TPLPrefix."product p on p.product_id = cp.product_id
		where 1=1 ".$cond." ";
		$getallproduct =$this->get_rsltset($strqry);
		
		if(count($getallproduct) == 0){
		echo json_encode(array("rslt"=>1));exit();
		}
		
		if($langid == $getallproduct[0]['lang_id']){
			 echo json_encode(array("rslt"=>1));exit();
			}
			
		foreach($getallproduct as $productlist){
			
			//check session and cart product id are same
			//echo $langid .'=='. $productlist['lang_id'];
			/*if($langid == $productlist['lang_id']){
			 echo json_encode(array("rslt"=>1));
			}else{*/
				
				 
				 
				/*if($productlist['parent_id'] == 0){
					 echo "select parent_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$productlist['product_id']."' ";
					 
					$getlang_product = $this->get_a_line("select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and product_id = '".$productlist['product_id']."' ");
					
				}else{
					*/
					$getparent = $this->get_a_line("select parent_id,product_id from ".TPLPrefix."product where product_id = '".$productlist['product_id']."' ");
					
				//	 echo "select product_id,parent_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$getparent['parent_id']."' ";
					
					if($langid == 1){
						//echo "sdf";
						//echo "select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and product_id = '".$getparent['parent_id']."' ";
						
						$getlang_product = $this->get_a_line("select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and product_id = '".$getparent['parent_id']."' ");
					}else if($getparent['parent_id'] != 0){
						//echo "elseif";
						//echo "select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$getparent['parent_id']."' ";
						
						$getlang_product = $this->get_a_line("select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$getparent['parent_id']."' ");
						
					}else{
						//echo "else";
						 
						//echo "select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$productlist['product_id']."' ";
					$getlang_product = $this->get_a_line("select product_id from ".TPLPrefix."product where lang_id = '".$langid ."' and parent_id = '".$productlist['product_id']."' ");
					}
			//	}
				
				 
				  $this->insert("update ".TPLPrefix."cart_products set product_id = '".$getlang_product['product_id']."' where cart_product_id = '".$productlist['cart_product_id']."' ");
				 
				 //atttribute value change based on language
				 
				   $att_query = "select * from ".TPLPrefix."carts_products_attribute where cart_product_id = '".$productlist['cart_product_id']."' and IsActive = 1 ";
				 $resulst_attr=$this->get_rsltset($att_query);
				 
				 
				 
				 foreach($resulst_attr as $attr_val){
					 
					 /* echo "select parent_id,attributeid,lang_id from ".TPLPrefix."m_attributes where attributeid = '".$attr_val['Attribute_id']."' ";
					 
					 echo "select parent_id,dropdown_id from ".TPLPrefix."dropdown where dropdown_id = '".$attr_val['Attribute_value_id']."' ";
					 
					 echo "--------------------------";
					 */
					 
					 $getparent = $this->get_a_line("select parent_id,attributeid,lang_id from ".TPLPrefix."m_attributes where attributeid = '".$attr_val['Attribute_id']."' ");
					 
					 $getparent_drop = $this->get_a_line("select parent_id,dropdown_id from ".TPLPrefix."dropdown where dropdown_id = '".$attr_val['Attribute_value_id']."' ");
					 					 
									 
										
					if($getparent['lang_id'] == 1){
					/*	echo "if";
						
						echo "select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and parent_id = '".$attr_val['Attribute_value_id']."' ";
						
						echo "select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and parent_id = '".$attr_val['Attribute_id']."' ";
						*/
						
					 $attribute_val_lang = $this->get_a_line("select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and parent_id = '".$attr_val['Attribute_value_id']."' ");
					 
					 $attribute_id_lang = $this->get_a_line("select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and parent_id = '".$attr_val['Attribute_id']."' ");
					 
					 }else if($getparent['parent_id'] != 0 && $langid != 1){
						 /*echo "elseif";
							
echo "select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and parent_id = '".$getparent_drop['parent_id']."' ";

echo "select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and parent_id = '".$getparent['parent_id']."' ";
*/
										
									$attribute_val_lang = $this->get_a_line("select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and parent_id = '".$getparent_drop['parent_id']."' ");
					 
					 $attribute_id_lang = $this->get_a_line("select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and parent_id = '".$getparent['parent_id']."' ");		 
						 
					 }
					 else{
						/*	echo "else";
							
echo "select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and dropdown_id = '".$getparent_drop['parent_id']."' ";

echo "select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and attributeid = '".$getparent['parent_id']."' ";

								*/		
									$attribute_val_lang = $this->get_a_line("select dropdown_id from ".TPLPrefix."dropdown where lang_id = '".$langid ."' and dropdown_id = '".$getparent_drop['parent_id']."' ");
					 
					 $attribute_id_lang = $this->get_a_line("select attributeid from ".TPLPrefix."m_attributes where lang_id = '".$langid ."' and attributeid = '".$getparent['parent_id']."' ");		 
										 }
										 
					/* echo "update ".TPLPrefix."carts_products_attribute set Attribute_id = '".$attribute_id_lang['attributeid']."',Attribute_value_id='".$attribute_val_lang['dropdown_id']."' where cart_product_attr_id = '".$attr_val['cart_product_attr_id']."' ";
					 
					 die();*/
					    $this->insert("update ".TPLPrefix."carts_products_attribute set Attribute_id = '".$attribute_id_lang['attributeid']."',Attribute_value_id='".$attribute_val_lang['dropdown_id']."' where cart_product_attr_id = '".$attr_val['cart_product_attr_id']."' ");
					  
				 }
				 
				 
				 
				 
				
			//}
			
		}
		echo json_encode(array("rslt"=>1));
	}
	
	function addtocart_insert( $filters, $djCart )
	{
		
		$product_price 			= $filters['product_price'];
		$isCheckout 			= $filters['isCheckout'];
		if( isset( $product_price ) && !empty( $product_price ) ) {
			$price 				= str_replace('$', '', $product_price);
		}
        $today 					= date("Y-m-d H:i:s");
        if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!='') {
			$customerid 		=  $_SESSION['Cus_ID'];
			$cus_groupid 		=  $_SESSION['cus_group_id'];
			$sessionId 			= '';
			$cond 				= " and t1.customer_id='".$customerid."' ";
		} else {
			$sessionId 			= session_id();
			$customerid 		= '0';
			$cus_groupid 		= '0';
			$cond 				= " and t1.sessionId='".$sessionId."' ";
		}
		$filters['proid'] 		= $this->real_escape_string($filters['proid']);
		$filters['minqty'] 		= $this->real_escape_string($filters['minqty']);
		if( $filters['minqty'] == "undefined" )
		{
			$filters['minqty'] 	= 1;
		}
		$str_all 				= "select minquantity,price from ".TPLPrefix."product  where IsActive=1 and product_id = ? "; 
		
	    $resulst 				= $this->get_a_line_bind($str_all,array($filters['proid']));	

		$minqty 				= $resulst['minquantity'];
		if( isset( $product_price ) && !empty( $product_price ) ) {
			$price 				= trim(str_replace('$', '', $product_price));
		} else {
			$price 				= (float)$resulst['price'];
		}
		
		$str_all 				= "select t1.cart_id from ".TPLPrefix."carts t1 where t1.IsActive=1 ".$cond." "; 
	    $resulst 				= $this->get_a_line($str_all);	
		$cart_id 				= $resulst['cart_id'];
	    
		$existProduct 			= $djCart->checkExistCartProduct();
		$filters['wishproid'] 	= $this->real_escape_string($filters['wishproid']);		
		// ss( $existProduct );
		$wishlist='';
	    if( count( $existProduct ) == 0 ) {  //check product ID
			
            //Update wishlist Product table 
            if( $filters['wishlist'] == 'wishlist' && $filters['wishlist'] != '' ) {
               
			   	$del_qry  	= "update ".TPLPrefix."wishlist_products set IsActive=2 where cart_product_id ='".$filters['wishproid']."' and IsActive=1 "; 
		        $prod_del 	= $this->insert($del_qry); 
				$wishlist 	= "wishlistdelete";

            }				
			 
			if((count($resulst)==0 || $filters['Iscustomimg']==1 ) && ($cart_id=='' || empty($cart_id))){ // check customer 
				//cart Table	 
				$strQry 		= "INSERT INTO ".TPLPrefix."carts (customer_id, customer_group_id,sessionId,ip, IsActive, UserId, CreatedDate,ModifiedDate ) VALUES ( '".$customerid."','".$cus_groupid."','".$sessionId."','','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
				$rsltMenu 		= $this->insert($strQry);
				$insert_cartid 	= $this->lastInsertId();
			}
			else
			{
				$insert_cartid 	= $cart_id;
			}
			$joinfields			= ""; 
			$joinvalues 		= ""; 
			if(isset($filters['Iscustomimg']) && $filters['Iscustomimg']==1)
			{				
				$base64_str = substr($filters['customimg'], strpos($filters['customimg'], ",")+1);
				$decoded = base64_decode($base64_str);
				$png_url = "product-".strtotime('now').".png";
				$imgapth="uploads/finalcustomimg/".$png_url;
				$result = file_put_contents($imgapth, $decoded);
				$joinfields=",IsCustomtool,CustomtoolImg"; 
				$joinvalues=" ,1,'".$png_url."' "; 				
			}
			
			$did=array();
			$aid=array();
			foreach($filters as $key=>$valu)
			{
				if(strpos($key,"selattr_")!== false)
				{
					$did[]=	$valu;
					$aid[]=(explode("_",$key))[1];
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					$did[]=	$valu;
					$aid[]=(explode("_",$key))[1];
				}
			}
			if (($product instanceof product_model) != true ) {		
				$product = $this->loadModel('product_model');
			}
		
			if(isset($filters['sku']) && $filters['sku']!='')
			{
				$prodsku = $filters['sku'];	
			} 
			$resulsts 			= $this->get_a_line(" select product_url from ".TPLPrefix."product where product_id='".$filters['proid']."'");
			$productdetails 	= $product->productdetails('','',$resulsts['product_url'],$prodsku,$did,$aid);
			$productCombination = $djCart->getProductAttributeCombination( $filters['proid'] );
			
			//Cart Product Table
			$strQry 			= "INSERT INTO  ".TPLPrefix."cart_products (cart_id, product_id, product_qty, product_amount, product_code, IsActive,attr_combi_id, CreatedDate,ModifiedDate ".$joinfields." ) VALUES ( '".$insert_cartid."','".$this->getRealescape($filters['proid'])."','".$this->getRealescape($filters['minqty'])."', '".$this->getRealescape($price)."','".$productCombination->sku."','1','".$this->getRealescape($productdetails['attr_combi_id'])."','".$this->getRealescape($today)."','".$this->getRealescape($today)."'".$joinvalues.");"; 
			$rsltMenu 			= $this->insert($strQry);
			$insert_cartproid 	= $this->lastInsertId();
			
			if(count($_SESSION['customimg'])>0)
			{
				foreach($_SESSION['customimg'] as $att_img)
				{
					$custstrQry ="INSERT INTO  ".TPLPrefix."carts_customtool_images (cart_id, cart_product_id, customsimgpath, IsActive, CreatedDate,ModifiedDate  ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$att_img."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($custstrQry);
				}
			}
			
			$_SESSION['customimg']=array();
			$did=array();
			$aid=array();
			//echo "<pre>"; print_r($filters); exit;
			foreach($filters as $key=>$valu)
			{
				if(strpos($key,"selattr_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."carts_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."carts_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
			}
		
			//Cart Product Attribute Table
			
			
			if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
				$customerid =  $_SESSION['Cus_ID'];
				$cus_groupid =  $_SESSION['cus_group_id'];
				$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
				$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		    }
		    else{
				$sessionId=session_id();
				$cond = " and t1.sessionId= '".$sessionId."' ";
				$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
			}
			$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
			//echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);
			$cnt = count($resulst);
			//update cart total
			$cart_query = "SELECT sum(product_amount) as total FROM `kr_cart_products` where cart_id = ".$insert_cartid." and IsActive=1";
			$cart_products = $this->get_a_line($cart_query);

			if(isset( $cart_products) && !empty( $cart_products ) ) {
				$del_qry = "update ".TPLPrefix."carts set grand_total='".$cart_products['total']."' where cart_id ='".$insert_cartid."'"; 
			}
			
			echo json_encode(array("rslt"=>1,"cartcount"=>$cnt,"wishlist"=>$wishlist));
		}
		else
		{
			if( isset( $filters['minqty'] ) && !empty( $filters['minqty'] ) ) {	
				
				$update_query  	= "update ".TPLPrefix."cart_products set product_qty='".$filters['minqty']."' where cart_product_id ='".$existProduct->cart_product_id."'"; 
		        $this->insert($update_query); 

				if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
					$customerid =  $_SESSION['Cus_ID'];
					$cus_groupid =  $_SESSION['cus_group_id'];
					$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
					$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
				} else {
					$sessionId=session_id();
					$cond = " and t1.sessionId= '".$sessionId."' ";
					$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
				}

				$str_all 		= "select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
				//echo $str_all; exit;
				$resulst 		= $this->get_rsltset($str_all);
				$cnt 			= count($resulst);
				echo json_encode(array("rslt"=>1,"cartcount"=>$cnt));

			} else {
				echo json_encode( array( "rslt" => 2, "proqty" => $existProduct->product_qty ) );
			}
		}
		
	}
	
	function addtocatalogue_insert($filters)
	{
		
        $today = date("Y-m-d H:i:s");
        if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$sessionId='';
			$cond = " and t1.customer_id='".$customerid."' ";
 		}
		else{
			$sessionId=session_id();
			$customerid = '0';
			$cus_groupid = '0';
			$cond = " and t1.sessionId='".$sessionId."' ";
 			
		}
		
		 $selectQry = $this->get_a_line("select group_concat(t1.cart_id) as cartids from ".TPLPrefix."catalogue t1 where t1.IsActive = 1 ".$cond." ");
		 ##########delete exisitng data###########
		 $this->insert("delete from ".TPLPrefix."catalogue where cart_id in (".$selectQry['cartids'].")");
		 $this->insert("delete from ".TPLPrefix."catalogue_products_attribute where cart_id in (".$selectQry['cartids'].")");
		 $this->insert("delete from ".TPLPrefix."catalogue_products where cart_id in (".$selectQry['cartids'].")");
		
		//print_r($filters['corpcatalogue']);die();
		foreach($filters['corpcatalogue'] as $productid){
			
		$filters['proid']=$this->real_escape_string($productid);
		$filters['minqty']=$this->real_escape_string(1);
		 
			 
		 
		
		
			
		$str_all="select minquantity,price from ".TPLPrefix."product  where IsActive=1 and product_id = ? "; 
		//echo $str_all; exit;
	    $resulst=$this->get_a_line_bind($str_all,array($filters['proid']));		
		$minqty = $resulst['minquantity'];
		$price = (float)$resulst['price'];
		/*if($price==0){
			echo json_encode(array("rslt"=>4,"price"=>"This product can not add your cart."));
			exit;
		}*/
		//var_dump($price); exit;	
		/*echo $filters['minqty'].'>='.$minqty;
		die();*/
		//if($filters['minqty']>=$minqty){
				
		$str_all="select t1.cart_id from ".TPLPrefix."catalogue t1 where t1.IsActive=1 ".$cond." "; 
		//echo $str_all; exit;
	    $resulst=$this->get_a_line($str_all);	
		$cart_id = $resulst['cart_id'];
	    
		$joinqry="";
		$qryinx=1;
	//	print_r($filters); die();		
		foreach($filters as $key=>$valu)
			{
				$valu=$this->real_escape_string($valu);
				if(strpos($key,"selattr_")!== false)
				{
					if($valu!=""){
					$joinqry .="inner join   ".TPLPrefix."catalogue_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}
				if(strpos($key,"iconatt_")!== false)
				{
					if($valu!=""){
					$joinqry .="inner join   ".TPLPrefix."catalogue_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}	
			}
		
		
		
		 $str_alls="select t2.cart_product_id,t2.product_qty from ".TPLPrefix."catalogue t1 inner join ".TPLPrefix."catalogue_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 and t2.IsCustomtool='0' and t2.product_id='".$filters['proid']."' ".$joinqry." where t1.IsActive=1 ".$cond." "; 
		
		//echo $str_all; exit;
	    $resulsts=$this->get_a_line($str_alls);
		$filters['wishproid']=$this->real_escape_string($filters['wishproid']);		
		//print_r($resulsts); exit;
		$wishlist='';
	    if(count($resulsts)==0 || $filters['Iscustomimg']==1){  //check product ID
			
            //Update wishlist Product table 
            if($filters['wishlist']=='wishlist' && $filters['wishlist']!=''){
               
			   $del_qry = "update ".TPLPrefix."wishlist_products set IsActive=2 where cart_product_id ='".$filters['wishproid']."' and IsActive=1 "; 
		        $prod_del=$this->insert($del_qry); 
				$wishlist = "wishlistdelete";
            }				
			
			if((count($resulst)==0 || $filters['Iscustomimg']==1 ) && ($cart_id=='' || empty($cart_id))){ // check customer 
			//cart Table	 
			$strQry ="INSERT INTO  ".TPLPrefix."catalogue (customer_id, customer_group_id,sessionId,ip, IsActive, UserId, CreatedDate,ModifiedDate ) VALUES ( '".$customerid."','".$cus_groupid."','".$sessionId."','','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
			$rsltMenu=$this->insert($strQry);
			$insert_cartid = $this->lastInsertId();
			}
			else
			{
				$insert_cartid =$cart_id;
			}
			$joinfields=""; 
			$joinvalues=""; 
			if(isset($filters['Iscustomimg']) && $filters['Iscustomimg']==1)
			{				
				$base64_str = substr($filters['customimg'], strpos($filters['customimg'], ",")+1);
				$decoded = base64_decode($base64_str);
				$png_url = "product-".strtotime('now').".png";
				$imgapth="uploads/finalcustomimg/".$png_url;
				$result = file_put_contents($imgapth, $decoded);
				$joinfields=",IsCustomtool,CustomtoolImg"; 
				$joinvalues=" ,1,'".$png_url."' "; 				
			}
			
			//Cart Product Table
			$strQry ="INSERT INTO  ".TPLPrefix."catalogue_products (cart_id, product_id, product_qty, IsActive, CreatedDate,ModifiedDate ".$joinfields." ) VALUES ( '".$insert_cartid."','".$this->getRealescape($filters['proid'])."','".$this->getRealescape($filters['minqty'])."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."'".$joinvalues.");"; 
			$rsltMenu=$this->insert($strQry);
			$insert_cartproid = $this->lastInsertId();
			
			
			if(count($_SESSION['customimg'])>0)
			{
				foreach($_SESSION['customimg'] as $att_img)
				{
						 $custstrQry ="INSERT INTO  ".TPLPrefix."catalogue_customtool_images (cart_id, cart_product_id, customsimgpath, IsActive, CreatedDate,ModifiedDate  ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$att_img."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
						$rsltMenu=$this->insert($custstrQry);
				}
			}
			
			$_SESSION['customimg']=array();
			$did=array();
			$aid=array();
			//echo "<pre>"; print_r($filters); exit;
			foreach($filters as $key=>$valu)
			{
				if(strpos($key,"selattr_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."catalogue_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."catalogue_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
			}
		
			//Cart Product Attribute Table
			
			
			if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."catalogue_products_attribute t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		    }
		    else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."catalogue_products_attribute t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
			}
			$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
			//echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);
			$cnt = count($resulst);
			
			
			
			///echo json_encode(array("rslt"=>1,"cartcount"=>'('.$cnt.')',"wishlist"=>$wishlist));
		}
		else
		{
			//		echo json_encode(array("rslt"=>2,"proqty"=>$resulsts['product_qty']));
		}
		}
		echo json_encode(array("rslt"=>1));
		/*}else{
			
				echo json_encode(array("rslt"=>3,"proqty"=>$minqty));
			
		}		*/	
		
	}
	
	function buynow_insert($filters)
	{
		
        $today = date("Y-m-d H:i:s");
        if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$sessionId='';
			$cond = " and t1.customer_id='".$customerid."' ";
			$cond1 = " and customer_id='".$customerid."' ";
		}
		else{
			$sessionId=session_id();
			$customerid = '0';
			$cus_groupid = '0';
			$cond = " and t1.sessionId='".$sessionId."' ";
			$cond1 = " and sessionId='".$sessionId."' ";
			
		}
		
		if($cond != ''){

 			$this->insert("delete from ".TPLPrefix."carts  where IsActive = 1 ".$cond."");
		}
			
		$filters['proid']=$this->real_escape_string($filters['proid']);
		$filters['minqty']=$this->real_escape_string($filters['minqty']);
		if($filters['minqty']=="undefined")
		{
			$filters['minqty']=1;
		}
		$str_all="select minquantity,price from ".TPLPrefix."product  where IsActive=1 and product_id = ? "; 
		//echo $str_all; exit;
	    $resulst=$this->get_a_line_bind($str_all,array($filters['proid']));		
		$minqty = $resulst['minquantity'];
		$price = (float)$resulst['price'];
		 
				
		$str_all="select t1.cart_id from ".TPLPrefix."carts t1 where t1.IsActive=1 ".$cond." "; 
		//echo $str_all; exit;
	    $resulst=$this->get_a_line($str_all);	
		$cart_id = $resulst['cart_id'];
	    
		$joinqry="";
		$qryinx=1;
 
 		foreach($filters as $key=>$valu)
			{
				$valu=$this->real_escape_string($valu);
				if(strpos($key,"selattr_")!== false)
				{
					if($valu!=""){
					$joinqry .="inner join   ".TPLPrefix."carts_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}
				if(strpos($key,"iconatt_")!== false)
				{
					if($valu!=""){
					$joinqry .="inner join   ".TPLPrefix."carts_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}	
			}
		
		
		
		 $str_alls="select t2.cart_product_id,t2.product_qty from ".TPLPrefix."carts t1 inner join ".TPLPrefix."cart_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 and t2.IsCustomtool='0' and t2.product_id='".$filters['proid']."' ".$joinqry." where t1.IsActive=1 ".$cond." "; 
		
		//echo $str_all; exit;
	    $resulsts=$this->get_a_line($str_alls);
		$filters['wishproid']=$this->real_escape_string($filters['wishproid']);		
		//print_r($resulsts); exit;
		$wishlist='';
	    if(count($resulsts)==0 || $filters['Iscustomimg']==1){  //check product ID
			
			if($cond != ''){
			$this->insert("delete from ".TPLPrefix."carts where IsActive = 1 ".$cond."");
			}
			
            //Update wishlist Product table 
            if($filters['wishlist']=='wishlist' && $filters['wishlist']!=''){
               
			   $del_qry = "update ".TPLPrefix."wishlist_products set IsActive=2 where cart_product_id ='".$filters['wishproid']."' and IsActive=1 "; 
		        $prod_del=$this->insert($del_qry); 
				$wishlist = "wishlistdelete";
            }				
			
			if((count($resulst)==0 || $filters['Iscustomimg']==1 ) && ($cart_id=='' || empty($cart_id))){ // check customer 
			//cart Table	 
			$strQry ="INSERT INTO  ".TPLPrefix."carts (customer_id, customer_group_id,sessionId,ip, IsActive, UserId, CreatedDate,ModifiedDate ) VALUES ( '".$customerid."','".$cus_groupid."','".$sessionId."','','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
			$rsltMenu=$this->insert($strQry);
			$insert_cartid = $this->lastInsertId();
			}
			else
			{
				$insert_cartid =$cart_id;
			}
			$joinfields=""; 
			$joinvalues=""; 
			if(isset($filters['Iscustomimg']) && $filters['Iscustomimg']==1)
			{				
				$base64_str = substr($filters['customimg'], strpos($filters['customimg'], ",")+1);
				$decoded = base64_decode($base64_str);
				$png_url = "product-".strtotime('now').".png";
				$imgapth="uploads/finalcustomimg/".$png_url;
				$result = file_put_contents($imgapth, $decoded);
				$joinfields=",IsCustomtool,CustomtoolImg"; 
				$joinvalues=" ,1,'".$png_url."' "; 				
			}
			
			
			$did=array();
			$aid=array();
			foreach($filters as $key=>$valu)
			{
				if(strpos($key,"selattr_")!== false)
				{
					$did[]=	$valu;
					$aid[]=(explode("_",$key))[1];
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					$did[]=	$valu;
					$aid[]=(explode("_",$key))[1];
				}
			}
			if (($product instanceof product_model) != true ) {		
				$product=$this->loadModel('product_model');
				}
		
			if(isset($filters['sku']) && $filters['sku']!='')
			{
				 $prodsku=$filters['sku'];	
			}
				$resulsts=$this->get_a_line(" select product_url from ".TPLPrefix."product where product_id='".$filters['proid']."'");
				
			$productdetails=$product->productdetails('','',$resulsts['product_url'],$prodsku,$did,$aid);
			
			
			
			//Cart Product Table
			$strQry ="INSERT INTO  ".TPLPrefix."cart_products (cart_id, product_id, product_qty, IsActive,attr_combi_id, CreatedDate,ModifiedDate ".$joinfields." ) VALUES ( '".$insert_cartid."','".$this->getRealescape($filters['proid'])."','".$this->getRealescape($filters['minqty'])."','1','".$this->getRealescape($productdetails['attr_combi_id'])."','".$this->getRealescape($today)."','".$this->getRealescape($today)."'".$joinvalues.");"; 
			$rsltMenu=$this->insert($strQry);
			$insert_cartproid = $this->lastInsertId();
			
			
			if(count($_SESSION['customimg'])>0)
			{
				foreach($_SESSION['customimg'] as $att_img)
				{
						 $custstrQry ="INSERT INTO  ".TPLPrefix."carts_customtool_images (cart_id, cart_product_id, customsimgpath, IsActive, CreatedDate,ModifiedDate  ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$att_img."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
						$rsltMenu=$this->insert($custstrQry);
				}
			}
			
			$_SESSION['customimg']=array();
			$did=array();
			$aid=array();
			//echo "<pre>"; print_r($filters); exit;
			foreach($filters as $key=>$valu)
			{
				if(strpos($key,"selattr_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."carts_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					 $strQry ="INSERT INTO  ".TPLPrefix."carts_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$insert_cartproid."','".$aid."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
			}
		
			//Cart Product Attribute Table
			
			
			if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		    }
		    else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
			}
			$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
			//echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);
			$cnt = count($resulst);
			
			
			echo json_encode(array("rslt"=>1,"cartcount"=>$cnt,"wishlist"=>$wishlist));
		}
		else
		{
			
			echo json_encode(array("rslt"=>2,"proqty"=>$resulsts['product_qty']));
		}
		/*}else{
			
				echo json_encode(array("rslt"=>3,"proqty"=>$minqty));
			
		}		*/	
		
	}
	
	function SaveDownloadpdfcatalog($data){

		
		ob_start();
		$tableid = $data['cid'];
		//insert form enquiry
		
		
		$prod_details=$this->cataloguecartProductList($filters);
		//echo "<pre>";print_r($prod_details); exit;
		$helper=$this->loadHelper('common_function');
		$helper->getStoreConfig();
		require_once('TCPDF/tcpdf_include.php');
			
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Product Catelogue');
			
		
		$pdf->SetHeaderData(BASE_URL.'uploads/logo/'.$helper->getStoreConfigvalue('ecomLogo'), PDF_HEADER_LOGO_WIDTH, $helper->getStoreConfigvalue('store_name'), PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));
	

		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		$pdf->setFontSubsetting(true);
		$pdf->SetFont('dejavusans', '', 14, '', true);

		$pdf->AddPage();

		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		
		$grandtotal=0; 
				
		  $checkout = $this->loadModel('checkout_model'); 
					
		 $disgranttotal=0;
		 foreach($prod_details as $cartlist){
			$totaprice = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
			$disgranttotal+=$totaprice;
		 }	
		$discount =0;
		 $discountslap =  $checkout->chkDiscountSlap($disgranttotal);	
		
		$productlist='';

        $htmlbinddata = '';
        //echo "<pre>"; print_r($prod_details); exit;
        foreach($prod_details as $cartlist){ 
            $img = explode('|',$cartlist['img_names']);
			$imgpath =  $img[0];
			$single_price = $cartlist['final_price']; 
			$prodprice = ($cartlist['final_price'] * $cartlist['product_qty']);
			$discount =0;
			if($discountslap['DiscountAmount']!=''){												
					if($discountslap['DiscountType']==1){
					$discount = (($cartlist['final_prod_attr'] * $cartlist['product_qty'])*$discountslap['DiscountAmount'])/100;
							
					$prodprice = $prodprice-$discount;
					}
					else{
						$discount = $discountslap['DiscountAmount'];
						$prodprice = $prodprice-$discount;
					} 
			}
		  
			if( strtoupper($cartlist['taxTyp'])=="P"){											
				$totaprice = $prodprice + (($prodprice * $cartlist['taxRate'])/100);
			 }	
			 else if(strtoupper($cartlist['taxTyp'])=="F"){
				$totaprice = $prodprice +  $cartlist['taxRate'];
			 }
			else{
				$totaprice = $prodprice;
			}	
			
            $strAttr='';
			if($cartlist['attr_values']!='')
			{
				$temparr=explode("||",$cartlist['attr_values']);
				$strAttr= "<p><small>".implode(" <br/>", $temparr)."</small></p>";
			}
			$arrpath=array();
			$helper->getProductPath($cartlist['categoryID'],$arrpath);
			//printing options
			if($cartlist['attr_price']==''){
											
				$printingoption = "N/A";
			}
			else{
				$printingoption = $cartlist['attr_price'];
				$totaprice = $totaprice+$printingoption;
			}

			$htmlbinddata .= '<table border="1" cellpadding="5px" cellspacing="0" width="100%" style="margin-bottom: 5px; border-color: #f5f5f5; font-size: 12px;">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 5px;">
                <tbody>
                    <tr>
                        <td align="center" style="width:30%">
                            <img src="'.BASE_URL.'uploads/productassest/'.$cartlist['product_id'].'/photos/'.$imgpath.'"
                                alt="" width="150" height="150" /></td>
                        <td style="width:70%;vertical-align: middle;">

                            <table border="0" cellpadding="5px" cellspacing="0" width="100%"
                                style="border-color: #f5f5f5;">

                                <tbody>
                                    <tr>
                                        <td> <b>Title </b></td>
                                        <td>: '.$cartlist['product_name'].'</td>

                                    </tr>
                                    <tr>
                                        <td> <b>ItemCode</b> </td>
                                        <td>: '.$cartlist['sku'].'</td>

                                    </tr>
                                   ';
									if($cartlist['attr_values']!=''){
                  $htmlbinddata .= '<tr>
                                        <td> <b>Attribute</b> </td>
                                        <td>: '.$cartlist['attr_values'].'</td>
                                    </tr>';
									}
               $htmlbinddata .= '</tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>


            <table border="1" cellpadding="5px" cellspacing="0" width="100%"
                style="border-color: #f5f5f5; text-align: left;">
                <thead>
                    <tr>
                        <th scope="col">Price (INR)</th>
                        
                        <th scope="col">GST (INR)</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total (INR)</th>
					    <th scope="col">Discount (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.$single_price.'</td>
                         
                        <td>'.$cartlist['taxmat'].'</td>
                        <td>'.$cartlist['product_qty'].'</td>
                        <td>'.$totaprice.'</td>
						<td>';
						if($discount>0){
			    $htmlbinddata .='<small>You Saved</small><br/> INR '.$discount.'('.$discountslap['DiscountAmount'].'%)';
                        }
						else{
                $htmlbinddata .='N/A';
						}							
                $htmlbinddata .='</td></tr>
                </tbody>
            </table>
        </td>
    </tr>

</table>';
			$grandtotal += $totaprice;
        }

		$htmlbinddata .='<table border="1" cellpadding="5px" cellspacing="0" width="100%" style="margin-top: 15px; border-color: #f5f5f5; font-size: 14px;">
    <tbody>
        <tr>
            <td><b>Grand Total</b></td>

            <td align="right"><b>'.$grandtotal.'</b></td>
        </tr>
    </tbody>
</table>';


   
//echo "<pre>"; print_r($htmlbinddata); exit;
		$pdf->writeHTMLCell(0, 0, '', '', $htmlbinddata, 0, 1, 0, true, '', true);
		$unqui = rand().time();

		ob_end_clean();
		$pdf->Output(__DIR__.'/../../uploads/catalogue/catalogue'.$unqui.'.pdf', 'F');
		
		require_once (__DIR__.'/mailsend.php');
		//send mail function -()
	 	Downloadproformasend($this,$tableid,'catalogue'.$unqui.'.pdf');
 echo json_encode(array("rslt"=>1));		
	}
	
	
	function cataloguecartProductList($filters='',$orderjoinfields='',$orderjoinqry='',$isenableTax=0)
	{
		
		$conqry='';	
		$joinqry='';
		$skuimg='';
		$joinfields='';	
		$joinfieldsafter='';	
		$limitqry='';	
		 
			
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$conqry.= " and c.customer_id=".$customerid." and c.customer_group_id=".$cus_groupid." ";
		}
		else{
			$sessionId=session_id();
			$conqry.= " and c.sessionId= '".$sessionId."' ";		
		}
	
		 $joinfieldsafter.=" , @attr_price:=(  SELECT sum(price) from ( select adrp.base_productId,adrp.price,cpa.cart_product_id  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     cpa.Attribute_value_id=adrp.attr_combi_id
                      AND cpa.isactive = 1
                   inner join ".TPLPrefix."product_attr_combi_opt paco on  find_in_set(cpa.Attribute_id,paco.optionId)=1 or (find_in_set(cpa.Attribute_id,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )    
           WHERE   
                  adrp.IsActive = 1            
                 AND adrp.outofstock = 0
                 group by adrp.product_attr_combi_id,cpa.cart_product_id  ) at_tab where   base_productId = p.product_id
                 AND cart_product_id = cp.cart_product_id ) as attr_price , @other_attr_price:=0 as other_attr_price , (SELECT  group_concat(distinct concat(attr.attributename,' : ',dp.dropdown_values) SEPARATOR  '||') 
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."catalogue_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
          AS attr_values,  (   SELECT group_concat(sku SEPARATOR  '_') from ( select adrp.base_productId,adrp.sku,cpa.cart_product_id  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     cpa.Attribute_value_id=adrp.attr_combi_id
                      AND cpa.isactive = 1
                   inner join ".TPLPrefix."product_attr_combi_opt paco on  find_in_set(cpa.Attribute_id,paco.optionId)=1 or (find_in_set(cpa.Attribute_id,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )    
           WHERE   
                  adrp.IsActive = 1            
                 AND adrp.outofstock = 0
                 group by adrp.product_attr_combi_id,cpa.cart_product_id  ) at_tab where   base_productId = p.product_id
                 AND cart_product_id = cp.cart_product_id )
          AS item_code, (SELECT  group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|')  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
				inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1     
					
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
          AS attr_images  "  ; 
	
		$joinqry.=" inner join ".TPLPrefix."catalogue c on c.IsActive=1 
		inner join ".TPLPrefix."catalogue_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1  ".$orderjoinqry;
		$joinfields=' ,cp.product_qty,cp.cart_product_id,cp.IsCustomtool,cp.CustomtoolImg '.$orderjoinfields;	
	
		if (($product instanceof product_model) != true ) {		
		$product=$this->loadModel('product_model');
		}
	
		$resDiscountSel=$product->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		
		$groupby=" group by cp.cart_product_id ";
		$sortby=" order by cp.cart_product_id ";
		
		  $strqry=$product->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,'',$conqry,$sortby,'',$groupby);	
	//	die();
		$prod_details=$this->get_rsltset($strqry);
	//	echo "<pre>"; print_r($prod_details); exit;
		return $prod_details;
		
	}
    
    function cataloguecartProductList_old($filters='',$orderjoinfields='',$orderjoinqry='',$isenableTax=0)
	{
		
		$conqry='';	
		$joinqry='';
		$skuimg='';
		$joinfields='';	
		$joinfieldsafter='';	
		$limitqry='';	
		 
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$conqry.= " and c.customer_id=".$customerid." and c.customer_group_id=".$cus_groupid." ";
		}
		else{
			$sessionId=session_id();
			$conqry.= " and c.sessionId= '".$sessionId."' ";		
		}
	
		 $joinfieldsafter.=" , @attr_price:=( SELECT sum(price) from ( select adrp.base_productId,adrp.price,cpa.cart_product_id  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     cpa.Attribute_value_id=adrp.attr_combi_id
                      AND cpa.isactive = 1
                   inner join ".TPLPrefix."product_attr_combi_opt paco on  find_in_set(cpa.Attribute_id,paco.optionId)=1 or (find_in_set(cpa.Attribute_id,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )    
           WHERE   
                  adrp.IsActive = 1            
                 AND adrp.outofstock = 0
                 group by adrp.product_attr_combi_id,cpa.cart_product_id  ) at_tab where   base_productId = p.product_id
                 AND cart_product_id = cp.cart_product_id) as attr_price , @other_attr_price:=0 as other_attr_price , (SELECT  group_concat(distinct concat(attr.attributename,' : ',dp.dropdown_values) SEPARATOR  '||') 
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."catalogue_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
          AS attr_values, (   SELECT group_concat(sku SEPARATOR  '_') from ( select adrp.base_productId,adrp.sku,cpa.cart_product_id  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     cpa.Attribute_value_id=adrp.attr_combi_id
                      AND cpa.isactive = 1
                   inner join ".TPLPrefix."product_attr_combi_opt paco on  find_in_set(cpa.Attribute_id,paco.optionId)=1 or (find_in_set(cpa.Attribute_id,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )    
           WHERE   
                  adrp.IsActive = 1            
                 AND adrp.outofstock = 0
                 group by adrp.product_attr_combi_id,cpa.cart_product_id  ) at_tab where   base_productId = p.product_id
                 AND cart_product_id = cp.cart_product_id )
          AS item_code,  (SELECT  group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|')  
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
				inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1     
					
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
          AS attr_images  "  ; 
	
		$joinqry.=" inner join ".TPLPrefix."catalogue c on c.IsActive=1 
		inner join ".TPLPrefix."catalogue_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1  ".$orderjoinqry;
		$joinfields=' ,cp.product_qty,cp.cart_product_id,cp.IsCustomtool,cp.CustomtoolImg '.$orderjoinfields;	
	
		if (($product instanceof product_model) != true ) {		
		$product=$this->loadModel('product_model');
		}
	
		$resDiscountSel=$product->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		
		$groupby=" group by cp.cart_product_id ";
		$sortby=" order by cp.cart_product_id ";
		
		  $strqry=$product->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,'',$conqry,$sortby,'',$groupby);	
	 //echo $strqry;	die();
		$prod_details=$this->get_rsltset($strqry);
	//	echo "<pre>"; print_r($prod_details); exit;
		return $prod_details;
		
	}
	
	
	function addtocartcount()
	{ 
	    if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		}
		else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		}
		$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
		//echo $str_all; exit;
	    $resulst=$this->get_rsltset($str_all);	
	    $cnt = count($resulst);
		echo json_encode(array("cartcount"=>$cnt));
	}
	
    function addtocartlist($cartpage='',$filters='')
	{
		
		$prod_details 					= $this->cartProductList($filters);
		
		if($cartpage == 'cartpage' ) {
			return $prod_details;
			exit;		 
		}
         
		$grandtotal 					= 0; 
		$checkout 						= $this->loadModel('checkout_model'); 
		$helper 						= $this->loadHelper('common_function'); 
		
		$commondisplaylanguage  		= $helper->languagepagenames($_SESSION['lang_id'],'common');
		$headdisplaylanguage  			= $helper->languagepagenames($_SESSION['lang_id'],'head');
		$helper->getStoreConfig();	
		$childsid 						= $helper->getChildsId();
		$arrexcludecat					= explode(",",$childsid);
		$disgranttotal					= 0;
		foreach($prod_details as $cartlist){
			if(!in_array($cartlist['categoryID'],$arrexcludecat)){
				$totaprice 				= ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
				$disgranttotal 			+= $totaprice;
			}
		}	
		$discount 						= 0;
		$discountslap 					=  $checkout->chkDiscountSlap($disgranttotal);	
		if(count($prod_details) > 1){ $itemid =$commondisplaylanguage['items'];}else{
			//$itemid = $commondisplaylanguage['item'];
		}						
		$productlisthead 				= '  <button class="dropbtn"><span class="cart-items-icon"><i class="flaticon-cart" aria-hidden="true"></i></span> <span class="d-none d-sm-block">'.$commondisplaylanguage['mycart'].' ('.count($prod_details).') '.$itemid.' </span><span class="mobile-count d-block d-sm-none">'.count($prod_details).'</span></button> ';
		$productlist 					= '';			 
		if(count($prod_details)>0) {
				   
			$productlist 				= ' <div class="dropdown-content"><table class="table mb-0">';

			foreach( $prod_details as $cartlist ) { 
				
				$img 			= explode('|',$cartlist['img_names']);
				$cimgpath 		= $cartlist['attr_images']; 
				$imgpath 		=  $img[0];
				$single_price 	= $cartlist['final_price']; 
				$cartProductAmount = $cartlist['cartProductAmount'];
				$prodprice 		= ($cartlist['cartProductAmount'] * $cartlist['product_qty']);
				$discount 		= 0;

				if($discountslap['DiscountAmount']!=''){	
					if(!in_array($cartlist['categoryID'],$arrexcludecat)){
						if($discountslap['DiscountType']==1){
							$discount = (($cartlist['final_prod_attr'] * $cartlist['product_qty'])*$discountslap['DiscountAmount'])/100;
							$prodprice = $prodprice-$discount;
						}
						else{
							$discount = $discountslap['DiscountAmount'];
							$prodprice = $prodprice-$discount;
						} 
					}
				}
				   
				if( strtoupper($cartlist['taxTyp'])=="P"){											
					$totaprice = round($prodprice,2) + round((($prodprice * $cartlist['taxRate'])/100),2);
				} else if(strtoupper($cartlist['taxTyp'])=="F"){
					$totaprice = round($prodprice,2) +  round($cartlist['taxRate'],2);
				} else {
					$totaprice = round($prodprice,2);
				}		
				
				$strAttr='';
				if($cartlist['attr_values']!='')
				{
					$temparr=explode("||",$cartlist['attr_values']);
					$strAttr= "<p><small>".implode(" <br/>", $temparr)."</small></p>";
				}
				$arrpath=array(); 
				$helper->getProductPath($cartlist['categoryID'],$arrpath);

				$product_link = BASE_URL.'products/'.$cartlist['categoryCode'].'/'.$cartlist['product_url'];

				$productlist 	.= '<tr>
									<td><a href="'.$product_link.'" >';
				if($imgpath != ''){
					$productlist.='	<img src="'.img_base_url.'productassest/'.$cartlist['product_id'].'/photos/'.$imgpath.'" class="cart-items-image" alt="'.$cartlist["product_name"].'"  /> ';
				}else{
					$productlist.='	<img src="'.img_base_url.'uploads/noimage/photos/noimage.png" class="cart-items-image" alt="'.$cartlist["product_name"].'"  /> ';	
				}
				$productlist.=' </a>
										<input type="hidden" id="productid" value="'.$cartlist['cart_product_id'].'" >
									<button class="btn btn-danger btn-xs" type="button" title="Remove Product"  onclick="deletecartfunction('.$cartlist['cart_product_id'].');"><i class="flaticon-cancel-12"></i></button></td>
									<td><p class="header-cart-description"><a href="'.$product_link.'">'.$cartlist['product_name'].'</a></p>
									<small>'.str_replace("||","<br/>",$cartlist['attr_values']).'</small>
									</td>
									<td>
										<p class="header-cart-description"><span class="header-cart-price">$'.number_format($prodprice,2).'</span></p>
										<div class="text-right text-muted px-1"> Qty:'.$cartlist['product_qty'].' x $'.$cartlist['cartProductAmount'].'</div>
									</td>
								</tr>';
				$grandtotal += $prodprice;
			}  
   
  			$productlist.=' <tr class="no-border">
							<td colspan="2"><h4 class="text-right">'.$commondisplaylanguage['carttotal'].'</h4></td>
							<td><h4 class="text-right"><strong>$'.number_format($grandtotal,2).'</strong></h4></td>
						</tr>
						<tr class="no-border">
							<td colspan="3"><div class="row">
								<div class="col-6">
								<button class="btn btn-primary" onclick="window.location=\''.BASE_URL.'cart\'" type="button">'.$headdisplaylanguage['viewcart'].'<i class="flaticon-cart-2"></i></button>
								</div>
								<div class="col-6">
								<button class="btn btn-secondary" onclick="window.location=\''.BASE_URL.'checkout\'" type="button">'.$commondisplaylanguage['checkout'].' <i class="flaticon-check"></i></button>
								</div>
							</div></td>
						</tr>
						</table>   </div>';

		
		 	echo json_encode(array("productlist"=>$productlisthead.$productlist));
	    } else{
			$productlist .='<div class="dropdown-content"><table class="table mb-0">
                              <tr>
                                 <td>
                                 '.$commondisplaylanguage['nocartitem'].'
                                 </td>
                              </tr></table>   </div>';
			echo json_encode(array("productlist"=>$productlisthead.$productlist));
		}
		
	} 
	 
	 function deletecartproduct($filters)
	 {
		 $filters['carproid']=$this->real_escape_string($filters['carproid']);
		 $del_qry = "update ".TPLPrefix."cart_products set IsActive=2 where cart_product_id ='".$filters['carproid']."' and IsActive=1 ";
		 //echo $del_qry; exit;
		 $prod_del=$this->insert($del_qry);
		 
/*		 if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." "; */
		
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		    }
		    else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
			}
			$str_all="select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
		 //echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);
			
			
		//echo $str_all; exit;
	   // $resulst=$this->get_rsltset($str_all);
		$cnt = count($resulst);
		echo json_encode(array("rslt"=>"1","cartcount"=>$cnt,'checnt'=>$cnt));
	}
	 
	 
	 function deletecartpageproduct($filters)
	{
		$filters['carproid'] 	= $this->real_escape_string($filters['carproid']);
		$del_qry 				= "update ".TPLPrefix."cart_products set IsActive=2 where cart_product_id ='".$filters['carproid']."' and IsActive=1 ";
		$prod_del 				= $this->insert($del_qry); 
		
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid 	=  $_SESSION['Cus_ID'];
			$cus_groupid 	=  $_SESSION['cus_group_id'];
			$cond 			= " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry 		= " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		} else {
			$sessionId=session_id();
			$cond 			= " and t1.sessionId= '".$sessionId."' ";
			$joinqry 		= " inner join ".TPLPrefix."cart_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		}
		$str_all 			= "select t2.cart_product_id  from ".TPLPrefix."carts t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
		
		$resulst 			= $this->get_rsltset($str_all);
		$cnt 				= count($resulst); 	 
		$prod_details 		= $this->cartProductList($filters);
		
		return array("prod_details"=>$prod_details,"cartcount"=>$cnt);

	}
	
	
	function changequantity($filters)
	{
		$filters['cpid']=$this->real_escape_string($filters['cpid']);
		$filters['qty']=$this->real_escape_string($filters['qty']);
		
		$str_all="select minquantity from ".TPLPrefix."product t1 inner join ".TPLPrefix."cart_products t2  on t1.product_id=t2.product_id and t2.cart_product_id='".$filters['cpid']."' and t2.IsActive=1 where t1.IsActive=1 "; 
		//echo $str_all; exit;
	    $resulst=$this->get_a_line($str_all);	
		$minqty = $resulst['minquantity'];
		
		//Quantity update
		if($filters['qty']>=$minqty){
		$updateqry=" update ".TPLPrefix."cart_products set product_qty='".$filters['qty']."' where cart_product_id='".$filters['cpid']."' and IsActive=1  ";
		}
		else{
				$updateqry=" update ".TPLPrefix."cart_products set  IsActive=2 where cart_product_id='".$filters['cpid']."'   ";
		}
		$this->insert($updateqry);
		
		$prod_details = $this->cartProductList($filters);				
		return $prod_details;
	}
	
	function cartProductList($filters='',$orderjoinfields='',$orderjoinqry='',$isenableTax=0)
	{
		$finddiscountqry = $conqry = $joinqry = $skuimg = '';
		$joinfields = $joinfieldsafter = $limitqry = '';	
		
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$conqry.= " and c.customer_id=".$customerid." and c.customer_group_id=".$cus_groupid." ";
		}
		else{
			$sessionId=session_id();
			$conqry.= " and c.sessionId= '".$sessionId."' ";		
		}
	
		 $joinfieldsafter.=" , (SELECT  group_concat(distinct concat(attr.attributename,' : ',dp.dropdown_values) SEPARATOR  '||') 
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."carts_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
          AS attr_values ,  (CASE WHEN adrp.attr_combi_id <> '' THEN adrp.sku ELSE p.sku END)
          AS item_code   "  ; 
	
		$imgpath_con_qry= "1";
		$joinqry.=" inner join ".TPLPrefix."carts c on c.IsActive=1 
		inner join ".TPLPrefix."cart_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1 Left JOIN ".TPLPrefix."carts_products_attribute cpa
                ON  cpa.cart_id=cp.cart_id and cpa.cart_product_id = cp.cart_product_id
                   AND cpa.isactive = 1   ".$orderjoinqry;
		
		$joinqry.="   LEFT JOIN ".TPLPrefix."dropdown drp
        ON drp.dropdown_id = cpa.Attribute_value_id and drp.isactive=1      
			LEFT JOIN ".TPLPrefix."product_attr_combi adrp
			ON adrp.base_productId = cp.product_id
			  and   find_in_set(drp.dropdown_id,
							   REPLACE(adrp.attr_combi_id, '_', ','))       
			   AND adrp.IsActive = 1
			   AND adrp.outofstock = 0         
			   AND drp.isactive = 1
			   and  adrp.attr_combi_id=cp.attr_combi_id		
				";
		
		$joinfields=' ,cp.product_qty, cp.product_code, cp.product_amount as cartProductAmount,cat.categoryCode,cp.cart_product_id,cp.IsCustomtool,cp.CustomtoolImg '.$orderjoinfields;	
	
		if (($product instanceof product_model) != true ) {		
		$product=$this->loadModel('product_model');
		}
	
		$resDiscountSel 	= $product->getDiscountSelection('2','','0','1');
		 
		$joinqry 			.= $resDiscountSel['joinqry'];
		$joinfields 		.= $resDiscountSel['joinfields'];	
		$finddiscountqry 	.= $resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter 	.= $resDiscountSel['joinfieldsafter']; 
		
		$groupby			= " group by cp.cart_product_id ";
		$sortby 			= " order by cp.cart_product_id ";
		
		$strqry 			= $product->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,'',$conqry,$sortby,'',$groupby,'','',$imgpath_con_qry,1);	
		// echo $strqry;die;
		$prod_details 		= $this->get_rsltset($strqry);
		//echo "<pre>"; print_r($prod_details); exit;
		return $prod_details;
		
	}

}
?>