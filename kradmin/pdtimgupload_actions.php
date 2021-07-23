<?php 
include 'session.php';
//$directory = __DIR__."/../uploadproductimages";
//$directory = 'E:/xampp/htdocs/kesar/ploadproductimages/10233_C.jpg';
$directory = docroots."uploadproductimages/";
//$directory = docroots."uploadproductimages_test/";
//echo $directory; exit;

$images = glob($directory . "*.{jpg,png,gif}", GLOB_BRACE);

$productsku=array();
$successprd=array();
$successprdid=array();
$deleteimg=array();
$resproductexist= $db->get_rsltset(" select product_id,sku from ".TPLPrefix."product where IsActive <>2 ");

foreach($images as $image)
{
	
	ob_start();
	$imgpath=str_replace($directory."/","",$image);	
	$file_info=pathinfo($imgpath);
	$splitsku=explode("_",$file_info['filename']);
	if(in_array($splitsku[0],$productsku))	
	{
		if(in_array($splitsku[0],$successprd))
		{
//		  if(strpos("_c", strtolower($file_info['filename']))!== false) 
	 if(strpos(strtolower($file_info['filename']),'_c') !== false) 
		  {
			
			CustomizedProductImage($db,$successprdid[$splitsku[0]],$splitsku[0],$image);
		  }			  
		  else{		
			uploadPortfolio($db,$successprdid[$splitsku[0]],$splitsku[0],$image);
		  }	
			unlink($image);
			
		}	
	}	
	else	
	{
		 $productsku[]=$splitsku[0];
		//$chkproductexist= $db->get_a_line(" select product_id,count(product_id) as cnt from ".TPLPrefix."product where IsActive <>2 and sku='".$splitsku[0]."' ");
		
		 $product_id=searchkey_sku($splitsku[0],$resproductexist);
		
		if($product_id!=0)
		{
			
		
			$successprd[]=$splitsku[0];
			$successprdid[$splitsku[0]]=$product_id;
			
			 if(strpos(strtolower($file_info['filename']),'_c') !== false) 
			  {
				  CustomizedProductImage($db,$successprdid[$splitsku[0]],$splitsku[0],$image);			
			  }	
			  else{				
					uploadPortfolio($db,$successprdid[$splitsku[0]],$splitsku[0],$image);			
		  }	
				unlink($image);
		}
		else{
			unlink($image);
		}
		
    }	
  echo ob_get_contents();
  ob_end_flush();	
}


