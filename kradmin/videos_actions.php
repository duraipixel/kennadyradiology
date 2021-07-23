<?php 
include 'session.php';
extract($_REQUEST);

$act=$action;

$sizes = getdynamicimage($db,'videoimage','videoimages');
$today = date('Y-m-d H:i:s');
 
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES["video_image"]['tmp_name']);

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$date_time = date('Y-m-d H:i:s');

if($chkmain !=null)
	$chkmain =1;
else
	$chkmain =0;

switch($act)
{
	case 'insert':
	
	$video_code = clean(trim($video_title));
	$video_code =urlencode(strtolower($video_code));
			
	if(!empty($video_title)) {
	
		$strChk = "select count(video_id) from ".TPLPrefix."videos where video_title = '".$video_title."' and video_code = '".$video_code."' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
		$bannerimg='';
				if(isset($_FILES["video_image"])){
					 
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["video_image"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg=str_replace(' ','_',$_FILES['video_image']['name']);
					  $bannerimg=time().rand(0,9).$bannerimg;	
					  $target_file = '../uploads/videoimages/'.$bannerimg;
					 
					  move_uploaded_file($_FILES["video_image"]["tmp_name"], $target_file);
						//image upload path - ends	
					 
				}			
			$video_date = date("Y-m-d", strtotime($video_date));
			
		 	$str="insert into ".TPLPrefix."videos(video_title,video_code,video_date,video_url,IsActive,userid,createDate,parent_id,lang_id,video_image)values('".getRealescape($video_title)."','".$video_code."','".$video_date."','".$video_url."','".$status."','".$_SESSION["UserId"]."','".$date_time."',0,1,'".$bannerimg."')";
			
			$rslt = $db->insert($str);	
			$insertid = $db->insert_id;

$str="insert into ".TPLPrefix."videos(video_title,video_code,video_date,video_url,IsActive,userid,createDate,parent_id,lang_id,video_image)values('".getRealescape($video_title_es)."','".$video_code."','".$video_date."','".$video_url_es."','".$status."','".$_SESSION["UserId"]."','".$date_time."','".$insertid."',2,'".$bannerimg."')";
			
			$rslt = $db->insert($str);	

$str="insert into ".TPLPrefix."videos(video_title,video_code,video_date,video_url,IsActive,userid,createDate,parent_id,lang_id,video_image)values('".getRealescape($video_title_pt)."','".$video_code."','".$video_date."','".$video_url_pt."','".$status."','".$_SESSION["UserId"]."','".$date_time."','".$insertid."',3,'".$bannerimg."')";
			
			$rslt = $db->insert($str);				
			$log = $db->insert_log("insert","".TPLPrefix."videos","","Videos Added Newly","videos",$str);
			
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
	
	$video_code = clean(trim($video_title));
	$video_code =urlencode(strtolower($video_code));
 	
	if(!empty($video_title)) {
		
		
			
		$strChk = "select count(video_id) from ".TPLPrefix."videos where video_title = '".$video_title."' and video_code = '".$video_code."' and IsActive != '2' and video_id != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
				$bannerimg = array();	
				if(isset($_FILES["video_image"])){
 					 
						$file_info = getimagesize($_FILES["video_image"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $imgname=str_replace(' ','_',$_FILES['video_image']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/videoimages/'.$imgname;
					 
					  move_uploaded_file($_FILES["video_image"]["tmp_name"], $target_file);
						 
						$bannernamedesk = " ,video_image='".getRealescape($imgname)."' ";	
					
				    
						
				}	
			
			$video_date = date("Y-m-d", strtotime($video_date));
			
			  $str = "update ".TPLPrefix."videos set video_title='".getRealescape($video_title)."', video_code='".$video_code."', video_date = '".$video_date."', video_url = '".$video_url."',  IsActive = '".$status."', userid='".$_SESSION["UserId"]."', modifyDate = '".$date_time."' ".$bannernamedesk." where video_id = '".$edit_id."'";			
			
			$db->insert_log("update","".TPLPrefix."videos",$edit_id,"Videos updated","videos",$str);
			$db->insert($str);
			
			$str = "update ".TPLPrefix."videos set video_title='".getRealescape($video_title_es)."', video_code='".$video_code."', video_date = '".$video_date."', video_url = '".$video_url_es."',  IsActive = '".$status."', userid='".$_SESSION["UserId"]."', modifyDate = '".$date_time."' where video_id = '".$edit_id_es."'";			
			 $db->insert($str);
			
$str = "update ".TPLPrefix."videos set video_title='".getRealescape($video_title_pt)."', video_code='".$video_code."', video_date = '".$video_date."', video_url = '".$video_url_pt."',  IsActive = '".$status."', userid='".$_SESSION["UserId"]."', modifyDate = '".$date_time."' where video_id = '".$edit_id_pt."'";			
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
	  
	  $today = date("Y-m-d");
	  $str="update ".TPLPrefix."videos set IsActive = '2', modifyDate = '".$date_time."' , userid='".$_SESSION["UserId"]."'  where video_id = '".$edit_id."'";
	 
	  $db->insert_log("delete","".TPLPrefix."videos",$edit_id,"Videos deleted","videos",$str);
	  $db->insert($str);
	  
	  $str="update ".TPLPrefix."videos set IsActive = '2', modifyDate = '".$date_time."' , userid='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."'";
	  $db->insert($str);
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion	  	 
		
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		$status = $actval;
	
		$str="update ".TPLPrefix."videos set IsActive = '".$status."', modifyDate = '".$date_time."' , userid='".$_SESSION["UserId"]."'  where video_id = '".$edit_id."'";
	 
		$db->insert_log("status","".TPLPrefix."videos",$edit_id,"Videos status","videos",$str);
		$db->insert($str); 	
		
		$str="update ".TPLPrefix."videos set IsActive = '".$status."', modifyDate = '".$date_time."' , userid='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."'";
	 $db->insert($str);
	 
	 
	 echo json_encode(array("rslt"=>"6")); //status update success	
	break;
		
}



?>