<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
//print_r($_REQUEST); exit;
include 'includes/image_thumb.php';

//Destop Banner
if($Bannerposition == 2){
$getsize = getimagesize_large($db,'promotiondestopbanner','banners');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES["bannerimage"]['tmp_name']);
list($widthes, $heightes, $type, $attr) = getimagesize($_FILES["bannerimage_es"]['tmp_name']);
list($widthpt, $heightpt, $type, $attr) = getimagesize($_FILES["bannerimage_pt"]['tmp_name']);
// Mobile banner
$getsize1 = getimagesize_large($db,'promotionmobilebanner','mobile');
$imageval1 = explode('-',$getsize1);
$imgheight1 = $imageval1[1];
$imgwidth1 = $imageval1[0];

list($width1, $height1, $type, $attr) = getimagesize($_FILES["mobileimage"]['tmp_name']);

list($width1es, $height1es, $type, $attr) = getimagesize($_FILES["mobileimage_es"]['tmp_name']);
list($width1pt, $height1pt, $type, $attr) = getimagesize($_FILES["mobileimage_pt"]['tmp_name']);
}else{
$getsize = getimagesize_large($db,'destopbanner','banners');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

list($width, $height, $type, $attr) = getimagesize($_FILES["bannerimage"]['tmp_name']);
list($widthes, $heightes, $type, $attr) = getimagesize($_FILES["bannerimage_es"]['tmp_name']);
list($widthpt, $heightpt, $type, $attr) = getimagesize($_FILES["bannerimage_pt"]['tmp_name']);
// Mobile banner
$getsize1 = getimagesize_large($db,'mobilebanner','mobile');
$imageval1 = explode('-',$getsize1);
$imgheight1 = $imageval1[1];
$imgwidth1 = $imageval1[0];

list($width1, $height1, $type, $attr) = getimagesize($_FILES["mobileimage"]['tmp_name']);
list($width1es, $height1es, $type, $attr) = getimagesize($_FILES["mobileimage_es"]['tmp_name']);
list($width1pt, $height1pt, $type, $attr) = getimagesize($_FILES["mobileimage_pt"]['tmp_name']);
}

if($chkstatus !=null)
	$status =1;
else
	$status =0;

$datetime=date('Y-m-d H:i:s');


//echo "banner: ".$width .'>='. $imgwidth .'&&'. $height .'>='. $imgheight .'&&'. $height .'=='. round($width * $imgheight / $imgwidth);

//echo "mobile: ".$width1 >= $imgwidth1 && $height1 >= $imgheight1) && $height1 == round($width1 * $imgheight1 / $imgwidth1;

