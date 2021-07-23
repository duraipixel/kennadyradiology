<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
/*print_r($_REQUEST);
die();*/


if($chkstatus !=null)
	$status =1;
else
	$status =0;

switch($act)
{
	case 'insert':
	
	$today=date("Y-m-d");	
	if(!empty($shippingCost) ) {
		$strChk = "select count(flatshippingId) from ".TPLPrefix."shipping_flat where shippingId = '$shippingId' and IsActive != '2' and shippingCost = '$shippingCost'";		

 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
		
			$strmain="insert into ".TPLPrefix."shipping_flat(`shippingId`,pricetype,`shippingTitle`,`orderMinimum`,`shippingCost`, `customer_group_id`,  `IsActive`, `createdDate`, `UserId`, `sortingOrder`,countryid,stateid) values('".$shippingId."','".$pricetype."','".$shippingTitle."','0','".$shippingCost."','".$customer_group_id."','".$status."','".$today."','".$_SESSION["UserId"]."','".$txtSortingorder."','".implode(',',$txtcountryid)."','".implode(',',$txtstateid)."')";
			$rslt = $db->insert($strmain);	
			
			/*$lastInserId = $db->insert_id;
			
			$str="insert into ".TPLPrefix."shipping_flat_states(flatshippingId,IsActive,UserId,createdDate) values('".$lastInserId."','".implode(',',$txtcountryid)."','".implode(',',$txtstateid)."','".$status."','".$_SESSION["UserId"]."','".$today."')";
			$rslt = $db->insert($str);	*/
			
			$logmain = $db->insert_log("insert","".TPLPrefix."shipping_flat","","Flat Air Shipping Rate Added Newly","shipping",$strmain);
			//$log = $db->insert_log("insert","".TPLPrefix."shipping_flat_states","","Flat Shipping countries Added Newly","shipping",$str);
			
			//echo json_encode(array("rslt"=>$rslt)); //success
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
	//$edit_id
	$today=date("Y-m-d");	
	if(!empty($shippingCost) ) {
 	$strChk = "select count(flatshippingId) from ".TPLPrefix."shipping_flat where shippingCost = '$shippingCost' and IsActive != '2' and flatshippingId != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			  $str = "update ".TPLPrefix."shipping_flat set orderMinimum = '".$orderMinimum."', pricetype = '".$pricetype."' , shippingTitle = '".$shippingTitle."', shippingCost = '".$shippingCost."', customer_group_id = '".$customer_group_id."', IsActive = '".$status."', countryid = '".implode(',',$txtcountryid)."',stateid = '".implode(',',$txtstateid)."', modifiedDate = '$today' , UserId='".$_SESSION["UserId"]."',sortingOrder = '".$txtSortingorder."'  where flatshippingId = '".$edit_id."'";
			$db->insert($str);
			$db->insert_log("update","".TPLPrefix."shipping_flat",$edit_id,"Flat Air Shipping Rate updated","shipping",$str);

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
	  $today = date("Y-m-d");
	  
	  $chk_Ref_there = 1;
	  
	  if (isset($chk_Ref_there)) {
		  	echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  	}
	  	else{
	  $str="update ".TPLPrefix."shipping_flat set IsActive = '2', modifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where flatshippingId = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".TPLPrefix."shipping_flat",$edit_id,"Shipping Method deleted","shipping",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  }
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;
		
		
		/*$chkReference_ed = $db->get_a_line("select shippingId from ".TPLPrefix."products where shippingId = '".$edit_id."' and IsActive <> 2 ");
	  	$chk_Ref_there = $chkReference_ed['shippingId'];
	 
	  	if (isset($chk_Ref_there)) {
		  	echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  	}
	  	else{	*/		
		$str="update ".TPLPrefix."shipping_flat set IsActive = '".$status."', modifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where flatshippingId = '".$edit_id."' ";
			$db->insert($str); 	
			
			$db->insert_log("status update","".TPLPrefix."shipping_flat",$edit_id,"Shipping Rate Status updated","shipping",$str);	
			echo json_encode(array("rslt"=>"6")); //status update success		
	//	}
		
			
	
	break;
}



?>