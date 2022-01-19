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

//$getsize = getimagesize_large($db,'shippingimg');
//$sizes = getdynamicimage($db,'banners');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES['shippingimage']['tmp_name']);
switch($act)
{
	case 'insert':
	
	if(!empty($shippingName) ) {
		$strChk = "select count(shippingId) from ".shoping_db."".TPLPrefix."shippingmethods where shippingName = ? and IsActive != ?  and lang_id = 1";		
		$reslt = $db->get_a_line_bind($strChk,array(getRealescape($shippingName),'2'));
				
				/*$strChk = "select count(shippingId) from ".TPLPrefix."shippingmethods where shippingName = '$shippingName' and IsActive != '2'";		

 		$reslt = $db->get_a_line($strChk);*/
		if($reslt[0] == 0) {
			
			$path='';
			if(isset($_FILES["shippingimage"])){
				//validate image size
			//	if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
			
				    //validate image file allowed (jpg,png,gif)
					$file_info = getimagesize($_FILES["shippingimage"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
						echo json_encode(array("rslt"=>"7"));
						exit();
					}	
					//image upload path - starts			
					$obj=new Gthumb();			
					$path=$obj->genThumbAdminshippingImage('shippingimage');
					 //$path=$obj->genThumbCatImage('bannerimage', $db);				
					//image upload path - ends
				/*}
				else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }*/
				
			}
			
			$str="insert into ".TPLPrefix."shippingmethods(shippingName,shippingDesc,shippingCode,shippingPage,modelname,shippingimage,sortby,IsActive,UserId,createdDate,modifiedDate) values(?,?,?,?,?,?,?,?,?,?,?)";

				$rslt = $db->insert_bind($str,array(getRealescape($shippingName),getRealescape($shippingDesc),getRealescape($shippingCode),$shippingPage,$modelname,getRealescape($path),$sortby,$status,$_SESSION["UserId"],$today,$today));	
				
				 
		
			$log = $db->insert_log("insert","".TPLPrefix."shippingmethods","","Shipping Method Added Newly","shipping",$str);
			
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
	if(!empty($shippingName) ) {
		$strChk = "select count(shippingId) from ".shoping_db."".TPLPrefix."shippingmethods where shippingName = ? and IsActive != ? and shippingId != ?  and lang_id = 1";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($shippingName),'2',getRealescape($edit_id)));
			if($reslt[0] == 0) {
			$shipimg='';
				if(isset($_FILES["shippingimage"])){
				
				//validate image size
				//if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
					
				    //validate image file allowed (jpg,png,gif)
                    $file_info = getimagesize($_FILES["shippingimage"]['tmp_name']);
					$file_mime = explode('/',$file_info['mime']);				
					if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
						echo json_encode(array("rslt"=>"7"));
						exit();
					}				
					//image upload path - starts			
					$obj=new Gthumb();			
					$path=$obj->genThumbAdminshippingImage('shippingimage');								
					//image upload path - ends	
					$shipimg = " ,shippingimage='".getRealescape($path)."'  ";
					
				/*}
				else
			    {
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			    }
					*/
			}
			
  			$str = "update ".TPLPrefix."shippingmethods set shippingName =? ,shippingDesc = ? ,shippingCode = ? ,shippingPage = ? ,modelname = ? ,sortby = ? ,IsActive = ? ,UserId = ?,modifiedDate = ? ".$shipimg." where shippingId = ? ";
				 
				$qry_main = array(getRealescape($shippingName),getRealescape($shippingDesc),getRealescape($shippingCode),$shippingPage,$modelname,$sortby,$status,$_SESSION["UserId"],$today);
				$qry_condition = array($edit_id);
				$result_data = array_merge($qry_main,$qry_condition);
				 
				$rslt = $db->insert_bind($str,$result_data);
				
				 
				
			$db->insert_log("update","".TPLPrefix."shippingmethods",$edit_id,"Shipping Method updated","shipping",$str);
			//echo $str; exit;
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
	  
	  $chk_Ref_there = 1;
	  
	//  if (isset($chk_Ref_there)) {
		  	//echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
	  //	}
	  //	else{
	  $str="update ".TPLPrefix."shippingmethods set IsActive = ?, modifiedDate = ? , UserId=?  where shippingId = ? ";
		$db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id)); 	
		
	   $db->insert_log("delete","".TPLPrefix."shippingmethods",$edit_id,"Shipping Method deleted","shipping",$str);
	 
	  
	 
 	  echo json_encode(array("rslt"=>"5")); //deletion
	 // }
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		$str="update ".shoping_db."".TPLPrefix."shippingmethods set IsActive = ?, modifiedDate = ? , UserId=?  where shippingId = ? ";
		//echo $str; exit;
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 	
		
		$db->insert_log("update","".TPLPrefix."shippingmethods",$edit_id,"Shipping Method Statuschanged","shipping",$str);
		$db->insert($str); 		
		echo json_encode(array("rslt"=>"6")); //status update success		
	//	}
		
			
	
	break;
}



?>