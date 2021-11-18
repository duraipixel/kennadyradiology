<?php
define("markup_calc",(markup_pent/100));
class product_model extends Model {
	function getproductfeature_list($product_id=null){
		$features = "select * from ".TPLPrefix."product_list_features where product_id = ? and IsActive = 1 order by sortingorder asc ";
		$result = $this->get_rsltset_bind($features,array($product_id));
		return $result;
	}
	
	function othercategorylist($catid){
		
		/*$othercategory = "select c.* from ".TPLPrefix."product p 
		inner join ".TPLPrefix."product_categoryid pc on pc.product_id = p.product_id and pc.IsActive=1
		inner join ".TPLPrefix."category c on c.categoryID=pc.categoryID and c.parentId=0 and c.IsActive=1
		where c.categoryID not in(".$catid.") and p.IsActive = ? group by c.categoryID order by c.sortingOrder asc ";*/
		
		 $parentcatid_qry = "select parentId from ".TPLPrefix."category where categoryID = ".$catid." and parentId !=0 and IsActive = ? ";
		$parentcatid = $this->get_a_line_bind($parentcatid_qry,array(1));
		//print_r($parentcatid); exit;
		if(count($parentcatid)>0){
			$parentcatid = $parentcatid['parentId'];
		}else{
			$parentcatid = $catid;
		}
		
		$othercategory = "select * from ".TPLPrefix."category where categoryID not in(".$parentcatid.") and parentId=0 and IsActive = ? order by sortingOrder asc ";
		
		$result = $this->get_rsltset_bind($othercategory,array(1));
		return $result;
	}

	function trendingcategorys(){
		
	  $trendingcategory = "select c.*,(select t1.categoryCode from ".TPLPrefix."category t1 where t1.categoryID = c.parentId and t1.IsActive=1) as parentslug from ".TPLPrefix."category c where c.trending_categorys=1 and c.IsActive = ?  and c.lang_id = ".$_SESSION['lang_id']." order by c.sortingOrder asc "; 	 
		$result = $this->get_rsltset_bind($trendingcategory,array(1));
		//print_r($result);
		return $result;

	}	
	function homevideolists(){
		
	  $videolist = "select * from ".TPLPrefix."videos where IsActive=1 and lang_id = ".$_SESSION['lang_id']." order by video_id asc "; 	 
		$result = $this->get_rsltset_bind($videolist,array(1));
		//print_r($result);
		return $result;

	}	
	
	function productlists($catcode,$catid='0',$searchkey='',$page='1',$filters='',$limit='15',$iscount='1',$type='',$productid='',$homeslidertitle='',$productidarr=array(),$catidarr=array())
	{
		$conqry='';	
		$joinqry='';
		$joinfields='';	
		$finaldiscountqry='';	
		$joinfieldsafter='';	
		$limitqry='';		
		$havingqry=	array();	
		$arrparams=array();
		if(trim($catid)!='' && empty($filters['subcatid']))
		{
		//	echo $catid;
		/*	echo  " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ?) temp1
											   WHERE IsActive=1 and lang_id = ".$_SESSION['lang_id']."
											) temp2";*/
											
			$catid=$this->real_escape_string($catid);
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line_bind( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ?) temp1
											   WHERE IsActive=1 and lang_id = ".$_SESSION['lang_id']."
											) temp2 ",array($catid) );
			
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".$strques.") ";	
		}
		
		if(!empty($catcode) && $catcode!='')
		{
			$catcode=$this->real_escape_string($catcode);
			$cid=$this->get_a_line_bind("select categoryID from ".TPLPrefix."category where categoryCode like ? and IsActive=1 ",array($catcode));
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ".$cid['categoryID'].") temp1
											   WHERE IsActive=1 and lang_id = ".$_SESSION['lang_id']."
											) temp2 " );
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".$strques.") ";			
		}	
	 
		
		if(!empty($filters['subcatid'])){
 			$conqry.=" and  cat.categoryID in (".implode(',',$filters['subcatid']).") ";	
		}
		
		
		if(!empty($searchkey) && $searchkey!='')
		{
			$searchkey=$this->real_escape_string($searchkey);
			$conqry.=" and (MATCH(p.product_name,p.description,p.longdescription,p.sku) AGAINST ('\"".$searchkey."\"' IN NATURAL LANGUAGE MODE) or soundex(p.product_name) like soundex('%".$searchkey."') or find_in_set('".$searchkey."',p.producttag) ) ";
		}
		
		$sortby= " order by final_price asc ";
		$iscolorattr=0;
		foreach($filters as $key=>$val)
		{
				

			if($key=="route")
			  continue;
		    switch($key)
			{
				case "priceval" :
				if($val!= ''){
									$getprices = explode('-',$val);
									$fromprice = $getprices[0];
									$toprice = $getprices[1];
							
								    $fromprice=$this->real_escape_string($fromprice);
									$havingqry[]=" final_price>='".$fromprice."' ";
									 
									
									$toprice=$this->real_escape_string($toprice);
									$havingqry[]=" final_price<='".$toprice."' ";
				}
									break;
			   case "min_price" :
									$val=$this->real_escape_string($val);
									$havingqry[]=" round(final_price_tax)>='".$val."' ";
									break;
			   case "max_price"	:
									$val=$this->real_escape_string($val);
									$havingqry[]=" round(final_price_tax)<='".$val."' ";
									break;
				case "colorid"	:	
									
									
									if($val != ''){
									
									
									$attrjoinqry.="inner join ".TPLPrefix."product_attr_dropdwid adrp on adrp.product_id=p.product_id and adrp.IsActive=1
									inner join ".TPLPrefix."attributes att on att.attributeId = adrp.attribute_id and att.IsFilter=1
									inner join ".TPLPrefix."dropdown drp on drp.dropdown_id = adrp.dropdown_id and drp.isactive=1
									inner join ".TPLPrefix."m_attributes m_att on m_att.attributeid = adrp.attribute_id  and adrp.isactive=1 ";
									
									$conqry.=" and  ( drp.dropdown_id in ('".$val."') or drp.dropdown_id in (select dr.dropdown_id from ".TPLPrefix."dropdown dr
inner join (select  m.attributeId, max(d.dropdown_values) as dropdown_values from  ".TPLPrefix."dropdown d inner join ".TPLPrefix."m_attributes m on m.attributeId=d.attributeId and m.IsActive=1  where d.dropdown_id IN('".$val."') and d.IsActive=1 group by m.attributeId ) dr2 on
dr.attributeId= dr2.attributeId 
and cast(dr.dropdown_values as UNSIGNED)<=cast(dr2.dropdown_values  as UNSIGNED)) ) ";
									
									
									}else{
										
										$attrjoinqry.="inner join ".TPLPrefix."product_attr_dropdwid adrp on adrp.product_id=p.product_id and adrp.IsActive=1
									inner join ".TPLPrefix."attributes att on att.attributeId = adrp.attribute_id and att.IsFilter=1
									inner join ".TPLPrefix."dropdown drp on drp.dropdown_id = adrp.dropdown_id and drp.isactive=1
									inner join ".TPLPrefix."m_attributes m_att on m_att.attributeid = adrp.attribute_id  and adrp.isactive=1 ";
									
									$conqry.=" and  (  drp.dropdown_id in (select dr.dropdown_id from ".TPLPrefix."dropdown dr
inner join (select  m.attributeId, max(d.dropdown_values) as dropdown_values from  ".TPLPrefix."dropdown d inner join ".TPLPrefix."m_attributes m on m.attributeId=d.attributeId and m.IsActive=1  where d.IsActive=1 group by m.attributeId ) dr2 on
dr.attributeId= dr2.attributeId 
and cast(dr.dropdown_values as UNSIGNED)<=cast(dr2.dropdown_values  as UNSIGNED)) ) ";
										
									}
									break;					
			    case "attr"	:	
									//print_r($val); die();
									if($val!=''){
									
								/*	$attrjoinqry.="inner join ".TPLPrefix."product_attr_dropdwid adrp on adrp.product_id=p.product_id and adrp.IsActive=1
									inner join ".TPLPrefix."attributes att on att.attributeId = adrp.attribute_id and att.IsFilter=1
									inner join ".TPLPrefix."dropdown drp on drp.dropdown_id = adrp.dropdown_id and drp.isactive=1
									inner join ".TPLPrefix."m_attributes m_att on m_att.attributeid = adrp.attribute_id  and adrp.isactive=1 "; */
								$attrjoinqry.=" inner join (select drp.dropdown_id,if(adrp1.product_attr_combi_id is null, adrp.product_id, adrp1.base_productId) as product_id from  ".TPLPrefix."dropdown drp
left join ".TPLPrefix."product_attr_dropdwid adrp  on drp.dropdown_id = adrp.dropdown_id and adrp.IsActive=1
left join ".TPLPrefix."product_attr_combi adrp1 on find_in_set(drp.dropdown_id, REPLACE(adrp1.attr_combi_id,'_',','))   and adrp1.isactive=1  and  adrp1.outofstock = 0 
inner join ".TPLPrefix."attributes att on if(adrp1.product_attr_combi_id is null,  att.attributeId = adrp.attribute_id and att.IsFilter=1, att.attributeId = drp.attributeId and att.isCombined=1) 

inner join ".TPLPrefix."m_attributes m_att on  if(adrp1.product_attr_combi_id is null,  m_att.attributeid = adrp.attribute_id ,  m_att.attributeid = drp.attributeId) and m_att.isactive=1
  where drp.isactive=1  ) drp on drp.product_id=p.product_id ";  
									
									$c=0;
									foreach($val as $v){
											$val[$c]=$this->real_escape_string($val[$c]);		
											$c++;
									}
									//print_r( $val);
									$conqry.=" and  ( drp.dropdown_id in ('".implode("', '", $val)."') or drp.dropdown_id in (select dr.dropdown_id from ".TPLPrefix."dropdown dr
