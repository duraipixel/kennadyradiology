<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
//$today=date("Y-m-d");	


if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");
switch($act)
{
	case 'insert':
	
		if(!empty($txtblockslug)) {
			
			//check last character "-" to be removed from string after that checked - START
			$chk_slug_lstchr = substr($txtblockslug, -1);		
			if($chk_slug_lstchr == "-"){
				$slug_name = substr($txtblockslug, 0, -1);
			}
			else{
				$slug_name = $txtblockslug;
			}
			//check last character "-" to be removed from string after that checked - END
			
			//check slug name from database table - START
			$rslt_slugchk = $db->get_a_line("select count(*) as slugcnt from ".TPLPrefix."cms_block where 1=1 and actual_slug ='".getRealescape($slug_name)."'  ");	
			if($rslt_slugchk['slugcnt'] == 0){
				$slug_name_sve = $slug_name;
			}
			else{
				$slug_name_sve = $slug_name."-".$rslt_slugchk['slugcnt'];
			}
			//check slug name from database table - END
			
			$str="insert into ".TPLPrefix."cms_block(cms_blockname, cms_blogslug, cms_blogdesc,front_content, IsActive, UserId, actual_slug, createdDate,modifiedDate)values('".getRealescape($txtblockname)."','".getRealescape($slug_name_sve)."','".getRealescape($blockcontent)."','".getRealescape(str_replace(image_replace_url,'',$blockcontent))."','".$status."','".$_SESSION["UserId"]."','".getRealescape($slug_name)."' ,'".$today."','".$today."')";
			
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".TPLPrefix."cms_block","","CMS-Block Add Successfully","cmsblock",$str);
			
			
			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
		
	break;
	
	
	case 'update':	 	
	//$edit_id
	
		$str = "update ".TPLPrefix."cms_block set cms_blockname = '".getRealescape($txtblockname)."', cms_blogdesc = '".getRealescape($blockcontent)."', front_content='".getRealescape(str_replace(image_replace_url,'',$blockcontent))."', UserId='".$_SESSION["UserId"]."', IsActive = '".$status."',ModifiedDate = '".$today."' where cms_blockid = '".$edit_id."'";
		
		$db->insert_log("update","".TPLPrefix."cms_block",$edit_id,"CMS-Block updated","cmsblock",$str);
		
		$db->insert($str);
		

		echo json_encode(array("rslt"=>"2"));
				
	break;
	
	case 'del':
		$edit_id = base64_decode($Id);	
		$str = "update ".TPLPrefix."cms_block set IsActive = '2',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."' where cms_blockid = '".$edit_id."'";
		$db->insert_log("delete","".TPLPrefix."cms_block",$edit_id,"CMS-Block Deleted","cmsblock",$str);
		$db->insert($str);
		
		
		echo json_encode(array("rslt"=>"5")); //deletion	
	  
	  // echo json_encode(array("rslt"=>"7")); //not change	
	  //echo json_encode(array("rslt"=>"5")); //deletion	  
		
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);	
		$status = $actval;
		  
		$str = "update ".TPLPrefix."cms_block set IsActive = '".$status."',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where cms_blockid = '".$edit_id."'";
		
		$db->insert_log("update","".TPLPrefix."cms_block",$edit_id,"CMS-Block Status change","cmsblock",$str);
		$db->insert($str);
		
		
		echo json_encode(array("rslt"=>"6")); //Status Change
	  
	  //echo json_encode(array("rslt"=>"7")); //not change	
	  //echo json_encode(array("rslt"=>"6")); //Status Change		
	  
	break;
}



?>