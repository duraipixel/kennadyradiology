<?php 
include 'session.php';
extract($_REQUEST);

$pagename=$_REQUEST['pagename']; 

if($pagename == "modulemenusorting")
{
	$modulemenuId=$_REQUEST['modulemenuId']; 
	$sort_value=$_REQUEST['sort_value']; 
	
	$str = "update ".TPLPrefix."modulemenus  set SortingOrder = ?  where ModuleMenuId = ? ";
 	$db->insert_bind($str,array($sort_value,$modulemenuId));
 	
	echo "success";
}

//attributemap
else if($pagename == "attributemap")
{
	$attrMapId=$_REQUEST['attrMapId']; 
	$sort_value=$_REQUEST['sort_value']; 
	
	$str = "update ".TPLPrefix."attributes  set sortingOrder = ?  where attrMapId = ? ";
 	$db->insert_bind($str,array($sort_value,$attrMapId));
	
	echo "success";
}


//product approval quantity changes - START
else if($pagename == "pdtapprovalqtychange")
{
	$pdtsku=$_REQUEST['pdtsku']; 
	$pdtid=$_REQUEST['pdtid']; 
	$tblchange=$_REQUEST['tblchange']; 
	$change_value=$_REQUEST['change_value']; 
	
	if(isset($tblchange)){
		if($tblchange == "m"){
			//update to main table		
			$str = "update ".TPLPrefix."product  set minquantity = ?  where product_id = ? and sku = ? and IsActive = ?";
 			$db->insert_bind($str,array($change_value,$pdtid,$pdtsku,0));
			echo json_encode(array("rslt"=>"1")); //success
		}
		else{
			//update to temp table	
			$str = "update ".TPLPrefix."pdt_bulk_approval  set minquantity = ?  where sno = ? and sku = ?";
 			$db->insert_bind($str,array($change_value,$pdtid,$pdtsku));
 			echo json_encode(array("rslt"=>"1")); //success
		}
	}
	
}

//product approval quantity changes - END


//product approval price changes - START
else if($pagename == "pdtapprovalpricechange")
{
	$pdtsku=$_REQUEST['pdtsku']; 
	$pdtid=$_REQUEST['pdtid']; 
	$tblchange=$_REQUEST['tblchange']; 
	$change_value=$_REQUEST['change_value']; 
	
	if(isset($tblchange)){
		if($tblchange == "m"){
			//update to main table
			$str = "update ".TPLPrefix."product  set price = ?  where product_id = ? and sku = ?";
 			$db->insert_bind($str,array($change_value,$pdtid,$pdtsku));
			echo json_encode(array("rslt"=>"1")); //success
		}
		else{
			//update to temp table
			$str = "update ".TPLPrefix."pdt_bulk_approval  set price = ?  where sno = ? and sku = ?";
 			$db->insert_bind($str,array($change_value,$pdtid,$pdtsku));
			echo json_encode(array("rslt"=>"1")); //success
		}
	}
	
}

//product approval price changes - END


//product bulk approval - START
else if($pagename == "pdtbulkapprove")
{
	$approveidlist=$_REQUEST['approveidlist'];	
	$arr_approveidlist = explode(",",$approveidlist);
	
	foreach($arr_approveidlist as $arr_approveidlist_S ){
		$arr_split = explode("@",$arr_approveidlist_S);
		
		//$arr_split[0] - check table , $arr_split[1] - product id or sno , $arr_split[2] - product sku
		
		if(isset($arr_split[0])){
			
			if($arr_split[0] == "m"){
				//main table approve 
				if(isset($arr_split[1])){
					$str = "update ".TPLPrefix."product  set IsActive = ?  where product_id = ? and sku = ?";
 					$db->insert_bind($str,array(1,$arr_split[1],$arr_split[2]));
					
					$str = "update ".TPLPrefix."product  set IsActive = ?  where parent_id = ? and sku = ?";
 					$db->insert_bind($str,array(1,$arr_split[1],$arr_split[2]));
				}				
			}
			else{
			   //temp table to main table update 
			   if(isset($arr_split[1])){
				   $get_pdt_details_g = " select * from ".TPLPrefix."pdt_bulk_approval where sno = ? ";
				   $get_pdt_details = $db->get_a_line_bind($get_pdt_details_g,array($arr_split[1]));
				   if($get_pdt_details[0] == 1) {
			  
					   
					   //tax detail get from ".TPLPrefix."taxmaster table by name from temp table - START
					   $tax_id = "2";
					   
					    $get_tax_det_q = "select taxId from ".TPLPrefix."taxmaster where taxName where taxName = ? ";
				 	    $get_tax_det = $db->get_a_line_bind($get_tax_det_q,array($get_pdt_details['taxname']));
										   				    
						if(isset($get_tax_det['taxId'])){
						   $tax_id = $get_tax_det['taxId'];
						}
					   //tax detail get from ".TPLPrefix."taxmaster table by name from temp table - END
					   
					   
						//check the sku already there 
						$chk_sku = $db->get_a_line(" select count(product_id) from ".TPLPrefix."product where sku = '".$arr_split[2]."' ");
						if($chk_sku[0] == 0) {														
							//add product details from temp table to main table							
							$db->insert("insert into ".TPLPrefix."product(product_name, description, longdescription, metaname, metadescription, metakeyword, sku, quantity, price, tax_id, IsActive, userid)values('".$get_pdt_details['product_name']."', '".$get_pdt_details['description']."', '".$get_pdt_details['longdescription']."', '".$get_pdt_details['metaname']."', '".$get_pdt_details['metadescription']."', '".$get_pdt_details['metakeyword']."', '".$get_pdt_details['sku']."', '".$get_pdt_details['quantity']."', '".$get_pdt_details['price']."', '".$tax_id."', '1', '".$_SESSION["UserId"]."') ");
							
							$db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");
							//$db= mysql_query(" delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");
						}
						else{
							//sku already there - update from temp table to main table					
							
							$db->insert("update ".TPLPrefix."product set product_name='".$get_pdt_details['product_name']."', description='".$get_pdt_details['description']."', longdescription='".$get_pdt_details['longdescription']."', metaname='".$get_pdt_details['metaname']."', metadescription='".$get_pdt_details['metadescription']."', metakeyword='".$get_pdt_details['metakeyword']."', quantity='".$get_pdt_details['quantity']."', price='".$get_pdt_details['price']."', tax_id='".$tax_id."', userid='".$_SESSION["UserId"]."'  where sku = '".$arr_split[2]."' ");
							
							$db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$get_pdt_details['sno']."' ");							
						}
					   
				   }				   
			   }
			}
		}
	}     
	echo json_encode(array("rslt"=>"1")); //success			
}
//product bulk approval - END


