<?php 
include 'session.php';
extract($_REQUEST);
 $act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
	
	include 'includes/image_thumb.php';
$today=date("Y-m-d H:i:s");

$getsize = getimagesize_large($db,'manufacturer','manufacturer');
//$sizes = getdynamicimage($db,'banners');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES['manufactImage']['tmp_name']);


switch($act)
{
	case 'insert':
	
	if(!empty($txtManufacturer)) {
		$strChk = "select count(manufacturerId) from ".TPLPrefix."manufacturer where manufacturerName = '$txtManufacturer' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
		
		////for image upload from here
			$path = '';
			
				
			if(isset($_FILES["manufactImage"])){
				if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){				
				
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["manufactImage"]['tmp_name']);
				$file_mime = pathinfo($_FILES["manufactImage"]['name']);				
				
				if(!in_array($file_mime['extension'],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
			 $path=$obj->genThumbManufactImage('manufactImage', $db);							
				//image upload path - ends	
				}else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }	
			}
		////for image upload till here
		
		$strunicode = "select count(*) as keycnt from ".TPLPrefix."manufacturer where manucode = '$manucode' and IsActive != '2'";
		$reslt = $db->get_a_line($strunicode);		
		if($reslt['keycnt'] > 0)
			$manucode = $manucode.'_'.$reslt['keycnt'];
			
			$str="insert into ".TPLPrefix."manufacturer(parentId,manufacturerName,description, manufactImage,manucode, metatitle, metadesc, metakeyword,IsActive,UserId, sortingOrder,createdDate,modifiedDate)values('".$parentId."','".getRealescape($txtManufacturer)."','".getRealescape($txtdescription)."','".$path."','".$manucode."','".$metatitle."','".$metadesc."','".$metakeyword."','".$status."','".$_SESSION["UserId"]."','".$txtSortingorder."','".$today."','".$today."')";
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".TPLPrefix."manufacturer","","Manufacturer Added Newly","manufacturer",$str);
			
			
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
	if(!empty($txtManufacturer)) {
		$strChk = "select count(manufacturerId) from ".TPLPrefix."manufacturer where manufacturerName = '$txtManufacturer' and IsActive != '2' and manufacturerId != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
		
		
		$strunicode = "select count(*) as keycnt from ".TPLPrefix."manufacturer where manucode = '$manucode' and IsActive != '2'";
		$reslt = $db->get_a_line($strunicode);		
		if($reslt['keycnt'] > 0)
			$manucode = $manucode.'_'.$reslt['keycnt'];
		
		$str = "update ".TPLPrefix."manufacturer set parentId= '".$parentId."' , manufacturerName = '".getRealescape($txtManufacturer)."',description='".getRealescape($txtdescription)."', UserId='".$_SESSION["UserId"]."', IsActive = '".$status."' , manucode= '".$manucode."', modifiedDate = '".$today."' ,metatitle= '".$metatitle."', metadesc= '".$metadesc."', metakeyword= '".$metakeyword."',sortingOrder = '".$txtSortingorder."' ";
		
		if(isset($_FILES["manufactImage"])){
 if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){				
				
 				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["manufactImage"]['tmp_name']);
				$file_mime = pathinfo($_FILES["manufactImage"]['name']);	
				if(!in_array($file_mime['extension'],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
				$path=$obj->genThumbManufactImage('manufactImage', $db);	
				//image upload path - ends
				$str .= " , manufactImage = '".$path."' ";	
					}else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }	
					
			}
			
			$str .= " where manufacturerId = '".trim($edit_id)."'";	
		    $db->insert_log("update","".TPLPrefix."manufacturer",$edit_id,"Manufacturer updated","manufacturer",$str);

			
			$db->insert($str);
			
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
	  
	 // $today = date("Y-m-d");
	
	  $chkReference_ed = $db->get_a_line("select manufacturerId from ".TPLPrefix."product where manufacturerId = '".$edit_id."' and IsActive <> 2 ");
	  $chk_Ref_there = $chkReference_ed['manufacturerId'];
	 
	  if (isset($chk_Ref_there)) {
		  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  }
	  else{	  	  
		  $str="update ".TPLPrefix."manufacturer set IsActive = '2', modifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where manufacturerId = '".$edit_id."'";
		   $db->insert_log("delete","".TPLPrefix."manufacturer",$edit_id,"Manufacturer deleted","manufacturer",$str);
		  $db->insert($str); 	 
		  
		 
		  echo json_encode(array("rslt"=>"5")); //deletion
	  }
	  	 		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $status = $actval;
	  
	  
	  //echo "select manufacturerId from ".TPLPrefix."products where manufacturerId = '".$edit_id."' and IsActive<>2 ";
	 // die();
	  $chkReference_ed = $db->get_a_line("select manufacturerId from ".TPLPrefix."product where manufacturerId = '".$edit_id."' and IsActive <> 2 ");
	  $chk_Ref_there = $chkReference_ed['manufacturerId'];
	 
	  if (isset($chk_Ref_there)) {
		  
		  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  }
	  else{	 
	      
		   $str="update ".TPLPrefix."manufacturer set IsActive = '".$status."', modifiedDate = '".$today."', UserId='".$_SESSION["UserId"]."'  where manufacturerId = '".$edit_id."'"; 
		   $db->insert_log("update","".TPLPrefix."manufacturer",$edit_id,"Status Changed","manufacturer",$str);
		  $db->insert($str); 	 
		  
		 
		  echo json_encode(array("rslt"=>"6")); //status change
	  }
	  	 		
	break;
	
	
}



?>