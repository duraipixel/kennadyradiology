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
	case 'del':	
			$edit_id = base64_decode($Id);		  	   
			$str="update ".TPLPrefix."subscribe set IsActive = '2', modifieddate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where subscribeid = '".$edit_id."' ";
			$db->insert($str); 	 
	break;	
	
	case 'changestatus':	
		$edit_id = base64_decode($Id);
		$status = $actval;		 		
			$str="update ".TPLPrefix."subscribe set IsActive = '".$status."', modifieddate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where subscribeid = '".$edit_id."' ";
			$db->insert($str); 		
			echo json_encode(array("rslt"=>"6")); //status update success				 
	break;	
}
?>