<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");
$getlanguage = getLanguages($db);	

switch($act)
{
	case 'insert':
	
	if(!empty($txtAttrGroupName)) {
		$strChk = "select count(attribute_groupID) from ".TPLPrefix."attributegroup where attribute_groupName = ? and IsActive != ?  and lang_id = 1";
 		$reslt = $db->get_a_line_bind($strChk,array($txtAttrGroupName,'2'));
		if($reslt[0] == 0) {
			$parentidval = 0;
			foreach($getlanguage as $languageval){
			$str="insert into ".TPLPrefix."attributegroup(attribute_groupName,attribute_groupdesc,IsActive,sortingOrder,UserId,createdDate,modifiedDate,parent_id,lang_id)values(?,?,?,?,?,?,?,?,?)";			
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtAttrGroupName'.$languageval['languagefield']]),getRealescape($_POST['txtAttrGroupDesc'.$languageval['languagefield']]),$status,$txtSortingorder,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid']));	
			if($languageval['languageid'] == 1){
				$lastInserId = $db->insert_id;
				$parentidval = $lastInserId;
			}
			}
			
			$log = $db->insert_log("insert"," ".TPLPrefix."attributegroup","","Attribute Group Added Newly","attributegroups",$str);
			
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
	//$today=date("Y-m-d");	
	if(!empty($txtAttrGroupName)) {
		$strChk = "select count(attribute_groupID) from ".TPLPrefix."attributegroup where attribute_groupName = '$txtAttrGroupName' and IsActive != '2' and attribute_groupID != '".$edit_id."' and parent_id='0' ";
 		$reslt = $db->get_a_line($strChk);
		
		$strChk_es = "select count(attribute_groupID) from ".TPLPrefix."attributegroup where attribute_groupName = '$txtAttrGroupName_es' and IsActive != '2' and parent_id != '".$edit_id."' and lang_id=2";
 		$reslt_es = $db->get_a_line($strChk_es);		
		
		$strChk_pt = "select count(attribute_groupID) from ".TPLPrefix."attributegroup where attribute_groupName = '$txtAttrGroupName_pt' and IsActive != '2' and parent_id != '".$edit_id."' and lang_id=3";
 		$reslt_pt = $db->get_a_line($strChk_pt);


		if($reslt[0] == 0 && $reslt_es[0] == 0 && $reslt_pt[0] == 0) {
			//english
			$str = "update ".TPLPrefix."attributegroup set 
			attribute_groupName = '".getRealescape($txtAttrGroupName)."',attribute_groupdesc='".getRealescape($txtAttrGroupDesc)."', SortingOrder = '".$txtSortingorder."', modifiedDate = '$today' ,IsActive = '".$status."', UserId='".$_SESSION["UserId"]."'  where attribute_groupID = '".$edit_id."'";
			
			$db->insert_log("update","".TPLPrefix."attributegroup",$edit_id,"Attribute Group  updated","attributegroups",$str);
			$db->insert($str);
			
			//Spanish
			$str_es = "update ".TPLPrefix."attributegroup set 
			attribute_groupName = '".getRealescape($txtAttrGroupName_es)."',attribute_groupdesc='".getRealescape($txtAttrGroupDesc_es)."', SortingOrder = '".$txtSortingorder."', modifiedDate = '$today' ,IsActive = '".$status."', UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' and lang_id='2' ";
			
			$db->insert_log("update","".TPLPrefix."attributegroup",$edit_id,"Attribute Group  updated","attributegroups",$str_es);
			$db->insert($str_es);
			
			//Portuguese
			$str_pt = "update ".TPLPrefix."attributegroup set 
			attribute_groupName = '".getRealescape($txtAttrGroupName_pt)."',attribute_groupdesc='".getRealescape($txtAttrGroupDesc_pt)."', SortingOrder = '".$txtSortingorder."', modifiedDate = '$today' ,IsActive = '".$status."', UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' and lang_id='3' ";
			
			$db->insert_log("update","".TPLPrefix."attributegroup",$edit_id,"Attribute Group  updated","attributegroups",$str_pt);
			$db->insert($str_pt);			
			
			$db->insert_bind($str,array(getRealescape($txtAttrGroupName),getRealescape($txtAttrGroupDesc),$txtSortingorder,$today,$status,$_SESSION["UserId"],$edit_id));
			

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
	  
	  //$today = date("Y-m-d");
	  $str="update ".TPLPrefix."attributegroup set IsActive = ?, modifiedDate = ? , UserId = ?  where attribute_groupID = ? and attribute_groupID <> ? ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."attributegroup",$edit_id,"Attribute Group deleted","attributegroups",$str);
	  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id,'1')); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
	
	 if($edit_id !="1"){
		$str="update ".TPLPrefix."attributegroup set IsActive = ?, modifiedDate = ? , UserId=?  where attribute_groupID = ?  ";
		 $db->insert_log("update"," ".TPLPrefix."attributegroup",$edit_id,"Attribute Group Statuschanged","attributegroups",$str);		
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 
       
		echo json_encode(array("rslt"=>"6")); //status update success
	 }
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }	
	
	break;
	
	
}



?>