<?php 
include 'session.php';
extract($_REQUEST);




$act=$action;
//$today=date("Y-m-d");	
$today=date("Y-m-d H:i:s");
if($chkstatus !=null)
	$status =1;
else
	$status =0;


if($chkiscust !=null)
	$iscust =1;
else
	$iscust =0;


if($chkismail !=null)
	$ismail =1;
else
	$ismail =0;



if($txtemailtemp !=null)
	$emailtemp =$txtemailtemp;
else
	$emailtemp ='';

$today=date("Y-m-d H:i:s");
switch($act)
{ 

  case 'insert':
         if(!empty($txtfrmname)) {
		$strChk = "select count(FormId) from ".TPLPrefix."formbuilder where FormName = '$txtfrmname' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
		 /* Customer Main table Insert - START	*/
		$str="insert into ".TPLPrefix."formbuilder (`FormName`,`fromtablename`, `FormDesc`, `IsCustomer`, `IsEmail`, `ToEmail`, `ccEmail`, `BcEmail`, `EmailTemplate`,  `IsActive`,`UserId`, `CreatedDate`,ModifiedDate )values('".getRealescape($txtfrmname)."','".generateslugformbuilder($txtfrmname)."','".getRealescape($txtfrmdesc)."','".$iscust."','".$ismail."','".getRealescape($txtemailto)."','".getRealescape($txtemailcc)."','".getRealescape($txtemailbcc)."','".getRealescape($emailtemp)."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";			
		$rslt = $db->insert($str);	
		$insert_cusId = $db->insert_id;
		 $db->insert_log("insert","".TPLPrefix."formbuilder",'',"Insert  Form Builder","Form Builder",$str);
		
		//create table  START
		 $create_qry =  "CREATE TABLE ".TPLPrefix."fb_".generateslugformbuilder($txtfrmname)."( id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY ( id ),IsActive int(11) NOT NULL,UserId int(11) NOT NULL ,Createddate DATETIME NOT NULL,Modifieddate DATETIME NOT NULL )";
		 //echo  $create_qry; exit;
		 $rslt = $db->insert($create_qry);
		
		//create table  End
		
		//Creating Dynamic module START
		$modulepath = "rpt_formbuilder.php?formid=".base64_encode($insert_cusId)."";
		  $str="insert into ".TPLPrefix."modules(ModuleName,Description,ModulePath,IsActive,UserId,CreatedDate,ModifiedDate) values('".      getRealescape($txtfrmname)."','".getRealescape($txtfrmdesc)."','".$modulepath."','".$status.      "','".$_SESSION["UserId"]."','".$today."','".$today."')";
		  $rslt = $db->insert($str);
		//Creating Dynamic module End
		
		
		 /* Customer Main table Insert - END */ 
		  
		echo json_encode(array("rslt"=>"1"));	
        
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
	//$edit_id = base64_decode($Id);       	
	
	
  /* Customer Main table Update - START	*/	
     if(!empty($txtfrmname)) {
		$strChk = "select count(FormId) from ".TPLPrefix."formbuilder where FormName = '$txtfrmname' and IsActive != '2' and FormId != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
    if($reslt[0] == 0) {
		//select old tablename
	   $old_tablename = "select fromtablename from ".TPLPrefix."formbuilder where  IsActive != '2' and FormId = '".$edit_id."' ";
	   $rslt = $db->get_a_line($old_tablename);
	   $old_tblname = $rslt['fromtablename'];
	
	//Rename the Table Name
	    $rename_qry =  "ALTER TABLE ".TPLPrefix."fb_".$old_tblname." RENAME TO  ".TPLPrefix."fb_".generateslugformbuilder($txtfrmname)." "; 
		//echo $rename_qry; exit;
	    $rslt = $db->insert($rename_qry);
		
	//select module id
	 $mpath = "rpt_formbuilder.php?formid=".base64_encode($edit_id)." ";
    $mid = "select ModuleId from ".TPLPrefix."modules where  IsActive != '2' and ModulePath = '".$mpath."' ";
 	$reslt = $db->get_a_line($mid);	
	$moduleid = $reslt['ModuleId']; 
	
    //Update module 
	$modulepath = "rpt_formbuilder.php?formid=".base64_encode($edit_id)." ";
    $str_module = "update ".TPLPrefix."modules set ModuleName = '".getRealescape($txtfrmname)."', Description = '".getRealescape($txtfrmdesc)."', ModulePath = '".$modulepath."', IsActive = '".$status."', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where ModuleId = '".$moduleid."'";	
	$db->insert($str_module);
	
	$str="update ".TPLPrefix."formbuilder set `FormName`='".getRealescape($txtfrmname)."',`fromtablename`='".generateslugformbuilder($txtfrmname)."', `FormDesc`='".getRealescape($txtfrmdesc)."', `IsCustomer`='".$iscust."', `IsEmail`='".$ismail."', `ToEmail`='".getRealescape($txtemailto)."', `ccEmail`='".getRealescape($txtemailcc)."', `BcEmail`='".getRealescape($txtemailbcc)."', `EmailTemplate`='".getRealescape($emailtemp)."',  `IsActive`='".$status."',`UserId`='".$_SESSION["UserId"]."',ModifiedDate = '".$today."'  where  FormId='".$edit_id."'  ";
  
   $db->insert_log("update","".TPLPrefix."formbuilder",$edit_id,"Update  Form Builder","Form Builder",$str);	
	$rslt = $db->insert($str);			
	 
	 
		
	/* Customer Main table Update - END */
	
	
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
	  
	  // $chkReference_ed = $db->get_a_line("select userid from ".TPLPrefix."formbuilder where FormId = '".$edit_id."' and status<>2 ");
	  // $chk_Ref_there = $chkReference_ed['userid'];
	  
	  // if (isset($chk_Ref_there)) {
		  // echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  // }
	 // else{	  
		  $str="update ".TPLPrefix."formbuilder set IsActive = '2',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where FormId = '".$edit_id."'";
		  
		  $db->insert_log("delete","".TPLPrefix."formbuilder",$edit_id, "Form Builder deleted","Form Builder",$str);
		  $db->insert($str); 

           //select module id
	       $mpath = "rpt_formbuilder.php?formid=".base64_encode($edit_id)." ";
           $mid = "select ModuleId from ".TPLPrefix."modules where  IsActive != '2' and ModulePath = '".$mpath."' ";
 	       $reslt = $db->get_a_line($mid);	
	       $moduleid = $reslt['ModuleId'];	

         //  delete module	
           $str="update ".TPLPrefix."modules set IsActive = '2', ModifiedDate = '$today' , UserId='".$_SESSION["UserId"]."'  where ModuleId = '".$moduleid."'  and ModuleId NOT IN(1,2,3) ";
	       $db->insert($str);		 
		  
		   //select old tablename
	      $old_tablename = "select fromtablename from ".TPLPrefix."formbuilder where  IsActive = '2' and FormId = '".$edit_id."' ";
	      $rslt = $db->get_a_line($old_tablename);
	      $old_tblname = $rslt['fromtablename'];
	
	    //Rename the Table Name
	     $rename_qry =  "ALTER TABLE ".TPLPrefix."fb_".$old_tblname." RENAME TO  ".TPLPrefix."delete_fb_".$old_tblname." "; 
		 $rslt = $db->insert($rename_qry);
		  
		  	
		  echo json_encode(array("rslt"=>"5")); //deletion
	 // }
	  	 
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $status = $actval;
	  
	  // $chkReference_ed = $db->get_a_line("select userid from ".TPLPrefix."formbuilder where FormId = '".$edit_id."' and status<>2 ");
	  // $chk_Ref_there = $chkReference_ed['userid'];
	  
	  // if (isset($chk_Ref_there)) {
		  // echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  // }
	 // else{	
	  
			  $str="update ".TPLPrefix."formbuilder set IsActive = '$status',ModifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where FormId = '".$edit_id."'";
			  
			  $db->insert_log("update","".TPLPrefix."formbuilder",$edit_id, "Form Builder Status Changed","Form Builder",$str);
		  $db->insert($str); 	 
		  
		   	
		
		  echo json_encode(array("rslt"=>"6")); //deletion
	// }
	  	 
		
	break;	
	
	
}


?>