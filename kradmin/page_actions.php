<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
$today=date("Y-m-d");	


if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");
switch($act)
{
	case 'insert':
	
		if(!empty($txtPageslug)) {
			
			//check last character "-" to be removed from string after that checked - START
			$chk_slug_lstchr = substr($txtPageslug, -1);		
			if($chk_slug_lstchr == "-"){
				$slug_name = substr($txtPageslug, 0, -1);
			}
			else{
				$slug_name = $txtPageslug;
			}
			//check last character "-" to be removed from string after that checked - END
			
			//check slug name from database table - START
			$rslt_slugchk = $db->get_a_line("select count(*) as slugcnt  from ".TPLPrefix."cms_pages where 1=1 and actual_slug ='".getRealescape($slug_name)."'  ");	
			if($rslt_slugchk['slugcnt'] == 0){
				$slug_name_sve = $slug_name;
			}
			else{
				$slug_name_sve = $slug_name."-".$rslt_slugchk['slugcnt'];
			}
			//check slug name from database table - END
			
			$str="insert into ".TPLPrefix."cms_pages(cms_pagename, cms_pageurl, cms_pagedesc, cms_metatitle, cms_metadesc, cms_metakeywords, IsActive, UserId, actual_slug, createdDate,modifiedDate)values('".getRealescape($txtPagename)."','".getRealescape($slug_name_sve)."','".getRealescape($pagecontent)."','".getRealescape($txtmetatitle)."','".getRealescape($txtmetadesc)."','".getRealescape($txtmetakeyword)."','".$status."','".$_SESSION["UserId"]."','".getRealescape($slug_name)."' ,'".$today."','".$today."')";
			//echo $str; exit;
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".TPLPrefix."cms_pages","","CMS-Page Add Successfully","cmspage",$str);
			
			
			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
		
	break;
	
	
	case 'update':	 	
	//$edit_id
	
		$str = "update ".TPLPrefix."cms_pages set cms_pagename = '".getRealescape($txtPagename)."', cms_pagedesc = '".getRealescape($pagecontent)."',cms_metatitle = '".getRealescape($txtmetatitle)."',cms_metadesc = '".getRealescape($txtmetadesc)."',cms_metakeywords = '".getRealescape($txtmetakeyword)."', UserId='".$_SESSION["UserId"]."',modifiedDate = '".$today."'  where cms_pageid = '".$edit_id."'";
		$db->insert_log("update","".TPLPrefix."cms_pages",$edit_id,"CMS-Page updated","cmspage",$str);
		$db->insert($str);
		

		echo json_encode(array("rslt"=>"2"));
				
	break;
	
	case 'del':
		$edit_id = base64_decode($Id);	
		$str = "update ".TPLPrefix."cms_pages set IsActive = '2',modifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where cms_pageid = '".$edit_id."'";
		$db->insert_log("delete","".TPLPrefix."cms_pages",$edit_id,"CMS-Page Deleted","cmspage",$str);
		$db->insert($str);
		
		
		echo json_encode(array("rslt"=>"5")); //deletion	
	  
	  // echo json_encode(array("rslt"=>"7")); //not change	
	  //echo json_encode(array("rslt"=>"5")); //deletion	  
		
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);	
		$status = $actval;
		  
		$str = "update ".TPLPrefix."cms_pages set IsActive = '".$status."', modifiedDate = '".$today."',UserId='".$_SESSION["UserId"]."'  where cms_pageid = '".$edit_id."'";
		
		$db->insert_log("update","".TPLPrefix."cms_pages",$edit_id,"CMS-Page Status change","cmspage",$str);
		$db->insert($str);
		
		
		echo json_encode(array("rslt"=>"6")); //Status Change
	  
	  //echo json_encode(array("rslt"=>"7")); //not change	
	  //echo json_encode(array("rslt"=>"6")); //Status Change		
	  
	break;
}



?>