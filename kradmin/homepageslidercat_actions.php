<?php 
include 'session.php';
extract($_REQUEST);

$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
//date_default_timezone_set('Asia/Kolkata');
$today=date("Y-m-d H:i:s");	


if($startdate!=''){
	$sdate= getdateFormat($db,$startdate);
}

if($enddate!=''){
	$edate= getdateFormat($db,$enddate);
}
	
switch($act)
{
	case 'insert':
	//print_r($_REQUEST); exit;
	if(!empty($title)) {
		$strChk = "select count(hpsid) from ".TPLPrefix."homepagecatslider where title = '$title' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if($rowcount<=10){
				
				$str="insert into ".TPLPrefix."homepagecatslider(title,categoryid,type,sortby,IsActive,UserId,CreatedDate,ModifiedDate)values('".getRealescape($title)."','".getRealescape($parentid)."','".$type."','".$sortby."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";
				
				$rslt = $db->insert($str);
				$lastInserId = $db->insert_id;			
				$log = $db->insert_log("insert","".TPLPrefix."Homepage Slider","","Homepage Slider Added Newly","Homepage Slider",$str);
				
				
				if(isset($product)){
					
					
					foreach($product as $val)
					{
						
							$str = "insert into ".TPLPrefix."homepagecatslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate) values('".$lastInserId."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."') ";	
							
							 $db->insert($str);
							$log = $db->insert_log("insert","".TPLPrefix."homepagecatslider_product","","homepagecatslider_product Add successfully","homepagecatslider_product",$str);
					
						
					}
					
				}
				
				
				if(isset($categoryIDs)){
				
					
					foreach($categoryIDs as $val)
					{
						
						
						 	$str = "insert into ".TPLPrefix."homepagecatslider_category(hpsid,categoryID,sortby,IsActive,UserId,createdDate,modifiedDate) values('".$lastInserId."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."') ";	
							
							 $db->insert($str);
							$log = $db->insert_log("insert","".TPLPrefix."homepagecatslider_category","","homepagecatslider_product Add successfully","homepagecatslider_product",$str);
					
						
					}
					
				}
				
				//echo json_encode(array("rslt"=>$rslt)); //success
				echo json_encode(array("rslt"=>"1")); //success
			}
			else{
				echo json_encode(array("rslt"=>"5")); //warnning for max product
			}
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
	
	
	
	if(!empty($title)) {
		$strChk = "select count(hpsid) from ".TPLPrefix."homepagecatslider where title = '$title' and IsActive != '2' and hpsid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if($rowcount<=10){
				
				$str = "update ".TPLPrefix."homepagecatslider set title = '".getRealescape($title)."',categoryid='".getRealescape($parentid)."', type='".$type."', sortby='".$sortby."', ModifiedDate = '$today' , IsActive= '".$status."', UserId='".$_SESSION["UserId"]."' where hpsid = '".$edit_id."'";
				
				$db->insert($str);
				$db->insert_log("update","".TPLPrefix."homepagecatslider",$edit_id,"homepagecatslider  updated","homepagecatslider",$str);
				
				
				if(isset($product)){
					

					 $selqry = "select productid as id,hpd_proid from   ".TPLPrefix."homepagecatslider_product  where hpsid = '".$edit_id."' and IsActive=1 "; 
					$product_list=$db->get_rsltset($selqry);

					$productids = Array();
					
					foreach ($product_list as $key => $value) {
					  $productids[] = $value['id'];
					}
					 $productids = implode(',',$productids);
					 $productids = explode(',',$productids); 

					$array_equal = array_intersect($product,$productids);
					$array_diff  = array_diff($product,$productids); 

					foreach($array_equal as $vals)
					{   
						
						$str = "update ".TPLPrefix."homepagecatslider_product set sortby = '".$_REQUEST["sortby".$vals]."', ModifiedDate = '$today' where productid = '".$vals."' and hpsid= '".$edit_id."' ";
						   
						$db->insert($str);
					   
					} 

					foreach($array_diff as $val)
					{
										
						$str = "insert into ".TPLPrefix."homepagecatslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate) values('".$edit_id."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."') ";	
						$db->insert($str);
					}
					
				}
				
				
				if(isset($categoryIDs)){
					

					 $selqry = "select categoryID as id,hpd_proid from   ".TPLPrefix."homepagecatslider_category  where hpsid = '".$edit_id."' and IsActive=1 "; 
					$product_list=$db->get_rsltset($selqry);

					$productids = Array();
					
					foreach ($product_list as $key => $value) {
					  $productids[] = $value['id'];
					}
					 $productids = implode(',',$productids);
					 $productids = explode(',',$productids); 

					$array_equal = array_intersect($categoryIDs,$productids);
					$array_diff  = array_diff($categoryIDs,$productids); 

					foreach($array_equal as $vals)
					{   
						
						$str = "update ".TPLPrefix."homepagecatslider_category set sortby = '".$_REQUEST["sortby".$vals]."', ModifiedDate = '$today' where categoryID = '".$vals."' and hpsid= '".$edit_id."' ";
						   
						$db->insert($str);
					   
					} 

					foreach($array_diff as $val)
					{
										
						$str = "insert into ".TPLPrefix."homepagecatslider_category(hpsid,categoryID,sortby,IsActive,UserId,createdDate,modifiedDate) values('".$edit_id."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."') ";	
						$db->insert($str);
					}
					
				}

				echo json_encode(array("rslt"=>"2"));
			}
			else{
				echo json_encode(array("rslt"=>"5")); //warnning for max product
			}
			
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
	 // $today = date("Y-m-d");
	  $str="update ".TPLPrefix."homepagecatslider set IsActive = '2', ModifiedDate = '$today'  where hpsid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".TPLPrefix."homepagecatslider",$edit_id,"homepagecatslider deleted","homepagecatslider",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	
	
	case 'del_innerpage':
	  $edit_id = base64_decode($Id);
	 // $today = date("Y-m-d");
	  $str="update ".TPLPrefix."homepagecatslider_product set IsActive = '2', ModifiedDate = '$today'  where hpd_proid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".TPLPrefix."homepagecatslider_product",$edit_id,"homepagecatslider_product deleted","homepagecatslider_product",$str);
 	  echo json_encode(array("rslt"=>"6")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	//echo "reach"; exit;
	$edit_id = base64_decode($Id);
	
	//$today = date("Y-m-d");
	$status = $actval;
	
	    $str="update ".TPLPrefix."homepagecatslider set IsActive = '".$status."', ModifiedDate = '$today' where hpsid = '".$edit_id."'  ";
		$db->insert($str); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
}



?>