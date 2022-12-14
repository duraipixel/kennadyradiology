<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

$status =1;

$datetime=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
		if(!empty($pagename) ) {
			$strChk = "select count(variableid) from ".TPLPrefix."language_pages where pagename = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($pagename),'2'));
			if($reslt[0] == 0) {
				
				$str="insert into ".TPLPrefix."language_pages(pagename,lang_id,pagecontent,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($pagename),1,getRealescape($pagecontent),getRealescape($pagecode),1,$datetime,0));	
$insert_id=	$db->insert_id;				
							 
				$str="insert into ".TPLPrefix."language_pages(pagename,lang_id,pagecontent,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($pagename),2,getRealescape($pagecontent_es),getRealescape($pagecode),1,$datetime,$insert_id));	
				
				$str="insert into ".TPLPrefix."language_pages(pagename,lang_id,pagecontent,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($pagename),3,getRealescape($pagecontent_pt),getRealescape($pagecode),1,$datetime,$insert_id));	
				
				
				$log = $db->insert_log("insert","".TPLPrefix."language_pages","","language_pages Added Newly","language_pages",$str);
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
		if(!empty($pagename) ) {
			$strChk = "select count(pageid) from ".TPLPrefix."language_pages where   IsActive != ? and pageid != ? ";
			$reslt = $db->get_a_line_bind($strChk,array('2',getRealescape($edit_id)));
			//if($reslt[0] == 0) {
				
			 
				$str = "update ".TPLPrefix."language_pages set pagecontent = ?,pagename=?  where pageid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($pagecontent),getRealescape($pagename),$edit_id));
				
				  $stres = "update ".TPLPrefix."language_pages set pagecontent = ?,pagename=?  where pageid = ? ";
				$rslt = $db->insert_bind($stres,array(getRealescape($pagecontent_es),getRealescape($pagename),$edit_id_es));
				
				  $str = "update ".TPLPrefix."language_pages set pagecontent = ?,pagename=?  where pageid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($pagecontent_pt),getRealescape($pagename),$edit_id_pt));
			
			$db->insert_log("update","".TPLPrefix."language_pages",$edit_id,"language_pages updated","language_pages",$str);

				echo json_encode(array("rslt"=>"2"));
			//}
			//else {
				//echo json_encode(array("rslt"=>"3")); //same exists
			//}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
		
	break;
	
	
	case 'del':
	
		$edit_id = base64_decode($Id);
		$ref_cnt = reference_exist($db,"language_pages",$edit_id);

		if($ref_cnt == 0){			  
		$str="update ".TPLPrefix."language_pages set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where pageid = '".$edit_id."' ";
		$db->insert($str); 	 
		  
		$db->insert_log("delete","".TPLPrefix."language_pages",$edit_id,"language_pages deleted","language_pages",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		$ref_cnt = reference_exist($db,"language_pages",$edit_id);

		if($ref_cnt == 0){				
		$str="update ".TPLPrefix."language_pages set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where pageid = '".$edit_id."' ";
		$db->insert($str); 		
		echo json_encode(array("rslt"=>"6")); //status update success	
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
		
	break;
	
}


function reference_exist($db,$table,$id) {
	if(strtolower($table) == "language_pages") {
		$reference_table = TPLPrefix."pincode";
	}
	
 	$ref_xst_qry = "select count(*) as ref_cnt from ".$reference_table." where pageid = '".$id."' and IsActive = 1 ";
	$ref_xst = $db->get_a_line($ref_xst_qry);
	$ref_cnt = $ref_xst['ref_cnt'];
	return $ref_cnt;
}

?>