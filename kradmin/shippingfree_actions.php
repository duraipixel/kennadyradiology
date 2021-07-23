<?php 
include 'session.php';
 extract($_REQUEST);
//echo "<pre>"; print_r($_REQUEST); 
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$today=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
       // print_r($_FILES); exit;
	   
		$countryids = implode(',',$txtcountryid);
		$stateids = implode(',',$txtstateid);
 		if(!empty($orderMinimum) ) {
			$strChk = "select count(flatshippingId) from ".TPLPrefix."shipping_flat where orderMinimum = ? and shippingId = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($orderMinimum),$shippingId,'2'));
				//print_r($reslt); exit;
			if($reslt[0] == 0) {	

				$str="insert into ".TPLPrefix."shipping_flat(shippingId,shippingTitle,shippingCost,orderMinimum, IsActive,UserId, createdDate,  sortingOrder,countryid,stateid) values(?,?,?,?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($shippingId),getRealescape($shippingTitle),'0',$orderMinimum,$status,$_SESSION["UserId"],$today,$txtSortingorder,$countryids,$stateids));	
				
				
				$log = $db->insert_log("insert"," ".TPLPrefix."shipping_flat","","shipping_flat Added Newly","shipping_flat",$str);
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

		$countryids = implode(',',$txtcountryid);
		$stateids = implode(',',$txtstateid); 	
 		if(!empty($orderMinimum) ) {		
		//print_r($_REQUEST); exit;
			$strChk = "select count(flatshippingId) from ".TPLPrefix."shipping_flat where orderMinimum = ? and IsActive != ? and flatshippingId != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($orderMinimum),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				
				
				$str = "update ".TPLPrefix."shipping_flat set shippingTitle = ? ,shippingCost = ? ,orderMinimum = ? , IsActive = ? ,UserId = ? , modifiedDate = ? ,  sortingOrder = ?,countryid = ?,stateid = ? where flatshippingId = ? ";
	            
				$rslt = $db->insert_bind($str,array(getRealescape($shippingTitle),'0',$orderMinimum,$status,$_SESSION["UserId"],$today,$txtSortingorder,$countryids,$stateids,$edit_id));
				$db->insert_log("update"," ".TPLPrefix."shipping_flat",$edit_id,"shipping_flat updated","shipping_flat",$str);

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
		  
		$str="update ".TPLPrefix."shipping_flat set IsActive = ?, modifiedDate = ? , UserId=?  where flatshippingId = ? ";
		$db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		$db->insert_log("delete"," ".TPLPrefix."shipping_flat",$edit_id,"shipping_flat deleted","shipping_flat",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
				
		$str="update ".TPLPrefix."shipping_flat set IsActive = ?, modifiedDate = ? , UserId=?  where flatshippingId = ? ";
		//echo $str; exit;
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}




?>