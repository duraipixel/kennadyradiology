<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

switch($act)
{
	case 'insert':	
	if(!empty($txtMenuname)) {
		
		$strChk = "select count(MenuId) from ".tbl_menus." where MenuName = ? and IsActive != '2'";
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtMenuname)));
		if($reslt[0] == 0) {
			
			$str="insert into ".tbl_menus."(MenuName,Description,IsActive,SortingOrder,UserId,Parent,moduleicon)values(?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($txtMenuname),getRealescape($txtMenuDesc),getRealescape($status),getRealescape($txtSortingorder),getRealescape($_SESSION["UserId"]),0,getRealescape($moduleicon)));			
			$log = $db->insert_log("insert","".tbl_menus."","","Menu Added Newly","menu",$str);
			
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
 	$today=date('Y-m-d H:i:s');	
	if(!empty($txtMenuname)) {
		$strChk = "select count(MenuId) from ".tbl_menus." where MenuName = ? and IsActive != '2' and MenuId != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtMenuname),$edit_id));
		if($reslt[0] == 0) {
		 	$str = "update ".tbl_menus." set MenuName = ?,Description=?, SortingOrder = ?, ModifiedDate = ? , UserId=?,moduleicon = ?,IsActive=?  where MenuId = ? ";
		
			$db->insert_bind($str,array(getRealescape($txtMenuname),getRealescape($txtMenuDesc),getRealescape($txtSortingorder),$today,getRealescape($_SESSION["UserId"]),getRealescape($moduleicon),getRealescape($status),getRealescape($edit_id)));
			$db->insert_log("update","".tbl_menus."",$edit_id,"Menu  updated","Menu",$str);
		
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
	  $str="update ".tbl_menus." set IsActive = '2', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where MenuId =?  ";
	  $db->insert_bind($str,array(getRealescape($edit_id))); 	 
	  
	  $db->insert_log("delete","".tbl_menus."",$edit_id,"Menu deleted","Menu",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	 $edit_id = base64_decode($Id);
	$today = date('Y-m-d H:i:s');
	$status = $actval;
	
	 if($edit_id !="1"){
	 	$str="update ".tbl_menus." set IsActive = '".$status."', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where MenuId = ?  ";
		$db->insert_bind($str,array(getRealescape($edit_id))); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	 }
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }	
	
	break;
	
	
}



?>