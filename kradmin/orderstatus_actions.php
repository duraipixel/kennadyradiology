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
	if(!empty($txtOrderstatusName) ) {
		$strChk = "select count(order_statusId) from ".TPLPrefix."order_status where order_statusName = ? and IsActive != ?  and lang_id = 1";		
 		$reslt = $db->get_a_line_bind($strChk,array($txtOrderstatusName,2));
		if($reslt[0] == 0) {
			
				$parentidval = 0;
				foreach($getlanguage as $languageval){
			$str="insert into ".TPLPrefix."order_status(order_statusName,order_statusDescription,sortingOrder,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id) values(?,?,?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtOrderstatusName'.$languageval['languagefield']]),getRealescape($_POST['txtOrdStDescription'.$languageval['languagefield']]),$txtSortingorder,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid']));	//print_r($db); exit;
		 
			if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
			
			}
			
			$log = $db->insert_log("insert"," ".TPLPrefix."order_status","","Order Status Added Newly","orderstatus",$str);
			
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
	if(!empty($txtOrderstatusName) ) {
		$strChk = "select count(order_statusId) from ".TPLPrefix."order_status where order_statusName = ? and IsActive != ? and order_statusId != ?  and lang_id = 1";
 		$reslt = $db->get_a_line_bind($strChk,array($txtOrderstatusName,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
			$str = "update ".TPLPrefix."order_status set order_statusName = ?, order_statusDescription =?, sortingOrder = ?, IsActive = ?, modifiedDate = ? , UserId=? where order_statusId = ? ";
			
			$db->insert_log("update"," ".TPLPrefix."order_status",$edit_id,"Order Status updated","orderstatus",$str);
			
			$rslt = $db->insert_bind($str,array(getRealescape($txtOrderstatusName),getRealescape($txtOrdStDescription),$txtSortingorder,$status,$today,$_SESSION["UserId"],$edit_id));
			
			
$str_es = "update ".TPLPrefix."order_status set order_statusName = ?, order_statusDescription =?, sortingOrder = ?, IsActive = ?, modifiedDate = ? , UserId=? where parent_id = ? and lang_id = 2 ";
$rslt_es = $db->insert_bind($str_es,array(getRealescape($txtOrderstatusName_es),getRealescape($txtOrdStDescription_es),$txtSortingorder,$status,$today,$_SESSION["UserId"],$edit_id));
			

			
$str_pt = "update ".TPLPrefix."order_status set order_statusName = ?, order_statusDescription =?, sortingOrder = ?, IsActive = ?, modifiedDate = ? , UserId=? where parent_id = ?   and lang_id = 3";
$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txtOrderstatusName_pt),getRealescape($txtOrdStDescription_pt),$txtSortingorder,$status,$today,$_SESSION["UserId"],$edit_id));


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
	  $str="update ".TPLPrefix."order_status set IsActive = ?, modifiedDate = ? , UserId=?  where order_statusId = ? and order_statusId NOT IN(?) ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."order_status",$edit_id,"Order Status deleted","orderstatus",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id,1)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" ){			
			$str="update ".TPLPrefix."order_status set IsActive = ?, modifiedDate = ? , UserId=?  where order_statusId = ? and order_statusId NOT IN(?) ";
			
			 $db->insert_log("update"," ".TPLPrefix."order_status",$edit_id,"OrderStatus Statuschanged","orderstatus",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id,1)); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
}



?>