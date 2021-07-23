<?php 
include 'session.php';
extract($_REQUEST);
 $act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
	
	
	
	include 'includes/image_thumb.php';
$today=date("Y-m-d H:i:s");
switch($act)
{
	
	case 'update':	 	
	//$edit_id
	$today=date("Y-m-d");	
	if($_REQUEST) {
		//$strChk = "select count(configureId) from ".TPLPrefix."configuration where storeName = '$txtcategory' and IsActive != '2'  ";
 		//$reslt = $db->get_a_line($strChk);
		//if($reslt[0] == 0) {
		////for image upload from here
			$path = '';
			if(isset($_FILES["ecomLogo"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["ecomLogo"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','ico') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
			 $path=$obj->genThumbConfigureImage('ecomLogo', $db);							
				//image upload path - ends	
			}
			
			$pathfav = '';
			
			
			if(isset($_FILES["favIcon"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["favIcon"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);	
				
				//print_r($file_mime);
				//die();			
				/*if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','ico') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}*/
				//image upload path - starts			
				$objn=new Gthumb();			
			 $pathfav=$objn->genThumbFaviconImage('favIcon', $db);							
				//image upload path - ends	
			}
			
			
			if(isset($_FILES["watermark"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["watermark"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);	
				
				//print_r($file_mime);
				//die();			
				/*if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','ico') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}*/
				//image upload path - starts			
				$objn=new Gthumb();			
				$pathwatermark=$objn->genThumbwatermarkImageEdt('watermark', $db);							
				//image upload path - ends	
			}
			
		////for image upload till here
		
		
			 /*$str = "update ".TPLPrefix."configuration set storeName = '".getRealescape($storeName)."', defaultCurrency = '".$defaultCurrency."', isTaxable='".$isTaxable."', UserId='".$_SESSION["UserId"]."', IsActive = '".$status."', productsPerpage = '".$productsPerpage."',pagingOrLazy = '".$pagingOrLazy."',displayStock= '".$displayStock."',displayOutofstock ='".$displayOutofstock."', minimumStock = '".$minimumStock."', storeMetaTitle = '".getRealescape($storeMetaTitle)."', storeMetaDesc = '".getRealescape($storeMetaDesc)."', storeMetaKey = '".$storeMetaKey."', dateFormat = '".getRealescape($dateFormat)."'  ";
			 
			 if(isset($_FILES["ecomLogo"])){
			 $str .= " ,ecomLogo = '".$path."' ";
			 }
			 
			 if(isset($_FILES["favIcon"])){
			 $str .= " ,favIcon = '".$pathfav."' ";
			 }
			 
			 $str .= " where configureId = '".$edit_id."'";
			
			$db->insert($str);*/
			$strupdat = '';
			foreach($_REQUEST as $key=>$value)
			{		
				if($value != '' && $key != 'action' && $key != 'edit_id')
				{
				 $strupdat = "update ".TPLPrefix."configuration set value = '".$value."',modifiedDate = '".$today."' where `key` = '".$key."'";
				$db->insert($strupdat);
				}
				Switch($key){
					
					case "IsAttributeLink":
												if($value==1)
												{
													$qrysel=" select attributeid, attributename, attributecode, data_type, attribute_type, sortingOrder,UserId from ".TPLPrefix."m_attributes where IsActive=1 ";
													$resattr=$db->get_rsltset($qrysel);
													
													foreach($resattr as $attr)
													{
													  $chkmodule = $db->get_a_line("select ModuleId from ".TPLPrefix."modules where ModuleName = '".$attr['attributename']."' and   IsActive=1  ");
													  $chk_attrmapid = $chkmodule['ModuleId'];													
													
														  $qrymodule="insert into ".TPLPrefix."modules(ModuleId, ModuleName, Description, ModulePath, SortingOrder, IsActive, UserId , CreatedDate, ModifiedDate) values ('".getRealescape($chk_attrmapid)."','".getRealescape($attr['attributename'])."','".getRealescape($attr['attributename'])."','attributevalue_mng.php?attid=".base64_encode($attr['attributeid'])."','".$attr['sortingOrder']."','1','".$attr['UserId']."','".$today."','".$today."') ON DUPLICATE KEY UPDATE ModuleName='".$attr['attributename']."',Description='".$attr['attributename']."',ModulePath='attributevalue_mng.php?attid=".base64_encode($attr['attributeid'])."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."' "; 
														
														$db->insert($qrymodule);
														
													}	
													
												}
												break;
					
					
					
				}
			}
			
			if(isset($_FILES["ecomLogo"])){
			
				$strlogo = "update ".TPLPrefix."configuration set value = '".$path."',modifiedDate = '".$today."' where `key` = 'ecomLogo'";
				$db->insert($strlogo);
			 
			 }
			 
			 if(isset($_FILES["favIcon"])){
			 
			 	$strfav = "update ".TPLPrefix."configuration set value = '".$pathfav."',modifiedDate = '".$today."' where `key` = 'favIcon'";
				$db->insert($strfav);
			 }
			 
			 
			  if(isset($_FILES["watermark"])){
			 
			 	$strfav = "update ".TPLPrefix."configuration set value = '".$pathwatermark."',modifiedDate = '".$today."' where `key` = 'watermark'";
				$db->insert($strfav);
			 }
			 
			$db->insert_log("update","".TPLPrefix."configuration",$edit_id,"Configuration updated","Configuration",$strupdat);

			echo json_encode(array("rslt"=>"2"));
		/*}
		else {
			echo json_encode(array("rslt"=>"3")); //same exists
		}*/
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
		
	break;
	
	
	
	case 'changestatus':
	  /*$edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	  $status = $actval;
	  
	  $chkReference_ed = $db->get_a_line("select categoryID from ".TPLPrefix."configuration where parentId = '".$edit_id."' and IsActive<>2 ");
	  $chk_Ref_there = $chkReference_ed['categoryID'];
	 
	  if (isset($chk_Ref_there)) {*/
		  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	 /* }
	  else{	 
		  $str="update ".TPLPrefix."configuration set IsActive = '$status', UserId='".$_SESSION["UserId"]."'  where categoryID = '".$edit_id."'";
		  $db->insert($str); 	 
		  
		  $db->insert_log("changestatus","".TPLPrefix."configuration",$edit_id,"Status Changed","Category",$str);
		  echo json_encode(array("rslt"=>"6")); //status change
	  }*/
	  	 		
	break;
	
	
}



?>