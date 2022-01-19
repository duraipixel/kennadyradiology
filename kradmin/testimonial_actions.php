<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$datetime=date('Y-m-d H:i:s');

switch($act)
{
	 
	
	
	case 'del':
	
		$edit_id = base64_decode($Id);
		  
	   
			$str="update ".TPLPrefix."testimonial set IsActive = '2', modifieddate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where testimonialid = '".$edit_id."' ";
			$db->insert($str); 	 
		  
			 
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		 		
			$str="update ".TPLPrefix."testimonial set IsActive = '".$status."', modifieddate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where testimonialid = '".$edit_id."' ";
			$db->insert($str); 		
			echo json_encode(array("rslt"=>"6")); //status update success		
		 
	break;
	
	case 'insert':	
	if(!empty($customername)) {
		
		$strChk = "select count(testimonialid) from  ".TPLPrefix."testimonial where IsActive != '2' and lang_id = 1";
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($customername)));
		//if($reslt[0] == 0) {
			
			$str="insert into ".TPLPrefix."testimonial(customername,customeremailid,testimonialcontent,lang_id,customer_id,IsActive,SortingOrder,UserId)values(?,?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($customername),getRealescape($customeremailid),getRealescape($testimonialcontent),getRealescape($lang_id),0,getRealescape($status),getRealescape($txtSortingorder),getRealescape($_SESSION["UserId"])));			
			$log = $db->insert_log("insert","".TPLPrefix."testimonial","","Testimonial Added Newly","Testimonial",$str);
			
			//echo json_encode(array("rslt"=>$rslt)); //success
			echo json_encode(array("rslt"=>"1")); //success
		//}
		//else {
		//	 echo json_encode(array("rslt"=>"3")); //same exists
		//}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	 
	break;
	
	case 'update':	 	
 	$today=date('Y-m-d H:i:s');	
	if(!empty($customername)) {
		$strChk = "select count(testimonialid) from ".TPLPrefix."testimonial where customername = ? and IsActive != '2' and testimonialid != ?  and lang_id = 1";
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($customername),$edit_id));
		//if($reslt[0] == 0) {
		 	$str = "update ".TPLPrefix."testimonial set customername = ?,customeremailid=?, testimonialcontent=?,SortingOrder = ?, ModifiedDate = ? , UserId=?,IsActive=?,lang_id=?  where testimonialid = ? ";
		
			$db->insert_bind($str,array(getRealescape($customername),getRealescape($customeremailid),getRealescape($testimonialcontent),getRealescape($txtSortingorder),'$today',getRealescape($_SESSION["UserId"]),getRealescape($status),getRealescape($lang_id),getRealescape($edit_id)));
			$db->insert_log("update","".TPLPrefix."testimonial",$edit_id,"testimonial  updated","testimonial",$str);
		
	 	echo json_encode(array("rslt"=>"2"));
		//}
		//else {
		//	echo json_encode(array("rslt"=>"3")); //same exists
		//}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	 
	break;
	
}
 
?>