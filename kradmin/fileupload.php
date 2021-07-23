<?php
include "session.php"; 
include "includes/image_thumb.php";
//echo "reach"; exit;
extract($_REQUEST);
//print_r($_FILES); exit;

if(isset($action) && $action=='fileUpload'){
	
//$path =  __DIR__ ."/uploads/customfields/"; 
$img = $_FILES['files']['name'];
	
for($i=0;$i<count($img);$i++){
	 //$uploadimgs[] =$_FILES["files"]["name"][$i];
	 $uploadimg_temp = $_FILES["files"]['tmp_name'][$i];
	 $uploadimg_name =$_FILES["files"]["name"][$i];
	  $uploadimg_type =$_FILES["files"]["type"][$i];
	// move_uploaded_file($uploadimg_temp,$path.$uploadimg);
	
	//image upload path - starts			
	$obj=new Gthumb();			
    $paths[]=$obj->genThumbuploadsImage($uploadimg_name, $uploadimg_temp, $uploadimg_type, $db);							
	//image upload path - ends	
}
		
//print_r($path); exit;
           
	
  echo'{"success":true,"time":"2018-11-14 15:14:21","data":{"baseurl":"'.image_public1_url.'customfields/","messages":[],"files":'.json_encode($paths).',"isImages":[true],"code":220}}';
}


?>