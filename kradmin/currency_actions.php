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
 		if(!empty($currencyTitle) ) {
			$strChk = "select count(currencyid) from ".TPLPrefix."currency where currencyTitle = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($currencyTitle),'2'));
			if($reslt[0] == 0) {
				
			 	$str="insert into ".TPLPrefix."currency(currencyTitle,currencysymbol,curpriceusd,IsActive,UserId,CreatedDate) values(?,?,?,?,?,?)";
			//print_r(array(getRealescape($currencyTitle),getRealescape($currencysymbol),getRealescape($curpriceusd),$status,$_SESSION["UserId"],$datetime));
				$rslt = $db->insert_bind($str,array(getRealescape($currencyTitle),getRealescape($currencysymbol),getRealescape($curpriceusd),$status,$_SESSION["UserId"],$datetime));	
				
				$log = $db->insert_log("insert","".TPLPrefix."currency","","Currency Added Newly","Currency",$str);
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
 		if(!empty($currencyTitle) ) {
			$strChk = "select count(currencyid) from ".TPLPrefix."currency where currencyTitle = ? and IsActive != ? and currencyid != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($currencyTitle),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				$str = "update ".TPLPrefix."currency set currencyTitle = ?, currencysymbol = ?, curpriceusd = ?, IsActive = ?, ModifiedDate = ? , UserId=?  where currencyid = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($currencyTitle),getRealescape($currencysymbol),getRealescape($curpriceusd),$status,$datetime,$_SESSION["UserId"],$edit_id));
				$db->insert_log("update","".TPLPrefix."currency",$edit_id,"Currency updated","Currency",$str);

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
		  
		$str="update ".TPLPrefix."currency set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where currencyid = '".$edit_id."' ";
		$db->insert($str); 	 
		  
		$db->insert_log("delete","".TPLPrefix."currency",$edit_id,"Currency deleted","Currency",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
				
		$str="update ".TPLPrefix."currency set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where currencyid = '".$edit_id."' ";
		$db->insert($str); 		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}

?>