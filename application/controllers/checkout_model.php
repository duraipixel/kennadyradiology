<?php
class checkout_model extends Model {
	function getcpdiscount($cpcode)
	{
		//echo $cpcode; exit;
		if($cpcode!='')
		{
		$cpcode=str_replace(" ","",$cpcode);
		$cpcode=str_replace("'","",$cpcode);
		$cpcode=str_replace("*","",$cpcode);
		$cpcode=$this->real_escape_string($cpcode);
		$arrParam=array();
		$arrParam[]=$cpcode;
		$resgetcoupon = $this->get_a_line_bind(" select c.CouponID,c.CouponCatType,ifnull(o.cnt,0) as ocnt, c.CouponPerUser from ".TPLPrefix."coupons c
			inner join ".TPLPrefix."couponapplied ca on ca.cpnappid=c.CouponCatType and ca.IsActive=1
			left join ( select couponcode,count(couponcode) as cnt from ".TPLPrefix."orders where IsActive=1 and customer_id ='".$_SESSION['Cus_ID']."'  group by couponcode )
			o on o.couponcode=c.CouponCode  
			where '".date("Y-m-d")."' between date(c.CouponStartDate) and date(c.CouponEndDate) and c.CouponCode COLLATE latin1_general_cs LIKE ?
			and c.NoofCouponUsed<=c.CouponTotal and c.IsActive=1 group by c.CouponCode ",$arrParam);  
	
		
		
		if($resgetcoupon['CouponID']!=''){
			
		  if(!empty($resgetcoupon['CouponPerUser']) && $resgetcoupon['CouponPerUser']<=$resgetcoupon['ocnt'] )
		  {
			return json_encode(array("rslt"=>0,"msg"=>" This coupon code already used ".$resgetcoupon['ocnt']." times " ));
		  }	
			
		$joinqry='';
		$isenabletax=0;
		
		
		switch($resgetcoupon['CouponCatType'])
		{	
		  case "1" :
		            
					$joinqry.= "  inner join ".TPLPrefix."cart_products cp on  cp.product_id=p.product_id and cp.IsActive=1
					inner join ".TPLPrefix."carts c1 on cp.cart_id=c1.cart_id and c1.IsActive=1 and c1.customer_id='".$_SESSION['Cus_ID']."'         
					inner join ".TPLPrefix."coupons c on find_in_set(cp.product_id,c.CouponProducts)
					and c.IsActive=1 and c.CouponCode=? and  '".date("Y-m-d")."' between date(c.CouponStartDate) and date(c.CouponEndDate)
					and c.NoofCouponUsed<=c.CouponTotal 
					";
					$isenabletax=0;
					break;
		  case "2" :
		             
					$joinqry.= "  inner join ".TPLPrefix."cart_products cp on  cp.product_id=p.product_id and cp.IsActive=1
					inner join ".TPLPrefix."carts c1 on cp.cart_id=c1.cart_id and c1.IsActive=1 and c1.customer_id='".$_SESSION['Cus_ID']."'         
					inner join ".TPLPrefix."coupons c on find_in_set(cat.categoryID,c.CouponCategorys)
					and c.IsActive=1 and c.CouponCode=? and  '".date("Y-m-d")."' between date(c.CouponStartDate) and date(c.CouponEndDate)
					and c.NoofCouponUsed<=c.CouponTotal   ";
					$isenabletax=0;
					break;	
		   case "4" :
		             
					$joinqry.= "  inner join ".TPLPrefix."cart_products cp on  cp.product_id=p.product_id and cp.IsActive=1
					inner join ".TPLPrefix."carts c1 on cp.cart_id=c1.cart_id and c1.IsActive=1 and c1.customer_id='".$_SESSION['Cus_ID']."'         
					inner join ".TPLPrefix."coupons c on  if(c.CustomerIds!='', find_in_set('".$_SESSION['Cus_ID']."',c.CustomerIds) , find_in_set('".$_SESSION['cus_group_id']."',c.customergroupid  )) 
					and c.IsActive=1 and c.CouponCode=? and  '".date("Y-m-d")."' between date(c.CouponStartDate) and date(c.CouponEndDate)
					and c.NoofCouponUsed<=c.CouponTotal   ";
					$isenabletax=1;
					break;	
		   case "3" :
		                
						$joinqry.= "  inner join ".TPLPrefix."cart_products cp on  cp.product_id=p.product_id and cp.IsActive=1
						inner join ".TPLPrefix."carts c1 on cp.cart_id=c1.cart_id and c1.IsActive=1 and c1.customer_id='".$_SESSION['Cus_ID']."'         
						inner join ".TPLPrefix."coupons c on  c.IsActive=1 and c.CouponCode=? and  '".date("Y-m-d")."' between date(c.CouponStartDate) and date(c.CouponEndDate)
						and c.NoofCouponUsed<=c.CouponTotal   ";
						$isenabletax=1;
					break;	
					
					
		  default:
					return json_encode(array("rslt"=>0,"msg"=>"Invalid Coupon Code"));
				
					break;
					 
		}
		
		$product=$this->loadModel('product_model');
		
		$resDiscountSel=$product->getDiscountSelection();
		 
		 $joinqry.=$resDiscountSel['joinqry'];
		
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		
		 $joinfieldsafter.=" , @attr_price:=( select sum(adrp.price)  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."carts_products_attribute cpa on find_in_set(cpa.Attribute_value_id, REPLACE(adrp.attr_combi_id,'_',',')) and cpa.isactive=1
		where adrp.base_productId=p.product_id  and cpa.cart_product_id = cp.cart_product_id and adrp.IsActive=1 and cpa.Attribute_id=4) as attr_price , @other_attr_price:=( select sum(adrp.price)  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."carts_products_attribute cpa on find_in_set(cpa.Attribute_value_id, REPLACE(adrp.attr_combi_id,'_',',')) and cpa.isactive=1
		where adrp.base_productId=p.product_id  and cpa.cart_product_id = cp.cart_product_id and adrp.IsActive=1 and cpa.Attribute_id<>4) as other_attr_price  "  ; 
		
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		
		
		$selectqry = " select ";
		
		$joinfields=trim($joinfields," ,");
		
		
		if($isenabletax==0){	
		$joinfieldsafter.= "  , c.CouponID,c.CouponTitle,c.CouponCode,c.Couponpriority,c.CouponAppend,c.CouponAmount,c.CouponType, 
          @final_price_tax,c.CouponCatType,
          @coupon_price :=
          ROUND(
             CASE
                WHEN     c.CouponAmount IS NOT NULL
                     AND c.CouponAmount != ''
                     AND c.CouponAmount != '0.00'
                THEN
                   CASE
                      WHEN c.CouponType = 1
                      THEN
                         ((@final_price * c.CouponAmount) / 100) *cp.product_qty
                      WHEN c.CouponType = 2
                      THEN
                          c.CouponAmount
                   END
             END,2)
          AS coupon_price " ;
		}
		else if($isenabletax==1)
		{
			$joinfieldsafter.=" ,c.CouponID,c.CouponTitle,c.CouponCode,c.Couponpriority,c.CouponAppend,c.CouponAmount,c.CouponMinAmt,cp.product_qty,c.CouponType,c.CouponCatType  ";
			
		}
		
		
	
		$groupby=" group by cp.cart_product_id ";
		 $strqry=$product->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,$attrjoinqry,$conqry,'','',$groupby,'',$selectqry);
		
		  $strqry= $selectqry.trim($strqry," ,"); 
		
		if($isenabletax==0){
	  
		$productcoupon=$this->get_a_line_bind(" select CouponID,CouponTitle,CouponCode,CouponAmount,Couponpriority,CouponAppend,CouponType,CouponCatType, sum(coupon_price) as coupon_price  from (".$strqry." ) tab ",$arrParam);
		
		}
		else if($isenabletax==1)
		{
		   			
		$productcoupon=$this->get_a_line_bind(" select CouponID,CouponTitle,CouponCode,Couponpriority,CouponAppend,CouponCatType,CouponAmount,CouponMinAmt,CouponType,sum(final_price_tax*product_qty) as final_price_amt,
       @coupon_price:=ROUND(case when  CouponType='1' then 
             ((sum(final_price_tax*product_qty)*CouponAmount)/100)
           else
            CouponAmount 
            end,2 ) as coupon_price  from (".$strqry." ) tab  ",$arrParam);
			
		
		
		  if($productcoupon['final_price_amt']<$productcoupon['CouponMinAmt'] && $resgetcoupon['CouponCatType']==3 )
		  {
			  	return json_encode(array("rslt"=>0,"msg"=>" Order Value less than INR".$productcoupon['CouponMinAmt'] ));
				exit;
			  
		  }
			
		}
		
	//	print_r($productcoupon); die();
		//return $productcoupon;
	return json_encode(array("rslt"=>1,"couponamt"=>$productcoupon['coupon_price'],"coupontit"=>$productcoupon['CouponTitle'],"coupon"=>$productcoupon['CouponCode'],"coupontype"=>$productcoupon['CouponType'],"couponvalue"=>$productcoupon['CouponAmount'],"CouponCatType"=>$productcoupon['CouponCatType']));
		
			}
			else
				{
				 return json_encode(array("rslt"=>0,"msg"=>" Invalid Coupon Code"));
				}	
		}	
		else
		{
		  return json_encode(array("rslt"=>0,"msg"=>"Invalid Coupon Code"));
		}	
	}
	
	
	
