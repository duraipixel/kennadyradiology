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
	if(!empty($txtStoryTitle) ) {
		$strChk = "select count(FsId) from ".TPLPrefix."feature_stories where StoryTitle = ? and IsActive != ? ";		
 		$reslt = $db->get_a_line_bind($strChk,array($txtStoryTitle,2));
		if($reslt[0] == 0) {
			
				$parentidval = 0;
				foreach($getlanguage as $languageval){
			$str="insert into ".TPLPrefix."feature_stories(StoryTitle,StoryDate,StoryURL,StoryDescription,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id) values(?,?,?,?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtStoryTitle'.$languageval['languagefield']]),$_POST['txtStoryDate'],getRealescape($_POST['txtStoryURL'.$languageval['languagefield']]),getRealescape($_POST['txtStoryDescription'.$languageval['languagefield']]),$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid']));	
			//print_r($db); exit;
		 
			if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
			
			}
			
			$log = $db->insert_log("insert"," ".TPLPrefix."feature_stories","","Feature Stories Added Newly","feature stories",$str);
			
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
	if(!empty($txtStoryTitle) ) {
		$strChk = "select count(FsId) from ".TPLPrefix."feature_stories where StoryTitle = ? and IsActive != ? and FsId != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtStoryTitle,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
			$str = "update ".TPLPrefix."feature_stories set StoryTitle = ? , StoryDate = ? , StoryURL = ? , StoryDescription = ?,  IsActive = ? , modifiedDate = ? , UserId = ? where FsId = ? ";
			
			$db->insert_log("update"," ".TPLPrefix."feature_stories",$edit_id,"Feature Stories updated","feature stories",$str);
			
			$rslt = $db->insert_bind($str,array(getRealescape($txtStoryTitle),getdateFormat($db,$txtStoryDate),getRealescape($txtStoryURL),getRealescape($txtStoryDescription),$status,$today,$_SESSION["UserId"],$edit_id));

			
$str_es = "update ".TPLPrefix."feature_stories set StoryTitle = ?, StoryDate = ? , StoryURL = ? , StoryDescription =?, IsActive = ?, modifiedDate = ? , UserId=? where parent_id = ? and lang_id = 2 ";
$rslt_es = $db->insert_bind($str_es,array(getRealescape($txtStoryTitle_es),getdateFormat($db,$txtStoryDate),getRealescape($txtStoryURL_es),getRealescape($txtStoryDescription_es),$status,$today,$_SESSION["UserId"],$edit_id));
			
//print_r($db); exit;
			
$str_pt = "update ".TPLPrefix."feature_stories set StoryTitle = ?, StoryDate = ? , StoryURL = ? , StoryDescription =?, IsActive = ?, modifiedDate = ? , UserId=? where parent_id = ?   and lang_id = 3";
$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txtStoryTitle_pt),getdateFormat($db,$txtStoryDate),getRealescape($txtStoryURL_pt),getRealescape($txtStoryDescription_pt),$status,$today,$_SESSION["UserId"],$edit_id));


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
	  $str="update ".TPLPrefix."feature_stories set IsActive = ?, modifiedDate = ? , UserId=?  where FsId = ? and FsId NOT IN(?) ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."feature_stories",$edit_id,"Feature Stories deleted","feature stories",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id,1)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" ){			
			$str="update ".TPLPrefix."feature_stories set IsActive = ?, modifiedDate = ? , UserId=?  where FsId = ? and FsId NOT IN(?) ";
			
			 $db->insert_log("update"," ".TPLPrefix."feature_stories",$edit_id,"feature stories Statuschanged","feature stories",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id,1)); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
}



?>