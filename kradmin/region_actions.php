<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

$created=date('Y-m-d H:i:s');

if($chkstatus !=null)
	$status =1;
else
	$status =0;

switch($act)
{
	case 'insert':
	
	if(!empty($txtRegionName)) {
		$strChk = "select count(RegionId) from ".TPLPrefix."region where RegionName = '$txtRegionName' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			$str="insert into ".TPLPrefix."region(RegionName,IsActive,UserId,createddate)values('".getRealescape($txtRegionName)."','".$status."','".$_SESSION["UserId"]."','".$created."')";
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".TPLPrefix."region","","Region Added Newly","Region",$str);
			
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
	
	$today=date("Y-m-d");	
	if(!empty($txtRegionName)) {
		$strChk = "select count(RegionId) from ".TPLPrefix."region where RegionName = '$txtRegionName' and IsActive != '2' and RegionId != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".TPLPrefix."region set RegionName = '".getRealescape($txtRegionName)."', UserId='".$_SESSION["UserId"]."', IsActive =  '".$status."' where RegionId = '".$edit_id."'";
		
			$db->insert_log("update","".TPLPrefix."region",$edit_id,"Region updated","Region",$str);
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
	  
	   
		  
		
		
		$str="update ".TPLPrefix."region set IsActive = '2',  UserId='".$_SESSION["UserId"]."'  where RegionId = '".$edit_id."'";
		
		$db->insert_log("delete","".TPLPrefix."region",$edit_id,"Region deleted","Region",$str);
		
		$db->insert($str); 		
		  
	
		echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	  $status = $actval;	  
	   
		$str="update ".TPLPrefix."region set IsActive = '$status',  UserId='".$_SESSION["UserId"]."'  where RegionId = '".$edit_id."'";
		$db->insert_log("update","".TPLPrefix."region",$edit_id,"Region status Changed","Region",$str);
		$db->insert($str); 
		
	  
		
		echo json_encode(array("rslt"=>"6")); //deletion	  	 
	   
	break;
}



?>