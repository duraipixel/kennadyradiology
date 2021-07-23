<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");	
switch($act)
{
	case 'insert':
	
	if(!empty($txtcustomergroupname)) {
		$strChk = "select count(customer_group_id) from ".TPLPrefix."customer_group where customer_group_name = ? and IsActive <> ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtcustomergroupname,'2'));
		if($reslt[0] == 0) {
			
			$str="insert into ".TPLPrefix."customer_group(customer_group_name,IsActive,UserId,createddate,modifieddate)values(?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($txtcustomergroupname),$status,$_SESSION["UserId"],$today,$today));			
			$log = $db->insert_log("insert","".TPLPrefix."customer_group","","Customer Group Added Newly","customergroups",$str);
			
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
	//$today=date("Y-m-d");	
	if(!empty($txtcustomergroupname)) {
		$strChk = "select count(customer_group_id) from ".TPLPrefix."customer_group where customer_group_name = ? and IsActive <> ? and customer_group_id != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtcustomergroupname,'2',$edit_id));
		if($reslt[0] == 0) {
			$str = "update ".TPLPrefix."customer_group set customer_group_name = ?, UserId=?,modifieddate = ?  where customer_group_id = ?";
			
			$db->insert_log("update","".TPLPrefix."customer_group",$edit_id,"Customer Group  updated","customergroups",$str);
			
			$db->insert_bind($str,array(getRealescape($txtcustomergroupname),$_SESSION["UserId"],$today,$edit_id));
			

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
	
	  $chkReference_ed = $db->get_a_line("select customer_id from ".TPLPrefix."customers where customer_group_id = '".$edit_id."' and IsActive<>2 ");
	  $chk_Ref_there = $chkReference_ed['customer_id'];
	 
	  if (isset($chk_Ref_there)) {
		  echo json_encode(array("rslt"=>"7","msg"=>"Customer available in this group")); 
		  exit;
	  }
	  else{	  	  
		  $str="update ".TPLPrefix."customer_group set IsActive =?,modifiedDate = ?, UserId=?  where customer_group_id = ?";
		   $db->insert_log("delete","".TPLPrefix."customer_group",$edit_id,"Customer group deleted","customer_group",$str);
		  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		 
		  echo json_encode(array("rslt"=>"5")); //deletion
	  }	
		
	  	  	 
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	   $status = $actval;
	 $str="update ".TPLPrefix."customer_group set IsActive =?,modifiedDate =?, UserId=?  where customer_group_id = ?"; 
		   $db->insert_log("update","".TPLPrefix."customer_group",$edit_id,"Customer group status deleted","customer_group",$str); 
		 $db->inser_bindt($str,array($status,$today,$_SESSION["UserId"],$edit_id));
	  
	  echo json_encode(array("rslt"=>"6")); //not change	  
	  
	break;
}



?>