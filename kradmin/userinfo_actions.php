<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
if($chkstatus !=null)
	$status =1;
else
	$status =0;

include 'includes/image_thumb.php';
$sizes = getdynamicimage($db,'adminusers','adminusers');
$today = date('Y-m-d H:i:s');
 
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES["user_photo"]['tmp_name']);


$created=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
	if(!empty($txtuser_firstname)) {
 		
        $strChk = "select count(user_ID) from ".tbl_users." where user_email = ? and IsActive != ? ";		
    	$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtuser_email),'2')); 	 		
		if($reslt[0] == 0) {			
			
				$bannerimg='';
				if(isset($_FILES["user_photo"])){
					 
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg=str_replace(' ','_',$_FILES['user_photo']['name']);
					  $bannerimg=time().rand(0,9).$bannerimg;	
					  $target_file = '../uploads/adminusers/'.$bannerimg;
					 
					  move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file);
						//image upload path - ends	
					 
				}			
			
			
			
		 $newpwd  =trim($txtuser_password);
		 $lastInserId = $db->insert_id;
			
    		$str="insert into ".tbl_users."(user_firstname,user_lastname,user_name,user_email,user_mobile,user_pwd,RoleId,user_photo,IsActive,UserId,createddate,IsNotify) values(?,?,?,?,?,?,?,?,?,?,?,?)";
    
	
    		$rslt = $db->insert_bind($str,array(getRealescape($txtuser_firstname),getRealescape($txtuser_lastname),getRealescape($txtuser_email),getRealescape($txtuser_email),getRealescape($txtuser_mobile),md5($newpwd),getRealescape($txtRoleId),$bannerimg,$status,$_SESSION["UserId"],$today,0));			
			
			$log = $db->insert_log("insert","".tbl_users."",$lastInserId,"User Added Newly","user",$str);
						
			
			
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
 
 	if(!empty($txtuser_firstname)) {
 		
    	$strChk = "select count(user_ID) from ".tbl_users."  where user_email = ? and IsActive != ? and user_ID != ? ";
    	$reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtuser_email),'2',getRealescape($edit_id))); 
    	
		if($reslt[0] == 0) {
			 
				// User Image
				$bannerimg = array();	
				if(isset($_FILES["user_photo"])){
 					 
						$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $imgname=str_replace(' ','_',$_FILES['user_photo']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/adminusers/'.$imgname;
					 
					  move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file);
						$bannerimg[] = getRealescape($imgname);
						$bannernamedesk = " ,user_photo=? ";	
					
				    
						
				}	
			
			
			 $str = "update ".tbl_users." set user_firstname = ? ,user_lastname = ?, user_email = ?,user_mobile = ?,user_name = ?,RoleId = ?, IsActive = ?, ModifiedDate = ? , UserId=? ".$bannernamedesk." where user_ID = ? ";
			
			$qry_main = array(getRealescape($txtuser_firstname),getRealescape($txtuser_lastname),getRealescape($txtuser_email),getRealescape($txtuser_mobile),getRealescape($txtuser_email),getRealescape($txtRoleId),$status,$today,$_SESSION["UserId"]);
			$qry_condition = array($edit_id);
			$result_data = array_merge($qry_main,$bannerimg,$qry_condition);
 			$rslt = $db->insert_bind($str,$result_data);
			
			$db->insert_log("update","".tbl_users."",$edit_id,"User updated","User",$str);
			
			
		

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
 		
		$str="update ".tbl_users." set IsActive = ?, ModifiedDate = ? , UserId= ? where user_ID = ? ";  
		$rslt = $db->insert_bind($str,array('2',getRealescape($today),$_SESSION["UserId"],$edit_id));		
		
		$db->insert_log("delete","".tbl_users."",$edit_id,"User deleted","User",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
 	  $status = $actval;
    		
		    $str="update ".tbl_users." set IsActive = ?, ModifiedDate = ? , UserId= ?  where user_ID = ? and  IsActive !=? ";		
		    $rslt = $db->insert_bind($str,array($status,getRealescape($today),$_SESSION["UserId"],$edit_id,'2'));    		
    		
    		
    		
		  $db->insert_log("update","".tbl_users."",$edit_id,"Userinfo status changed","User",$str);
		  	 

		  echo json_encode(array("rslt"=>"6")); //deletion
	  
		
	break;
	
	case 'profileupdate':	 	
	//$edit_id
 	if(!empty($txtuser_firstname)) {
 		
    $strChk = "select count(user_ID) from ".tbl_users."  where user_email = ? and IsActive != ? and user_ID != ? ";
    $reslt = $db->get_a_line_bind($strChk,array(getRealescape($txtuser_email),'2',getRealescape($edit_id))); 
    	
		if($reslt[0] == 0) {

		$bannerimg = array();	
				if(isset($_FILES["user_photo"])){
 					 
						$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $imgname=str_replace(' ','_',$_FILES['user_photo']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/adminusers/'.$imgname;
					 
					  move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file);
						$bannerimg[] = getRealescape($imgname);
						$bannernamedesk = " ,user_photo=? ";	
					
				    
						
				}	
			
			$str = "update ".tbl_users." set user_firstname = ? ,user_lastname = ?, user_email = ?,user_mobile = ?, ModifiedDate = ? , UserId=? ".$bannernamedesk." where user_ID = ? ";
			
			$qry_main = array(getRealescape($txtuser_firstname),getRealescape($txtuser_lastname),getRealescape($txtuser_email),getRealescape($txtuser_mobile),$today,$_SESSION["UserId"]);
			$qry_condition = array($edit_id);
			$result_data = array_merge($qry_main,$bannerimg,$qry_condition);
					//print_r($result_data); exit;
			$rslt = $db->insert_bind($str,$result_data);			
			
			
			$db->insert_log("update","".tbl_users."",$edit_id,"User updated","User",$str);
			


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
	
}



?>