<?php 
include 'session.php';
extract($_REQUEST);

$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");		
$templatecopyname = 0;
$getlanguage = getLanguages($db);
switch($act)
{
	case 'insert':
	 
	if(!empty($templatename)) {
		 
		$strChk = "select count(mtemid) from ".TPLPrefix."mailtemplate where MenuName = '$txtMenuname' and IsActive != '2'  and lang_id = 1";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			 	
				$parentidval = 0;
				foreach($getlanguage as $languageval){
					
			  $str="insert into ".TPLPrefix."mailtemplate(masterid,masteridcopy,mailbcc,mailsub,mailcontent,mailfooter,aftertable,IsActive,userid,createdate,parent_id,lang_id)values(?,?,?,?,?,?,?,?,?,?,?,?)";
		 
			$rslt = $db->insert_bind($str,array($_POST['templatename'.$languageval['languagefield']],$templatecopyname,getRealescape($mailbcc),getRealescape($_POST['mailsub'.$languageval['languagefield']]),getRealescape($_POST['mailcontent'.$languageval['languagefield']]),getRealescape($_POST['mailfooter'.$languageval['languagefield']]),getRealescape($aftertable),$status,$_SESSION["UserId"],$today,$parentidval,$languageval['languageid']));
					
					if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
			
			}
			
			
			$log = $db->insert_log("insert","".TPLPrefix."mailtemplate","","Mailtemplate Added Newly","Mailtemplate",$str);
			
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
	 
	if(!empty($templatename)) {
		$strChk = "select count(MenuId) from ".TPLPrefix."menus where MenuName = '$txtMenuname' and IsActive != '2' and MenuId != '".$edit_id."'  and lang_id = 1";
 		$reslt = $db->get_a_line($strChk);
		//if($reslt[0] == 0) {
		 		
			
			$str = "update ".TPLPrefix."mailtemplate set masterid= ?,masteridcopy= ?,mailbcc = ?,mailsub=?,mailcontent=?,mailfooter=?,aftertable=?, modifieddate = ? , IsActive= ?, UserId=? where mtemid = ? and parent_id = 0";
			$rslt = $db->insert_bind($str,array($templatename,$templatecopyname,getRealescape($mailbcc),getRealescape($mailsub),getRealescape($mailcontent),getRealescape($mailfooter),getRealescape($aftertable),$today,$status,$_SESSION["UserId"],$edit_id));			
			
			//spanish			
			$str_es = "update ".TPLPrefix."mailtemplate set masterid= ?,masteridcopy= ?,mailbcc = ?,mailsub=?,mailcontent=?,mailfooter=?,aftertable=?, modifieddate = ? , IsActive= ?, UserId=? where parent_id = ? and lang_id = 2 ";
			$rslt_es = $db->insert_bind($str_es,array($templatename,$templatecopyname,getRealescape($mailbcc),getRealescape($mailsub_es),getRealescape($mailcontent_es),getRealescape($mailfooter_es),getRealescape($aftertable),$today,$status,$_SESSION["UserId"],$edit_id));
			
			//portuguse			
			$str_pt = "update ".TPLPrefix."mailtemplate set masterid= ?,masteridcopy= ?,mailbcc = ?,mailsub=?,mailcontent=?,mailfooter=?,aftertable=?, modifieddate = ? , IsActive= ?, UserId=? where parent_id = ? and lang_id = 3";
			$rslt_pt = $db->insert_bind($str_pt,array($templatename,$templatecopyname,getRealescape($mailbcc),getRealescape($mailsub_pt),getRealescape($mailcontent_pt),getRealescape($mailfooter_pt),getRealescape($aftertable),$today,$status,$_SESSION["UserId"],$edit_id));
			
			
			$db->insert_log("update","".TPLPrefix."mailtemplate",$edit_id,"Mailtemplate  updated","Mailtemplate",$str);

			echo json_encode(array("rslt"=>"2"));
		 
		/*}
		else {
			echo json_encode(array("rslt"=>"3")); //same exists
		}*/
	 
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	 
		
	break;
	
	case 'del':
	
	  $edit_id = base64_decode($Id);  
	  
	 // $today = date("Y-m-d");
	  $str="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where mtemid = ?  ";
	  $rslt = $db->insert_bind($str,array('2',getRealescape($today),$_SESSION["UserId"],$edit_id));
	  
	  $str_es="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where parent_id = ? and lang_id = 2 ";
	  $rslt_es = $db->insert_bind($str_es,array('2',getRealescape($today),$_SESSION["UserId"],$edit_id));
	  
	  $str_pt="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where parent_id = ? and lang_id = 2 ";
	  $rslt_pt = $db->insert_bind($str_pt,array('2',getRealescape($today),$_SESSION["UserId"],$edit_id));
	  
	  $db->insert_log("delete","".TPLPrefix."mailtemplate",$edit_id,"Mailtemplate deleted","Mailtemplate",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	//echo "reach"; exit;
	$edit_id = base64_decode($Id);
	
	//$today = date("Y-m-d");
	$status = $actval;
	
		$str="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where mtemid = ? ";		
		$rslt = $db->insert_bind($str,array($status,getRealescape($today),$_SESSION["UserId"],$edit_id));
		
		$str_es="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where parent_id = ? ";		
		$rslt_es = $db->insert_bind($str_es,array($status,getRealescape($today),$_SESSION["UserId"],$edit_id));
		
		$str_pt="update ".TPLPrefix."mailtemplate set IsActive = ?, modifieddate = ? , UserId=?  where parent_id = ? ";		
		$rslt_pt = $db->insert_bind($str_pt,array($status,getRealescape($today),$_SESSION["UserId"],$edit_id));
		echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
}



?>