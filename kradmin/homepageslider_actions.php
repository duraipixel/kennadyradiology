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
		$strChk = "select count(hpsid) from ".TPLPrefix."homepageslider where title = '$title' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if($rowcount<=10){
				
				$str="insert into ".TPLPrefix."homepageslider(title,subtitle,categoryid,type,sortby,IsActive,UserId,CreatedDate,ModifiedDate,parent_id,lang_id)values('".getRealescape($title)."','".getRealescape($subtitle)."','".getRealescape($parentid)."','".$type."','".$sortby."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."',0,1)";
				
				$rslt = $db->insert($str);
				$lastInserId = $db->insert_id;			
				$log = $db->insert_log("insert","".TPLPrefix."Homepage Slider","","Homepage Slider Added Newly","Homepage Slider",$str);
				
				$getspanish = $db->get_a_line("select * from ".TPLPrefix."category where parent_id = '".getRealescape($parentid)."' and lang_id = 2 and IsActive = 1 ");
				$getportguese = $db->get_a_line("select * from ".TPLPrefix."category where parent_id = '".getRealescape($parentid)."' and lang_id = 3 and IsActive = 1 ");
				
				//spanish
				$spstr="insert into ".TPLPrefix."homepageslider(title,subtitle,categoryid,type,sortby,IsActive,UserId,CreatedDate,ModifiedDate,parent_id,lang_id)values('".getRealescape($title_es)."','".getRealescape($subtitle_es)."','".getRealescape($getspanish['categoryID'])."','".$type."','".$sortby."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$lastInserId."',2)";				
				$sprslt = $db->insert($spstr);
				$splastInserId = $db->insert_id;			
				
				//portugues
				$spstr="insert into ".TPLPrefix."homepageslider(title,subtitle,categoryid,type,sortby,IsActive,UserId,CreatedDate,ModifiedDate,parent_id,lang_id)values('".getRealescape($title_pt)."','".getRealescape($subtitle_pt)."','".getRealescape($getportguese['categoryID'])."','".$type."','".$sortby."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$lastInserId."',3)";				
				$sprslt = $db->insert($spstr);
				$portlastInserId = $db->insert_id;			
				
				if(isset($product)){
					foreach($product as $val)
					{
							$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id) values('".$lastInserId."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',1) ";	
							$db->insert($str);
							$sliderproductid = $db->insert_id;		
							$log = $db->insert_log("insert","".TPLPrefix."homepageslider_product","","homepageslider_product Add successfully","homepageslider_product",$str);
					  
					//spanish
					$getspanish = $db->get_a_line("select * from ".TPLPrefix."product where parent_id = '".getRealescape($val)."' and lang_id = 2 and IsActive = 1 ");						
					$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id,parent_id) values('".$splastInserId."','".$getspanish['product_id']."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',2,'".$sliderproductid."') ";	
					$db->insert($str);
					$log = $db->insert_log("insert","".TPLPrefix."homepageslider_product","","homepageslider_product Add successfully","homepageslider_product",$str);
					 
					
					//portugues
					 
						$getportguese = $db->get_a_line("select * from ".TPLPrefix."product where parent_id = '".getRealescape($val)."' and lang_id = 3 and IsActive = 1 ");
				
						$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id,parent_id) values('".$portlastInserId."','".$getportguese['product_id']."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',3,'".$sliderproductid."') ";	
						$db->insert($str);
						$log = $db->insert_log("insert","".TPLPrefix."homepageslider_product","","homepageslider_product Add successfully","homepageslider_product",$str);
					}
				}
				
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
		$strChk = "select count(hpsid) from ".TPLPrefix."homepageslider where title = '$title' and IsActive != '2' and hpsid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if($rowcount<=10){
				
				$str = "update ".TPLPrefix."homepageslider set subtitle= '".getRealescape($subtitle)."', title = '".getRealescape($title)."',categoryid='".getRealescape($parentid)."', type='".$type."', sortby='".$sortby."', ModifiedDate = '$today' , IsActive= '".$status."', UserId='".$_SESSION["UserId"]."' where hpsid = '".$edit_id."'";				
				$db->insert($str);
				$db->insert_log("update","".TPLPrefix."homepageslider",$edit_id,"homepageslider  updated","homepageslider",$str);
				
				
				$getspanish = $db->get_a_line("select * from ".TPLPrefix."category where parent_id = '".getRealescape($parentid)."' and lang_id = 2 and IsActive = 1 ");
				$getportguese = $db->get_a_line("select * from ".TPLPrefix."category where parent_id = '".getRealescape($parentid)."' and lang_id = 3 and IsActive = 1 ");
				
				//spanish
				
				$str = "update ".TPLPrefix."homepageslider set subtitle= '".getRealescape($subtitle_es)."', title = '".getRealescape($title_es)."',categoryid='".getRealescape($getspanish['categoryID'])."', type='".$type."', sortby='".$sortby."', ModifiedDate = '$today' , IsActive= '".$status."', UserId='".$_SESSION["UserId"]."' where hpsid = '".$edit_id_es."'";				
				$db->insert($str);
				$splastInserId = $edit_id_es;			
				
				//portugues
				$str = "update ".TPLPrefix."homepageslider set subtitle= '".getRealescape($subtitle_pt)."', title = '".getRealescape($title_pt)."',categoryid='".getRealescape($getportguese['categoryID'])."', type='".$type."', sortby='".$sortby."', ModifiedDate = '$today' , IsActive= '".$status."', UserId='".$_SESSION["UserId"]."' where hpsid = '".$edit_id_pt."'";				
				$db->insert($str);
				$portlastInserId = $edit_id_pt;
				
				
				if(isset($product)){
					

					 $selqry = "select productid as id,hpd_proid from   ".TPLPrefix."homepageslider_product  where hpsid = '".$edit_id."' and IsActive=1 "; 
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
						
						$str = "update ".TPLPrefix."homepageslider_product set sortby = '".$_REQUEST["sortby".$vals]."', ModifiedDate = '$today' where productid = '".$vals."' and hpsid= '".$edit_id."' ";						   
						$db->insert($str);
					   
					} 

					foreach($array_diff as $val)
					{
										
						$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id) values('".$edit_id."','".$val."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',1) ";	
						$db->insert($str);
						$sliderproductid = $db->insert_id;		
						
						//spanish
						$getspanish = $db->get_a_line("select * from ".TPLPrefix."product where parent_id = '".getRealescape($val)."' and lang_id = 2 and IsActive = 1 ");						
						$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id,parent_id) values('".$edit_id_es."','".$getspanish['product_id']."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',2,'".$sliderproductid."') ";	
						$db->insert($str);
						
						//portugues
						$getportguese = $db->get_a_line("select * from ".TPLPrefix."product where parent_id = '".getRealescape($val)."' and lang_id = 3 and IsActive = 1 ");
				
						$str = "insert into ".TPLPrefix."homepageslider_product(hpsid,productid,sortby,IsActive,UserId,createdDate,modifiedDate,lang_id,parent_id) values('".$edit_id_pt."','".$getportguese['product_id']."','".$_REQUEST["sortby".$val]."',1,'".$_SESSION["UserId"]."','".$today."','".$today."',3,'".$sliderproductid."') ";	
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
	  $str="update ".TPLPrefix."homepageslider set IsActive = '2', ModifiedDate = '$today'  where hpsid = '".$edit_id."'  ";
	  $db->insert($str); 

 $str="update ".TPLPrefix."homepageslider set IsActive = '2', ModifiedDate = '$today'  where parent_id = '".$edit_id."'  ";
	  $db->insert($str); 	  
	  
	  $db->insert_log("delete","".TPLPrefix."homepageslider",$edit_id,"homepageslider deleted","homepageslider",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	
	
	case 'del_innerpage':
	  $edit_id = base64_decode($Id);
	 // $today = date("Y-m-d");
	  $str="update ".TPLPrefix."homepageslider_product set IsActive = '2', ModifiedDate = '$today'  where hpd_proid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $str="update ".TPLPrefix."homepageslider_product set IsActive = '2', ModifiedDate = '$today'  where parent_id = '".$edit_id."'  ";
	  $db->insert($str);
	  $db->insert_log("delete","".TPLPrefix."homepageslider_product",$edit_id,"homepageslider_product deleted","homepageslider_product",$str);
 	  echo json_encode(array("rslt"=>"6")); //deletion	  	 		
	break;
	
	case 'del_innerpagecat':
	  $edit_id = base64_decode($Id);
	 // $today = date("Y-m-d");
	  $str="update ".TPLPrefix."homepagecatslider_product set IsActive = '2', ModifiedDate = '$today'  where hpd_proid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $str="update ".TPLPrefix."homepagecatslider_product set IsActive = '2', ModifiedDate = '$today'  where parent_id = '".$edit_id."'  ";
	  $db->insert($str); 
	  
	  $db->insert_log("delete","".TPLPrefix."ib_homepagecatslider_product",$edit_id,"ib_homepagecatslider_product deleted","ib_homepagecatslider_product",$str);
 	  echo json_encode(array("rslt"=>"6")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	//echo "reach"; exit;
	$edit_id = base64_decode($Id);
	
	//$today = date("Y-m-d");
	$status = $actval;
	
	    $str="update ".TPLPrefix."homepageslider set IsActive = '".$status."', ModifiedDate = '$today' where hpsid = '".$edit_id."'  ";
		$db->insert($str); 


	    $str="update ".TPLPrefix."homepageslider set IsActive = '".$status."', ModifiedDate = '$today' where parent_id = '".$edit_id."'  ";
		$db->insert($str); 

		
		echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
}



?>