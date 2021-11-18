<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
	
	

$moduleid_chkall = $_REQUEST['modulecheck_list'];
$filter_list = $_REQUEST['filter_list'];
$infront = $_REQUEST['infront'];
$isCombined = $_REQUEST['isCombined'];

$today=date("Y-m-d H:i:s");		


switch($act)
{
	case 'insert':	
		case 'update':	
		     
			$strChk = "select count(attribute_groupID) from ".TPLPrefix."attributegroup where attribute_groupName = '$txtAttrGroupName' and IsActive != '2' and parent_id='0' ";
 		$reslt = $db->get_a_line($strChk);
		
		
		
		if($reslt[0] == 0) {
			
					  		
			for($jj=0;$jj<count($moduleid_chkall);$jj++)
			{
					$chkmodulethere_ed_qry = "select attrMapId from ".TPLPrefix."attributes where attribute_groupId = ? and attributeId = ? and  IsActive= ? and parent_id = 0";
					$chkmodulethere_ed = $db->get_a_line_bind($chkmodulethere_ed_qry,array($edit_id,$moduleid_chkall[$jj],'1'));
					$chk_attrmapid = $chkmodulethere_ed['attrMapId'];
					
					
					//spanish
					
					$chkmodulethere_ed_qry_es = "select attrMapId from ".TPLPrefix."attributes where attribute_groupId = ? and attributeId = ? and  IsActive= ? and lang_id = 2";
					$chkmodulethere_ed_es = $db->get_a_line_bind($chkmodulethere_ed_qry_es,array($edit_id,$moduleid_chkall[$jj],'1'));
					$chk_attrmapid_es = $chkmodulethere_ed_es['attrMapId'];
					
					///attribute id
					
					$getattributeid_es = $db->get_a_line("select attributeid from ".TPLPrefix."m_attributes where parent_id = '".$moduleid_chkall[$jj]."' and lang_id = 2 and IsActive = 1 ");
					
					//portgueses
					
					$chkmodulethere_ed_qry_pt = "select attrMapId from ".TPLPrefix."attributes where attribute_groupId = ? and attributeId = ? and  IsActive= ? and lang_id = 3";
					$chkmodulethere_ed_pt = $db->get_a_line_bind($chkmodulethere_ed_qry_pt,array($edit_id,$moduleid_chkall[$jj],'1'));
					$chk_attrmapid_pt = $chkmodulethere_ed_pt['attrMapId'];
					
					$getattributeid_pt = $db->get_a_line("select attributeid from ".TPLPrefix."m_attributes where parent_id = '".$moduleid_chkall[$jj]."' and lang_id = 3 and IsActive = 1 ");
					
					
					$filterstat = '0';
					$fntstat = '0';
					$combstat = '0';
					
					if (in_array($moduleid_chkall[$jj], $filter_list)) 
						$filterstat = '1';					
						
					if (in_array($moduleid_chkall[$jj], $infront)) 
						$fntstat = '1';
						
					if (in_array($moduleid_chkall[$jj], $isCombined)) 
						$combstat = '1';
 				
					//getspanishid
					$getspanish = $db->get_a_line("select attribute_groupID from ".TPLPrefix."attributegroup where parent_id = '".$attribute_groupId."' and lang_id = 2");
				
					//getspanishid
					$getportgueses = $db->get_a_line("select attribute_groupID from ".TPLPrefix."attributegroup where parent_id = '".$attribute_groupId."' and lang_id = 3");
					 
					$updateQry =" insert into ".TPLPrefix."attributes (attrMapId,attribute_groupID, attributeId, IsActive,IsFilter,useInFront, createdDate,modifiedDate, UserId, isCombined,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?) 
					ON DUPLICATE KEY UPDATE attribute_groupID=?,attributeId=?,IsActive=?,IsFilter=?,useInFront=?,modifiedDate =?,UserId=?,isCombined=?,lang_id=? ";
					
					$db->insert_bind($updateQry,array($chk_attrmapid,$attribute_groupId,$moduleid_chkall[$jj],'1',$filterstat,$fntstat,$today,$today,$_SESSION["UserId"],$combstat,1,0,$attribute_groupId,$moduleid_chkall[$jj],'1',$filterstat,$fntstat,$today,$_SESSION["UserId"],$combstat,1)); 
					$insertid = $db->insert_id;
					
					//spanish
					$updateQry =" insert into ".TPLPrefix."attributes (attrMapId,attribute_groupID, attributeId, IsActive,IsFilter,useInFront, createdDate,modifiedDate, UserId, isCombined,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?) 
					ON DUPLICATE KEY UPDATE attribute_groupID=?,attributeId=?,IsActive=?,IsFilter=?,useInFront=?,modifiedDate =?,UserId=?,isCombined=?,lang_id=? ";
					
					$db->insert_bind($updateQry,array($chk_attrmapid_es,$getspanish[0],$getattributeid_es['attributeid'],'1',$filterstat,$fntstat,$today,$today,$_SESSION["UserId"],$combstat,2,$insertid,$attribute_groupId,$getattributeid_es['attributeid'],'1',$filterstat,$fntstat,$today,$_SESSION["UserId"],$combstat,2)); 
					
					//portgueses
					$updateQry =" insert into ".TPLPrefix."attributes (attrMapId,attribute_groupID, attributeId, IsActive,IsFilter,useInFront, createdDate,modifiedDate, UserId, isCombined,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?) 
					ON DUPLICATE KEY UPDATE attribute_groupID=?,attributeId=?,IsActive=?,IsFilter=?,useInFront=?,modifiedDate =?,UserId=?,isCombined=?,lang_id=? ";
					
					$db->insert_bind($updateQry,array($chk_attrmapid_pt,$getportgueses[0],$getattributeid_pt['attributeid'],'1',$filterstat,$fntstat,$today,$today,$_SESSION["UserId"],$combstat,3,$insertid,$attribute_groupId,$getattributeid_pt['attributeid'],'1',$filterstat,$fntstat,$today,$_SESSION["UserId"],$combstat,3)); 
					
				 
				 
				 $db->insert("update ".TPLPrefix."attributes set sortingOrder = '".$_POST['sorting'.$moduleid_chkall[$jj]]."' where attributeId = '".$moduleid_chkall[$jj]."' ");
				 $getrel = $db->get_a_line("select attrMapId from ".TPLPrefix."attributes where attributeId = '".$moduleid_chkall[$jj]."'");
				 
					 $db->insert("update ".TPLPrefix."attributes set sortingOrder = '".$_POST['sorting'.$moduleid_chkall[$jj]]."' where parent_id = '".$getrel['attrMapId']."' ");
					 
				 $db->insert_log("insert"," ".TPLPrefix."attributes",$edit_id,"updated","Attribute Mapping",$str);	
			}	
			echo json_encode(array("rslt"=>"2")); //update success
		}
		
		
		$delattribute=array_diff($resattributeId,$moduleid_chkall);
	
		if(count($delattribute)>0)
		{
			foreach($delattribute as $d){
				
			   $str = "update ".TPLPrefix."attributes set IsActive = ?, UserId=?,modifiedDate=?  where attribute_groupId = ? and attributeId= ? "; 
			    $db->insert_log("update"," ".TPLPrefix."attributes",$edit_id,"updated","Attribute Mapping",$str);
				$db->insert_bind($str,array('2',$_SESSION["UserId"],$today,$edit_id,$d));
				
				 $str = "update ".TPLPrefix."attributes set IsActive = ?, UserId=?,modifiedDate=?  where attribute_groupId = ? and parent_id= ? "; 			   
				$db->insert_bind($str,array('2',$_SESSION["UserId"],$today,$edit_id,$d));
				
			}
			
		}
		
	 	
			
	break;

	case 'del':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $str="update ".TPLPrefix."attributegroup set IsActive = ?, modifiedDate = ? , UserId=? where attribute_groupID = ? and attribute_groupID <> 1 ";
	  
	  $db->insert_log("delete","".TPLPrefix."attributegroup",$edit_id,"Attribute Group deleted","attributegroups",$str);
	  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$status = $actval;
	
	 if($edit_id !="1"){
		$str="update ".TPLPrefix."attributegroup set IsActive = ?, modifiedDate = ? , UserId=?  where attribute_groupID = ? ";
		 $db->insert_log("update","".TPLPrefix."attributegroup",$edit_id,"Attribute Group Statuschanged","attributegroups",$str);		
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 
       
		echo json_encode(array("rslt"=>"6")); //status update success
	 }
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }	
	
	break;
	
}



?>