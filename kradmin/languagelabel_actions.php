<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

$status =1;

$datetime=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
		if(!empty($displayname) ) {
			$strChk = "select count(variableid) from ".TPLPrefix."language_variables where displayname = ? and IsActive != ? and pagecode = ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($displayname),'2',$pagecode));
			if($reslt[0] == 0) {
				
				$str="insert into ".TPLPrefix."language_variables(displayname,lang_id,shortcode,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname_es),1,getRealescape($shortcode),getRealescape($pagecode),1,$datetime,0));	
$insert_id=	$db->insert_id;				
							 
				$str="insert into ".TPLPrefix."language_variables(displayname,lang_id,shortcode,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname_es),2,getRealescape($shortcode),getRealescape($pagecode),1,$datetime,$insert_id));	
				
				$str="insert into ".TPLPrefix."language_variables(displayname,lang_id,shortcode,pagecode,IsActive,createddate,parent_id) values(?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname_pt),3,getRealescape($shortcode),getRealescape($pagecode),1,$datetime,$insert_id));	
				
				
				$log = $db->insert_log("insert","".TPLPrefix."language_variables","","language_variables Added Newly","language_variables",$str);
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
		if(!empty($displayname) ) {
			$strChk = "select count(variableid) from ".TPLPrefix."language_variables where   IsActive != ? and variableid != ? ";
			$reslt = $db->get_a_line_bind($strChk,array('2',getRealescape($edit_id)));
			//if($reslt[0] == 0) {
				
			 
				$str = "update ".TPLPrefix."language_variables set displayname = ?,pagecode=?,shortcode=?  where variableid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname),getRealescape($pagecode),getRealescape($shortcode),$edit_id));
				
				$str = "update ".TPLPrefix."language_variables set displayname = ?,pagecode=?,shortcode=?  where variableid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname_es),getRealescape($pagecode),getRealescape($shortcode),$edit_id_es));
				
				$str = "update ".TPLPrefix."language_variables set displayname = ?,pagecode=?,shortcode=?  where variableid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($displayname_pt),getRealescape($pagecode),getRealescape($shortcode),$edit_id_pt));
			
			$db->insert_log("update","".TPLPrefix."language_variables",$edit_id,"language_variables updated","language_variables",$str);

				echo json_encode(array("rslt"=>"2"));
			//}
			//else {
			//	echo json_encode(array("rslt"=>"3")); //same exists
			//}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
		
	break;
	
	
	case 'del':
	
		$edit_id = base64_decode($Id);
		$ref_cnt = reference_exist($db,"language_variables",$edit_id);

		if($ref_cnt == 0){			  
		$str="update ".TPLPrefix."language_variables set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where variableid = '".$edit_id."' ";
		$db->insert($str); 	 
		  
		$db->insert_log("delete","".TPLPrefix."language_variables",$edit_id,"language_variables deleted","language_variables",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		$ref_cnt = reference_exist($db,"language_variables",$edit_id);

		if($ref_cnt == 0){				
		$str="update ".TPLPrefix."language_variables set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where variableid = '".$edit_id."' ";
		$db->insert($str); 		
		echo json_encode(array("rslt"=>"6")); //status update success	
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
		
	break;
	
}


function reference_exist($db,$table,$id) {
	if(strtolower($table) == "language_variables") {
		$reference_table = TPLPrefix."pincode";
	}
	
 	$ref_xst_qry = "select count(*) as ref_cnt from ".$reference_table." where variableid = '".$id."' and IsActive = 1 ";
	$ref_xst = $db->get_a_line($ref_xst_qry);
	$ref_cnt = $ref_xst['ref_cnt'];
	return $ref_cnt;
}

?>