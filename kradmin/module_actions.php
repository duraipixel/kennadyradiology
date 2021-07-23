<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
if($chkIsAdd !=null)
	$IsAdd =1;
else
	$IsAdd =0;
if($chkIsEdit !=null)
	$IsEdit =1;
else
	$IsEdit =0;
if($chkIsDelete !=null)
	$IsDelete =1;
else
	$IsDelete =0;

$created=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
	
	if(!empty($txtModulename) ) {
		$strChk = "select count(ModuleId) from ".tbl_modules." where ModuleName = ? and IsActive != '2'";		
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtModulename)));
		if($reslt[0] == 0) {
			
			$str="insert into ".tbl_modules."(ModuleName,Description,ModulePath,IsActive,UserId,CreatedDate,SortingOrder) values(?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($txtModulename),getRealescape($txtModuledescription),getRealescape($txtModulepath),getRealescape($status),$_SESSION["UserId"],$created,0));	
			
			$log = $db->insert_log("insert","".tbl_modules."","","Module Added Newly","module",$str);
			
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
	$today=date('Y-m-d H:i:s');	
	if(!empty($txtModulename) ) {
		$strChk = "select count(ModuleId) from ".tbl_modules." where ModuleName = ? and IsActive != '2' and ModuleId != '".$edit_id."' ";
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtModulename)));
		if($reslt[0] == 0) {
		$str = "update ".tbl_modules." set ModuleName = ?, Description = ?, ModulePath = ?, IsActive = ?, ModifiedDate = ? , UserId=?  where ModuleId = ? ";
		
			$db->insert_bind($str,array(getRealescape($txtModulename),getRealescape($txtModuledescription),getRealescape($txtModulepath),getRealescape($status),$today,$_SESSION["UserId"],getRealescape($edit_id)));
			$db->insert_log("update","".tbl_modules."",$edit_id,"Module  updated","module",$str);

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
	  $str="update ".tbl_modules." set IsActive = '2', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where ModuleId =?  and ModuleId NOT IN(1,2,3) ";
	  $db->insert_bind($str,array(getRealescape($edit_id))); 	 
	  
	  $db->insert_log("delete","".tbl_modules."",$edit_id,"Module deleted","Module",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date('Y-m-d H:i:s');
		$status = $actval;
		
		if($edit_id !="1" && $edit_id !="2" && $edit_id !="3"){			
			$str="update ".tbl_modules." set IsActive = ?, ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where ModuleId = ? and ModuleId NOT IN(1,2,3) ";
		  $db->insert_bind($str,array(getRealescape($status),getRealescape($edit_id))); 		
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
}



?>