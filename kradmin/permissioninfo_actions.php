<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

switch($act)
{
	case 'insert':			
	break;
		
	case 'update':	 	
	//$edit_id as roleid
	$today=date('Y-m-d H:i:s');	
	
	$mainmenu_list = $db->get_rsltset("select t1.MenuId,t2.MenuName from ".tbl_modulemenus." t1 inner join ".tbl_menus." t2 on t1.MenuId = t2.MenuId and t2.IsActive =1 where 1=1 and t1.IsActive = 1 group by t1.MenuId");
	foreach($mainmenu_list as $mainmenu_list_S)
	{
	 $page_list =$db->get_rsltset("select t1.*,t2.MenuName,t3.ModuleName,t3.Description,t3.ModulePath from ".tbl_modulemenus." t1 inner join ".tbl_menus." t2 on t1.MenuId = t2.MenuId and t2.IsActive =1 inner join ".tbl_modules." t3 on t1.ModuleId = t3.ModuleId and t3.IsActive =1 	 where 1=1 and  t1.IsActive =1 and t1.MenuId='".$mainmenu_list_S['MenuId']."' order by t1.moduleId asc ");
	    foreach($page_list as $page_list_S)
		{
			$chk_modulemenuid = $page_list_S['ModuleMenuId'];
            $chk_AddPrm = 0; 
			$chk_EditPrm = 0;
			$chk_DeletePrm = 0; 
			$chk_ViewPrm = 0;									 				
			
			if(isset($_POST['AddPrm_'.$chk_modulemenuid]))
				$chk_AddPrm = 1;
			if(isset($_POST['EditPrm_'.$chk_modulemenuid]))
				$chk_EditPrm = 1;
			if(isset($_POST['DeletePrm_'.$chk_modulemenuid]))
				$chk_DeletePrm = 1;
			if(isset($_POST['ViewPrm_'.$chk_modulemenuid]))
				$chk_ViewPrm = 1;
			
			if($chk_AddPrm == 1 || $chk_EditPrm == 1 || $chk_DeletePrm == 1 || $chk_ViewPrm == 1){
				
				$chkexists_ed = $db->get_a_line("select acl_Id from ".tbl_useracl." where RoleId = '".$edit_id."' and ModuleMenuId = '".$chk_modulemenuid."' ");
				$chk_aclid = $chkexists_ed['acl_Id'];
				
				if (isset($chk_aclid)) {					
					 $db->insert("update ".tbl_useracl." set AddPrm = '".$chk_AddPrm."',EditPrm = '".$chk_EditPrm."',DeletePrm = '".$chk_DeletePrm."',ViewPrm = '".$chk_ViewPrm."', user_id='".$_SESSION["UserId"]."', IsActive=1  where acl_Id ='".$chk_aclid."' ");
				}
				else{
 					
					$db->insert("insert into ".tbl_useracl."(RoleId,ModuleMenuId,AddPrm,EditPrm,DeletePrm,ViewPrm,user_id,IsActive,ApprovalPrm,createdDate)values('".$edit_id."','".$chk_modulemenuid."','".$chk_AddPrm."','".$chk_EditPrm."','".$chk_DeletePrm."','".$chk_ViewPrm."','".$_SESSION["UserId"]."','1',0,'".date('Y-m-d')."')  ");
				}
			}
			else{
				$chkexists_ed = $db->get_a_line("select acl_Id from ".tbl_useracl." where RoleId = '".$edit_id."' and ModuleMenuId = '".$chk_modulemenuid."' ");
				$chk_aclid = $chkexists_ed['acl_Id'];
				
				if (isset($chk_aclid)) {
					 $db->insert("update ".tbl_useracl." set AddPrm = '".$chk_AddPrm."',EditPrm = '".$chk_EditPrm."',DeletePrm = '".$chk_DeletePrm."',ViewPrm = '".$chk_ViewPrm."', user_id='".$_SESSION["UserId"]."',IsActive=0  where acl_Id ='".$chk_aclid."' ");
				}
			}	
		}
	}	
	echo json_encode(array("rslt"=>"2")); //update success
						
	break;
	
	case 'del':
	  /*$edit_id = base64_decode($Id);	  
	  $today = date('Y-m-d H:i:s');*/		 
	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
	  	 		
	break;
	
	case 'changestatus':
	  /*$edit_id = base64_decode($Id);	  
	  $today = date('Y-m-d H:i:s');
	  $status = $actval;*/	  
	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
		
	break;
	
}



?>