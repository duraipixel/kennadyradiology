<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

if($isdisplayimg !=null)
	$displayimg =1;
else
	$displayimg =0;


if($isadmin !=null)
	$isadmin =1;
else
	$isadmin =0;

if($isregister !=null)
	$register =1;
else
	$register =0;
	
	
if($chk_ismandatory !=null)
	$chk_ismandatory =1;
else
	$chk_ismandatory =0;
$today=date("Y-m-d H:i:s");	
switch($act)
{
	case 'insert':	
	   // $today=date("Y-m-d");
		
		$strChk = "select count(AttributeId) from ".TPLPrefix."customfields_attributes where AttributeCode = '".getRealescape($txtAttr_code)."' and IsActive <>2 ";
 		$reslt = $db->get_a_line($strChk);
		if(empty($customer_group_id) && $customer_group_id==''){
			
			echo json_encode(array("rslt"=>"11",'text'=>'Customer group fields is required')); //validation
			exit;
		}
		if($reslt[0] == 0) {		
			$str="insert into ".TPLPrefix."customfields_attributes(AttributeCode,AttributeName,AttributeType,accept_filetype,numberoffile,isdisplayimg,SortBy,IsActive,isregister,isadmin,UserId,CreateDate,MandatoryAttr,IsMandatory,ModifiedDate)values('".getRealescape($txtAttr_code)."','".getRealescape($txtAttr_name)."','".$selAttr_typeid."','".getRealescape($accept_filetype)."','".getRealescape($numberoffile)."','".$displayimg."','".$txtSortby."','".$status."','".$register."','".$isadmin."','".$_SESSION["UserId"]."','".$today."','".getRealescape($txtmandatorycls)."','".$chk_ismandatory."','".$today."')";
			//echo $str; exit;
			$rslt = $db->insert($str);
            $insert_id=	$db->insert_id;			
			$log = $db->insert_log("insert","".TPLPrefix."customfields_attributes","","Custom Attributes Added Newly","customattributes",$str);
			
			
			
			for($jj=0;$jj<count($customer_group_id);$jj++)
			{	
				$updateQry =" insert into ".TPLPrefix."customfield_custgrp (CustomFieldId ,CustomerGrupId, IsActive,  UserId, CreatedDate,ModifiedDate ) values('".$insert_id."','".
							$customer_group_id[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."' ) ";
					$db->insert($updateQry); 
				 $db->insert_log("insert","".TPLPrefix."customfield_custgrp",$insert_id," customfield Customer group added ","customfield Customer Group",$updateQry);	
			}
			
			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			 echo json_encode(array("rslt"=>"3")); //same exists
		}	
	break;
	
	
	case 'update':	 	
		//$edit_id		
		$strChk = "select count(AttributeId) from ".TPLPrefix."customfields_attributes where AttributeCode = '".getRealescape($txtAttr_code)."' and IsActive <>2 and AttributeId != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		
		if($reslt[0] == 0) {		
			$str = "update ".TPLPrefix."customfields_attributes set AttributeCode = '".getRealescape($txtAttr_code)."', AttributeName = '".getRealescape($txtAttr_name)."',AttributeType = '".$selAttr_typeid."', accept_filetype= '".getRealescape($accept_filetype)."',numberoffile= '".getRealescape($numberoffile)."',isdisplayimg='".$displayimg."', IsActive='".$status."',isregister='".$register."',isadmin='".$isadmin."',SortBy = '".$txtSortby."', UserId='".$_SESSION["UserId"]."', MandatoryAttr = '".getRealescape($txtmandatorycls)."',IsMandatory = '".$chk_ismandatory."',ModifiedDate = '".$today."'  where AttributeId = '".$edit_id."'";
			
			$db->insert_log("update","".TPLPrefix."customfields_attributes",$edit_id,"Custom Attributes updated","customattributes",$str);
			$db->insert($str);
			
			
			
			for($jj=0;$jj<count($customer_group_id);$jj++)
			{
					$chkmodulethere_ed = $db->get_a_line("select Id from ".TPLPrefix."customfield_custgrp where CustomFieldId = '".$edit_id."' and CustomerGrupId = '".$customer_group_id[$jj]."'  and  IsActive=1  ");
						$chk_attrmapid = $chkmodulethere_ed['Id'];
										
					
					$updateQry =" insert into ".TPLPrefix."customfield_custgrp (Id,CustomFieldId ,CustomerGrupId, IsActive,  UserId, CreatedDate,ModifiedDate ) values('".$chk_attrmapid."','".$edit_id."','".$customer_group_id[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."' ) 
					ON DUPLICATE KEY UPDATE CustomFieldId='".$edit_id."',CustomerGrupId='".$customer_group_id[$jj]."',IsActive='1',ModifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."' ";
					
					$db->insert($updateQry); 
				   $db->insert_log("insert","".TPLPrefix."customfield_custgrp",$insert_id," CustomField  group added ","CustomField Group",$updateQry);	
			}	
		
		
		
		$selqry = "select group_concat(CustomerGrupId) as id from   ".TPLPrefix."customfield_custgrp  where CustomFieldId = '".$edit_id."' and IsActive=1 "; 
		$resattributeId=$db->get_a_line($selqry);
		$resattributeId=explode(",",$resattributeId['id']);
		
		$delattribute=array_diff($resattributeId,$customer_group_id);
	
		if(count($delattribute)>0)
		{
			foreach($delattribute as $d){
				
			   $str = "update ".TPLPrefix."customfield_custgrp set IsActive = 2, UserId='".$_SESSION["UserId"]."',ModifiedDate='".$today."'  where CustomFieldId = '".$edit_id."' and CustomerGrupId= '".$d."' "; 
			    $db->insert_log("delete","".TPLPrefix."customfield_custgrp",$edit_id,"CustomField group deleted","CustomField Group",$str);
			   $db->insert($str);
			  
			}
			
		}
			
			
			
			echo json_encode(array("rslt"=>"2")); //update
		}
		else {
			echo json_encode(array("rslt"=>"3")); //same exists
		}
		
	break;
	
	case 'del':
	  $edit_id = base64_decode($Id);	  
	  //$today = date("Y-m-d");
	  
	  $str = "update ".TPLPrefix."customfields_attributes set IsActive = '2',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where AttributeId = '".$edit_id."'";	
	  $db->insert_log("delete","".TPLPrefix."customfields_attributes",$edit_id,"Custom Attributes deleted","customattributes",$str);
	  $db->insert($str);	
	  
	  echo json_encode(array("rslt"=>"5")); //deleted success	  	 	  	 
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);	  
	  //$today = date("Y-m-d");
	  $status = $actval;	
	  $str="update ".TPLPrefix."customfields_attributes set IsActive = '".$status."', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where AttributeId = '".$edit_id."' ";	

       $db->insert_log("update","".TPLPrefix."customfields_attributes",$edit_id,"Custom Attributes Statuschanged","customattributes",$str);
	   
	  $db->insert($str);		  
	  echo json_encode(array("rslt"=>"6")); //Status change	  
	  
	break;
}



?>