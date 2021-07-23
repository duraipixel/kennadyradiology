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
 		if(!empty($pincode) ) {
			$strChk = "select count(pincodeid) from ".TPLPrefix."pincode where pincode = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($pincode),'2'));
			if($reslt[0] == 0) {
				
				$str="insert into ".TPLPrefix."pincode(pincode,cityid,areaid,IsActive,UserId,CreatedDate) values(?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($pincode),getRealescape($CityID),'0',$status,$_SESSION["UserId"],$datetime));	
				
				$log = $db->insert_log("insert","".TPLPrefix."pincode","","Pincode Added Newly","Pincode",$str);
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
 		if(!empty($pincode) ) {
			$strChk = "select count(pincodeid) from ".TPLPrefix."pincode where pincode = ? and IsActive != ? and pincodeid != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($pincode),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				$str = "update ".TPLPrefix."pincode set pincode = ?, cityid = ?, IsActive = ?, ModifiedDate = ? , UserId=?  where pincodeid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($pincode),getRealescape($CityID),$status,$datetime,$_SESSION["UserId"],$edit_id));
				$db->insert_log("update","".TPLPrefix."pincode",$edit_id,"Pincode updated","Pincode",$str);

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
		
		$str="update ".TPLPrefix."pincode set IsActive = ?, ModifiedDate = ? , UserId= ? where pincodeid = ? ";  
		$rslt = $db->insert_bind($str,array('2',getRealescape($datetime),$_SESSION["UserId"],$edit_id)); 		
		  
		$db->insert_log("delete","".TPLPrefix."area",$edit_id,"Area deleted","area",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		
		$str="update ".TPLPrefix."pincode set IsActive = ?, ModifiedDate = ? , UserId= ?  where pincodeid = ? ";		
		$rslt = $db->insert_bind($str,array($status,getRealescape($datetime),$_SESSION["UserId"],$edit_id));		
		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}

?>