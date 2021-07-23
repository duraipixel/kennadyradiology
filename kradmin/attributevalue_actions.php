<?php 
include 'session.php';
extract($_REQUEST);
$img = $_FILES["dropdown_images"]["name"];
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$today=date("Y-m-d H:i:s");

switch($act)
{
	case 'insert':
	
	if(!empty($dropdown_values)) {
		$strChk = "select count(dropdown_id) from ".TPLPrefix."dropdown where dropdown_values = ? and isactive != ?";
 		$reslt = $db->get_a_line_bind($strChk,array($dropdown_values,'2'));
		if($reslt[0] == 0) {
			
			//echo"reach1";
		
		if(isset($_FILES["dropdown_images"]["name"])){
			$uploadimg_temp = $_FILES["dropdown_images"]['tmp_name'];
			$uploadimg = time().'_'.$_FILES["dropdown_images"]["name"];
			move_uploaded_file($uploadimg_temp,"../uploads/attributevalue/".$uploadimg);	
			
			
		}
		
          /*
         ////for image upload from here
			$path = '';
			if(isset($_FILES["dropdown_images"])){
				
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["dropdown_images"]['tmp_name']);
				echo"reach2";
				$file_mime = explode('/',$file_info['mime']);	
                 echo"reach3";				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				echo"reach4";
				//image upload path - starts			
				$obj=new Gthumb();			
			 $path=$obj->genThumbAttrivalueImage('dropdown_images', $db);	
             echo "reach5";			 
				//image upload path - ends	
			}
		////for image upload till here		
			*/
			
			$str="insert into ".TPLPrefix."dropdown(attributeId,dropdown_values,dropdown_unit,dropdown_images,isactive,sortingOrder,userid,createdate,modifieddate)values(?,?,?,?,?,?,?,?,?)";
		
			
			$rslt = $db->insert_bind($str,array($attid,getRealescape($dropdown_values),getRealescape($dropdown_unit),$uploadimg,$status,$sortingOrder,$_SESSION["UserId"],$today,$today));			
			$log = $db->insert_log("insert","".TPLPrefix."dropdown","","dropdown Added Newly","dropdown",$str);
			
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
	if(!empty($dropdown_values)) {
		
		$strChk = "select count(dropdown_id) from ".TPLPrefix."dropdown where dropdown_values = ? and isactive != ? and dropdown_id != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($dropdown_values,'2',$edit_id));
		if($reslt[0] == 0) {
			$img_path = array();
			if(isset($_FILES["dropdown_images"]["name"])){
			$uploadresume_temp = $_FILES["dropdown_images"]['tmp_name'];
			$uploadimg = time().'_'.$_FILES["dropdown_images"]["name"];
			move_uploaded_file($uploadresume_temp,"../uploads/attributevalue/".$uploadimg);	
			$img_path[] =  $uploadimg ;
			$dropdown_images = " ,dropdown_images=? ";	
			}
			
			/*
			////for image upload from here
			$path = '';
			if(isset($_FILES["dropdown_images"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["dropdown_images"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
			 $path=$obj->genThumbAttrivalueImage('dropdown_images', $db);							
				//image upload path - ends	
				$img_path = " dropdown_images= '".$path."' ";
			}
		   // for image upload till here
			*/
			  $str = "update ".TPLPrefix."dropdown set attributeId = ?,dropdown_values=?, dropdown_unit =?, isactive= ?,sortingOrder = ?,modifieddate = ? , userid=? ".$dropdown_images." where dropdown_id = ?";
 
 			$qry_main = array($attid,getRealescape($dropdown_values),getRealescape($dropdown_unit),$status,$sortingOrder,$today,$_SESSION["UserId"]);
			$qry_condition = array($edit_id);
			$result_data = array_merge($qry_main,$img_path,$qry_condition);
		
			$rslt = $db->insert_bind($str,$result_data);
 			$db->insert_log("update","".TPLPrefix."dropdown",$edit_id,"dropdown  updated","dropdown",$str);

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
	  $str="update ".TPLPrefix."dropdown set isactive = ?, modifieddate = ?, userid=?  where dropdown_id = ? ";
	  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id)); 	 
	  
	  $db->insert_log("delete","".TPLPrefix."dropdown",$edit_id,"dropdown deleted","dropdown",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
	
		$str="update ".TPLPrefix."dropdown set isactive = ?, modifieddate = ? , userid=?  where dropdown_id = ?  ";
		//echo $str; exit;
		$db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 	
		echo json_encode(array("rslt"=>"6")); //status update success
 	break;
	
	
}



?>