inner join (select  m.attributeId, max(d.dropdown_values) as dropdown_values from  ".TPLPrefix."dropdown d inner join ".TPLPrefix."m_attributes m on m.attributeId=d.attributeId and m.IsActive=1 and m.data_type='number' where d.dropdown_id IN('".implode("', '", $val)."') and d.IsActive=1 group by m.attributeId ) dr2 on
dr.attributeId= dr2.attributeId 
and cast(dr.dropdown_values as UNSIGNED)<=cast(dr2.dropdown_values  as UNSIGNED)) ) ";
									}else{
										
											$attrjoinqry.="  left join ".TPLPrefix."product_attr_combi adrp1 on adrp1.base_productId=p.product_id and adrp1.IsActive=1 and adrp1.isDefault=1  and  adrp1.outofstock = 0 
									left join ".TPLPrefix."dropdown drp1 on find_in_set(drp1.dropdown_id, REPLACE(adrp1.attr_combi_id,'_',','))   and drp1.isactive=1
				left join ".TPLPrefix."attributes att1 on att1.attributeId = drp1.attributeId and att1.isCombined=1 and  att1.isactive=1
				left join ".TPLPrefix."m_attributes m_att1 on m_att1.attributeid = drp1.attributeId   and m_att1.isactive=1 
									";	
									$joinfields.=" , drp1.dropdown_values, drp1.dropdown_unit,drp1.attributeId,drp1.dropdown_id ";	
										
									}
									break;
									
				case "colorattr" :
										
									$attrjoinqry.="  left join ".TPLPrefix."product_attr_combi adrp1 on adrp1.base_productId=p.product_id and adrp1.IsActive=1  and  adrp1.outofstock = 0 
									left join ".TPLPrefix."dropdown drp1 on find_in_set(drp1.dropdown_id, REPLACE(adrp1.attr_combi_id,'_',','))   and drp1.isactive=1
				left join ".TPLPrefix."attributes att1 on att1.attributeId = drp1.attributeId and att1.isCombined=1 and  att1.isactive=1
				left join ".TPLPrefix."m_attributes m_att1 on m_att1.attributeid = drp1.attributeId   and m_att1.isactive=1 
									";	
									$joinfields.=" , drp1.dropdown_values, drp1.dropdown_unit,drp1.attributeId,drp1.dropdown_id ";	
									$joinfieldsafter.=" , @attr_price:=( select sum(price) from ( SELECT  adrp.base_productId, adrp.price  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."dropdown drp on  drp.dropdown_id=adrp.attr_combi_id
								AND drp.isactive = 1     inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	
					  where adrp.IsActive=1 and adrp.attr_combi_id=drp1.dropdown_id  and  adrp.outofstock = 0 group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id     ) as attr_price, @other_attr_price:=0  "  ;
									$iscolorattr=1;
									
									$joinfields.=" , (SELECT group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|') 
						  FROM ".TPLPrefix."product_attr_combi adrp
							   INNER JOIN ".TPLPrefix."dropdown drp
								  ON     find_in_set(
											drp.dropdown_id,
											REPLACE(adrp.attr_combi_id, '_', ','))
									 AND drp.isactive = 1									
								 inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1       
						  WHERE adrp.base_productId = p.product_id AND adrp.IsActive = 1 and adrp.attr_combi_id=drp1.dropdown_id  and  adrp.outofstock = 0 ) 
					  as img_names_color  ";
									
									
									break;

			    case "selsortby"	:
									 if($val==1)
										 $sortby= " order by p.product_name asc ";
									 else if($val==2)
										 $sortby= " order by p.product_name desc ";
									 else if($val==3)
										 $sortby= " order by final_price asc ";
									 elseif($val==4)
										 $sortby= " order by final_price desc ";
									 elseif($val==5)
										 $sortby= " order by p.minquantity asc ";
									 elseif($val==6)
										 $sortby= " order by p.minquantity desc ";
									 break;						
			}			
		}
		
		
		if($limit!='' || $page!='')
	    	$limitqry=' limit '. (($page-1)*$limit).",".$limit;
		$totcnt=0;
		if($iscount==1)
		{
			if($type=='deals_of_day')
			 {
				 $deal_of_day_qry.=" inner join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3  ";
				 
			 }
			 else if($type=='newproducts')
			 {
				 	$conqry.=" and p.isnewproduct=1  and '".date("Y-m-d")."' between date(p.newprod_fromdate) and  date(p.newprod_todate) ";
			 }
			
			
		
			 $totcnt=$this->get_a_line_bind(" select count(distinct p.product_id) as cnt from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1 
			 ".$attrjoinqry. $deal_of_day_qry." where p.IsActive=1 and p.lang_id = ".$_SESSION['lang_id']." ".$conqry." ",$arrparams);
			 
			// print_r($totcnt); die();
		}
		else if($iscount==0)
		{
			$sortby= " order by p.modified_date desc ";
		}
		$productid=$this->real_escape_string($productid);
		if($type!='')
		 {
			
			switch(strtolower($type))
			{
				
			  case "bestselling" :
									 $joinqry.=" inner join ".TPLPrefix."orders_products op on op.product_id=p.product_id and op.IsActive=1 inner join ".TPLPrefix."orders o on o.order_id=op.order_id and o.IsActive=1 ";	
									 $sortby= " order by SUM(op.product_qty)  desc ";
									 break;	
			  case "newproducts" :
									$conqry.=" and p.isnewproduct=1  and '".date("Y-m-d")."' between date(p.newprod_fromdate) and  date(p.newprod_todate) ";									
									 break;	
			  case "recentview" :
									 if($_SESSION['Cus_ID']!='' ){		 
			
										$cond = " and rec.customer_id='".$customerid."' ";
								}	else{
									$sessionId=session_id();
			
									$cond = " and rec.session_id='".$sessionId."' ";
			
										}
									 $joinqry.=" inner join ".TPLPrefix."recentview rec on rec.product_id=p.product_id 
									 and rec.IsActive=1 ".$cond." ";									
									 $sortby= " order by rec.Createddate  desc ";
									 break;								
			  case "relatedproduct" :
			  
										if($productid!=''){
										//	echo "gg"; die();
									  $conqry.=" and find_in_set(p.product_id,(
										select group_concat(related_products) from (
										SELECT related_products FROM ".TPLPrefix."product  where product_id='".$productid."'
										union 
										SELECT group_concat(p2.product_id) as related_products FROM ".TPLPrefix."product p1 
										cross JOIN ".TPLPrefix."product p2 ON find_in_set(p1.product_id, p2.related_products) AND p2.IsActive=1 WHERE p1.product_id='".$productid."' )t ) ) and  p.product_id!='".$productid."'  ";	
									
									}
									 break;		
			  case "suggestedproduct" :
									if($productid!=''){
									$conqry.=" and find_in_set(p.product_id,( 
									select group_concat(suggested_products) from (
										SELECT suggested_products FROM ".TPLPrefix."product  where product_id='".$productid."'
										union 
										SELECT group_concat(p2.product_id) as suggested_products FROM ".TPLPrefix."product p1 
										cross JOIN ".TPLPrefix."product p2 ON find_in_set(p1.product_id, p2.suggested_products ) AND p2.IsActive=1 WHERE p1.product_id='".$productid."' )t))  and  p.product_id!='".$productid."'  ";	
									}
									 break;		
			 case "staticproductids" :
									if($productid!=''){
									$conqry.=" and p.product_id in ( ".$productid." ) ";	
									}
									 break;	
			  case "staticproductcode" :
									if($productid!=''){
									$conqry.=" and p.sku in ( ".$productid." ) ";	
									}
									 break;	
			  case "producturl" :
									if($productid!=''){
									$conqry.=" and p.product_url = '".$productid."'  ";	
									}
									 break;									
			  case "homeproduct" :
									
									$conqry.=" and p.displayinhome=1 and p.lang_id = ".$_SESSION['lang_id']."";	
									
									 break;	
			  case "homeslider" :
								//	echo 'hhh'; die();
									 $joinqry.=" inner join ".TPLPrefix."homepageslider hps on hps.title='".$homeslidertitle."' and hps.IsActive=1 inner join ".TPLPrefix."homepageslider_product hsp on hsp.hpsid=hps.hpsid and hsp.productid=p.product_id  and hsp.IsActive=1 ";										
									$sortby= " order by hsp.sortby asc ";
									 break;							 
									 
			}
		 }
		 
		 if(count($productidarr)>0 && count($catidarr)>0 )
		 {
			
			$conqry.=" and p.product_id in ( '".implode("','",$productidarr)."' ) and cat.categoryID in ( '".implode("','",$catidarr)."' )   ";	 
			$sortby= " order by field(cat.categoryID,".implode(",",$catidarr).") asc ";	
		 } 
		 
		/* if($type=='deals_of_day')
		 {
			 $joinqry.=" inner join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3  ";
			 
		 }
		 else{
			 
			  $joinqry.=" left join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3 ";
		 } */
		 
		$resDiscountSel=$this->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		if($iscolorattr==0)
		$groupby=" group by p.product_id ";
	   else 
		$groupby="   group by drp1.dropdown_id ";
		
		if(count($havingqry)>0)
		{ 
			$havingind=0;
			foreach($havingqry as  $qry)
			{
				if($havingind==0)
				{
				$groupby.=" having ".$qry." ";				
				}
				else{
				 $groupby.=" and ".$qry." ";		
				}				
				$havingind++;
			}
			
		}
	if($iscolorattr!='1'){	
		$joinfields.=" ,  @attr_price :=
          CASE
             WHEN p.dropdown_id <> ''
             THEN
                ( select sum(price) from (  select  adrp.base_productId, adrp.price
                 FROM ".TPLPrefix."product_attr_combi adrp
                      INNER JOIN ".TPLPrefix."dropdown drp
                         ON  drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1
					   inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	
                 WHERE      adrp.IsActive = 1
                       AND adrp.isDefault = '1'  and  adrp.outofstock = 0  GROUP BY adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id   )
             else '0'          
          END
          AS temp_attrprice, @other_attr_price:=0  "  ;
}
		
		 $strqry=$this->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,$attrjoinqry,$conqry,$sortby,$limitqry,$groupby,$type);
		//  echo $strqry; 
		
		//echo $strqry; die();
		// echo $strqry; die();
