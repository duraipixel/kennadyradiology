<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$today=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
	
		//print_r($CustomerIds);  exit;
		$categoryIDs = explode(',',$categoryIDs);
		// print_r($va);
		$categoryIDs = implode(',',$categoryIDs);
		// print_r($categoryIDs); 
		//exit;
		//echo "<pre>"; print_r($_POST); exit;	
		$productids = implode(',',$DiscountProducts);
		if(!empty($DiscountTitle) ) {
			$strChk = "select count(DiscountID) from ".TPLPrefix."discount where DiscountTitle = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($DiscountTitle),'2'));
			if($reslt[0] == 0) {
				$category_val =array();
				if($categoryIDs!=''){ 
				 
				 $cat_key=',DiscountCategorys';
				 $cat_val=',?';
				 $category_val[] = $categoryIDs;
				}
				$product_val =array();
				if($productids!=''){ 
				  
				 $pro_key=',DiscountProducts';
				 $pro_val=',?';
				 $product_val[] = $productids;
				 //print_r($product_val); exit;
				}
                $discountslab_val = array();
				if($Discountslabamt!=''){ 
				 
				 $disslab_key=',Discountslabamt';
				 $disslab_val=',?';
				 $discountslab_val[] = getRealescape($Discountslabamt);
				}					
				
				if(count($CustomerIds) > 0){
					$CustomerIds = implode(',',$CustomerIds);
				}else{
					$CustomerIds = '';	
				}
				
				if($Customergroup != ''){
					$Customergroup = $Customergroup;
				}else{
					$Customergroup = '';
				}
				 
				
				  $str="insert into ".TPLPrefix."discount(DiscountTitle,DiscountCatType,DiscountType,DiscountAmount,DiscountStartDate,DiscountEndDate,created,IsActive,UserId,CustomerIds,customergroupid, modifiedDate".$cat_key.$pro_key.$disslab_key.") values(?,?,?,?,?,?,?,?,?,?,?,?".$cat_val.$pro_val.$disslab_val.")";
                //echo $str;
				$discount_val = array(getRealescape($DiscountTitle),getRealescape($DiscountCatType),getRealescape($DiscountType),getRealescape($DiscountAmount),getdateFormat($db,$DiscountStartDate),getdateFormat($db,$DiscountEndDate),$today,$status,$_SESSION["UserId"],$CustomerIds,$Customergroup,$today);
				
				 
	           
				$result_data = array_merge($discount_val,$category_val,$product_val,$discountslab_val);
		 
				
				$rslt = $db->insert_bind($str,$result_data);	
				
				
				$log = $db->insert_log("insert"," ".TPLPrefix."discount","","discount Added Newly","discount",$str);
				echo json_encode(array("rslt"=>"1")); //success
			}
			else {
				 echo json_encode(array("rslt"=>"3")); //same exists
			}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
 	break;
	
	
	case 'update':	 	
		if(!empty($DiscountTitle) ) {
			
			//$today=date("Y-m-d");	
				//print_r($categoryIDs); 
			$categoryIDs = explode(',',$categoryIDs);
			// print_r($categoryIDs);
			$categoryIDs = implode(',',$categoryIDs);
			// print_r($categoryIDs); 
			//exit;			
			
			$strChk = "select count(DiscountID) from ".TPLPrefix."discount where DiscountTitle = ? and IsActive != ? and DiscountID != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($DiscountTitle),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				
				if($DiscountCatType == 1 || $DiscountCatType == 3 ) //Product and Deal of the day
				{ 
					$DiscountProducts = $DiscountProducts;
					$categoryIDs='';
					$CustomerIds='';
					$Discountslabamt=''; 
					$Customergroup='';
				}
				
				if($DiscountCatType == 2) //Category
				{ 
					$DiscountProducts = '';
					$categoryIDs= $categoryIDs;
					$CustomerIds='';
					$Discountslabamt=''; 
					$Customergroup='';
				}
				
				if($DiscountCatType == 5) //Discount Slap
				{ 
					$DiscountProducts = '';
					$categoryIDs= '';
					$CustomerIds= '';
					$Discountslabamt= $Discountslabamt; 
					$Customergroup= '';
				}	
				
				if(count($CustomerIds) > 0){
					$CustomerIds = implode(',',$CustomerIds);
				}else{
					$CustomerIds = '';	
				}
				
				if($Customergroup != ''){
					$Customergroup = $Customergroup;
				}else{
					$Customergroup = '';
				}
				
				
				$str = "update ".TPLPrefix."discount set DiscountTitle = ?, DiscountCatType = ?,DiscountType = ?,DiscountAmount = ?,DiscountProducts = ?,DiscountCategorys = ?,Discountslabamt = ?, DiscountStartDate = ?,DiscountEndDate = ?,IsActive = ?, modifiedDate = ? , UserId=?, customergroupid=?, CustomerIds = ?  where DiscountID = ? ";
				
				$rslt = $db->insert_bind($str,array(getRealescape($DiscountTitle),getRealescape($DiscountCatType),getRealescape($DiscountType),getRealescape($DiscountAmount),implode(',',$DiscountProducts),$categoryIDs,getRealescape($Discountslabamt),getdateFormat($db,$DiscountStartDate),getdateFormat($db,$DiscountEndDate),$status,$today,$_SESSION["UserId"],$Customergroup,$CustomerIds,$edit_id));
				$db->insert_log("update"," ".TPLPrefix."discount",$edit_id,"discount updated","discount",$str);

				echo json_encode(array("rslt"=>"2"));
			}
			else {
				echo json_encode(array("rslt"=>"3")); //same exists
			}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
		
	break;
	
	
	case 'del':
	
		$edit_id = base64_decode($Id);
		  
		$str="update ".TPLPrefix."discount set IsActive = ?, modifiedDate = ? , UserId=?  where DiscountID = ? ";
		$db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		$db->insert_log("delete"," ".TPLPrefix."discount",$edit_id,"discount deleted","discount",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
				
		$str="update ".TPLPrefix."discount set IsActive = ?, modifiedDate = ? , UserId=?  where DiscountID = ? ";
		//echo $str; exit;
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}




?>