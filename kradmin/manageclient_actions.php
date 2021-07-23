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

$getsize = getimagesize_large($db,'ourclient','mcimage');
//$sizes = getdynamicimage($db,'banners');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES['mcimage']['tmp_name']);


switch($act)
{
	case 'insert':
	
	if(!empty($mcname)) {
		$strChk = "select count(mcid) from ".TPLPrefix."manageclient where mcname = '$mcname' and IsActive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$path='';
			if(isset($_FILES["mcimage"])){
				
                //validate image size
				if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){				
				   //validate image file allowed (jpg,png,gif)
				    $file_info = getimagesize($_FILES["mcimage"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
						echo json_encode(array("rslt"=>"7"));
						exit();
					}	
					//image upload path - starts			
					$obj=new Gthumb();			
					$path=$obj->genThumbAdminclientImage('mcimage');
					 //$path=$obj->genThumbCatImage('bannerimage', $db);				
					//image upload path - ends
               		 
					 
				}	
				else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }	 
			}
			$str="insert into ".TPLPrefix."manageclient(mcname,mcimage,mcurl,SortingOrder,IsActive,userid,CreatedDate,ModifiedDate)values('".getRealescape($mcname)."','".getRealescape($path)."','".getRealescape($mcurl)."','".getRealescape($txtSortingOrder)."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."')";
			//echo $str; exit;
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".TPLPrefix."manageclient","","manageclient Added Newly","manageclient",$str);
			
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
	if(!empty($mcname)) {
		$strChk = "select count(mcid) from ".TPLPrefix."manageclient where mcname = '$mcname' and IsActive != '2' and mcid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".TPLPrefix."manageclient set mcname = '".getRealescape($mcname)."',SortingOrder = '".getRealescape($txtSortingOrder)."', ";
			$str .= " mcurl = '".getRealescape($mcurl)."',  ";
			if(isset($_FILES["mcimage"])){
				
				//validate image size
				if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
				    //validate image file allowed (jpg,png,gif)
					$file_info = getimagesize($_FILES["mcimage"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
						echo json_encode(array("rslt"=>"7"));
						exit();
					}				
					//image upload path - starts			
					$obj=new Gthumb();			
					 $path=$obj->genThumbAdminclientImage('mcimage');								
					//image upload path - ends	
					$str .= " mcimage='".getRealescape($path)."' , ";
				}	
				else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }	 
			}
			$str .= "  IsActive = '".$status."', ModifiedDate = '$today' , userid='".$_SESSION["UserId"]."'  where mcid = '".$edit_id."'";
			$db->insert_log("update","".TPLPrefix."manageclient",$edit_id,"manageclient updated","manageclient",$str);
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
	  
	  //$today = date("Y-m-d");
	  $str="update ".TPLPrefix."manageclient set IsActive = '2', ModifiedDate = '$today' , userid='".$_SESSION["UserId"]."'  where mcid = '".$edit_id."'";
	  $db->insert_log("delete","".TPLPrefix."manageclient",$edit_id,"manageclient deleted","manageclient",$str);
	  $db->insert($str); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
	
	 $str="update ".TPLPrefix."manageclient set IsActive = '".$status."', ModifiedDate = '$today' , userid='".$_SESSION["UserId"]."'  where mcid = '".$edit_id."'";
	 $db->insert_log("update","".TPLPrefix."manageclient",$edit_id,"manageclient Statuschanged","manageclient",$str);
	 $db->insert($str); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
}



?>