function uploadPortfolio($db,$edit_id,$sku,$imgpath){
$today=date("Y-m-d H:i:s");	
$configinfo=getQuerys($db,"allconfigurable");
$getsize = getimagesize_large($db,'product','Product Thumb');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height) = getimagesize($imgpath);


		if (!file_exists('../uploads/productassest/'.$edit_id)) {
			mkdir('../uploads/productassest/'.$edit_id, 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/thumb")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/thumb", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/medium")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/medium", 0777, true);
		}
		if (!file_exists('../uploads/productassest/'.$edit_id."/photos/base")) {
			mkdir('../uploads/productassest/'.$edit_id."/photos/base", 0777, true);
		}
			
	
			 if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth))
			{			
				$target_dir	= '../uploads/productassest/'.$edit_id."/photos/";
				
					$target_file_t = $target_dir . basename($imgpath);					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					
					$filename = $edit_id."_".pathinfo($target_file_t)['filename']."_".time().".".$imageFileType;
					
					$target_file = $target_dir . $filename;
					
					if(searchkeyvalue("IsEnableWaterMark",$configinfo)==1){
						if ($imageFileType == "gif")
							$image = imagecreatefromgif($imgpath);
							elseif ($imageFileType  == "jpg")
							$image = imagecreatefromjpeg($imgpath);
							elseif ($imageFileType  == "jpeg")
							$image = imagecreatefromjpeg($imgpath);
							elseif ($imageFileType  == "png")
							$image = imagecreatefrompng($imgpath);
							
							list($width, $height) = getimagesize($imgpath);
							
							$watermark = imagecreatefrompng(docroot.'watermark/'.$GLOBALS['watermark']['value']);  
							 $watermark_width = imagesx($watermark);
							 $watermark_height = imagesy($watermark);
							
							 $wat_width =$width/1.5;
							 $x_ratio = $wat_width / $watermark_width;
							 $wat_height = ceil($x_ratio * $watermark_height);
							
							$new_watermark = imagecreatetruecolor($wat_width, $wat_height);

							imagealphablending($new_watermark, false);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagefill($new_watermark, 0, 0, $color);
							imagecopyresized($new_watermark, $watermark, 0, 0, 0, 0, $wat_width, $wat_height, $watermark_width, $watermark_height);
							$wt_width = imagesx($new_watermark);
							$wt_height = imagesy($new_watermark);
							imagepng($new_watermark,$target_dir.'w'.$counter.'.png', 9);		
							
							imagealphablending($image, true);
							imagealphablending($new_watermark, true);
							imagesavealpha($new_watermark, true);
							$color = imagecolorallocatealpha($new_watermark, 0, 0, 0, 127);
							imagecolortransparent($new_watermark, $color); 
							imagefill($new_watermark, 0, 0, $color); 
							
							imagecopymerge($image, $new_watermark, 0.95*(($width/2) - ($wt_width/2)), 0.95*(($height/2) - ($wt_height/2)), 0, 0, $wt_width, $wt_height,35);
							
							if ($imageFileType == "gif")
								imagegif($image,$target_file, 50);
							elseif ($imageFileType  == "jpg")
								imagejpeg($image,$target_file, 50);
							elseif ($imageFileType  == "jpeg")
								imagejpeg($image,$target_file, 50);
							elseif ($imageFileType  == "png")
								imagepng($image,$target_file, 9);
							
					}
					else{	
						if ($imageFileType == "gif")
							$image = imagecreatefromgif($imgpath);
							elseif ($imageFileType  == "jpg")
							$image = imagecreatefromjpeg($imgpath);
							elseif ($imageFileType  == "jpeg")
							$image = imagecreatefromjpeg($imgpath);
							elseif ($imageFileType  == "png")
							$image = imagecreatefrompng($imgpath);
							$image_p = imagecreatetruecolor($width, $height);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
							if ($imageFileType == "gif")
								imagegif($image_p,$target_file, 50);
							elseif ($imageFileType  == "jpg")
								imagejpeg($image_p,$target_file, 50);
							elseif  ($imageFileType  == "jpeg")
								imagejpeg($image_p,$target_file, 50);
							elseif ($imageFileType  == "png")
								imagepng($image_p,$target_file, 9);
							
								
					}
					if(file_exists( $target_file))	
					{
						$str = "INSERT INTO ".TPLPrefix."product_images(product_id,sku,img_path,ordering,IsActive,createdDate,modifiedDate) values('".$edit_id."','".$sku."','".$filename."',(select count(product_id)  from ".TPLPrefix."product where IsActive <>2 and sku='".$sku."' ),1,'".$today."','".$today."'); ";
						//echo $str; 
						$db->insert($str);
						 $strChk = "select * from ".TPLPrefix."imageconfig where imageconfigModule = 'product' and IsActive != '2'";		
						$reslt = $db->get_rsltset($strChk);
						$counter = 0;
					
						for($mm=0;$mm<count($reslt);$mm++)
						{
							
							//list($width, $height) = getimagesize($target_file);
							
							
							// $new_width = $reslt[$mm]['imageconfigWidth']; 
							// $new_height = $reslt[$mm]['imageconfigHeight'];  

							$tn_w = $reslt[$mm]['imageconfigWidth']; 
							$tn_h = $reslt[$mm]['imageconfigHeight'];  

							$x_ratio = $tn_w / $width;
							$y_ratio = $tn_h / $height;

							if (($width <= $tn_w) && ($height <= $tn_h)) {							
								$new_width = $width;
								$new_height = $height;
							} elseif (($x_ratio * $height) < $tn_h) {
								$new_height = ceil($x_ratio * $height);
								$new_width = $tn_w;
							} else {
								$new_width = ceil($y_ratio * $width);
								$new_height = $tn_h;
							}	
							
							 $image_p = imagecreatetruecolor($new_width, $new_height);
							
							if ($imageFileType == "gif")
							$image = imagecreatefromgif($target_file);
							elseif ($imageFileType  == "jpg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($imageFileType  == "jpeg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($imageFileType  == "png")
							$image = imagecreatefrompng($target_file);
						
						
							
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							
						
							
							if($counter == 0)
								 $location = $target_dir."thumb/".$filename;
							else if($counter == 1)
								$location = $target_dir."medium/".$filename;
							else if($counter == 2)
								$location = $target_dir."base/".$filename;
						
							if ($imageFileType == "gif")
								imagegif($image_p,$location, 50);
							elseif ($imageFileType  == "jpg")
								imagejpeg($image_p,$location, 50);
							elseif  ($imageFileType  == "jpeg")
								imagejpeg($image_p,$location, 50);
							elseif ($imageFileType  == "png")
								imagepng($image_p,$location, 9);
							
							$counter++;
						}
																
					}
			  return '1';	
			}
			
}