	function shippingmethod($orderamt='',$countryid='',$stateid='',$cityid='',$pincode=''){
	
		//$shipping_Qtr = "select * from ".TPLPrefix."shippingmethods  where IsActive=1 order by sortby asc ";
		$conditionqry='';
		if($orderamt!='')
		{
			$minamtqry=" and  ( sf.orderMinimum <= '".$orderamt ."' and sf.orderMinimum>0 ) ";			
		}
		
		if($countryid!='' || $stateid!='' || $cityid!='' || $pincode!='')
		{
		$conditionqry.="	and (case  ";
			if($pincode!='')
			 $conditionqry.=" when sf.pincodeid is not null then pc.pincode in ('".$pincode."')";	
			if($cityid!='')
			 $conditionqry.="  when sf.cityid is not null then ct.cityid in (".$cityid.")";	
		 if($stateid!='')
			 $conditionqry.=" when sf.stateid is not null then st.stateid in (".$stateid.")";	
		 if($countryid!='')
			 $conditionqry.=" when sf.countryid is not null then c.countryid  in (".$countryid.")";	
			
			
		$conditionqry.="	end )  ";	
		}

		
		$freeshipping_Qtr = " select s.* from ".TPLPrefix."shippingmethods s 
							left join ".TPLPrefix."shipping_flat sf on sf.shippingId = s.shippingId and sf.IsActive=1 

							left join ".TPLPrefix."country c on find_in_set(c.countryid,sf.countryid) and c.IsActive=1
							left join ".TPLPrefix."state st on find_in_set(st.stateid,sf.stateid)  and c.countryid = st.countryid and st.IsActive=1
							left join ".TPLPrefix."city ct on find_in_set(ct.cityid,sf.cityid )  and ct.stateid = st.stateid and ct.IsActive=1
							left join ".TPLPrefix."pincode pc on find_in_set(pc.pincodeid,sf.pincodeid) and pc.cityid = ct.cityid and pc.IsActive=1

							where s.IsActive=1  and s.shippingCode='free'  ".$conditionqry.$minamtqry."							
							group by sf.flatshippingId
							order by s.sortby asc ";
				
		$resulst=$this->get_rsltset($freeshipping_Qtr);	
		
		if(count($resulst)=='0')
		{
		if($orderamt!='')
		{
			$minamtqry=" and  ( sf.orderMinimum <= '".$orderamt ."' ) ";			
		}
			
			$shipping_Qtr = " select s.* from ".TPLPrefix."shippingmethods s 
							left join ".TPLPrefix."shipping_flat sf on sf.shippingId = s.shippingId and sf.IsActive=1 

							left join ".TPLPrefix."country c on find_in_set(c.countryid,sf.countryid) and c.IsActive=1
							left join ".TPLPrefix."state st on find_in_set(st.stateid,sf.stateid)  and c.countryid = st.countryid and st.IsActive=1
							left join ".TPLPrefix."city ct on find_in_set(ct.cityid,sf.cityid )  and ct.stateid = st.stateid and ct.IsActive=1
							left join ".TPLPrefix."pincode pc on find_in_set(pc.pincodeid,sf.pincodeid) and pc.cityid = ct.cityid and pc.IsActive=1

							where s.IsActive=1  and s.shippingCode!='free'   ".$conditionqry."							
							group by sf.flatshippingId
							order by s.sortby asc ";
			$resulst=$this->get_rsltset($shipping_Qtr);	
			
		}
		//print_r($resulst); die();
		
		return $resulst;
    }
	