/*	if($type=='homeslider') {	
	echo $strqry; die();
	}*/
	 //print_r($arrparams); die();
		//$prod_list=$this->get_rsltset($strqry);
			$prod_list=$this->get_rsltset_bind($strqry,$arrparams);
			
			$pricefilter=$this->get_a_line_bind(" select min(final_price) as minprice , 
										 max(final_price) as maxprice from (".$strqry." ) tab ",$arrparams);
										 
										 
		//echo "<pre>"; print_r($prod_list); 
		return array("prod_list"=>$prod_list,"totcnt"=>$totcnt['cnt'],"pricefilter"=>$pricefilter);
		
		
	}
	
	function productdetails($catcode,$catid='0',$producturl='',$sku='',$arrdownid,$arraidid,$ishome=0)
	{
		//echo $sku; die();
 		$conqry='';	
		$joinqry='';
		$skuimg='';
		$prodimgpath='';
		$joinfields='';	
		$joinfieldsafter='';
		$finaldiscountqry='';		
		$limitqry='';	
		$mainparam=array();		
		$skuparam=array();		
		$prdparam=array();		
		if(count($arrdownid)>0 )
		{
			
				$err=1;
				$c=0;
				foreach($arrdownid as $arrid)
				{
					
					if($err==1 && $arrid!='')
					{
						$err=0;
					}
					$arrdownid[$c]=$this->real_escape_string($arrdownid[$c]);		
					$c++;
						
				}
			if($err==0){
				$joinqry.=" inner join ".TPLPrefix."product_attr_combi adrp on adrp.base_productId=p.product_id and adrp.IsActive=1  and  adrp.outofstock = 0 
				inner join ".TPLPrefix."dropdown drp on find_in_set(drp.dropdown_id, REPLACE(adrp.attr_combi_id,'_',',')) and drp.isactive=1 and drp.dropdown_id in ( '".trim(implode("','",$arrdownid),",")."')  ";
				$joinfieldsafter.=" , @attr_price:=( select sum(price) from ( SELECT  adrp.base_productId, adrp.price  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."dropdown drp on  drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1 and drp.dropdown_id in ( '".trim(implode("','",$arrdownid),",")."')    inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	 where  adrp.IsActive=1  and  adrp.outofstock = 0    group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id   ) as attr_price, @other_attr_price:=0  "  ;
				
					$prodimgpath=" ,
					 
							 (SELECT group_concat(
					  DISTINCT img.img_path ORDER BY
											    img.ordering ASC SEPARATOR '|') 
						  FROM ".TPLPrefix."product_attr_combi adrp
							   INNER JOIN ".TPLPrefix."dropdown drp
								  ON     find_in_set(
											drp.dropdown_id,
											REPLACE(adrp.attr_combi_id, '_', ','))
									 AND drp.isactive = 1
									
								 inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1       
						  WHERE adrp.base_productId = p.product_id AND adrp.IsActive = 1 and drp.dropdown_id in ( '".trim(implode("','",$arrdownid),",")."')  and  adrp.outofstock = 0  )
					  as img_names ";
				
			}
					else{
		
					$prodimgpath=" ,
					 
							( case 		
							 when p.dropdown_id!='' then
								
								(SELECT group_concat(
										  DISTINCT img.img_path ORDER BY
																   img.ordering ASC SEPARATOR '|') 
											  FROM ".TPLPrefix."product_attr_combi adrp
												   INNER JOIN ".TPLPrefix."dropdown drp
													  ON     find_in_set(
																drp.dropdown_id,
																REPLACE(adrp.attr_combi_id, '_', ','))
														 AND drp.isactive = 1
														 AND adrp.isDefault = 1
													 inner JOIN ".TPLPrefix."product_images img
										ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1       
											  WHERE adrp.base_productId = p.product_id AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
								
							  else		 
							 group_concat(DISTINCT img.img_path
							ORDER BY img.ordering ASC  SEPARATOR '|') end )
					  as img_names ";

					}
		}
		else{
		
	  	$prodimgpath=" ,
		 
				( case 
		
		 when p.dropdown_id!='' then
			
			(SELECT group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|') 
						  FROM ".TPLPrefix."product_attr_combi adrp
							   INNER JOIN ".TPLPrefix."dropdown drp
								  ON     find_in_set(
											drp.dropdown_id,
											REPLACE(adrp.attr_combi_id, '_', ','))
									 AND drp.isactive = 1
									 AND adrp.isDefault = 1
								 inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1       
						  WHERE adrp.base_productId = p.product_id AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
			
          else		 
		 group_concat(DISTINCT img.img_path
        ORDER BY img.ordering ASC  SEPARATOR '|') end ) as img_names ";

		}
		
		
	
		
		if(empty($sku) || $sku=='')
			$skuimg='  ';
		else{
			$sku=$this->real_escape_string($sku);	
			$skuimg=" and img.sku=? ";
					
			$skuparam[]=$sku;
		}
		
		$joinqry.=" left join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3 ";
		
		if(count($arrdownid)>0 )
		{

		$resDiscountSel=$this->getDiscountSelection('0',$arrdownid);
		}
		else{
			$resDiscountSel=$this->getDiscountSelection();
		}
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		
		$wishlistfield="";
		$wishlistqry="";
		if(isset($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!="")
		{
			$wishlistfield=" ,  if(w.cart_id is not null,wp.cart_product_id,'') as wishlist_id ";
			$wishlistqry=" LEFT JOIN ".TPLPrefix."wishlists w on  w.IsActive=1 and w.customer_id='".$_SESSION['Cus_ID']."'   LEFT JOIN ".TPLPrefix."wishlist_products wp on w.cart_id=wp.cart_id and wp.product_id=p.product_id and wp.IsActive=1 ";
			
		}
		
		
		$producturl=$this->real_escape_string($producturl);
		  $strqry=" select p.isbuynow,p.brochureimage,p.product_id,p.product_name,p.longdescription,p.description,p.sku,p.uploadecustomizedimg,p.product_url,p.price,  @attr_price :=
          CASE
             WHEN p.dropdown_id <> ''
             THEN
                ( select sum(price) from (  SELECT  adrp.base_productId, adrp.price
                 FROM ".TPLPrefix."product_attr_combi adrp
                      INNER JOIN ".TPLPrefix."dropdown drp
                         ON      drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1
					    inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	 
                 WHERE     adrp.IsActive = 1
                       AND adrp.isDefault = '1'  and  adrp.outofstock = 0    group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id  )
             else '0'          
          END
          AS temp_attrprice, @other_attr_price:=0 as other_attr_price,  p.specialprice,p.spl_fromdate,p.spl_todate,p.isnewproduct,p.newprod_fromdate,p.newprod_todate,p.soldout,p.minquantity,pc.categoryID,t.taxTyp,t.taxRate,d_prod.DiscountType  as prod_DiscountType,d_prod.DiscountAmount  as prod_DiscountAmount ,d_cat.DiscountType as   cat_DiscountType,d_cat.DiscountAmount as cat_DiscountAmount,d_deals.DiscountType  as deals_DiscountType,d_deals.DiscountAmount  as deals_DiscountAmount,p.iscustomized,p.isfeaturedproduct,pf.themeid 
		".$prodimgpath.$joinfields.$finddiscountqry.$joinfieldsafter.$wishlistfield." from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1
		left join ".TPLPrefix."product_feature pf on pf.product_id = p.product_id and pf.IsActive = 1
		inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1 
		left join ".TPLPrefix."product_images img on img.product_id=p.product_id and img.IsActive=1 ".$skuimg." left join ".TPLPrefix."discount d_prod on find_in_set(p.product_id,d_prod.DiscountProducts) and d_prod.IsActive=1 and '".date('Y-m-d')."' between d_prod.DiscountStartDate and d_prod.DiscountEndDate 	
		left join ".TPLPrefix."discount d_cat on find_in_set(p.product_id,d_cat.DiscountProducts) and d_cat.IsActive=1
		and '".date('Y-m-d')."' between d_cat.DiscountStartDate and d_cat.DiscountEndDate ".$joinqry.$wishlistqry." where p.IsActive=1 and p.product_url=? ".$conqry." and p.lang_id = ".$_SESSION['lang_id']." group by p.product_id limit 0,1" ;  
		$prdparam[]=$producturl;
		$mainparam=array_merge($skuparam,$prdparam);
	  //  echo $strqry; die();
	  //  print_r($mainparam); 
		$prod_details=$this->get_a_line_bind($strqry,$mainparam);
		//$prod_details=$this->get_a_line($strqry);
	//	echo "<pre>"; print_r($prod_details); exit;
		
		return $prod_details;
	}
	
	function productPricevariationFilter($catcode,$catid='0',$producturl='')
	{
		
		$conqry='';	
		$joinqry='';
		$joinfields='';			
		$limitqry='';	
		$producturl=$this->real_escape_string($producturl);
		  $strqry=" select  m_att.attributeid, m_att.attributename,
				   m_att.attribute_type,m_att.iconsdisplay,m_att.attributecode,
				   drp.dropdown_id,drp.dropdown_values,drp.dropdown_images,drp.dropdown_unit ,
				   adrp.price,adrp.sku,adrp.product_attr_combi_id,max(adrp.isDefault) as isDefault
				 from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1
				left join ".TPLPrefix."product_attr_combi adrp on adrp.base_productId=p.product_id and adrp.IsActive=1  and  adrp.outofstock = 0 
				left join ".TPLPrefix."dropdown drp on find_in_set(drp.dropdown_id, REPLACE(adrp.attr_combi_id,'_',','))   and drp.isactive=1
				left join ".TPLPrefix."attributes att on att.attributeId = drp.attributeId and att.isCombined=1 and  att.isactive=1
				left join ".TPLPrefix."m_attributes m_att on m_att.attributeid = drp.attributeId   and m_att.isactive=1 
				 where p.IsActive=1 and p.lang_id = '".$_SESSION['lang_id']."' and p.product_url=? and m_att.attributeid is not null group by m_att.attributeid,drp.dropdown_id ORDER BY m_att.sortingOrder,m_att.attributeid asc " ;  
				
		//echo $strqry; die();
		$prod_filter=$this->get_rsltset_bind($strqry,array($producturl));		
		return $prod_filter;
	}
	
	function productColorvariationFilter($catcode,$catid='0',$producturl='')
	{
		
		$conqry='';	
		$joinqry='';
		$joinfields='';			
		$limitqry='';	
		$producturl=$this->real_escape_string($producturl);
	//echo	
	 $strqry=" select  m_att.attributeid, m_att.attributename,
				   m_att.attribute_type,m_att.iconsdisplay,m_att.attributecode,
				   drp.dropdown_id,drp.dropdown_values,drp.dropdown_images,drp.dropdown_unit ,
				   adrp.price,adrp.sku,adrp.product_attr_combi_id,adrp.isDefault
				 from  ".TPLPrefix."product p 
				 inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 
				 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1
				left join ".TPLPrefix."product_attr_combi adrp on adrp.base_productId=p.product_id and adrp.IsActive=1  and  adrp.outofstock = 0 
				left join ".TPLPrefix."dropdown drp on find_in_set(drp.dropdown_id, REPLACE(adrp.attr_combi_id,'_',','))   and drp.isactive=1
				left join ".TPLPrefix."attributes att on att.attributeId = drp.attributeId and att.isCombined=1 and  att.isactive=1
				left join ".TPLPrefix."m_attributes m_att on m_att.attributeid = drp.attributeId   and m_att.isactive=1 
				 where p.IsActive=1 and p.product_url=? group by m_att.attributeid,drp.dropdown_id ORDER BY m_att.sortingOrder asc " ;  
				//echo $producturl;die();
		
		$prod_filter=$this->get_rsltset_bind($strqry,array($producturl));		
		return $prod_filter;
	}
	
	
	function productFrontAttr($catcode,$catid='0',$producturl='',$include_attr_code=array(),$exclude_attr_code=array())
	{
		
		$conqry='';	
		$joinqry='';
		$joinfields='';			
		$limitqry='';	
		$producturl=$this->real_escape_string($producturl);
		
		if(count($include_attr_code)>0)
		{
			$conqry.=" and m_att.attributecode in ('" . implode("', '", $include_attr_code) . "' ) ";    
			
		}
		
		if(count($exclude_attr_code)>0)
		{
			$conqry.=" and m_att.attributecode not in ('" . implode("', '", $exclude_attr_code) . "' ) ";    
			
		}
		
		 $strqry=" select  m_att.attributeid, m_att.attributename,
				   m_att.attribute_type,m_att.iconsdisplay,m_att.attributecode,
				  ( case when m_att.attribute_type in ('text','textarea')  then  atvar.attribute_value 
     when  m_att.attribute_type in ('dropdown','checkbox')   then  if( m_att.unitdisplay=1,concat(if(d.dropdown_values!='0',d.dropdown_values,''),' ',d.dropdown_unit),if(d.dropdown_values!='0',d.dropdown_values,'')) 
     end )
     AS value
				 from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1
				 
		LEFT JOIN ".TPLPrefix."product_attr_varchar atvar  ON atvar.product_id = p.product_id AND atvar.IsActive = 1
		LEFT JOIN ".TPLPrefix."product_attr_dropdwid atvardrop  ON atvardrop.product_id = p.product_id AND atvardrop.IsActive = 1   
		LEFT JOIN ".TPLPrefix."m_attributes m_att  ON (m_att.attributeid = atvar.attribute_id or m_att.attributeid =atvardrop.attribute_id)  AND m_att.isactive = 1  and m_att.lang_id = '".$_SESSION['lang_id']."'
		LEFT JOIN ".TPLPrefix."attributes att  ON  att.attributeId = m_att.attributeId   AND att.useInFront = 1   AND att.isactive = 1
		Left join ".TPLPrefix."dropdown d on d.attributeId = atvardrop.attribute_id  and d.dropdown_id= atvardrop.dropdown_id  and d.isactive =1 
							
				 where p.IsActive=1 and p.product_url=? and p.lang_id = '".$_SESSION['lang_id']."' ".$conqry."  group by m_att.attributeid ORDER BY m_att.sortingOrder " ;  
				 
		//echo $strqry; die();
		$prod_attr=$this->get_rsltset_bind($strqry,array($producturl));		
		return $prod_attr;
	}
	/* Changed by JP Isactive problem kiran  */
	/*function displayfilter($catcode,$catid='0',$searchkey='',$page='1',$filters='',$limit='12',$iscount='1',$type='',$productid='')
	{ 
		$conqry='';	
		$joinqry='';
		$joinqry1='';
		$joinfields='';	
		$joinfieldsafter='';
		$finaldiscountqry='';		
		$arrparams=array();
	
		if(trim($catid)!='')
		{
			$catid=$this->real_escape_string($catid);
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line_bind( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ?) temp1
											   WHERE IsActive=1
											) temp2 ",array($catid) );
			
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".$strques.") ";	
		}
		if(!empty($catcode) && $catcode!='')
		{
			$catcode=$this->real_escape_string($catcode);
			$cid=$this->get_a_line_bind("select categoryID from ".TPLPrefix."category where categoryCode like ? and IsActive=1 ",array($catcode));
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ".$cid['categoryID'].") temp1
											   WHERE IsActive=1
											) temp2 " );
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".$strques.") ";			
		}	
		if(!empty($searchkey) && $searchkey!='')
		{
			$searchkey=$this->real_escape_string($searchkey);
			$conqry.=" and MATCH(p.product_name,p.description,p.longdescription,p.sku) AGAINST ('\"".$searchkey."\"' IN NATURAL LANGUAGE MODE) ";
		}
		
		 if($type=='deals_of_day')
		 {
			 $joinqry1.=" inner join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3  ";
			 
		 }
		 else if($type=='newproducts')
		 {
			 	$conqry.=" and p.isnewproduct=1  and '".date("Y-m-d")."' between date(p.newprod_fromdate) and  date(p.newprod_todate) ";
		 }
		
		
		 $strqry= " SELECT m_att.attributeid, m_att.attributename,
		m_att.attribute_type,m_att.iconsdisplay,m_att.attributecode,
		drp.dropdown_id,if( m_att.unitdisplay=1,concat(if(drp.dropdown_values!='0',drp.dropdown_values,''),' ',drp.dropdown_unit),if(drp.dropdown_values!='0',drp.dropdown_values,'')) as dropdown_values,drp.dropdown_images,drp.dropdown_unit
		FROM ".TPLPrefix."product p 
		INNER JOIN ".TPLPrefix."product_categoryid pc ON pc.product_id=p.product_id AND pc.IsActive=1
		INNER JOIN ".TPLPrefix."category cat ON cat.categoryID=pc.categoryID AND cat.categoryID=pc.categoryID AND cat.IsActive=1 
		inner join ".TPLPrefix."product_attr_dropdwid adrp on adrp.product_id=p.product_id and adrp.IsActive=1
		inner join ".TPLPrefix."attributes att on att.attributeId = adrp.attribute_id and att.IsFilter=1
		inner join ".TPLPrefix."dropdown drp on drp.dropdown_id = adrp.dropdown_id and drp.isactive=1
		inner join ".TPLPrefix."m_attributes m_att on m_att.attributeid = adrp.attribute_id and m_att.isactive=1  ".$joinqry1."
		WHERE p.IsActive=1 ".$conqry." group by m_att.attributeid, drp.dropdown_id
		ORDER BY m_att.sortingOrder,drp.sortingOrder ASC " ;
		
		$fliter_list=$this->get_rsltset_bind($strqry,$arrparams);
		
	
		$resDiscountSel=$this->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		$groupby= "  group by p.product_id ";
		
		$selectqry = " select ";
		
		$joinfields=trim($joinfields," ,");
		
		 $strqry=$this->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,$attrjoinqry,$conqry,$sortby,$limitqry,$groupby,$type,$selectqry);
		 $strqry= $selectqry.trim($strqry," ,"); 
		
		$pricefilter=$this->get_a_line_bind(" select min(final_price) as minprice , 
										 max(final_price) as maxprice from (".$strqry." ) tab ",$arrparams);
		
		return array("fliter_list"=>$fliter_list,"pricefilter"=>$pricefilter);
	} */
	
	
	function displayfilter($catcode,$catid='0',$searchkey='',$page='1',$filters='',$limit='12',$iscount='1',$type='',$productid='')
	{ 
		$conqry='';	
		$joinqry='';
		$joinqry1='';
		$joinfields='';	
		$joinfieldsafter='';
		$finaldiscountqry='';		
		$arrparams=array();
	
		if(trim($catid)!='')
		{
			  $catid=$this->real_escape_string($catid);
		//	echo "kk";
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
	 
			$childcatlist=$this->get_a_line_bind( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1 and  lang_id = ".$_SESSION['lang_id']."
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ?) temp1
											   WHERE IsActive=1 and  lang_id = ".$_SESSION['lang_id']."
											) temp2 ",array($catid) );
			
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			 
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".implode(",",$arrparams).") ";
		}
		if(!empty($catcode) && $catcode!='')
		{
			$catcode=$this->real_escape_string($catcode);
			$cid=$this->get_a_line_bind("select categoryID from ".TPLPrefix."category where categoryCode like ? and IsActive=1 and  lang_id = ".$_SESSION['lang_id']." ",array($catcode));
			$this->insert("SET SESSION group_concat_max_len = 1000000;");
			$childcatlist=$this->get_a_line( " SELECT GROUP_CONCAT(Level SEPARATOR ',') as ids FROM (
											   SELECT @Ids := (
												   SELECT GROUP_CONCAT(categoryID SEPARATOR ',')
												   FROM ".TPLPrefix."category
												   WHERE FIND_IN_SET(parentId, @Ids) and IsActive=1
											   ) Level
											   FROM ".TPLPrefix."category
											   JOIN (SELECT @Ids := ".$cid['categoryID'].") temp1
											   WHERE IsActive=1
											) temp2 " );
			if(!empty($childcatlist['ids'])){
				$childcatlist['ids'].=",".$catid;
			}
		    else{
				$childcatlist['ids']=$catid;
			}
			$strques="";
			foreach(explode(",",$childcatlist['ids']) as $cid1){
				$strques.="?,";
				$arrparams[]=$cid1;
			}
			$strques=rtrim($strques,",");
			$conqry.=" and  cat.categoryID in (".implode(",",$arrparams).") ";			
		}	
		if(!empty($searchkey) && $searchkey!='')
		{
			$searchkey=$this->real_escape_string($searchkey);
			$conqry.=" and( MATCH(p.product_name,p.description,p.longdescription,p.sku) AGAINST ('\"".$searchkey."\"' IN NATURAL LANGUAGE MODE) or find_in_set('".$searchkey."',p.producttag) ) ";
		}
		
		 if($type=='deals_of_day')
		 {
			 $joinqry1.=" inner join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3  ";
			 
		 }
		 else if($type=='newproducts')
		 {
			 	$conqry.=" and p.isnewproduct=1  and '".date("Y-m-d")."' between date(p.newprod_fromdate) and  date(p.newprod_todate) ";
		 }
		
		
		 $strqry= " SELECT 
			if(comb.attributeid is not null,comb.attributeid,norm.attributeid) as attributeid ,
			if(comb.attributeid is not null,comb.attributename,norm.attributename) as attributename,
			if(comb.attributeid is not null,comb.attribute_type,norm.attribute_type) as attribute_type,
			if(comb.attributeid is not null,comb.iconsdisplay,norm.attribute_type) as attribute_type,
			if(comb.attributeid is not null,comb.attributecode,norm.attribute_type) as attribute_type,
			if(comb.attributeid is not null,comb.dropdown_id,norm.dropdown_id) as dropdown_id,
			if(comb.attributeid is not null,comb.dropdown_values,norm.dropdown_values) as dropdown_values,
			if(comb.attributeid is not null,comb.dropdown_images,norm.dropdown_images) as dropdown_images,
			if(comb.attributeid is not null,comb.dropdown_unit,norm.dropdown_unit) as dropdown_unit,
			if(comb.attributeid is not null,comb.attr_sortingOrder,norm.attr_sortingOrder) as attr_sortingOrder,
			if(comb.attributeid is not null,comb.drp_sortingOrder,norm.drp_sortingOrder) as drp_sortingOrder ,comb.iconsdisplay  
		FROM ".TPLPrefix."product p 
		INNER JOIN ".TPLPrefix."product_categoryid pc ON pc.product_id=p.product_id AND pc.IsActive=1
		INNER JOIN ".TPLPrefix."category cat ON cat.categoryID=pc.categoryID AND cat.categoryID=pc.categoryID AND cat.IsActive=1 
		  left join  (select adrp.product_id, m_att.attributeid,
       m_att.attributename,
       m_att.attribute_type,
       m_att.iconsdisplay,
       m_att.attributecode,
       drp.dropdown_id,
       if(
          m_att.unitdisplay = 1,
          concat(if(drp.dropdown_values != '0', drp.dropdown_values, ''),
                 ' ',
                 drp.dropdown_unit),
          if(drp.dropdown_values != '0', drp.dropdown_values, ''))
          AS dropdown_values,
       drp.dropdown_images,
       drp.dropdown_unit,    
        m_att.sortingOrder as attr_sortingOrder, 
        drp.sortingOrder   as drp_sortingOrder   
     from ".TPLPrefix."product_attr_dropdwid adrp
    
     INNER JOIN ".TPLPrefix."attributes att
        ON att.attributeId = adrp.attribute_id AND att.IsFilter = 1
     INNER JOIN ".TPLPrefix."dropdown drp
        ON drp.dropdown_id = adrp.dropdown_id AND drp.isactive = 1
     INNER JOIN ".TPLPrefix."m_attributes m_att
        ON m_att.attributeid = adrp.attribute_id AND m_att.isactive = 1
      where  adrp.IsActive = 1)  norm  ON  norm.product_id = p.product_id  
      
   left join  (select adrp1.base_productId, m_att.attributeid,
       m_att.attributename,
       m_att.attribute_type,
       m_att.iconsdisplay,
       m_att.attributecode,
       drp.dropdown_id,
       if(
          m_att.unitdisplay = 1,
          concat(if(drp.dropdown_values != '0', drp.dropdown_values, ''),
                 ' ',
                 drp.dropdown_unit),
          if(drp.dropdown_values != '0', drp.dropdown_values, ''))
          AS dropdown_values,
       drp.dropdown_images,
       drp.dropdown_unit,    
        m_att.sortingOrder as attr_sortingOrder, 
        drp.sortingOrder   as drp_sortingOrder ,  
		drp.attributeId as drp_attributeId
     from  ".TPLPrefix."product_attr_combi as adrp1
		inner join ".TPLPrefix."dropdown drp on find_in_set(drp.dropdown_id, REPLACE(adrp1.attr_combi_id,'_',','))   and drp.isactive=1
		inner join ".TPLPrefix."attributes att1 on att1.attributeId = drp.attributeId and att1.isCombined=1 and  att1.isactive=1
		inner join ".TPLPrefix."m_attributes m_att on m_att.attributeid = drp.attributeId   and m_att.isactive=1 
          where adrp1.IsActive=1  and  adrp1.outofstock = 0 
        )  comb  ON  comb.base_productId=p.product_id
		

		".$joinqry1."
		WHERE p.IsActive=1 and  p.lang_id = ".$_SESSION['lang_id']." ".$conqry." group by if(comb.attributeid is not null,comb.attributeid,norm.attributeid) , if(comb.attributeid is not null,comb.dropdown_id,norm.dropdown_id) 
		having attributeid is not null
		ORDER BY attr_sortingOrder,drp_attributeId,drp_sortingOrder ASC " ;
		
	
	//echo $strqry;die();
		$fliter_list=$this->get_rsltset($strqry);
		
		//print_r($fliter_list); die();
	
		$resDiscountSel=$this->getDiscountSelection();
		 
		$joinqry.=$resDiscountSel['joinqry'];
		$joinfields.=$resDiscountSel['joinfields'];	
		$finddiscountqry.=$resDiscountSel['finddiscountqry'];	  
		$joinfieldsafter.=$resDiscountSel['joinfieldsafter']; 
		$groupby= "  group by p.product_id ";
		
		$selectqry = " select ";
		
		$joinfields.=" ,  @attr_price :=
          CASE
             WHEN p.dropdown_id <> ''
             THEN
                ( select sum(price) from (  SELECT  adrp.base_productId, adrp.price
                 FROM ".TPLPrefix."product_attr_combi adrp
                      INNER JOIN ".TPLPrefix."dropdown drp
                         ON      drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1
				   inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1		  
                 WHERE    adrp.IsActive = 1
                       AND adrp.isDefault = '1'  and  adrp.outofstock = 0  group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id   )
             else '0'          
          END
          AS temp_attrprice, @other_attr_price:=0  "  ;
		
		$joinfields=trim($joinfields," ,");
		
		 $strqry=$this->getProductQry($joinfields,$finddiscountqry,$joinfieldsafter,$joinqry,$attrjoinqry,$conqry,$sortby,$limitqry,$groupby,$type,$selectqry);
		$strqry= $selectqry.trim($strqry," ,"); 
		
		$pricefilter=$this->get_a_line_bind(" select round(min(final_price_tax)) as minprice , 
										 round(max(final_price_tax)) as maxprice from (".$strqry." ) tab ",$arrparams);
		
		return array("fliter_list"=>$fliter_list,"pricefilter"=>$pricefilter);
	}
	
	function Discountslab()
	{
		$strqry= " SELECT * from ".TPLPrefix."discount where IsActive=1 and DiscountCatType='5' and DiscountType='1' order by Discountslabamt asc ";
		$discount_slab=$this->get_rsltset($strqry);
		return $discount_slab;
	}
	
	function getSortBy()
	{
		   $strqry= " SELECT SortId,case when '".$_SESSION['lang_id']."' = 1 then SortName when '".$_SESSION['lang_id']."' = 2 then sortname_es when '".$_SESSION['lang_id']."' = 3 then sortname_pt end as SortName from ".TPLPrefix."sortby where IsActive=1 order by sortby asc ";
		 
		// $strqry= " SELECT SortId,SortName from ".TPLPrefix."sortby where IsActive=1 order by sortby asc ";
		$rslt=$this->get_rsltset($strqry);
		return $rslt;
	}
	function IsVaildProduct($code)
	{
		$code=$this->real_escape_string($code);
		$totcnt=$this->get_a_line(" select count(distinct p.product_id) as cnt from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1  where p.IsActive=1 and p.product_url='".$code."' ");
		
		if($totcnt['cnt']>0)
			return '1';		
		else
			return '0';	
	}
	
	function getDiscountSelection_inbase($isenabletax=0)
	{
		$joinqry='';
		$joinfields='';	
		$finaldiscountqry='';	
		$joinfieldsafter='';
		$helper=$this->loadHelper('common_function'); 
		$helper->getStoreConfig();
	
		if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
			$joinqry.=" left join ".TPLPrefix."discount d_cust on if(d_cust.CustomerIds<>'',find_in_set('".$_SESSION['Cus_ID']."',d_cust.CustomerIds),find_in_set('".$_SESSION['cus_group_id']."',d_cust.customergroupid)) and d_cust.IsActive=1 and '".date('Y-m-d')."' between d_cust.DiscountStartDate and d_cust.DiscountEndDate 
			 LEFT JOIN ".TPLPrefix."customers bus_cust ON  bus_cust.IsActive = 1  AND bus_cust.customer_id = '".$_SESSION['Cus_ID']."' ";
			if($helper->getStoreConfigvalue('isTaxable')=="1" || $isenabletax==1){
				
			$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount, @cust_price :=( case when d_cust.DiscountAmount is not null and d_cust.DiscountAmount!=''  and d_cust.DiscountAmount!='0.00' then
         case when d_cust.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_cust.DiscountAmount)/100))+(((p.price-((p.price*d_cust.DiscountAmount)/100))*t.taxRate)/100)
          when d_cust.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_cust.DiscountAmount)/100))+(((p.price-d_cust.DiscountAmount)*t.taxRate)/100)
          when d_cust.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_cust.DiscountAmount)/100))-t.taxRate
          when d_cust.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_cust.DiscountAmount)-t.taxRate 
          end
       end ) as cust_price , @bus_cust :=
          ROUND(
             CASE
                WHEN     bus_cust.discount IS NOT NULL
                     AND  bus_cust.discount != ''
                     AND bus_cust.discount != '0.00'                    
                THEN
				case when t.taxTyp='p' then 
					(p.price-((p.price*bus_cust.discount)/100))+(((p.price-((p.price*bus_cust.discount)/100))*t.taxRate)/100)
                  when  t.taxTyp='F' then 
						(p.price-((p.price*bus_cust.discount)/100))-t.taxRate 
                 end    
             END,
             2)
          AS bus_cust ";
			}
		  else{

				$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount, @cust_price :=( case when d_cust.DiscountAmount is not null and d_cust.DiscountAmount!=''  and d_cust.DiscountAmount!='0.00' then
					 case when d_cust.DiscountType=1  then 
						(p.price-((p.price*d_cust.DiscountAmount)/100))
					  when d_cust.DiscountType=2  then    
						  (p.price-d_cust.DiscountAmount)
					  end
				   end ) as cust_price, @bus_cust :=
          ROUND(
             CASE
                WHEN     bus_cust.discount IS NOT NULL
                     AND  bus_cust.discount != ''
                     AND bus_cust.discount != '0.00'                    
                THEN
                   (p.price - ((p.price * bus_cust.discount) / 100))
                    
             END,
             2)
          AS bus_cust  ";
		  }		  
	   $finaldiscountqry.="   when @total> @cust_price and @cust_price>0 then  @cust_price "; 
		}
		
	if($helper->getStoreConfigvalue('isTaxable')=="1" || $isenabletax==1){ 
		$finddiscountqry= "  ,@total:=ROUND(case when  t.taxTyp='p' then 
              p.price+((p.price*t.taxRate)/100)
           else
             p.price-t.taxRate 
            end,2 ) as orgprice,
         @sprice:=ROUND(case when p.specialprice is not null and p.specialprice!=''  and p.specialprice!='0.00' and '".date("Y-m-d")."' between  date(p.spl_fromdate) and  date(p.spl_todate) then 
                     case when  t.taxTyp='p' then 
                         p.specialprice+(p.specialprice*t.taxRate)/100
                      else
                         p.specialprice-t.taxRate
                      end
                    end,2 ) as sprice,
       @deal_price :=ROUND( case when d_deals.DiscountAmount is not null and d_deals.DiscountAmount!=''  and d_deals.DiscountAmount!='0.00' then
         case when d_deals.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))+(((p.price-((p.price*d_deals.DiscountAmount)/100))*t.taxRate)/100)
          when d_deals.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_deals.DiscountAmount)/100))+(((p.price-d_deals.DiscountAmount)*t.taxRate)/100)
          when d_deals.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))-t.taxRate
          when d_deals.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_deals.DiscountAmount)-t.taxRate 
          end
       end,2 )  as deal_price ,
       @prod_price :=ROUND( case when d_prod.DiscountAmount is not null and d_prod.DiscountAmount!=''  and d_prod.DiscountAmount!='0.00' then
         case when d_prod.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))+(((p.price-((p.price*d_prod.DiscountAmount)/100))*t.taxRate)/100)
          when d_prod.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_prod.DiscountAmount)/100))+(((p.price-d_prod.DiscountAmount)*t.taxRate)/100)
          when d_prod.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))-t.taxRate
          when d_prod.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_prod.DiscountAmount)-t.taxRate 
          end
       end,2 ) as prod_price ,
        @cat_price :=ROUND( case when d_cat.DiscountAmount is not null and d_cat.DiscountAmount!=''  and d_cat.DiscountAmount!='0.00' then
         case when d_cat.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))+(((p.price-((p.price*d_cat.DiscountAmount)/100))*t.taxRate)/100)
          when d_cat.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_cat.DiscountAmount)/100))+(((p.price-d_cat.DiscountAmount)*t.taxRate)/100)
          when d_cat.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))-t.taxRate
          when d_cat.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_cat.DiscountAmount)-t.taxRate 
          end
       end,2 ) as cat_price,  ";
	   
	} else {
		
		$finddiscountqry= "  ,@total:=ROUND( p.price,2 ) as orgprice,@sum:= ROUND((@sum+@total),2) as totsum,  
         @sprice:=ROUND(case when p.specialprice is not null and p.specialprice!=''  and p.specialprice!='0.00' and '".date("Y-m-d")."' between  date(p.spl_fromdate) and  date(p.spl_todate) then p.specialprice
                    end,2 ) as sprice,
       @deal_price :=ROUND( case when d_deals.DiscountAmount is not null and d_deals.DiscountAmount!=''  and d_deals.DiscountAmount!='0.00' then
         case when d_deals.DiscountType=1 then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))
          when d_deals.DiscountType=2  then    
              (p.price-d_deals.DiscountAmount)
          end
       end,2 )  as deal_price ,
       @prod_price :=ROUND( case when d_prod.DiscountAmount is not null and d_prod.DiscountAmount!=''  and d_prod.DiscountAmount!='0.00' then
         case when d_prod.DiscountType=1 then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))
          when d_prod.DiscountType=2 then    
              (p.price-d_prod.DiscountAmount)
          end
       end,2 ) as prod_price ,
        @cat_price :=ROUND( case when d_cat.DiscountAmount is not null and d_cat.DiscountAmount!=''  and d_cat.DiscountAmount!='0.00' then
         case when d_cat.DiscountType=1 then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))
          when d_cat.DiscountType=2  then    
              (p.price-d_cat.DiscountAmount)
          end
       end,2 ) as cat_price,  ";
		
		
	}
        
      	$finddiscountqry.= " @finaltot:=ROUND(case  ";
		
		if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
		$finddiscountqry.= "	WHEN     CAST(@total AS DECIMAL(10, 2)) >
                         CAST(@bus_cust AS DECIMAL(10, 2))
                     AND @bus_cust > 0
                THEN
                   @bus_cust ";			
		}	
		
		$finddiscountqry.= "	 when  CAST(@total  AS DECIMAL(10,2))>  CAST(@deal_price  AS DECIMAL(10,2)) and @deal_price>0 then  @deal_price
             when  CAST(@total  AS DECIMAL(10,2))> CAST( @prod_price  AS DECIMAL(10,2))  and @prod_price>0 then  @prod_price
             when  CAST(@total  AS DECIMAL(10,2))> CAST(@cat_price  AS DECIMAL(10,2)) and @cat_price>0 then  @cat_price 
			 ".$finaldiscountqry."
             when  CAST(@total  AS DECIMAL(10,2))> CAST(@sprice AS DECIMAL(10,2)) and @sprice>0 then  @sprice
             else   @total 
        end,2) as finaldiscountamt
		,
		
        
        @totpent:=ROUND(case when CAST(@total AS DECIMAL(10,2))>CAST(@finaltot AS DECIMAL(10,2)) then
                    ((@total-@finaltot)/@total)*100
                   else '0' 
                   end ) as totpent ";
		
	
		$joinfieldsafter.=", @finaltot:=
   (case when @other_attr_price > 0 then @finaltot + @other_attr_price else @finaltot end)
   final_prod_attr  ,@taxmat:=ROUND((case when  t.taxTyp='p' then 
             (((@finaltot+ifnull(@attr_price,0))*t.taxRate)/100)
           else
             t.taxRate 
            end ),2) as taxmat , ROUND((case when @attr_price>0 then @total+@attr_price else @total end ),2) as final_orgprice, @final_price:=ROUND((case when @attr_price>0 then @finaltot+@attr_price else @finaltot end ),2) as final_price, @final_price_tax:=ROUND((case when @attr_price>0 then @finaltot+@attr_price+@taxmat else @finaltot+@taxmat end ),2) as final_price_tax
		";
	
		return array("joinqry"=>$joinqry,"joinfields"=>$joinfields,"finddiscountqry"=>$finddiscountqry,"joinfieldsafter"=>$joinfieldsafter);
		
	}
	
	function getDiscountSelection($isenabletax=0,$arrdownid='',$iscouponcheck='0')
	{
		
		
		
		$joinqry='';
		$joinfields='';	
		$finaldiscountqry='';	
		$joinfieldsafter='';
		$helper=$this->loadHelper('common_function'); 
		$helper->getStoreConfig();
	
		if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
			$joinqry.=" left join ".TPLPrefix."discount d_cust on if(d_cust.CustomerIds<>'',find_in_set('".$_SESSION['Cus_ID']."',d_cust.CustomerIds),find_in_set('".$_SESSION['cus_group_id']."',d_cust.customergroupid)) and d_cust.IsActive=1 and '".date('Y-m-d')."' between d_cust.DiscountStartDate and d_cust.DiscountEndDate 
			 LEFT JOIN ".TPLPrefix."customers bus_cust ON  bus_cust.IsActive = 1  AND bus_cust.customer_id = '".$_SESSION['Cus_ID']."' ";
			if($helper->getStoreConfigvalue('isTaxable')=="1" || $isenabletax==1){
				
			$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount, @cust_price :=( case when d_cust.DiscountAmount is not null and d_cust.DiscountAmount!=''  and d_cust.DiscountAmount!='0.00' then
         case when d_cust.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_cust.DiscountAmount)/100))+(((p.price-((p.price*d_cust.DiscountAmount)/100))*t.taxRate)/100)
          when d_cust.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_cust.DiscountAmount)/100))+(((p.price-d_cust.DiscountAmount)*t.taxRate)/100)
          when d_cust.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_cust.DiscountAmount)/100))-t.taxRate
          when d_cust.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_cust.DiscountAmount)-t.taxRate 
          end
       end ) as cust_price , @bus_cust :=
          ROUND(
             CASE
                WHEN     bus_cust.discount IS NOT NULL
                     AND  bus_cust.discount != ''
                     AND bus_cust.discount != '0.00'                    
                THEN
				case when t.taxTyp='p' then 
					(p.price-((p.price*bus_cust.discount)/100))+(((p.price-((p.price*bus_cust.discount)/100))*t.taxRate)/100)
                  when  t.taxTyp='F' then 
						(p.price-((p.price*bus_cust.discount)/100))-t.taxRate 
                 end    
             END,
             2)
          AS bus_cust ";
			}
		  else if($helper->getStoreConfigvalue('isTaxable')=="0"){

				$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount, @cust_price :=( case when d_cust.DiscountAmount is not null and d_cust.DiscountAmount!=''  and d_cust.DiscountAmount!='0.00' then
					 case when d_cust.DiscountType=1  then 
						(p.price-((p.price*d_cust.DiscountAmount)/100))
					  when d_cust.DiscountType=2  then    
						  (p.price-d_cust.DiscountAmount)
					  end
				   end ) as cust_price, @bus_cust :=
          ROUND(
             CASE
                WHEN     bus_cust.discount IS NOT NULL
                     AND  bus_cust.discount != ''
                     AND bus_cust.discount != '0.00'                    
                THEN
                   (p.price - ((p.price * bus_cust.discount) / 100))
                    
             END,
             2)
          AS bus_cust  ";
		  }	
		else if($helper->getStoreConfigvalue('isTaxable')=="2"){

				$joinfields.=" ,d_cust.DiscountType as cust_DiscountType,d_cust.DiscountAmount as cust_DiscountAmount, @cust_price :=( case when d_cust.DiscountAmount is not null and d_cust.DiscountAmount!=''  and d_cust.DiscountAmount!='0.00' then
					 case when d_cust.DiscountType=1  then 
						(p.price-((p.price*d_cust.DiscountAmount)/100))
					  when d_cust.DiscountType=2  then    
						  (p.price-d_cust.DiscountAmount)
					  end
				   end ) as cust_price, @bus_cust :=
          ROUND(
             CASE
                WHEN     bus_cust.discount IS NOT NULL
                     AND  bus_cust.discount != ''
                     AND bus_cust.discount != '0.00'                    
                THEN
                   (p.price - ((p.price * bus_cust.discount) / 100))
                    
             END,
             2)
          AS bus_cust  ";
		  }		
	   $finaldiscountqry.="   when @total> @cust_price and @cust_price>0 then  @cust_price "; 
		}
		
	if($helper->getStoreConfigvalue('isTaxable')=="1" || $isenabletax==1){ 
		$finddiscountqry= "  ,@total:=ROUND(case when  t.taxTyp='p' then 
              p.price+((p.price*t.taxRate)/100)
           else
             p.price-t.taxRate 
            end,2 ) as orgprice,
         @sprice:=ROUND(case when p.specialprice is not null and p.specialprice!=''  and p.specialprice!='0.00' and '".date("Y-m-d")."' between  date(p.spl_fromdate) and  date(p.spl_todate) then 
                     case when  t.taxTyp='p' then 
                         p.specialprice+(p.specialprice*t.taxRate)/100
                      else
                         p.specialprice-t.taxRate
                      end
                    end,2 ) as sprice,
       @deal_price :=ROUND( case when d_deals.DiscountAmount is not null and d_deals.DiscountAmount!=''  and d_deals.DiscountAmount!='0.00' then
         case when d_deals.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))+(((p.price-((p.price*d_deals.DiscountAmount)/100))*t.taxRate)/100)
          when d_deals.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_deals.DiscountAmount)/100))+(((p.price-d_deals.DiscountAmount)*t.taxRate)/100)
          when d_deals.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))-t.taxRate
          when d_deals.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_deals.DiscountAmount)-t.taxRate 
          end
       end,2 )  as deal_price ,
       @prod_price :=ROUND( case when d_prod.DiscountAmount is not null and d_prod.DiscountAmount!=''  and d_prod.DiscountAmount!='0.00' then
         case when d_prod.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))+(((p.price-((p.price*d_prod.DiscountAmount)/100))*t.taxRate)/100)
          when d_prod.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_prod.DiscountAmount)/100))+(((p.price-d_prod.DiscountAmount)*t.taxRate)/100)
          when d_prod.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))-t.taxRate
          when d_prod.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_prod.DiscountAmount)-t.taxRate 
          end
       end,2 ) as prod_price ,
        @cat_price :=ROUND( case when d_cat.DiscountAmount is not null and d_cat.DiscountAmount!=''  and d_cat.DiscountAmount!='0.00' then
         case when d_cat.DiscountType=1 and t.taxTyp='p' then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))+(((p.price-((p.price*d_cat.DiscountAmount)/100))*t.taxRate)/100)
          when d_cat.DiscountType=2 and t.taxTyp='p' then    
              (p.price-((p.price*d_cat.DiscountAmount)/100))+(((p.price-d_cat.DiscountAmount)*t.taxRate)/100)
          when d_cat.DiscountType=1 and t.taxTyp='F' then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))-t.taxRate
          when d_cat.DiscountType=2 and t.taxTyp='F' then    
              (p.price-d_cat.DiscountAmount)-t.taxRate 
          end
       end,2 ) as cat_price,  ";
	   
	} else if($helper->getStoreConfigvalue('isTaxable')=="0") {
		
		$finddiscountqry= "  ,@total:=ROUND( p.price,2 ) as orgprice,@sum:= ROUND((@sum+@total),2) as totsum,  
         @sprice:=ROUND(case when p.specialprice is not null and p.specialprice!=''  and p.specialprice!='0.00' and '".date("Y-m-d")."' between  date(p.spl_fromdate) and  date(p.spl_todate) then p.specialprice
                    end,2 ) as sprice,
       @deal_price :=ROUND( case when d_deals.DiscountAmount is not null and d_deals.DiscountAmount!=''  and d_deals.DiscountAmount!='0.00' then
         case when d_deals.DiscountType=1 then 
            (p.price-((p.price*d_deals.DiscountAmount)/100))
          when d_deals.DiscountType=2  then    
              (p.price-d_deals.DiscountAmount)
          end
       end,2 )  as deal_price ,
       @prod_price :=ROUND( case when d_prod.DiscountAmount is not null and d_prod.DiscountAmount!=''  and d_prod.DiscountAmount!='0.00' then
         case when d_prod.DiscountType=1 then 
            (p.price-((p.price*d_prod.DiscountAmount)/100))
          when d_prod.DiscountType=2 then    
              (p.price-d_prod.DiscountAmount)
          end
       end,2 ) as prod_price ,
        @cat_price :=ROUND( case when d_cat.DiscountAmount is not null and d_cat.DiscountAmount!=''  and d_cat.DiscountAmount!='0.00' then
         case when d_cat.DiscountType=1 then 
            (p.price-((p.price*d_cat.DiscountAmount)/100))
          when d_cat.DiscountType=2  then    
              (p.price-d_cat.DiscountAmount)
          end
       end,2 ) as cat_price,  ";
		
		
	}
	else if($helper->getStoreConfigvalue('isTaxable')=="2") {
		
		//echo "hhh"; die();
		
		$mainprice_field	=" ( p.price + (p.price * ".markup_calc." ))   ";
		if($helper->getStoreConfigvalue('Isattrprice_as_main')=="1")
		{
		if($arrdownid!=''){	
			$mainprice_field= " ( select (sum(price)+ (sum(price) * ".markup_calc." )) from (  SELECT  adrp.base_productId, adrp.price  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."dropdown drp on  drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1 and drp.dropdown_id in ( '".trim(implode("','",$arrdownid),",")."')    inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	 where  adrp.IsActive=1  and  adrp.outofstock = 0    group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id   ) ";
		}
		else{
		if($iscouponcheck==0){	
			$mainprice_field= " ( select (sum(price) + (sum(price) * ".markup_calc." )) from (  SELECT  adrp.base_productId, adrp.price from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."dropdown drp on  drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1  and adrp.isDefault=1    inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	 where  adrp.IsActive=1  and  adrp.outofstock = 0    group by adrp.product_attr_combi_id  ) at_tab where base_productId=p.product_id  ) ";
		$finddiscountqry.= " ,@attr_price:=ROUND(( select sum(price) from (  SELECT  adrp.base_productId, adrp.price  from ".TPLPrefix."product_attr_combi adrp inner join ".TPLPrefix."dropdown drp on  drp.dropdown_id=adrp.attr_combi_id
                      AND drp.isactive = 1 and adrp.isDefault=1    inner join ".TPLPrefix."product_attr_combi_opt paco on  ((find_in_set(drp.attributeId,paco.optionId)=1) or (find_in_set(drp.attributeId,paco.optionId_price) and adrp.attr_combi_id like '%,%'  )) and paco.IsActive=1	 where  adrp.IsActive=1  and  adrp.outofstock = 0    group by adrp.product_attr_combi_id ) at_tab where base_productId=p.product_id  ),2) as attr_price ";
		 }else{
			 	$mainprice_field= "  ( p.price + (p.price * ".markup_calc." )) ";
		$finddiscountqry.= " ";
			 
		 }
		
		}
	}
		
		$finddiscountqry.= "  ,@total:=ROUND(".$mainprice_field.",2 ) as orgprice,@sum:= ROUND((@sum+@total),2) as totsum,  
         @sprice:=ROUND(case when p.specialprice is not null and p.specialprice!=''  and p.specialprice!='0.00' and '".date("Y-m-d")."' between  date(p.spl_fromdate) and  date(p.spl_todate) then p.specialprice
                    end,2 ) as sprice,
       @deal_price :=ROUND( case when d_deals.DiscountAmount is not null and d_deals.DiscountAmount!=''  and d_deals.DiscountAmount!='0.00' then
         case when d_deals.DiscountType=1 then 
            (@total-((@total*d_deals.DiscountAmount)/100))
          when d_deals.DiscountType=2  then    
              (@total-d_deals.DiscountAmount)
          end
       end,2 )  as deal_price ,
       @prod_price :=ROUND( case when d_prod.DiscountAmount is not null and d_prod.DiscountAmount!=''  and d_prod.DiscountAmount!='0.00' then
         case when d_prod.DiscountType=1 then 
            (@total-((@total*d_prod.DiscountAmount)/100))
          when d_prod.DiscountType=2 then    
              (@total-d_prod.DiscountAmount)
          end
       end,2 ) as prod_price ,
        @cat_price :=ROUND( case when d_cat.DiscountAmount is not null and d_cat.DiscountAmount!=''  and d_cat.DiscountAmount!='0.00' then
         case when d_cat.DiscountType=1 then 
            (@total-((@total*d_cat.DiscountAmount)/100))
          when d_cat.DiscountType=2  then    
              (@total-d_cat.DiscountAmount)
          end
       end,2 ) as cat_price,  ";
		
		
	}
        
      	$finddiscountqry.= " @finaltot:=ROUND(case  ";
		
		if(!empty($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!='') 
		{
		$finddiscountqry.= "	WHEN     CAST(@total AS DECIMAL(10, 2)) >
                         CAST(@bus_cust AS DECIMAL(10, 2))
                     AND @bus_cust > 0
                THEN
                   @bus_cust ";			
		}	
		
		$finddiscountqry.= "	 when  CAST(@total  AS DECIMAL(10,2))>  CAST(@deal_price  AS DECIMAL(10,2)) and @deal_price>0 then  @deal_price
             when  CAST(@total  AS DECIMAL(10,2))> CAST( @prod_price  AS DECIMAL(10,2))  and @prod_price>0 then  @prod_price
             when  CAST(@total  AS DECIMAL(10,2))> CAST(@cat_price  AS DECIMAL(10,2)) and @cat_price>0 then  @cat_price 
			 ".$finaldiscountqry."
             when  CAST(@total  AS DECIMAL(10,2))> CAST(@sprice AS DECIMAL(10,2)) and @sprice>0 then  @sprice
             else   @total 
        end,2) as finaldiscountamt
		,
		
        
        @totpent:=ROUND(case when CAST(@total AS DECIMAL(10,2))>CAST(@finaltot AS DECIMAL(10,2)) then
                    ((@total-@finaltot)/@total)*100
                   else '0' 
                   end ) as totpent ";
		
	
		$joinfieldsafter.=", @finaltot:=
   (case when @other_attr_price > 0 then 
		 (case when 2<>'".$helper->getStoreConfigvalue('isTaxable')."' then 
			@other_attr_price 		
		  else
			(case when  t.taxTyp='p' then 
		    (@other_attr_price * (100/(100+t.taxRate)))
			 else 
			  (@other_attr_price-t.taxRate )		
          end)
		  end)	
		else 
		 (case when 2<>'".$helper->getStoreConfigvalue('isTaxable')."' then 	
			@finaltot
		  else
			(case when  t.taxTyp='p' then 
		    (@finaltot * (100/(100+t.taxRate)))
			 else 
			  (@finaltot-t.taxRate )		
          end)
		  end)		
			
		end)
   final_prod_attr  ,@taxmat:=ROUND((case when  t.taxTyp='p' then 
		 
                 ((((case when @attr_price>0 then @finaltot else @finaltot end))*t.taxRate)/100)
				
           else
             t.taxRate 
            end ),2) as taxmat , ROUND((case when @attr_price>0 then
			
				 @attr_price
			
			else 
			
			@total 
			 
			end ),2) as final_orgprice, @final_price:=ROUND((case when @attr_price>0 then
			
			 @finaltot 

			
			else 
			 		
				@finaltot + @taxmat
			 
			
			end ),2) as final_price, 
			@final_price_tax:=ROUND((case when @attr_price>0 then 
			 
			     @attr_price

		 
			else 
			
				@finaltot+@taxmat 
			
			end ),2) as final_price_tax
		";
	
		return array("joinqry"=>$joinqry,"joinfields"=>$joinfields,"finddiscountqry"=>$finddiscountqry,"joinfieldsafter"=>$joinfieldsafter);
		
	}
	
	function getProductQry($joinfields='',$finddiscountqry='',$joinfieldsafter='',$joinqry='',$attrjoinqry='',$conqry='',$sortby='',$limitqry='', $groupby='',$type='',$selectqry='',$imgpath_con_qry='',$echo=null)
	{
		/*
		if(isset($dispinhome) && $dispinhome=='displayinhome'){
			//echo $dispinhome; exit;
			$con = " and displayinhome = '1' ";
			
		}
		*/
		if($type=='deals_of_day')
		 {
			 $joinqry.=" inner join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3  ";
			 
		 }
		 else{
			 
			  $joinqry.=" left join ".TPLPrefix."discount d_deals on find_in_set(p.product_id,d_deals.DiscountProducts) and d_deals.IsActive=1 and '".date('Y-m-d')."' between d_deals.DiscountStartDate and d_deals.DiscountEndDate and d_deals.DiscountCatType=3 ";
		 }
		
		if($selectqry=='')
		{
			
		
		 $strqry=" select p.product_id,p.product_name,p.description,p.sku,p.product_url,p.price,p.specialprice,p.spl_fromdate,p.spl_todate,p.isnewproduct,p.newprod_fromdate,p.newprod_todate,p.soldout,p.minquantity,pc.categoryID, t.taxTyp,t.taxRate, d_prod.DiscountType  as prod_DiscountType,d_prod.DiscountAmount  as prod_DiscountAmount ,d_cat.DiscountType as   cat_DiscountType,d_cat.DiscountAmount as cat_DiscountAmount,d_deals.DiscountType  as deals_DiscountType,d_deals.DiscountAmount  as deals_DiscountAmount,
		 ( case 
			".$imgpath_con_qry."
		 when p.dropdown_id!='' then
			
			(SELECT group_concat(
					  DISTINCT img.img_path ORDER BY
											   img.ordering ASC SEPARATOR '|') 
						  FROM ".TPLPrefix."product_attr_combi adrp
							   INNER JOIN ".TPLPrefix."dropdown drp
								  ON     find_in_set(
											drp.dropdown_id,
											REPLACE(adrp.attr_combi_id, '_', ','))
									 AND drp.isactive = 1
									 AND adrp.isDefault = 1
								 inner JOIN ".TPLPrefix."product_images img
					ON  find_in_set(img.product_img_id ,adrp.product_img_id) AND img.IsActive = 1       
						  WHERE adrp.base_productId = p.product_id AND adrp.IsActive = 1  and  adrp.outofstock = 0 )
			
          else		 
		 group_concat(DISTINCT img.img_path
        ORDER BY img.ordering ASC  SEPARATOR '|') end ) as img_names ";
		
		}
		else {
			
			$strqry='';
			
		}
		$wishlistfield="";
		$wishlistqry="";
		if(isset($_SESSION['Cus_ID']) && $_SESSION['Cus_ID']!="")
		{
			$getwishid=$this->get_a_line( " select cart_id from  ".TPLPrefix."wishlists where IsActive=1 and customer_id='".$_SESSION['Cus_ID']."' ");
			
			$wishlistfield=" ,wp.cart_product_id as wishlist_id ";
			$wishlistqry="  LEFT JOIN ".TPLPrefix."wishlist_products wp on wp.product_id=p.product_id and wp.IsActive=1 and wp.cart_id='".$getwishid['cart_id']."' ";     
						
			
		}
			
		 $strqry.=$joinfields.$finddiscountqry.$joinfieldsafter.$wishlistfield.",p.isbuynow from  ".TPLPrefix."product p inner join ".TPLPrefix."product_categoryid pc on pc.product_id=p.product_id and pc.IsActive=1 inner join ".TPLPrefix."category cat on cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 inner join ".TPLPrefix."taxmaster t on t.taxId=p.taxId and t.IsActive=1 
		left join ".TPLPrefix."product_images img on img.product_id=p.product_id and img.IsActive=1 and img.ordering in(1) left join ".TPLPrefix."discount d_prod on find_in_set(p.product_id,d_prod.DiscountProducts) and d_prod.IsActive=1 and '".date('Y-m-d')."' between d_prod.DiscountStartDate and d_prod.DiscountEndDate 
		left join ".TPLPrefix."discount d_cat on find_in_set(pc.categoryID,d_cat.DiscountCategorys) and d_cat.IsActive=1
		and '".date('Y-m-d')."' between d_cat.DiscountStartDate and d_cat.DiscountEndDate ".$joinqry.$attrjoinqry.$wishlistqry.", (SELECT @attr_price := 0 ,@sum :=0 ) r where p.IsActive=1 and p.lang_id = ".$_SESSION['lang_id']." ".$conqry.$groupby.$sortby.$limitqry ;
	  //echo $strqry;   die();
//if($echo == 1){ echo $strqry; }
		return $strqry;
		
	}
	
	function getmaximumdiscountslapprice()
	{
		$query = "SELECT ifnull(max(DiscountAmount),0) as max_discnt_slap  FROM ".TPLPrefix."discount WHERE DiscountCatType = 5 AND IsActive = 1";
		$resulst=$this->get_a_line($query);	
		//echo "<pre>"; print_r($resulst); exit;
		return $resulst;
	}
	
	
	function productdetailsfetured($productid,$tag){
 		if($tag == 'specialfeature'){
			$qryjoin = " inner join ".TPLPrefix."product_specialfeature psf on psf.featureid = pf.featureid and psf.IsActive = 1 ";	
			$field = " ,psf.backgroundimage,psf.featureicon,psf.shortdescription,psf.sortingorder ";
			$sort = " order by psf.sortingorder asc ";
		}
		else if($tag == 'additionalfeature'){
			$qryjoin = " inner join ".TPLPrefix."feature_additional fa on fa.featureid = pf.featureid and fa.IsActive = 1 ";
			$field = " ,fa.aligntype,fa.featuretype,fa.featuretitle,fa.shortdescription,fa.featureimage,fa.videolink,fa.videoimage,fa.buttonurl,fa.sortingorder ";	
			$sort = " order by fa.sortingorder asc ";
		}
		else if($tag == 'specification'){
			$qryjoin = " inner join ".TPLPrefix."feature_specification fs on fs.featureid = fs.featureid and fs.IsActive = 1 ";
			$field = " ,fs.specimage,fs.spectitle,fs.specvalue,fs.sortingorder ";	
			$sort = " order by fs.sortingorder asc ";
		}
		
			$strQry = "select pf.* ".$field." from ".TPLPrefix."product_feature pf ".$qryjoin." where pf.product_id  = '".$productid."' and pf.IsActive = 1 ".$sort." ";	
			$prod_details=$this->get_rsltset($strQry);	
			return $prod_details;
	}
	
	function productdetailsfetured_additional($productid,$aligntype=null,$featuretype=null,$limit=null){
 		
		$addcondition = '';
		if($aligntype != ''){
			$addcondition .= " and fa.aligntype in (".$aligntype.")";	
		}
		
		if($featuretype != ''){
			$addcondition .= " and fa.featuretype in (".$featuretype.") ";	
		}
		
		if($limit != ''){
			$limits = " limit ".$limit." ";	
		}		
		
			$qryjoin = " inner join ".TPLPrefix."feature_additional fa on fa.featureid = pf.featureid and fa.IsActive = 1 ";
			$field = " ,fa.addid,fa.aligntype,fa.featuretype,fa.featuretitle,fa.shortdescription,fa.featureimage,fa.videolink,fa.videoimage,fa.buttonurl,fa.sortingorder ";	
			$sort = " order by fa.sortingorder asc ";
		 
		
			$strQry = "select pf.* ".$field." from ".TPLPrefix."product_feature pf ".$qryjoin." where pf.product_id  = '".$productid."' and pf.IsActive = 1 ".$addcondition."  ".$limits." ";	
			$prod_details=$this->get_rsltset($strQry);	
			return $prod_details;
	}
} 
?>