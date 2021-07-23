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
		if(!empty($CityName) ) {
			$strChk = "select count(cityid) from ".TPLPrefix."city where cityname = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($CityName),'2'));
			if($reslt[0] == 0) {
				
				$str="insert into ".TPLPrefix."city(countryid,stateid,cityname,IsActive,UserId,CreatedDate) values(?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($CountryID),getRealescape($StateID),getRealescape($CityName),$status,$_SESSION["UserId"],$datetime));	
				
				$log = $db->insert_log("insert","".TPLPrefix."city","","City Added Newly","City",$str);
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
		if(!empty($CityName) ) {
			$strChk = "select count(cityid) from ".TPLPrefix."city where cityname = ? and IsActive != ? and cityid != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($CityName),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				$str = "update ".TPLPrefix."city set countryid = ?, stateid = ?, cityname = ?, IsActive = ?, ModifiedDate = ? , UserId=?  where cityid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($CountryID),getRealescape($StateID),getRealescape($CityName),$status,$datetime,$_SESSION["UserId"],$edit_id));
				$db->insert_log("update","".TPLPrefix."city",$edit_id,"City updated","City",$str);

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
		$str="update ".TPLPrefix."city set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where cityid = '".$edit_id."' ";
		$db->insert($str); 	 
		  
		$db->insert_log("delete","".TPLPrefix."city",$edit_id,"City deleted","City",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		$ref_cnt = reference_exist($db,"city",$edit_id);

		if($ref_cnt == 0){				
		$str="update ".TPLPrefix."city set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where cityid = '".$edit_id."' ";
		$db->insert($str); 		
		echo json_encode(array("rslt"=>"6")); //status update success	
		}else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
		
	break;
	
}


function reference_exist($db,$table,$id) {
	if(strtolower($table) == "city") {
		$reference_table = TPLPrefix."pincode";
	}
	
 	$ref_xst_qry = "select count(*) as ref_cnt from ".$reference_table." where cityid = '".$id."' and IsActive = 1 ";
	$ref_xst = $db->get_a_line($ref_xst_qry);
	$ref_cnt = $ref_xst['ref_cnt'];
	return $ref_cnt;
}

?>