	function modelname($shippingcode)
	{
		$shippingcode=$this->real_escape_string($shippingcode);
		$shipping_Qtr = "select modelname,shippingId from ".TPLPrefix."shippingmethods  where shippingCode =? and IsActive=1 ";
		//echo $shipping_Qtr; exit;
		$resulst=$this->get_a_line_bind($shipping_Qtr,array($shippingcode));	
		return $resulst;
	}
	
	function Paymentmethod($pay_code=""){
		$conqry="";
		$pay_code=$this->real_escape_string($pay_code);
		if($pay_code!="")
		{
				$conqry=" and  pl.pay_code=? ";
			
		}	
		$paymeny_qry = "select * from ".TPLPrefix."paymentgateway_det pl inner join ".TPLPrefix."payment_master pm on pm.pmasterid=pl.pg_id and  pm.IsActive=1 where pl.IsActive=1 and FIND_IN_SET('".$_SESSION['cus_group_id']."', pl.custom_groupid) $conqry group by pm.pmasterid  order by pl.sortingorder asc";
		//echo $paymeny_qry; 
		$resulst=$this->get_rsltset_bind($paymeny_qry,array($pay_code));
		//print_r($resulst); die();	
		return $resulst;
    }
	
	function chkDiscountSlap($grandtotal)
    {
		$grandtotal=$this->real_escape_string($grandtotal);
		$today = date('Y-m-d');
		 $discount_slab ="SELECT DiscountType,DiscountAmount,DiscountTitle FROM ".TPLPrefix."discount d WHERE DiscountCatType = 5 AND IsActive = 1 and '".$today."' between d.DiscountStartDate and  d.DiscountEndDate AND ( case when (SELECT  (Discountslabamt - 1) FROM ".TPLPrefix."discount WHERE DiscountCatType = 5 AND IsActive = 1 AND Discountslabamt > d.Discountslabamt and '".$today."' between DiscountStartDate and  DiscountEndDate ORDER BY Discountslabamt LIMIT 0, 1) is not null then ? BETWEEN d.Discountslabamt and (SELECT  (Discountslabamt - 1) FROM ".TPLPrefix."discount WHERE  DiscountCatType = 5 AND IsActive = 1 AND Discountslabamt > d.Discountslabamt and  '".$today."' between DiscountStartDate and  DiscountEndDate ORDER BY Discountslabamt LIMIT 0, 1) else ?>= (SELECT  (Discountslabamt) FROM ".TPLPrefix."discount WHERE DiscountCatType = 5 AND IsActive = 1 and  '".$today."' between DiscountStartDate and  DiscountEndDate ORDER BY Discountslabamt desc LIMIT 0, 1)end)ORDER BY Discountslabamt";
	    
	    $resulst=$this->get_a_line_bind($discount_slab,array($grandtotal,$grandtotal));	
	    return $resulst;
	
    }
}



?>