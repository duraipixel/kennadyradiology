<?php
class wishlist_model extends Model {
	################## Cart Page ###############
	
	function addtowishlist_insert($filters)
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
		
		//print_r($filters); die(); 
		
		$str_all="select t1.cart_id from ".TPLPrefix."wishlists t1 where t1.IsActive=1 ".$cond." "; 
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
					$joinqry .="inner join   ".TPLPrefix."wishlist_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}	
				if(strpos($key,"iconatt_")!== false)
				{
					if($valu!=""){
					$joinqry .="inner join   ".TPLPrefix."wishlist_products_attribute  pa".$qryinx." on pa".$qryinx.".cart_product_id=t2.cart_product_id and pa".$qryinx.".IsActive=1 and pa".$qryinx.".Attribute_value_id='".$valu."' "; 
					}
					$qryinx+=1;	
				}
			}
		
		
		$filters['proid']=$this->real_escape_string($filters['proid']);
		 $str_alls="select t2.cart_product_id from ".TPLPrefix."wishlists t1 inner join ".TPLPrefix."wishlist_products t2 on t1.cart_id=t2.cart_id and t2.IsActive=1 and t2.product_id='".$filters['proid']."' ".$joinqry." where t1.IsActive=1 ".$cond." "; 
		
		//echo $str_alls;
	    $resulsts=$this->get_a_line($str_alls);	
		//print_r( $resulsts); die();
		$wishlist='';
	    if(count($resulsts)==0){  //check product ID
			
			if(count($resulst)==0){ // check customer 
			//cart Table	 
			$strQry ="INSERT INTO  ".TPLPrefix."wishlists (customer_id, customer_group_id,sessionId,ip, IsActive, UserId, CreatedDate,ModifiedDate ) VALUES ( '".$this->getRealescape($customerid)."','".$this->getRealescape($cus_groupid)."','".$sessionId."','','1',0,'".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
			$rsltMenu=$this->insert($strQry);
			$insert_cartid = $this->lastInsertId();
			}
			else
			{
				$insert_cartid =$cart_id;
			}
			
			//Cart Product Table
			 $strQry ="INSERT INTO  ".TPLPrefix."wishlist_products (cart_id, product_id, product_qty, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$insert_cartid."','".$this->getRealescape($filters['proid'])."','".$this->getRealescape($filters['minqty'])."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
			
			$rsltMenu=$this->insert($strQry);
			$insert_cartproid = $this->lastInsertId();
			
			$did=array();
			$aid=array();
			foreach($filters as $key=>$valu)
			{
				$valu=$this->real_escape_string($valu);
				if(strpos($key,"selattr_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					$strQry ="INSERT INTO  ".TPLPrefix."wishlist_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$this->getRealescape($insert_cartid)."','".$this->getRealescape($insert_cartproid)."','".$this->getRealescape($aid)."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}	
				
				if(strpos($key,"iconatt_")!== false)
				{
					
					$aid=(explode("_",$key))[1];
					if($valu!=""){
					$strQry ="INSERT INTO  ".TPLPrefix."wishlist_products_attribute (cart_id, cart_product_id, Attribute_id,Attribute_value_id, IsActive, CreatedDate,ModifiedDate ) VALUES ( '".$this->getRealescape($insert_cartid)."','".$this->getRealescape($insert_cartproid)."','".$this->getRealescape($aid)."','".$valu."','1','".$this->getRealescape($today)."','".$this->getRealescape($today)."');"; 
					$rsltMenu=$this->insert($strQry);
					}
				}
			}
			
			//Cart Product Attribute Table
			
			
			if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		    }
		    else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
			}
			$str_all="select t2.cart_product_id  from ".TPLPrefix."wishlists t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
			//echo $str_all; exit;
			$resulst=$this->get_rsltset($str_all);
			$cnt = count($resulst);
			
			
			
			echo json_encode(array("rslt"=>1,"wishlistcount"=>'('.$cnt.')'));
		}
		else
		{
			echo json_encode(array("rslt"=>2));
		}
	}
	
	function addtowishlistcount()
	{ 
	    if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		}
		else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 inner join ".TPLPrefix."product t3 on t3.product_id=t2.product_id and t3.IsActive=1 inner join ".TPLPrefix."product_categoryid t4 on t4.product_id=t3.product_id and t4.IsActive=1 inner join ".TPLPrefix."category t5 on t5.categoryID=t4.categoryID and t5.IsActive=1 ";
		}
		$str_all="select t2.cart_product_id  from ".TPLPrefix."wishlists t1 ".$joinqry." where t1.IsActive=1 ".$cond." group by t2.cart_product_id "; 
		//echo $str_all; exit;
	    $resulst=$this->get_rsltset($str_all);	
	    $cnt = count($resulst);
		echo json_encode(array("wishlistcount"=>'('.$cnt.')'));
	}
	
	function addtowishlist($wishlistpage='')
	 {
		
		
		
		$conqry='';	
		$joinqry='';
		$skuimg='';
		$joinfields='';			
		$limitqry='';	
		
		if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
			$joinqry.=" left join ".TPLPrefix."discount d_cust on if(d_cust.CustomerIds<>'',find_in_set('".$_SESSION['Cus_ID']."',d_cust.CustomerIds),find_in_set('".$_SESSION['cus_group_id']."',d_cust.customergroupid)) and d_cust.IsActive=1 and '".date('Y-m-d')."' between d_cust.DiscountStartDate and d_cust.DiscountEndDate ";
			$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount ";
			
		}
			
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and c.customer_id=".$customerid." and c.customer_group_id=".$cus_groupid." ";
		}
		else{
			$sessionId=session_id();
			$cond = " and c.sessionId= '".$sessionId."' ";		
		}
		
		/* $strqry=" select p.product_id,p.product_name,p.longdescription,p.sku,p.product_url,p.price,p.specialprice,p.spl_fromdate,p.spl_todate,p.isnewproduct,p.newprod_fromdate,p.newprod_todate,p.soldout,p.minquantity,pc.categoryID,t.taxTyp,t.taxRate,d_prod.DiscountType  as prod_DiscountType,d_prod.DiscountAmount  as prod_DiscountAmount ,d_cat.DiscountType as   cat_DiscountType,d_cat.DiscountAmount as cat_DiscountAmount,group_concat(DISTINCT img.img_path
        ORDER BY img.ordering ASC  SEPARATOR '|') as img_names,cp.product_qty,cp.cart_product_id ".$joinfields." from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1 
		inner join ".TPLPrefix."wishlists c on c.IsActive=1 ".$cond."
		inner join ".TPLPrefix."wishlist_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1 
		left join ".TPLPrefix."product_images img on img.product_id=p.product_id and img.IsActive=1 ".$skuimg." left join ".TPLPrefix."discount d_prod on find_in_set(p.product_id,d_prod.DiscountProducts) and d_prod.IsActive=1 and '".date('Y-m-d')."' between d_prod.DiscountStartDate and d_prod.DiscountEndDate 
		left join ".TPLPrefix."discount d_cat on find_in_set(p.product_id,d_cat.DiscountProducts) and d_cat.IsActive=1
		and '".date('Y-m-d')."' between d_cat.DiscountStartDate and d_cat.DiscountEndDate ".$joinqry." where p.IsActive=1  ".$conqry." group by cp.cart_product_id" ;  
		
		$prod_details=$this->get_rsltset($strqry); */
		
		$prod_details=$this->WishllistProductList('');		
		//echo "<pre>"; print_r($prod_details); exit;
		if($wishlistpage=='wishlistpage'){
		 return $prod_details;
         exit;		 
		}
		//echo "<pre>"; print_r($prod_details); exit;
         
					$grandtotal=0; 
					$helper=$this->loadHelper('common_function'); 
					$helper->getStoreConfig();
					
					$checkout = $this->loadModel('checkout_model'); 
					
				$disgranttotal=0;
				 foreach($prod_details as $cartlist){
					$totaprice = ($cartlist['final_price'] * $cartlist['product_qty']);
					$disgranttotal+=$totaprice;
				 }	
				$discount =0;
				$discountslap =  $checkout->chkDiscountSlap($disgranttotal);	
					
					$productlist=' <div class="itemlist-scroller"> ';
					if(count($prod_details)>0){
					foreach($prod_details as $cartlist){ 
					$img = explode('|',$cartlist['img_names']);
					$imgpath =  $img[0];
					$single_price = $cartlist['final_price'];  
					$prodprice = ($cartlist['final_price'] * $cartlist['product_qty']);
					$discount =0;
					if($discountslap['DiscountAmount']!=''){												
							if($discountslap['DiscountType']==1){
							$discount = ($prodprice*$discountslap['DiscountAmount'])/100;
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
					
					$productlist.='<div class="itemlist">
							<ul class="list-inline">
									<li class="cartimage">
										<span>
										<a href="'.$helper->pathrevise($arrpath).'/'.$cartlist['product_url'].'" class="prdsingle-inner">		<img src="'.BASE_URL.'uploads/productassest/'.$cartlist['product_id'].'/photos/'.$imgpath.'" class="img-responsive" alt="" /></a>
										</span>
									</li>
									<li class="cartprd-name">
										<a href="'.$helper->pathrevise($arrpath).'/'.$cartlist['product_url'].'" >	<span>
											'.$cartlist['product_name'].$strAttr.'
										</span></a>
									</li>
									<li class="cart-quantity">
										<span>
											&times;'.$cartlist['product_qty'].'
										</span>
									</li>
									<li class="cartprd-price">
										<span class="cart-price">
											<i class="fa fa-inr"></i>'.number_format($totaprice,2).'
										</span>
									</li>
									<li class="cartprd-remover">
									<!-- this hidden field get  product id for delete wislist image product -->
									<input type="hidden" id="productid" value="'.$cartlist['cart_product_id'].'" > 
									<!-- this hidden field get  product id for delete wislist image product -->
									<input type="hidden" id="productid_wishlist" value="'.$cartlist['product_id'].'" > 
										<span class="remove-item" onclick="deletewishlist('.$cartlist['cart_product_id'].','.$cartlist['minquantity'].');">
											&times; 
										</span>
									</li>
							</ul> 
						</div>';

					  $grandtotal += $totaprice;
					}  
					$productlist.='</div> ';
				
		 $productlist.='<div class="cartamount-wraper text-right">
							<span class="cartlabel">Total :</span>
							<span class="cartamount"><i class="fa fa-inr"></i>'.number_format($grandtotal,2).'</span>
						</div>';
						
						$productlist.='<div class="cartbtn-wraper text-right">
							<a href="'.BASE_URL.'wishlist" class="commonbtn viewcart-btn" ><span>View wishlist</span></a>	
								
						</div>';
						
		
		
		 echo json_encode(array("productlist"=>$productlist));
	    }else{
			$productlist.='<div class=" text-center nocart-caption">There are no items in the Wishlist. Why don’t you add now?</div>';
		echo json_encode(array("productlist"=>$productlist));	
		}
		
	}
	
	function deletewishlistproduct($filters)
	{
		$filters['carproid']=$this->real_escape_string($filters['carproid']);
		 $del_qry = "update ".TPLPrefix."wishlist_products set IsActive=2 where cart_product_id = '".$filters['carproid']."' and IsActive=1 ";
		 //echo $del_qry; exit;
		 $prod_del=$this->insert($del_qry);
		 
		 if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		$str_all="select t2.cart_product_id  from ".TPLPrefix."wishlists t1 ".$joinqry." where t1.IsActive=1 ".$cond." "; 
		//echo $str_all; exit;
	    $resulst=$this->get_rsltset($str_all);
		$cnt = count($resulst);
		echo json_encode(array("rslt"=>"1","wishlistcount"=>'('.$cnt.')'));
	}
	
	 function deletewishlistpageproduct($filters)
	{
		$filters['carproid']=$this->real_escape_string($filters['carproid']);
		 $del_qry = "update ".TPLPrefix."wishlist_products set IsActive=2 where cart_product_id = '".$filters['carproid']."' and IsActive=1 ";
		 $prod_del=$this->insert($del_qry); 
	
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and t1.customer_id=".$customerid." and t1.customer_group_id=".$cus_groupid." ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		else{
			$sessionId=session_id();
			$cond = " and t1.sessionId= '".$sessionId."' ";
			$joinqry = " inner join ".TPLPrefix."wishlist_products t2 on t2.cart_id=t1.cart_id and t2.IsActive=1 ";
		}
		$str_all="select t2.cart_product_id  from ".TPLPrefix."wishlists t1 ".$joinqry." where t1.IsActive=1 ".$cond." "; 
		//echo $str_all; exit;
	    $resulst=$this->get_rsltset($str_all);
		$cnt = count($resulst); 
			 
		$conqry='';	
		$joinqry='';
		$skuimg='';
		$joinfields='';			
		$limitqry='';	
		
		/*if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
			$joinqry.=" left join ".TPLPrefix."discount d_cust on if(d_cust.CustomerIds<>'',find_in_set('".$_SESSION['Cus_ID']."',d_cust.CustomerIds),find_in_set('".$_SESSION['cus_group_id']."',d_cust.customergroupid)) and d_cust.IsActive=1 and '".date('Y-m-d')."' between d_cust.DiscountStartDate and d_cust.DiscountEndDate ";
			$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount ";
			
		} */
			
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$cond = " and c.customer_id=".$customerid." and c.customer_group_id=".$cus_groupid." ";
		}
		else{
			$sessionId=session_id();
			$cond = " and c.sessionId= '".$sessionId."' ";		
		}
		
		 /*$strqry=" select p.product_id,p.product_name,p.longdescription,p.sku,p.product_url,p.price,p.specialprice,p.spl_fromdate,p.spl_todate,p.isnewproduct,p.newprod_fromdate,p.newprod_todate,p.soldout,p.minquantity,pc.categoryID,t.taxTyp,t.taxRate,d_prod.DiscountType  as prod_DiscountType,d_prod.DiscountAmount  as prod_DiscountAmount ,d_cat.DiscountType as   cat_DiscountType,d_cat.DiscountAmount as cat_DiscountAmount,group_concat(DISTINCT img.img_path
        ORDER BY img.ordering ASC  SEPARATOR '|') as img_names,cp.product_qty,cp.cart_product_id ".$joinfields." from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1 
		inner join ".TPLPrefix."wishlists c on c.IsActive=1 ".$cond."
		inner join ".TPLPrefix."wishlist_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1 
		left join ".TPLPrefix."product_images img on img.product_id=p.product_id and img.IsActive=1 ".$skuimg." left join ".TPLPrefix."discount d_prod on find_in_set(p.product_id,d_prod.DiscountProducts) and d_prod.IsActive=1 and '".date('Y-m-d')."' between d_prod.DiscountStartDate and d_prod.DiscountEndDate 
		left join ".TPLPrefix."discount d_cat on find_in_set(p.product_id,d_cat.DiscountProducts) and d_cat.IsActive=1
		and '".date('Y-m-d')."' between d_cat.DiscountStartDate and d_cat.DiscountEndDate ".$joinqry." where p.IsActive=1  ".$conqry." group by cp.cart_product_id" ;  
		
		$prod_details=$this->get_rsltset($strqry);  */
		
		$prod_details=$this->WishllistProductList($filters);		
		
		return array("prod_details"=>$prod_details,"wishlistcount"=>$cnt);
	}
	function WishllistProductList($filters='')
	{
		$conqry='';	
		$joinqry='';
		$skuimg='';
		$joinfields='';	
		$joinfieldsafter='';	
		$limitqry='';	
		
		// if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		// {
			// $joinqry.=" left join ".TPLPrefix."discount d_cust on if(d_cust.CustomerIds<>'',find_in_set('".$_SESSION['Cus_ID']."',d_cust.CustomerIds),find_in_set('".$_SESSION['cus_group_id']."',d_cust.customergroupid)) and d_cust.IsActive=1 and '".date('Y-m-d')."' between d_cust.DiscountStartDate and d_cust.DiscountEndDate ";
			// $joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount ";
			
		// }
			
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			 
			$customerid =  $_SESSION['Cus_ID'];
			$cus_groupid =  $_SESSION['cus_group_id'];
			$conqry.= " and c.customer_id='".$customerid."' and c.customer_group_id='".$cus_groupid."' ";
		}
		else{
			$sessionId=session_id();
			$conqry.= " and c.sessionId= '".$sessionId."' ";		
		}
		
		 $joinfieldsafter.=" , @attr_price:=( select sum(adrp.price)  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."wishlist_products_attribute cpa on find_in_set(cpa.Attribute_value_id, REPLACE(adrp.attr_combi_id,'_',',')) and cpa.isactive=1
		where adrp.base_productId=p.product_id  and cpa.cart_product_id = cp.cart_product_id and adrp.IsActive=1 and cpa.Attribute_id=4) as attr_price , @other_attr_price:=( select sum(adrp.price)  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."wishlist_products_attribute cpa on find_in_set(cpa.Attribute_value_id, REPLACE(adrp.attr_combi_id,'_',',')) and cpa.isactive=1
		where adrp.base_productId=p.product_id  and cpa.cart_product_id = cp.cart_product_id and adrp.IsActive=1 and cpa.Attribute_id<>4) as other_attr_price , (SELECT  group_concat(concat(attr.attributename,' : ',dp.dropdown_values) SEPARATOR  '||') 
           FROM ".TPLPrefix."product_attr_combi adrp
                INNER JOIN ".TPLPrefix."wishlist_products_attribute cpa
                   ON     find_in_set(cpa.Attribute_value_id,
                                      REPLACE(adrp.attr_combi_id, '_', ','))
                      AND cpa.isactive = 1
                inner join ".TPLPrefix."dropdown dp on dp.dropdown_id=cpa.Attribute_value_id      
                inner join ".TPLPrefix."m_attributes attr on attr.attributeid=cpa.Attribute_id      
           WHERE     adrp.base_productId =p.product_id 
                 AND cpa.cart_product_id = cp.cart_product_id
                 AND adrp.IsActive = 1)
          AS attr_values  "  ; 
	
		$joinqry.=" inner join ".TPLPrefix."wishlists c on c.IsActive=1 ".$cond."
		inner join ".TPLPrefix."wishlist_products cp on cp.cart_id=c.cart_id and cp.product_id=p.product_id and cp.IsActive=1  ";
		$joinfields=' ,cp.product_qty,cp.cart_product_id ';	
		
		$product=$this->loadModel('product_model');
		
		$resDiscountSel=$product->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		
		$groupby=" group by cp.cart_product_id ";
		$sortby=" order by cp.cart_product_id ";
		
		 $strqry=$product->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,'',$conqry,$sortby,'',$groupby);
        //echo "<pre>"; print_r($strqry); exit;		 
		$prod_details=$this->get_rsltset($strqry);
		return $prod_details;
		
	}

}