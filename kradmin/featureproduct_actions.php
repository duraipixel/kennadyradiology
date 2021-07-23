<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
 
if($chkstatus !=null)
	$status =1;
else
	$status =0;


if($unitdisplay !=null)
	$unitdis =1;
else
	$unitdis =0;

if($iconsdisplay !=null)
	$iconsdis =1;
else
	$iconsdis =0; 
	
	include 'includes/image_thumb.php';
$today=date("Y-m-d H:i:s");		
switch($act)
{
	case 'insert':
	
	if(!empty($bannertitle)) {
 
 		$strChk = "select count(featureid) from ".TPLPrefix."product_feature where themeid = ? and product_id = ? and IsActive != ? and bannertitle = ?";
 		$reslt = $db->get_a_line_bind($strChk,array($themeid,$product_id,'2',$bannertitle));
		if($reslt[0] == 0) {
		 
		
		if(isset($_FILES["thembanner"])){	
					$file_info = getimagesize($_FILES["thembanner"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $thembannerimg=str_replace(' ','_',$_FILES['thembanner']['name']);
						  $thembannerimg=time().rand(0,9).$thembannerimg;	
						  $target_file = '../uploads/featureuploads/banner/'.$thembannerimg;
						  move_uploaded_file($_FILES["thembanner"]["tmp_name"], $target_file);
				}	
				
		  
		 	$str="insert into ".TPLPrefix."product_feature(product_id,themeid,bannertitle,bannerimage,bannerlinar,userid,IsActive,CreatedDate,ModifiedDate,mspecificationtitle,mspecificationdesc)values(?,?,?,?,?,?,?,?,?,?,?)";
			
			$rslt = $db->insert_bind($str,array(getRealescape($product_id),getRealescape($themeid),getRealescape($bannertitle),getRealescape($thembannerimg),getRealescape($bannerlinar),$_SESSION["UserId"],1,$today,$today,getRealescape($mspecificationtitle),getRealescape($mspecificationdesc)));		
			
				
			  $lastInserId = $db->insert_id;
			 $log = $db->insert_log("insert"," ".TPLPrefix."product_feature","","Product Featured Added Newly","Product Featured",$str);	
           
			 	
			################### special feature start ##################	
			
			 for($i=0;$i<=$special_option_max_count;$i++) {
				 
				 ############### special feature attribute icon #######################
				if(isset($_FILES["featureImages".$i])){	
				
					$file_info = getimagesize($_FILES["featureImages".$i]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $attributeimage=str_replace(' ','_',$_FILES['featureImages'.$i]['name']);
						  $attributeimage=time().rand(0,9).$attributeimage;	
						  $target_file1 = '../uploads/featureuploads/specialfeature/icon/'.$attributeimage;
						  move_uploaded_file($_FILES["featureImages".$i]["tmp_name"], $target_file1);
				}	
				
				############### special feature background  #######################
				if(isset($_FILES["featureattributebanner".$i])){		
					$file_info = getimagesize($_FILES["featureattributebanner".$i]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $spattributeimage=str_replace(' ','_',$_FILES['featureattributebanner'.$i]['name']);
						  $spattributeimage=time().rand(0,9).$spattributeimage;	
						   $target_file2 = '../uploads/featureuploads/specialfeature/banner/'.$spattributeimage;
						  move_uploaded_file($_FILES["featureattributebanner".$i]["tmp_name"], $target_file2);
				}	
				######### end ############
								
						$shortdescription=$_POST['shortdescription'.$i];				
						$dropdownSort=$_POST['dropdownSort'.$i];
											
						if($shortdescription!='') {
							
						$specialQuery= "insert into ".TPLPrefix."product_specialfeature(featureid,backgroundimage,featureicon,shortdescription,userid,sortingorder,IsActive,CreatedDate,ModifiedDate)values(?,?,?,?,?,?,?,?,?)";
			  
			    
						$db->insert_bind($specialQuery,array($lastInserId,getRealescape($spattributeimage),getRealescape($attributeimage),getRealescape($shortdescription),$_SESSION["UserId"],$dropdownSort,1,$today,$today));		
						$log = $db->insert_log("insert","".TPLPrefix."product_specialfeature",$edit_id,"Scope Added Newly","product_specialfeature",$specialQuery);
						}
				 }					
			################## special feature start ##################	
			
			
			
			
			################### Specification start ##################
			for($s=0;$s<=$specification_option_max_count;$s++) {
				 if(isset($_FILES["specimage".$s])){		
					$file_info = getimagesize($_FILES["specimage".$s]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $specimagename=str_replace(' ','_',$_FILES['specimage'.$s]['name']);
						  $specimagename=time().rand(0,9).$specimagename;	
						  $target_file = '../uploads/featureuploads/specification/'.$specimagename;
						  move_uploaded_file($_FILES["specimage".$s]["tmp_name"], $target_file);
				}		
				
				$specvalue = trim($_POST['specvalue'.$s]); 
				$specdropdownSort = $_POST['specdropdownSort'.$s];
				$specificationtitle = $_POST['specificationtitle'.$s];
				
				if($specificationtitle!='') {
				
				$str= "insert into ".TPLPrefix."feature_specification(featureid,specimage,spectitle,specvalue,sortingorder,userid,IsActive,CreatedDate,ModifiedDate)values(?,?,?,?,?,?,?,?,?)";
								
				$db->insert_bind($str,array($lastInserId,getRealescape($specimagename),getRealescape($specificationtitle),getRealescape($specvalue),$specdropdownSort,$_SESSION["UserId"],1,$today,$today));		
				}
										
			 }			 			 						
			################### Specification end ##################
			
			
			
			################### Additional Feature Section start ##################
		 

  			for($gg=0;$gg<=$additionalfeat_option_max_count;$gg++) {
				if(isset($_FILES["addfeatureimage".$gg])){		
					$file_info = getimagesize($_FILES["addfeatureimage".$gg]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $specimagename=str_replace(' ','_',$_FILES['addfeatureimage'.$gg]['name']);
						  $specimagename=time().rand(0,9).$specimagename;	
						  $target_file = '../uploads/featureuploads/additionalfeature/'.$specimagename;
						  move_uploaded_file($_FILES["addfeatureimage".$gg]["tmp_name"], $target_file);
				}			
				
				$addfeaturetitle = trim($_POST['addfeaturetitle'.$gg]); 
				$alignmenttype = $_POST['alignmenttype'.$gg];
				$addfeadescription = $_POST['addfeadescription'.$gg];
				$addfeabuttonurl = $_POST['addfeabuttonurl'.$gg];
				$videolink = $_POST['videolink'.$gg];
				$addfeadropdownSort =$_POST['addfeadropdownSort'.$gg];
				$featuretype = $_POST['featuretype'.$gg];
				
				if($featuretype != ''){
				  $str= "insert into ".TPLPrefix."feature_additional(featureid, aligntype, featuretype, featuretitle, shortdescription, featureimage, videolink, videoimage, buttonurl, sortingorder, userid, IsActive, CreatedDate, ModifiedDate)values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					
				 
			 
					$db->insert_bind($str,array($lastInserId,$alignmenttype,getRealescape($featuretype),getRealescape($addfeaturetitle),$addfeadescription,$specimagename,$videolink,$specimagename,$addfeabuttonurl,$addfeadropdownSort,$_SESSION["UserId"],1,$today,$today));	
				}
				
				
			}
			
			############### Additional Feature Section
			
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
	 
	if(!empty($bannertitle)) {
		$strChk = "select count(featureid) from ".TPLPrefix."product_feature where product_id != ? and IsActive != ? and bannertitle = ?";
 		$reslt = $db->get_a_line_bind($strChk,array($product_id,'2',$bannertitle));
		
		 
		if($reslt[0] == 0) {
			
		 
		$thbannerimage = array();
		
		if(isset($_FILES["thembanner"])){	
					$file_info = getimagesize($_FILES["thembanner"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $thembannerimg=str_replace(' ','_',$_FILES['thembanner']['name']);
						  $thembannerimg=time().rand(0,9).$thembannerimg;	
						  $target_file = '../uploads/featureuploads/banner/'.$thembannerimg;
						  move_uploaded_file($_FILES["thembanner"]["tmp_name"], $target_file); 
						  //bannerimage
						  
						  $thbannerimage[] = $thembannerimg;
						  $thbannerimagefield = " ,bannerimage=? ";	
		}	
		  
		 	  $str="update ".TPLPrefix."product_feature set themeid =?,bannertitle=?,bannerlinar=?,userid=?,IsActive=?,ModifiedDate=?,mspecificationtitle=?,mspecificationdesc=? ".$thbannerimagefield." where featureid = ? and product_id = ? and IsActive = ?";
			
			$qry_main = array(getRealescape($themeid),getRealescape($bannertitle),getRealescape($bannerlinar),$_SESSION["UserId"],1,$today,getRealescape($mspecificationtitle),getRealescape($mspecificationdesc));
			$qry_main1 = array($edit_id,getRealescape($product_id),1);
			
			$result_data = array_merge($qry_main,$thbannerimage,$qry_main1);
			
			 
						
			$rslt = $db->insert_bind($str,$result_data);	
			
				
			 $lastInserId = $edit_id;
			 $log = $db->insert_log("update"," ".TPLPrefix."product_feature","","Product Featured updated","Product Featured",$str);	
           
			 	
			################### special feature start ##################	
			
			$specialfeatureic = $specialbackground = array();
			 for($i=0;$i<$special_option_max_count;$i++) {
				 
				 ############### special feature attribute icon #######################
				if(isset($_FILES["featureImages".$i])){	
				
					$file_info = getimagesize($_FILES["featureImages".$i]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $attributeimage=str_replace(' ','_',$_FILES['featureImages'.$i]['name']);
						  $attributeimage=time().rand(0,9).$attributeimage;	
						  $target_file1 = '../uploads/featureuploads/specialfeature/icon/'.$attributeimage;
						  move_uploaded_file($_FILES["featureImages".$i]["tmp_name"], $target_file1);
						  
						   $specialfeatureic[] = $attributeimage;
						   $specialfeatureicfield = " ,featureicon=? ";	
				}	
				
				############### special feature background  #######################
				if(isset($_FILES["featureattributebanner".$i])){		
					$file_info = getimagesize($_FILES["featureattributebanner".$i]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $spattributeimage=str_replace(' ','_',$_FILES['featureattributebanner'.$i]['name']);
						  $spattributeimage=time().rand(0,9).$spattributeimage;	
						   $target_file2 = '../uploads/featureuploads/specialfeature/banner/'.$spattributeimage;
						  move_uploaded_file($_FILES["featureattributebanner".$i]["tmp_name"], $target_file2);
						  
						  $specialbackground[] = $spattributeimage;
						   $specialbackfield = " ,backgroundimage=? ";	
				}	
				######### end ############
								
						$shortdescription=$_POST['shortdescription'.$i];				
						$dropdownSort=$_POST['dropdownSort'.$i];
						$option_edit_id = $_REQUEST['option_edit_id'.$i];	
											
						if($shortdescription!='') {
							
							if($option_edit_id!='') {
							  	$strspecial = "update ".TPLPrefix."product_specialfeature set shortdescription=?,sortingorder=?,IsActive=?,ModifiedDate=? ".$specialfeatureicfield.$specialbackfield." where specialid = ? and featureid = ? and IsActive = ? ";
								
						$qry_main = array(getRealescape($shortdescription),getRealescape($dropdownSort),1,$today);
						$qry_main1 = array($option_edit_id,$edit_id,1);
			
						$result_data = array_merge($qry_main,$specialfeatureic,$specialbackground,$qry_main1);		
						
					 
							
						$rslt = $db->insert_bind($strspecial,$result_data);	
						
						$log = $db->insert_log("update","".TPLPrefix."product_specialfeature",$edit_id,"special feature updated","product_specialfeature",$specialQuery);
			
								 
							}else{						
						  $specialQuery= "insert into ".TPLPrefix."product_specialfeature(featureid,backgroundimage,featureicon,shortdescription,userid,sortingorder,IsActive,CreatedDate,ModifiedDate)values(?,?,?,?,?,?,?,?,?)";
			  		   
						$db->insert_bind($specialQuery,array($edit_id,getRealescape($spattributeimage),getRealescape($attributeimage),getRealescape($shortdescription),$_SESSION["UserId"],$dropdownSort,1,$today,$today));		
						$log = $db->insert_log("insert","".TPLPrefix."product_specialfeature",$edit_id,"special feature Added Newly","product_specialfeature",$specialQuery);
							}
							
						}
				 }					
			################## special feature start ##################	
			
			
			
			
			################### Specification start ##################
			$specimagenamearr = array();
			
			for($s=0;$s<$specification_option_max_count;$s++) {
				 if(isset($_FILES["specimage".$s])){		
					$file_info = getimagesize($_FILES["specimage".$s]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
				
						  $specimagename=str_replace(' ','_',$_FILES['specimage'.$s]['name']);
						  $specimagename=time().rand(0,9).$specimagename;	
						  $target_file = '../uploads/featureuploads/specification/'.$specimagename;
						  move_uploaded_file($_FILES["specimage".$s]["tmp_name"], $target_file);
						  
						   $specimagenamearr[] = $specimagename;
						   $specimagenamefield = " ,specimage=? ";
						   
				}		
				
				$specvalue = trim($_POST['specvalue'.$s]); 
				$specdropdownSort = $_POST['specdropdownSort'.$s];
				$specificationtitle = $_POST['specificationtitle'.$s];
				
				$specification_option_edit_id = $_POST['specification_option_edit_id'.$s];	
				
				if($specificationtitle!='') {
					if($specification_option_edit_id != ''){
						
						$strspecial = "update ".TPLPrefix."feature_specification set spectitle=?,specvalue=?,sortingorder=?,IsActive=?,ModifiedDate=? ".$specimagenamefield." where specificationid = ? and featureid = ? and IsActive = ? ";
								
						$qry_main = array(getRealescape($specificationtitle),getRealescape($specvalue),$specdropdownSort,1,$today);
						$qry_main1 = array($specification_option_edit_id,$edit_id,1);
			
						$result_data = array_merge($qry_main,$specimagenamearr,$qry_main1);			
						$rslt = $db->insert_bind($strspecial,$result_data);
							
						$log = $db->insert_log("update","".TPLPrefix."feature_specification",$edit_id,"feature specification updated","feature_specification",$specialQuery);
						
						
					}else{ 
									
				$str= "insert into ".TPLPrefix."feature_specification(featureid,specimage,spectitle,specvalue,sortingorder,userid,IsActive,CreatedDate,ModifiedDate)values(?,?,?,?,?,?,?,?,?)";
								
				$db->insert_bind($str,array($edit_id,getRealescape($specimagename),getRealescape($specificationtitle),getRealescape($specvalue),$specdropdownSort,$_SESSION["UserId"],1,$today,$today));		
				$log = $db->insert_log("insert","".TPLPrefix."feature_specification",$edit_id,"feature specification created","feature_specification",$str);
					}
					
					
				}
										
			 }			 			 						
			################### Specification end ##################
			
			
			
			################### Additional Feature Section start ##################
		/* echo $additionalfeat_option_max_count;
		 for($gg=0;$gg<=$additionalfeat_option_max_count;$gg++) {
			echo  'ID: '.$_POST['additionalfeat_option_edit_id'.$gg];
		 }
		 
		 die();*/
		 
$specimagenamearra = $specimagenamearra1 = array();
 

   			for($gg=0;$gg<$additionalfeat_option_max_count;$gg++) {
				if(isset($_FILES["addfeatureimage".$gg])){		
					$file_info = getimagesize($_FILES["addfeatureimage".$gg]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','PNG','bmp') ) ){
						echo json_encode(array("rslt"=>"171"));
						exit();
					}
 				
						  $specimagename=str_replace(' ','_',$_FILES['addfeatureimage'.$gg]['name']);
						  $specimagename=time().rand(0,9).$specimagename;	
						  $target_file = '../uploads/featureuploads/additionalfeature/'.$specimagename;
						  move_uploaded_file($_FILES["addfeatureimage".$gg]["tmp_name"], $target_file);
						  
						   $specimagenamearra[] = $specimagename;
						   $specimagenamefld = " ,featureimage=?";
						   
						   $specimagenamearra1[] = $specimagename;
						   $specimagenamefld1 = " ,videoimage=?"; 
						   
						   
				}			
				
				
				$addfeaturetitle = trim($_POST['addfeaturetitle'.$gg]); 
				$alignmenttype = $_POST['alignmenttype'.$gg];
				$addfeadescription = $_POST['addfeadescription'.$gg];
				$addfeabuttonurl = $_POST['addfeabuttonurl'.$gg];
				$videolink = $_POST['videolink'.$gg];
				$addfeadropdownSort =$_POST['addfeadropdownSort'.$gg];
				$featuretype = $_POST['featuretype'.$gg];
				
				  $additionalfeat_option_edit_id = $_POST['additionalfeat_option_edit_id'.$gg];	
				/*echo 'additionalfeat_option_edit_id'.$gg;
				echo $addfeaturetitle;
				echo "\n\n";
				*/
				if($addfeaturetitle != ''){
					if($_POST['additionalfeat_option_edit_id'.$gg] != ''){
						
						  $strspecial = "update ".TPLPrefix."feature_additional set aligntype=?,featuretype=?,featuretitle=?,shortdescription=?,videolink=?,buttonurl=?,sortingorder=?,IsActive=?,ModifiedDate=? ".$specimagenamefld." ".$specimagenamefld1." where addid = ? and featureid = ? and IsActive = ? ";
								
						$qry_main = array(getRealescape($alignmenttype),getRealescape($featuretype),getRealescape($addfeaturetitle),getRealescape($addfeadescription),$videolink,$addfeabuttonurl,$addfeadropdownSort,1,$today);
						$qry_main1 = array($additionalfeat_option_edit_id,$edit_id,1);
						
						$result_data = array_merge($qry_main,$specimagenamearra,$specimagenamearra1,$qry_main1);
						 
						
						$rslt = $db->insert_bind($strspecial,$result_data);
							
						$log = $db->insert_log("update","".TPLPrefix."feature_specification",$edit_id,"feature specification updated","feature_specification",$specialQuery);
						
						
					}else{
				    $str= "insert into ".TPLPrefix."feature_additional(featureid, aligntype, featuretype, featuretitle, shortdescription, featureimage, videolink, videoimage, buttonurl, sortingorder, userid, IsActive, CreatedDate, ModifiedDate)values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					
				 
			 
					$db->insert_bind($str,array($lastInserId,$alignmenttype,getRealescape($featuretype),getRealescape($addfeaturetitle),getRealescape($addfeadescription),$specimagename,$videolink,$specimagename,$addfeabuttonurl,$addfeadropdownSort,$_SESSION["UserId"],1,$today,$today));	
					$log = $db->insert_log("insert","".TPLPrefix."feature_additional",$edit_id,"feature specification created","feature_additional",$str);
					}
				}
				
				
			}
			
			############### Additional Feature Section
			
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
	
	case 'del':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $str="update ".TPLPrefix."m_attributes set IsActive = ?, UserId=?  where attributeid = ?";
	  $db->insert_log("delete","".TPLPrefix."m_attributes",$edit_id,"Attributes deleted","Attributes",$str);
	  $db->insert_bind($str,array('2',$_SESSION["UserId"],$edit_id)); 

        //select module id
	       $mpath = "attributevalue_mng.php?attid=".base64_encode($edit_id)." ";
           $mid = "select ModuleId from ".TPLPrefix."modules where  IsActive != '2' and ModulePath = '".$mpath."' ";
 	       $reslt = $db->get_a_line($mid);	
	       $moduleid = $reslt['ModuleId'];	

         //  delete module	
           $str="update ".TPLPrefix."modules set IsActive =?, ModifiedDate =? , UserId=?  where ModuleId = ?  and ModuleId NOT IN(1,2,3) ";
	       $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$moduleid));		 	  
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
	
	 $str="update ".TPLPrefix."m_attributes set IsActive = ?, UserId=?  where attributeid = ?";
	 $db->insert_log("update"," ".TPLPrefix."m_attributes",$edit_id,"Attributes Statuschanged","Attributes",$str);
	 $db->insert_bind($str,array($status,$_SESSION["UserId"],$edit_id)); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	case 'deloptionsvalue':		
	
	 $str = "delete from ".TPLPrefix."dropdown where  dropdown_id = ? limit 1 ";	 
	 $db->insert_bind($str,array($dropdown_id)); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
	case 'remove_additionalfeat_option':
	
	  $delquery = "update ".TPLPrefix."feature_additional set IsActive = ? where addid = ? and IsActive=?";
	  $db->insert_bind($delquery,array(2,$addid,1));
	  $db->insert_log("update"," ".TPLPrefix."feature_additional",$edit_id,"Addition feature deleted","feature_additional",$delquery);
	  
	  echo json_encode(array("rslt"=>"1"));
	break;
	
	case 'remove_specification_option':
	
	  $delquery = "update ".TPLPrefix."feature_specification set IsActive = ? where specificationid = ? and IsActive=?";
	  $db->insert_bind($delquery,array(2,$specificationid,1));
	  $db->insert_log("update"," ".TPLPrefix."feature_specification",$edit_id,"specification deleted","feature_specification",$delquery);
	  
	  echo json_encode(array("rslt"=>"1"));
	break;
	
	case 'remove_special_option':
	
	  $delquery = "update ".TPLPrefix."product_specialfeature set IsActive = ? where specialid = ? and IsActive=?";
	  $db->insert_bind($delquery,array(2,$specialid,1));
	  $db->insert_log("update"," ".TPLPrefix."feature_additional",$edit_id,"Addition feature deleted","feature_additional",$delquery);
	  
	  echo json_encode(array("rslt"=>"1"));
	break;
}



?>