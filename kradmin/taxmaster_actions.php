<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$datetime=date('Y-m-d H:i:s');
$getlanguage = getLanguages($db);
switch($act)
{
	case 'insert':
		if(!empty($taxName) ) {
			$strChk = "select count(taxId) from ".TPLPrefix."taxmaster where taxName = ? and IsActive != ? ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($taxName),'2'));
			if($reslt[0] == 0) {
				$parentidval = 0;
				foreach($getlanguage as $languageval){
				$str="insert into ".TPLPrefix."taxmaster(taxName,taxDesc,taxTyp,taxRate,IsActive,UserId,CreatedDate,parent_id,lang_id) values(?,?,?,?,?,?,?,?,?)";
				$rslt = $db->insert_bind($str,array(getRealescape($_POST['taxName'.$languageval['languagefield']]),getRealescape($_POST['taxDesc'.$languageval['languagefield']]),getRealescape($taxTyp),getRealescape($taxRate),$status,$_SESSION["UserId"],$datetime,$parentidval,$languageval['languageid']));	
				if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
			
			}
				
				$log = $db->insert_log("insert","".TPLPrefix."taxmaster","","Taxmaster Added Newly","Taxmaster",$str);
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
		if(!empty($taxName) ) {
			$strChk = "select count(taxId) from ".TPLPrefix."taxmaster where $taxName = ? and IsActive != ? and taxId != ? ";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($taxName),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
				$str = "update ".TPLPrefix."taxmaster set taxName = ?, taxDesc = ?, taxTyp = ?, taxRate=?, IsActive = ?, ModifiedDate = ? , UserId=?  where taxId = ? ";
				$rslt = $db->insert_bind($str,array(getRealescape($taxName),getRealescape($taxDesc),getRealescape($taxTyp),getRealescape($taxRate),$status,$datetime,$_SESSION["UserId"],$edit_id));
				$db->insert_log("update","".TPLPrefix."taxmaster",$edit_id,"Taxmaster updated","Taxmaster",$str);

//spanish
$str_es = "update ".TPLPrefix."taxmaster set taxName = ?, taxDesc = ?, taxTyp = ?, taxRate=?, IsActive = ?, ModifiedDate = ? , UserId=?  where parent_id = ? and lang_id='2' ";
				$rslt_es = $db->insert_bind($str_es,array(getRealescape($taxName_es),getRealescape($taxDesc_es),getRealescape($taxTyp),getRealescape($taxRate),$status,$datetime,$_SESSION["UserId"],$edit_id));
				
				
				//portguese
				$str_pt = "update ".TPLPrefix."taxmaster set taxName = ?, taxDesc = ?, taxTyp = ?, taxRate=?, IsActive = ?, ModifiedDate = ? , UserId=?  where parent_id = ? and lang_id='3' ";
				$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($taxName_pt),getRealescape($taxDesc_pt),getRealescape($taxTyp),getRealescape($taxRate),$status,$datetime,$_SESSION["UserId"],$edit_id));
				
				
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
		  
		$str="update ".TPLPrefix."taxmaster set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where taxId = '".$edit_id."' ";
		$db->insert($str); 	 
		  
		 $str="update ".TPLPrefix."taxmaster set IsActive = '2', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' ";
		$db->insert($str); 	 
		
		$db->insert_log("delete","".TPLPrefix."taxmaster",$edit_id,"Taxmaster deleted","Taxmaster",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
	
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
				
		$str="update ".TPLPrefix."taxmaster set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where taxId = '".$edit_id."' ";
		$db->insert($str); 	

$str="update ".TPLPrefix."taxmaster set IsActive = '".$status."', ModifiedDate = '$datetime' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' ";
		$db->insert($str);		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}

?>