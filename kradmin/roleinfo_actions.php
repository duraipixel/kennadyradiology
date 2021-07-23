<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;


if($chkAllprod !=null)
	$chkALL =1;
else
	$chkALL =0;

$created=date('Y-m-d H:i:s');
$today=date('Y-m-d H:i:s');	
if($status == '')$status = 0;

switch($act)
{
	case 'insert':
   
	    if(!empty($txtRoleName)) {
 		
    		$strChk = "select count(RoleId) from ".tbl_roles." where RoleName = ? and IsActive != ? ";		
    		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtRoleName),'2')); 		
    		
			if($reslt[0] == 0) {
    			
    			$str="insert into ".tbl_roles."(RoleName,IsRestrict,IsActive,UserId,CreatedDate) values(?,?,?,?,?)";
     			$rslt = $db->insert_bind($str,array(getRealescape($txtRoleName),$chkALL,$status,$_SESSION["UserId"],$created));
				
     			$log = $db->insert_log("insert","".tbl_roles."","","Role Added Newly","role",$str);
    			
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
	$today=date('Y-m-d H:i:s');	
     	if(!empty($txtRoleName)) {
     		
    		$strChk = "select count(RoleId) from ".tbl_roles."  where RoleName = ? and IsActive != ? and RoleId != ? ";
    			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtRoleName),'2',getRealescape($edit_id)));
    			
    		if($reslt[0] == 0) {
    			 
    	        $str = "update ".tbl_roles." set RoleName = ?, ModifiedDate = ?,  UserId=?,IsActive=?,IsRestrict=?  where RoleId = ? ";
    			$rslt = $db->insert_bind($str,array(getRealescape($txtRoleName),$today,$_SESSION["UserId"],$status,$chkALL,$edit_id));			 
    		
    			$db->insert_log("update","".tbl_roles."",$edit_id,"Role  updated","Role",$str);
    			$db->insert($str);
    			
    
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
	  $today = date('Y-m-d H:i:s');
	  
	  if($_SESSION['RoleId'] != $edit_id) 
	  {
		  $chkReference_ed = $db->get_a_line("select user_ID from ".tbl_users." where RoleId = '".$edit_id."' and IsActive<>2 ");
		  $chk_Ref_there = $chkReference_ed['user_ID'];
		  
		  if (isset($chk_Ref_there)) {
			  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
		  }
		  else{

    		$str="update ".tbl_roles." set IsActive = ?, ModifiedDate = ? , UserId= ? where RoleId = ? ";  
    		$rslt = $db->insert_bind($str,array('2',getRealescape($today),$_SESSION["UserId"],$edit_id)); 
		
			$db->insert_log("delete","".tbl_roles."",$edit_id,"Role deleted","Role",$str);
			$db->insert($str); 	 
		  
			
			echo json_encode(array("rslt"=>"5")); //deletion  
		  }
	   }
	   else
	   		echo json_encode(array("rslt"=>"7")); //deletion cannot be done -  self role
	  		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  $today = date('Y-m-d H:i:s');
	  $status = $actval;
	  
	  //update role table	 
	  if($_SESSION['RoleId'] != $edit_id) 
	  {
		  $str="update ".tbl_roles." set IsActive = '$status', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where RoleId = '".$edit_id."'";
		
		  $db->insert($str); 	
	
			//update user table to change the status based on the role status  
		  
		    $str="update ".tbl_users." set IsActive = ?, ModifiedDate = ? , UserId= ?  where RoleId = ? and  IsActive !=? ";		
		    $rslt = $db->insert_bind($str,array($status,getRealescape($today),$_SESSION["UserId"],$edit_id,'2'));
		
		    $db->insert_log("update","".tbl_roles."",$edit_id,"Role status Change","Role",$str_update_users);
		    $db->insert($str_update_users); 	
		  
		
		   echo json_encode(array("rslt"=>"6")); //status update success
		}
		else
			echo json_encode(array("rslt"=>"7")); //status update cannot be done -  self role
	  	 
		
	break;
}



?>