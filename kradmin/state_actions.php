<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$datetime=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
	
		if(!empty($StateName) ) {
			$strChk = "select count(stateid) from ".TPLPrefix."state where statename = '$StateName' and IsActive != '2'";		
			$reslt = $db->get_a_line($strChk);
			if($reslt[0] == 0) {
				
				$str="insert into ".TPLPrefix."state(countryid,statename,IsActive,UserId,CreatedDate,taxcode) values('".getRealescape($CountryID)."','".getRealescape($StateName)."','".$status."','".$_SESSION["UserId"]."','".$datetime."','".$taxcode."')";
				$rslt = $db->insert($str);	
				
				$log = $db->insert_log("insert","".TPLPrefix."state","","State Added Newly","State",$str);
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

		if(!empty($StateName) ) {
			$strChk = "select count(stateid) from ".TPLPrefix."state where statename = '$StateName' and IsActive != '2' and stateid != '".$edit_id."' ";
			$reslt = $db->get_a_line($strChk);
			if($reslt[0] == 0) {
				$str = "update ".TPLPrefix."state set countryid = '".getRealescape($CountryID)."', statename = '".getRealescape($StateName)."', IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."', taxcode = '".$taxcode."'  where stateid = '".$edit_id."'";
				$db->insert($str);
				$db->insert_log("update","".TPLPrefix."state",$edit_id,"State updated","State",$str);

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
		  
		$ref_cnt = reference_exist($db,"city",$edit_id);  
		  
		if($ref_cnt == 0){	  
			$str="update ".TPLPrefix."state set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where stateid = '".$edit_id."' ";
			$db->insert($str); 	 
		  
			$db->insert_log("delete","".TPLPrefix."state",$edit_id,"State deleted","State",$str);
			echo json_encode(array("rslt"=>"5")); //deletion
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		
		$ref_cnt = reference_exist($db,"city",$edit_id);

		if($ref_cnt == 0){			
			$str="update ".TPLPrefix."state set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where stateid = '".$edit_id."' ";
			$db->insert($str); 		
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
		
	break;
	
}

function reference_exist($db,$table,$id) {
	if(strtolower($table) == "city") {
		$reference_table = TPLPrefix."city";
	}
	
 	$ref_xst_qry = "select count(*) as ref_cnt from ".$reference_table." where stateid = '".$id."' and IsActive = 1 ";
	$ref_xst = $db->get_a_line($ref_xst_qry);
	$ref_cnt = $ref_xst['ref_cnt'];
	return $ref_cnt;
}

?>