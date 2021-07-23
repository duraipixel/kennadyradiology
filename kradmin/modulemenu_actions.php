<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
$moduleid_chkall = $_REQUEST['modulecheck_list'];

switch($act)
{
	case 'insert':			
	break;
		
	case 'update':	 	
	//$edit_id
	$today=date('Y-m-d H:i:s');	
if( $admin_id == '')$admin_id = 0;
	
	if(count($moduleid_chkall) > 0)
	{
        $str = "update ".tbl_modulemenus." set IsActive = 0, UserId='".$_SESSION["UserId"]."'  where MenuId = '".$edit_id."'"; 
		$db->insert($str);
 		foreach ($moduleid_chkall as $moduleid_chkall_S)
		{
 			$chkmodulethere_ed = $db->get_a_line("select ModuleMenuId from ".tbl_modulemenus." where MenuId = '".$edit_id."' and ModuleId = '".$moduleid_chkall_S."' ");
			$chk_modulemenuid = $chkmodulethere_ed['ModuleMenuId'];
								
			if (isset($chk_modulemenuid)) {		
 				 $db->insert("update ".tbl_modulemenus." set IsActive = '1', UserId='".$_SESSION["UserId"]."' where  ModuleMenuId ='".$chk_modulemenuid."'  ");
			}
			else{ 				
				$db->insert("insert into ".tbl_modulemenus."(ModuleId,MenuId,SortingOrder,UserId,IsActive)values('".$moduleid_chkall_S."','".$edit_id."',0,'".$_SESSION["UserId"]."','1')  ");								
				
			  $str = "insert into ".tbl_useracl." (RoleId, ModuleMenuId, user_id, AddPrm, EditPrm, DeletePrm, ViewPrm, ApprovalPrm,ExpoPrm,IsActive,createdDate) values ('1','".$db->insert_id."', '".$admin_id."', '1','1','1','1','1','1','1','".$today."')";
				$db->insert($str);								
			}
		}	
	 	echo json_encode(array("rslt"=>"2")); //update success
	}
	else{
		echo json_encode(array("rslt"=>"4"));  //no values
	}
				
	break;
	
	case 'del':
	  /*$edit_id = base64_decode($Id);	  
	  $today = date('Y-m-d H:i:s');*/		 
	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
	  	 		
	break;
	
	case 'changestatus':
 	 echo json_encode(array("rslt"=>"7")); // cannot change status	  	
	  
	  
	  /*$edit_id = base64_decode($Id);	  
	  $today = date('Y-m-d H:i:s');
	  $status = $actval;	
	  $str="update ".tbl_modulemenus." set IsActive = '".$status."', UserId='".$_SESSION["UserId"]."' where MenuId = '".$edit_id."'";
	
	  $db->insert($str); 
	  
	  $db->insert_log("changestatus","".tbl_modulemenus."",$edit_id,"Status Changed","Module Menu Mapping",$str);	
	  echo json_encode(array("rslt"=>"6")); // cannot change status	   */
		
	break;
	
}



?>