switch($act)
{
	case 'insert':
 
		if(!empty($bannername) ) {
			$strChk = "select count(bannerid) from ".TPLPrefix."banners where bannername = ? and IsActive != ? and lang_id = 1 ";		
				$reslt = $db->get_a_line_bind($strChk,array(getRealescape($bannername),'2'));
			
				if($reslt[0] == 0) {
				
				//Banner Destop Image
				$bannerimg='';
				if(isset($_FILES["bannerimage"])){
				
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg=str_replace(' ','_',$_FILES['bannerimage']['name']);
					  $bannerimg=time().rand(0,9).$bannerimg;	
					  $target_file = '../uploads/banners/'.$bannerimg;
					 
					  move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				
				
				$bannerimg_es='';
				if(isset($_FILES["bannerimage_es"])){
				
					if(($widthes >= $imgwidth && $heightes >= $imgheight) && $heightes == round($widthes * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage_es"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg_es=str_replace(' ','_',$_FILES['bannerimage_es']['name']);
					  $bannerimg_es=time().rand(0,9).$bannerimg_es;	
					  $target_file = '../uploads/banners/'.$bannerimg_es;
					 
					  move_uploaded_file($_FILES["bannerimage_es"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Spanish Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				
				$bannerimg_pt='';
				if(isset($_FILES["bannerimage_pt"])){
				
					if(($widthpt >= $imgwidth && $heightpt >= $imgheight) && $heightpt == round($widthpt * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage_pt"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg_pt=str_replace(' ','_',$_FILES['bannerimage_pt']['name']);
					  $bannerimg_pt=time().rand(0,9).$bannerimg_pt;	
					  $target_file = '../uploads/banners/'.$bannerimg_pt;
					 
					  move_uploaded_file($_FILES["bannerimage_pt"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Portuguese Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				//Banner Mobile Image
				$banner_mobileimg='';
				if(isset($_FILES["mobileimage"])){
					if(($width1 >= $imgwidth1 && $height1 >= $imgheight1) && $height1 == round($width1 * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $banner_mobileimg=str_replace(' ','_',$_FILES['mobileimage']['name']);
					  $banner_mobileimg=time().rand(0,9).$banner_mobileimg;	
					  $target_file1 = '../uploads/banners/mobile/'.$banner_mobileimg;
					 
					  move_uploaded_file($_FILES["mobileimage"]["tmp_name"], $target_file1);
						//image upload path - ends	
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
				}			
					
					
					$banner_mobileimg_es='';
				if(isset($_FILES["mobileimage_es"])){
					if(($width1es >= $imgwidth1 && $height1es >= $imgheight1) && $height1es == round($width1es * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage_es"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $banner_mobileimg_es=str_replace(' ','_',$_FILES['mobileimage_es']['name']);
					  $banner_mobileimg_es=time().rand(0,9).$banner_mobileimg_es;	
					  $target_file1 = '../uploads/banners/mobile/'.$banner_mobileimg_es;
					 
					  move_uploaded_file($_FILES["mobileimage_es"]["tmp_name"], $target_file1);
						//image upload path - ends	
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Spanish Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
				}			
				
				$banner_mobileimg_pt='';
				if(isset($_FILES["mobileimage_pt"])){
					if(($width1pt >= $imgwidth1 && $height1pt >= $imgheight1) && $height1pt == round($width1pt * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage_pt"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $banner_mobileimg_pt=str_replace(' ','_',$_FILES['mobileimage_pt']['name']);
					  $banner_mobileimg_pt=time().rand(0,9).$banner_mobileimg_pt;	
					  $target_file1 = '../uploads/banners/mobile/'.$banner_mobileimg_pt;
					 
					  move_uploaded_file($_FILES["mobileimage_pt"]["tmp_name"], $target_file1);
						//image upload path - ends	
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Portuguese Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
				}			
					$str="insert into ".TPLPrefix."banners(bannername,Bannerposition,SortingOrder,bannerimage,mobileimage,IsActive,UserId,CreatedDate,banner_title,banner_desc,banner_btn_txt,banner_link,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";					
					$rslt = $db->insert_bind($str,array(getRealescape($bannername),$Bannerposition,$SortingOrder,$bannerimg,$banner_mobileimg,$status,$_SESSION["UserId"],$datetime,$banner_title,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link),1,0));	
					$bannerinsertid = $db->insert_id;

//spanish					
					$str="insert into ".TPLPrefix."banners(bannername,Bannerposition,SortingOrder,bannerimage,mobileimage,IsActive,UserId,CreatedDate,banner_title,banner_desc,banner_btn_txt,banner_link,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";					
					$rslt = $db->insert_bind($str,array(getRealescape($bannername_es),$Bannerposition,$SortingOrder,$bannerimg_es,$banner_mobileimg_es,$status,$_SESSION["UserId"],$datetime,$banner_title_es,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link),2,$bannerinsertid));	
					
					//portuguese
					
					$str="insert into ".TPLPrefix."banners(bannername,Bannerposition,SortingOrder,bannerimage,mobileimage,IsActive,UserId,CreatedDate,banner_title,banner_desc,banner_btn_txt,banner_link,lang_id,parent_id) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";					
					$rslt = $db->insert_bind($str,array(getRealescape($bannername_pt),$Bannerposition,$SortingOrder,$bannerimg_pt,$banner_mobileimg_pt,$status,$_SESSION["UserId"],$datetime,$banner_title_pt,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link),3,$bannerinsertid));	
					
					$log = $db->insert_log("insert","".TPLPrefix."banners","","banners Added Newly","banners",$str);
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
 		if(!empty($bannername) ) {
			$strChk = "select count(bannerid) from ".TPLPrefix."banners where bannername = ? and IsActive != ? and bannerid != ?  and lang_id = 1";
			$reslt = $db->get_a_line_bind($strChk,array(getRealescape($bannername),'2',getRealescape($edit_id)));
				if($reslt[0] == 0) {
				
				// Banner Desktop Image
				$bannerimg = array();	
				if(isset($_FILES["bannerimage"])){
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname=str_replace(' ','_',$_FILES['bannerimage']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/banners/'.$imgname;
					 
					  move_uploaded_file($_FILES["bannerimage"]["tmp_name"], $target_file);
						$bannerimg[] = getRealescape($imgname);
						$bannernamedesk = " ,bannerimage=? ";	
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}
				
				$bannerimg_es = array();	
				if(isset($_FILES["bannerimage_es"])){
				//	echo $widthes .'>='. $imgwidth .'&&'. $heightes .'>='. $imgheight .'&&'. $heightes .'=='. round($widthes * $imgheight / $imgwidth);
					if(($widthes >= $imgwidth && $heightes >= $imgheight) && $heightes == round($widthes * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage_es"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname_es=str_replace(' ','_',$_FILES['bannerimage_es']['name']);
					  $imgname_es=time().rand(0,9).$imgname_es;	
					  $target_file = '../uploads/banners/'.$imgname_es;
					 
					  move_uploaded_file($_FILES["bannerimage_es"]["tmp_name"], $target_file);
						$bannerimg_es[] = getRealescape($imgname_es);
						$bannernamedesk_es = " ,bannerimage=? ";	
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Spanish Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}
				
				$bannerimg_pt = array();	
				if(isset($_FILES["bannerimage_pt"])){
					if(($widthpt >= $imgwidth && $heightpt >= $imgheight) && $heightpt == round($widthpt * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["bannerimage_pt"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname_pt=str_replace(' ','_',$_FILES['bannerimage_pt']['name']);
					  $imgname_pt=time().rand(0,9).$imgname_pt;	
					  $target_file = '../uploads/banners/'.$imgname_pt;
					 
					  move_uploaded_file($_FILES["bannerimage_pt"]["tmp_name"], $target_file);
						$bannerimg_pt[] = getRealescape($imgname_pt);
						$bannernamedesk_pt = " ,bannerimage=? ";	
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Portuguese Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}
				
				//Banner Mobile Image
				$bannermobileimg = array();	
				if(isset($_FILES["mobileimage"])){
					if(($width1 >= $imgwidth1 && $height1 >= $imgheight1) && $height1 == round($width1 * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						/* 
						 $exten  =$_FILES["bannerimage"]["type"];
						 $obj=new Gthumb();	
						$path =	$obj->resize_image($sizes,'banners_logo',$exten,$_FILES['bannerimage']);
						*/
					  $imgname=str_replace(' ','_',$_FILES['mobileimage']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file1 = '../uploads/banners/mobile/'.$imgname;
					 
					  move_uploaded_file($_FILES["mobileimage"]["tmp_name"], $target_file1);
						$bannermobileimg[] = getRealescape($imgname);
						$bannernamemobile = " ,mobileimage=? ";	
					
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
						
				}
				
				
				$bannermobileimg_es = array();	
				if(isset($_FILES["mobileimage_es"])){
					if(($width1es >= $imgwidth1 && $height1es >= $imgheight1) && $height1es == round($width1es * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage_es"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						} 
					  $imgname_es=str_replace(' ','_',$_FILES['mobileimage_es']['name']);
					  $imgname_es=time().rand(0,9).$imgname_es;	
					  $target_file1 = '../uploads/banners/mobile/'.$imgname_es;
					 
					  move_uploaded_file($_FILES["mobileimage_es"]["tmp_name"], $target_file1);
						$bannermobileimg_es[] = getRealescape($imgname_es);
						$bannernamemobile_es = " ,mobileimage=? ";	
					
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Spanish Mobile Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
						
				}
				
				$bannermobileimg_pt = array();	
				if(isset($_FILES["mobileimage_pt"])){
					if(($width1pt >= $imgwidth1 && $height1pt >= $imgheight1) && $height1pt == round($width1pt * $imgheight1 / $imgwidth1)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["mobileimage_pt"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						} 
					  $imgname_pt=str_replace(' ','_',$_FILES['mobileimage_pt']['name']);
					  $imgname_pt=time().rand(0,9).$imgname_pt;	
					  $target_file1 = '../uploads/banners/mobile/'.$imgname_pt;
					 
					  move_uploaded_file($_FILES["mobileimage_pt"]["tmp_name"], $target_file1);
						$bannermobileimg_pt[] = getRealescape($imgname_pt);
						$bannernamemobile_pt = " ,mobileimage=? ";	
					
					}else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Portuguese Mobile Image Size should be '.$imgwidth1.' & '.$imgheight1.' or Ratio ('.round($imgheight1/$imgwidth1).': '.round($imgheight1%$imgwidth1).') size not matched'));  //no values
						exit();						
					}
						
				}
				
				
					$str = "update ".TPLPrefix."banners set bannername = ? ,Bannerposition = ?, SortingOrder = ?, IsActive = ?, ModifiedDate = ? , UserId=?, banner_title = ?,banner_desc = ?,banner_btn_txt = ?,banner_link = ? ".$bannernamedesk.$bannernamemobile." where bannerid = ? ";
					$qry_main = array(getRealescape($bannername),$Bannerposition,$SortingOrder,$status,$datetime,$_SESSION["UserId"],$banner_title,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link)); 
					$qry_condition = array($edit_id);
					$result_data = array_merge($qry_main,$bannerimg,$bannermobileimg,$qry_condition);					 
					$rslt = $db->insert_bind($str,$result_data);
					
					//spanish
			 		$str = "update ".TPLPrefix."banners set bannername = ? ,Bannerposition = ?, SortingOrder = ?, IsActive = ?, ModifiedDate = ? , UserId=?, banner_title = ?,banner_desc = ?,banner_btn_txt = ?,banner_link = ? ".$bannernamedesk_es.$bannernamemobile_es." where bannerid = ? and lang_id = 2 ";
					$qry_main = array(getRealescape($bannername_es),$Bannerposition,$SortingOrder,$status,$datetime,$_SESSION["UserId"],$banner_title_es,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link)); 
					$qry_condition = array($edit_id_es);
					$result_data = array_merge($qry_main,$bannerimg_es,$bannermobileimg_es,$qry_condition);		
 				
					$rslt = $db->insert_bind($str,$result_data);
					
					//spanish
					$str = "update ".TPLPrefix."banners set bannername = ? ,Bannerposition = ?, SortingOrder = ?, IsActive = ?, ModifiedDate = ? , UserId=?, banner_title = ?,banner_desc = ?,banner_btn_txt = ?,banner_link = ? ".$bannernamedesk_pt.$bannernamemobile_pt." where bannerid = ? and lang_id = 3 ";
					$qry_main = array(getRealescape($bannername_pt),$Bannerposition,$SortingOrder,$status,$datetime,$_SESSION["UserId"],$banner_title_pt,getRealescape($banner_desc),getRealescape($banner_btn_txt),getRealescape($banner_link)); 
					$qry_condition = array($edit_id_pt);
					$result_data = array_merge($qry_main,$bannerimg_pt,$bannermobileimg_pt,$qry_condition);					 
					$rslt = $db->insert_bind($str,$result_data);
					
					$db->insert_log("update","".TPLPrefix."banners",$edit_id,"banners updated","banners",$str);

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
		$str="update ".TPLPrefix."banners set IsActive = ?, ModifiedDate = ? , UserId= ? where bannerid = ? ";  
		$rslt = $db->insert_bind($str,array('2',getRealescape($datetime),$_SESSION["UserId"],$edit_id)); 
		
		$str="update ".TPLPrefix."banners set IsActive = ?, ModifiedDate = ? , UserId= ? where parent_id = ? ";  
		$rslt = $db->insert_bind($str,array('2',getRealescape($datetime),$_SESSION["UserId"],$edit_id)); 
		  
		$db->insert_log("delete","".TPLPrefix."banners",$edit_id,"banners deleted","banners",$str);
		echo json_encode(array("rslt"=>"5")); //deletion
		
	break;
	
 		
	case 'changestatus':
	
		$edit_id = base64_decode($Id);
		$status = $actval;
		$str="update ".TPLPrefix."banners set IsActive = ?, ModifiedDate = ? , UserId= ?  where bannerid = ? ";		
		$rslt = $db->insert_bind($str,array($status,getRealescape($datetime),$_SESSION["UserId"],$edit_id));		
		
		$str="update ".TPLPrefix."banners set IsActive = ?, ModifiedDate = ? , UserId= ?  where parent_id = ? ";		
		$rslt = $db->insert_bind($str,array($status,getRealescape($datetime),$_SESSION["UserId"],$edit_id));		
		echo json_encode(array("rslt"=>"6")); //status update success		
		
	break;
	
}

?>