//product bulk Delete - START
else if($pagename == "pdtbulkdelete")
{
	$approveidlist=$_REQUEST['approveidlist'];	
	$arr_approveidlist = explode(",",$approveidlist);
	
	foreach($arr_approveidlist as $arr_approveidlist_S ){
		$arr_split = explode("@",$arr_approveidlist_S);
		
		//$arr_split[0] - check table , $arr_split[1] - product id or sno , $arr_split[2] - product sku
		
		if(isset($arr_split[0])){
			
			if($arr_split[0] == "m"){
				//product details remove from main table 
				if(isset($arr_split[1])){					
					$db->insert("delete from ".TPLPrefix."product where product_id='".$arr_split[1]."' ");
					$db->insert("delete from ".TPLPrefix."product where parent_id='".$arr_split[1]."' ");
				}				
			}
			else{
			   //product details remove from temp table 
			   if(isset($arr_split[1])){	
				   $db->insert("delete from ".TPLPrefix."pdt_bulk_approval where sno='".$arr_split[1]."' ");
			   }
			}
		}
	}     
	echo json_encode(array("rslt"=>"1")); //success			
}
//product bulk Delete - END


//Customer approval Discount Amount change- START
else if($pagename == "customerdiscountamountchange")
{
	 
	$cusid=$_REQUEST['cusid']; 
	$tblchange=$_REQUEST['tblchange']; 
	$change_value=$_REQUEST['change_value']; 
	
	if(isset($tblchange)){
		if($tblchange == "m"){
			//update to main table
			$str = "update ".TPLPrefix."customers  set discount = ?  where customer_id = ?";
 			$db->insert_bind($str,array($change_value,$cusid));				
			echo json_encode(array("rslt"=>"1")); //success
		}
		
	}
	
}

//Customer approval Discount Amount change - END



//Customer bulk approval - START
else if($pagename == "customerbulkapprove")
{
	$approveidlist=$_REQUEST['approveidlist'];		
	$arr_approveidlist = explode(",",$approveidlist);
 	foreach($arr_approveidlist as $arr_approveidlist_S ){		
 		//main table approve 
		if(isset($arr_approveidlist_S)){
		  $str = "update ".TPLPrefix."customers  set IsActive = ?  where customer_id = ?";		 
		  $db->insert_bind($str,array(1,$arr_approveidlist_S));					
		}				
	} 
   
	echo json_encode(array("rslt"=>"1")); //success			
}
//Customer bulk approval - END


//Customer bulk Delete - START
else if($pagename == "customerbulkdelete")
{
    $approveidlist=$_REQUEST['approveidlist'];	
	
	$arr_approveidlist = explode(",",$approveidlist);
	//print_r($arr_approveidlist); exit;
	foreach($arr_approveidlist as $arr_approveidlist_S ){

		//main table approve 
		if(isset($arr_approveidlist_S)){
			$str = "update ".TPLPrefix."customers  set IsActive = ?  where customer_id = ?";
 			$db->insert_bind($str,array(2,$arr_approveidlist_S));
		}				
	} 
   
	echo json_encode(array("rslt"=>"1")); //success		   
			
}
//Customer bulk Delete - END



?>