function CustomizedProductImage($db,$edit_id,$sku,$imgpath)
{     
   

    $today=date("Y-m-d H:i:s");	
	$configinfo=getQuerys($db,"allconfigurable");
	$getsize = getimagesize_large($db,'product','Product Thumb');
	$imageval = explode('-',$getsize);
	$imgheight = $imageval[1];
	$imgwidth = $imageval[0];
   // echo $imgwidth; exit;
   
    list($width, $height) = getimagesize($imgpath);

	
		if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth))
		{
			
			$target_dir	= '../uploads/customizedproduct/';
			//$target_dir	= docroot.'customizedproduct/';
				
				 
				 
					$target_file_t = $target_dir . basename($imgpath);					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					
					$filename = pathinfo($target_file_t)['filename']."_".time().".".$imageFileType;
					
					$target_file = $target_dir . $filename;
			        copy($imgpath, $target_file); // move to one folder to another folder

			
			if($target_file)	
			{
				
				$str = "update ".TPLPrefix."product set uploadecustomizedimg='".$filename."' where product_id= '".$edit_id."' and IsActive = 1 ";
				//echo $str; 
				$db->insert($str);										
			}
			
			list($width, $height) = getimagesize($imgpath);
				
				$arrtype=getimagesize($imgpath); 
			if($width>=$height)
			{
				$new_width = 500;
				$new_height=$new_width * $height / $width;	
			}
			else
			{
				$new_height=500;
				$new_width=$new_height * $width / $height;
			}

			// Resample
			//$new_width = 206;   $new_height=102;	
			$image_p = imagecreatetruecolor($new_width, $new_height);
			//$image = imagecreatefromjpeg($filename);
		//	echo "ggg"; die();
			if ($arrtype['mime'] == "image/gif")
			$image = imagecreatefromgif($imgpath);		
			elseif ($arrtype['mime'] == "image/jpg")
			$image = imagecreatefromjpeg($imgpath);
			elseif ($arrtype['mime'] == "image/jpeg")
			$image = imagecreatefromjpeg($imgpath);
			elseif ($arrtype['mime'] == "image/png")
			$image = imagecreatefrompng($imgpath);			
			
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			 $location = $target_dir."thumbnails/".$filename;
		
			// Output

			//imagejpeg($image_p,$location, 100);
			if ($arrtype['mime'] == "image/gif")
			imagegif($image_p,$location, 50);
			elseif ($arrtype['mime'] == "image/jpg")
			imagejpeg($image_p,$location, 50);
			elseif ($arrtype['mime'] == "image/jpeg")
			imagejpeg($image_p,$location, 50);
			elseif ($arrtype['mime'] == "image/png")
			imagepng($image_p,$location, 9);	
			
		}
	}


   $db->multi_query($insertQuery); 
   echo json_encode(array("error"=>"0","msg"=>" Products Successfully Uploaded."));	
exit();  
														
error:
$reader->close();

if($errortype=="headrow"){
	echo json_encode(array("error"=>"1","type"=>"headrow","tab"=>$errortab,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$headerrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
}
else if($errortype=="prodattrrow") {
	echo json_encode(array("error"=>"1","type"=>"prodattrrow","prevfieldvalue"=> $prevfieldvalue,"tab"=>$errortab,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$attrheaderrow[$errorind]." value ".$row[$errorind]." not in our database.<br/> Are you want add?"));
	
}
else if($errortype=="attrrow") {
	echo json_encode(array("error"=>"1","type"=>"attrrow","attrbuteid"=> $attrbuteid,"attrbutevalue"=>$attrbutevalue,"val_ind"=>$row[$errorind],"rowindex"=>$errorrowindex,"msg"=>$baseattrbutevalue." value ".$attrbutevalue." not in our database.<br/> Are you want add?"));
	
}


die();
function searchkey_sku1($searchtext,$arrays)
{
	
	 foreach ($arrays as $arr) {
				
		   if (strtolower($arr['sku'])==strtolower(trim($searchtext))) {
				
		   		 return $arr['product_id'];
		}
	
	 }
   return '0';	
}
function searchkey_sku($searchtext,$arrays)
{
	 foreach ($arrays as $arr) {
				
		   if (strtolower($arr['sku'])==strtolower(trim($searchtext))) {
				
		   		 return $arr['product_id'];
		}
	
	 }
   return '0';		
}
?>