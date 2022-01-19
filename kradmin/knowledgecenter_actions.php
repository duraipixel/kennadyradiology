 <?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

function cleanurl($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

include 'includes/image_thumb.php';

if($chkstatus !=null)
	$status =1;
else
	$status =0;
		
$today=date("Y-m-d H:i:s");
$getlanguage = getLanguages($db);
 
$getsize = getimagesize_large($db,'knowledgecenter','knowledgecenter');

$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
list($width, $height, $type, $attr) = getimagesize($_FILES["knowledgecenterimage"]['tmp_name']);
 


switch($act)
{
	case 'insert':
	if(!empty($txtknowledgecentertitle) ) {
		$strChk = "select count(knowledgecenterid) from ".TPLPrefix."knowledgecenter where knowledgecentertitle = ? and IsActive != ? ";		
 		$reslt = $db->get_a_line_bind($strChk,array($txtknowledgecentertitle,2));
		//if($reslt[0] == 0) {
		    
		    $knowledgecenterimage='';

			if(isset($_FILES["knowledgecenterimage"])){
			
			
				
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){

						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["knowledgecenterimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg=str_replace(' ','_',$_FILES['knowledgecenterimage']['name']);
					  $bannerimg=time().rand(0,9).$bannerimg;	
					  $target_file = '../uploads/knowledgecenter/'.$bannerimg;
					 
					  move_uploaded_file($_FILES["knowledgecenterimage"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
 						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				
			 
			
			
				$parentidval = 0;
				foreach($getlanguage as $languageval){
					//echo $languageval['languagefield'].'languageid';
				//echo	'txtknowledgecentertitle'.$languageval['languagefield'];
				//	echo "<br>";
				if($languageval['languageid'] > 1){
					 
				$getcategory = $db->get_a_line("select categoryid from `".TPLPrefix."knowledgecenter_master_category` where parent_id = '".$_POST['categoryid']."' and lang_id = '".$languageval['languageid']."' and IsActive = 1 ");
				$knowcatid = $getcategory['categoryid'];
				}else{
					$knowcatid =$_POST['categoryid'];
				}
				
					$knowledgecentercode = cleanurl($_POST['txtknowledgecentertitle'.$languageval['languagefield']]);
					   $str="insert into ".TPLPrefix."knowledgecenter(categoryid,knowledgecentertitle,knowledgecenterdate,knowledgecenterdescription,knowledgecenterimage,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id,knowledgecentercode,sortingOrder) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
					
					  $rslt = $db->insert("insert into ".TPLPrefix."knowledgecenter(categoryid,knowledgecentertitle,knowledgecenterdate,knowledgecenterdescription,knowledgecenterimage,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id,knowledgecentercode,sortingOrder) values ('".getRealescape($knowcatid)."','".getRealescape($_POST['txtknowledgecentertitle'.$languageval['languagefield']])."','".getdateFormat($db,$_POST['txtknowledgecenterdate'])."','".getRealescape($_POST['txtknowledgecenterdescription'.$languageval['languagefield']])."','".$bannerimg."','".$status."','".$_SESSION["UserId"]."','".$today."','".$today."','".$parentidval."','".$languageval['languageid']."','".$knowledgecentercode."','".$txtSortingorder."')");
					
					// echo implode('"',array(getRealescape($knowcatid),getRealescape($_POST['txtknowledgecentertitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txtknowledgecenterdate']),getRealescape($_POST['txtknowledgecenterdescription'.$languageval['languagefield']]),$bannerimg,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$knowledgecentercode,$sortingOrder));
					//echo "<br>";
					
				//	echo "desc".$_POST['txtknowledgecenterdescription'.$languageval['languagefield']];
					
					//$rslt = $db->insert_bind($str,array(getRealescape($knowcatid),getRealescape($_POST['txtknowledgecentertitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txtknowledgecenterdate']),getRealescape($_POST['txtknowledgecenterdescription'.$languageval['languagefield']]),$bannerimg,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$knowledgecentercode,$sortingOrder));	
					//print_r($db); exit;
				 $lastInserId = $db->insert_id;
				 
						if($languageval['languageid'] == 1){
							$parentidval = $lastInserId;
							$lastinsert = $lastInserId;
						}
						
						if($languageval['languageid'] == 2){
							$lastinsertes = $lastInserId;
						}
						
						if($languageval['languageid'] == 3){
							$lastinsertpt = $lastInserId;
						}
					
			}
			
			
			#################### Pdf file - english #######################
			//echo "max".$option_max_count;
			 for($i=0;$i<=$option_max_count;$i++) {		
			
					  $qtitle=$_POST['qtitle'.$i];	
 						if($qtitle!='') {
							 
							$pdfimages = $_FILES['q1pdffile'.$i]['name'];
							
							$pdfimagename = time().rand(0,9).$pdfimages;
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
					 
					 		 move_uploaded_file($_FILES['q1pdffile'.$i]["tmp_name"], $target_file);
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$qtitle."','".$pdfimagename."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
				 
			
				 
				 #################### Pdf file - spanish #######################
			 for($i=0;$i<=$option_max_count_es;$i++) {				
					  $qtitle=$_POST['qtitle_es'.$i];	
 						if($qtitle!='') {
							 
							$pdfimages = $_FILES['q1pdffile_es'.$i]['name'];
							$pdfimagename = time().rand(0,9).$pdfimages;
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
					 
					 		 move_uploaded_file($_FILES['q1pdffile_es'.$i]["tmp_name"], $target_file);
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$qtitle."','".$pdfimagename."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
				 
				  #################### Pdf file - portugueses #######################
				   
			 for($i=0;$i<=$option_max_count_pt;$i++) {				
					  $qtitle=$_POST['qtitle_pt'.$i];	
 						if($qtitle!='') {
							 
							$pdfimages = $_FILES['q1pdffile_pt'.$i]['name'];
							$pdfimagename = time().rand(0,9).$pdfimages;
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
					 
					 		 move_uploaded_file($_FILES['q1pdffile_pt'.$i]["tmp_name"], $target_file);
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$qtitle."','".$pdfimagename."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
			######################## pdf file #############
				 
				 
				 
				 #################### url - english #######################
				//echo "option_max_count_url".$option_max_count_url;
			 for($i=0;$i<=$option_max_count_url;$i++) {				
					  $urltitle=$_POST['urltitle'.$i];	
					  $urllink = $_POST['urllink'.$i];
					  
 						if($urltitle!='') {
  
    $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### url - spanish #######################
			 for($i=0;$i<=$option_max_count_url_es;$i++) {				
					  $urltitle=$_POST['urltitle_es'.$i];	
					  $urllink = $_POST['urllink_es'.$i];
					  
 						if($urltitle!='') {
  
     $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### url - portuguese #######################
			 for($i=0;$i<=$option_max_count_url_pt;$i++) {				
					  $urltitle=$_POST['urltitle_pt'.$i];	
					  $urllink = $_POST['urllink_pt'.$i];
					  
 						if($urltitle!='') {
  
   $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### video - english #######################
				  //echo "video".$option_max_count_video;
			 for($i=0;$i<=$option_max_count_video;$i++) {				
					  $videotitle=$_POST['videotitle'.$i];	
					  $videolink = $_POST['videolink'.$i];
					  
 						if($videotitle!='') {
  
    $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
						}
				 }
				 
				  #################### video - spanish #######################
			  for($i=0;$i<=$option_max_count_video_es;$i++) {				
					  $videotitle=$_POST['videotitle_es'.$i];	
					  $videolink = $_POST['videolink_es'.$i];
					  
 						if($videotitle!='') {
  
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
						}
				 }
				 
				 
				  #################### video - portuguese #######################
			  for($i=0;$i<=$option_max_count_video_pt;$i++) {				
					  $videotitle=$_POST['videotitle_pt'.$i];	
					  $videolink = $_POST['videolink_pt'.$i];
					  
 						if($videotitle!='') {
  
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
						}
				 }
			
			$log = $db->insert_log("insert"," ".TPLPrefix."knowledgecenter","","knowledgecenter Added Newly","knowledgecenter",$str);
			
			//echo json_encode(array("rslt"=>$rslt)); //success
			echo json_encode(array("rslt"=>"1")); //success
	/*	}
		else {
			 echo json_encode(array("rslt"=>"3")); //same exists
		}*/
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	
	case 'update':	 	
	if(!empty($txtknowledgecentertitle) ) {
		$strChk = "select count(knowledgecenterid) from ".TPLPrefix."knowledgecenter where knowledgecentertitle = ? and IsActive != ? and knowledgecenterid != ? and lang_id = 1 ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtknowledgecentertitle,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
		    
		   $update_sql='';
			
			
			
					if(isset($_FILES["knowledgecenterimage"])){
			
			
				
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){

						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["knowledgecenterimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $bannerimg=str_replace(' ','_',$_FILES['knowledgecenterimage']['name']);
					  $bannerimg=time().rand(0,9).$bannerimg;	
					  $target_file = '../uploads/knowledgecenter/'.$bannerimg;
					 
					  move_uploaded_file($_FILES["knowledgecenterimage"]["tmp_name"], $target_file);
					  $update_sql.= " ,knowledgecenterimage='".getRealescape($bannerimg)."'";
						//image upload path - ends	
					}else{
 						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				
				
				 
				$getcategory = $db->get_a_line("select categoryid from `".TPLPrefix."knowledgecenter_master_category` where parentid = '".$_POST['categoryid']."' and lang_id = '".$languageval['languageid']."' and IsActive = 1 ");
				$knowcatidother = $getcategory['categoryid'];
				 
					$knowcatid =$_POST['categoryid'];
				 
			 
				
                 $str = "update ".TPLPrefix."knowledgecenter set sortingOrder='".$sortingOrder."',categoryid = '".$knowcatid."',knowledgecentertitle = '".getRealescape($txtknowledgecentertitle)."' , knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription = '".getRealescape($txtknowledgecenterdescription)."',  IsActive = '".$status."' , modifiedDate = '".$today."' , UserId = '".$_SESSION["UserId"]."',sortingOrder='".$txtSortingorder."' ".$update_sql." where knowledgecenterid = '".$edit_id."' "; 
                $db->insert_log("update"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter updated","knowledgecenter",$str);
                $db->insert($str);

			
$str_es = "update ".TPLPrefix."knowledgecenter set sortingOrder='".$sortingOrder."',categoryid = '".$knowcatidother."' ,knowledgecentertitle = '".getRealescape($txtknowledgecentertitle_es)."', knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription ='".getRealescape($txtknowledgecenterdescription_es)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',sortingOrder='".$txtSortingorder."' ".$update_sql." where parent_id = '".$edit_id."' and lang_id = 2 ";
//$rslt_es = $db->insert_bind($str_es,array(getRealescape($txtknowledgecentertitle_es),getdateFormat($db,$txtknowledgecenterdate),getRealescape($txtknowledgecenterdescription_es),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_es);
			
//print_r($db); exit;
			
$str_pt = "update ".TPLPrefix."knowledgecenter set sortingOrder='".$sortingOrder."',categoryid = '".$knowcatidother."' ,knowledgecentertitle = '".getRealescape($txtknowledgecentertitle_pt)."', knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription ='".getRealescape($txtknowledgecenterdescription_pt)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',sortingOrder='".$txtSortingorder."' ".$update_sql." where parent_id = '".$edit_id."'   and lang_id = 3";
//$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txtknowledgecentertitle_pt),getdateFormat($db,$txtknowledgecenterdate),getRealescape($txtknowledgecenterdescription_pt),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_pt);

$lastinsert = $edit_id;
$lastinsertes = $edit_id_es;
$lastinsertpt = $edit_id_pt;



#################### Pdf file - english #######################
			//echo "max".$option_max_count;
			 for($i=0;$i<=$option_max_count;$i++) {		
			
					  $qtitle=$_POST['qtitle'.$i];	
					  $pdf_option_edit_id = $_POST['option_edit_id'.$i];
					  
 						if($qtitle!='') {
							$pdfimages = $_FILES['q1pdffile'.$i]['name'];
							$pdfimagename = time().rand(0,9).$pdfimages;
							$target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
							 move_uploaded_file($_FILES['q1pdffile'.$i]["tmp_name"], $target_file);
							 if($pdfimages != ''){$joinq = " , `pdffile`='".$pdfimagename."'";}
							 
							 if($pdf_option_edit_id != ''){
								$pdfQurey = "update ".TPLPrefix."knowledgecenter_pdf set `pdftitle` = '".$qtitle."', `Modifieddate` = '".date('Y-m-d H:i:s')."' ".$joinq." where pdfid = '".$pdf_option_edit_id."' ";
								 	
								$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_pdf",$pdf_option_edit_id,"PDF Added Newly","PDF",$pdfQurey);
								$insertpdfQurey = $db->insert($pdfQurey);
								 
							 }else{
							
									  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$qtitle."','".$pdfimages."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
							 }
						}
				 }
				 
			
				 
				 #################### Pdf file - spanish #######################
			 for($i=0;$i<=$option_max_count_es;$i++) {				
					  $qtitle=$_POST['qtitle_es'.$i];	
					  $option_edit_id_es = $_POST['option_edit_id_es'.$i];
					
 						if($qtitle!='') {
							 
							$pdfimages = $_FILES['q1pdffile_es'.$i]['name'];
							  $pdfimagename = time().rand(0,9).$pdfimages;
							
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
					  if($pdfimages != ''){$joinq = " , `pdffile`='".$pdfimagename."'";}
					 		 move_uploaded_file($_FILES['q1pdffile_es'.$i]["tmp_name"], $target_file);
							  if($option_edit_id_es != ''){
								  $pdfQurey = "update ".TPLPrefix."knowledgecenter_pdf set `pdftitle` = '".$qtitle."', `Modifieddate` = '".date('Y-m-d H:i:s')."' ".$joinq." where pdfid = '".$option_edit_id_es."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_pdf",$option_edit_id_es,"PDF Added Newly","PDF",$pdfQurey);
									$insertpdfQurey = $db->insert($pdfQurey);
								 
							 }else{
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$qtitle."','".$pdfimages."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
							 }
						}
				 }
				 
				  #################### Pdf file - portugueses #######################
				   
			 for($i=0;$i<=$option_max_count_pt;$i++) {				
					  $qtitle=$_POST['qtitle_pt'.$i];	
					    $option_edit_id_pt = $_POST['option_edit_id_pt'.$i];
 						if($qtitle!='') {
							 
							$pdfimages = $_FILES['q1pdffile_pt'.$i]['name'];
							$pdfimagename = time().rand(0,9).$pdfimages;
							
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimagename;
					 
					 if($pdfimages != ''){$joinq = " , `pdffile`='".$pdfimagename."'";}
					 
					 		 move_uploaded_file($_FILES['q1pdffile_pt'.$i]["tmp_name"], $target_file);
							 if($option_edit_id_pt != ''){
								  $pdfQurey = "update ".TPLPrefix."knowledgecenter_pdf set `pdftitle` = '".$qtitle."', `Modifieddate` = '".date('Y-m-d H:i:s')."' ".$joinq." where pdfid = '".$option_edit_id_pt."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_pdf",$option_edit_id_pt,"PDF Added Newly","PDF",$pdfQurey);
									$insertpdfQurey = $db->insert($pdfQurey);
								 
							 }else{
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$qtitle."','".$pdfimages."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
							 }
						}
				 }
			######################## pdf file #############
				 
				 
				 
				 #################### url - english #######################
				//echo "option_max_count_url".$option_max_count_url;
			 for($i=0;$i<=$option_max_count_url;$i++) {				
					  $urltitle=$_POST['urltitle'.$i];	
					  $urllink = $_POST['urllink'.$i];
					   $url_option_edit_id = $_POST['url_option_edit_id'.$i];
					  
 						if($urltitle!='') {
							
							 if($url_option_edit_id != ''){
								  $urlQurey = "update ".TPLPrefix."knowledgecenter_url set `urltitle` = '".$urltitle."', `urllink`='".$urllink ."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where urlid = '".$url_option_edit_id."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_url",$url_option_edit_id,"URL Added Newly","URL",$urlQurey);
									 
								  $insertvideoQurey = $db->insert($urlQurey);
							 }else{
  
    $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
							 }
						}
				 }
				 
				  #################### url - spanish #######################
			 for($i=0;$i<=$option_max_count_url_es;$i++) {				
					  $urltitle=$_POST['urltitle_es'.$i];	
					  $urllink = $_POST['urllink_es'.$i];
					  $url_option_edit_id_es = $_POST['url_option_edit_id_es'.$i];
					  
 						if($urltitle!='') {
							
							 if($url_option_edit_id_es != ''){
								  $urlQurey = "update ".TPLPrefix."knowledgecenter_url set `urltitle` = '".$urltitle."', `urllink`='".$urllink ."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where urlid = '".$url_option_edit_id_es."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_url",$url_option_edit_id_es,"URL Added Newly","URL",$urlQurey);
									 $insertvideoQurey = $db->insert($urlQurey); 
								 
							 }else{
  
   $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
							 }
						}
				 }
				 
				  #################### url - portuguese #######################
			 for($i=0;$i<=$option_max_count_url_pt;$i++) {				
					  $urltitle=$_POST['urltitle_pt'.$i];	
					  $urllink = $_POST['urllink_pt'.$i];
					   $url_option_edit_id_pt = $_POST['url_option_edit_id_pt'.$i];
					  
 						if($urltitle!='') {
  
   if($url_option_edit_id_pt != ''){
								  $urlQurey = "update ".TPLPrefix."knowledgecenter_url set `urltitle` = '".$urltitle."', `urllink`='".$urllink ."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where urlid = '".$url_option_edit_id_es."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_url",$url_option_edit_id_pt,"URL Added Newly","URL",$urlQurey);
									  $insertvideoQurey = $db->insert($urlQurey);
								 
							 }else{
   $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
							 }
						}
				 }
				 
				  #################### video - english #######################
				  //echo "video".$option_max_count_video;
			 for($i=0;$i<=$option_max_count_video;$i++) {				
					  $videotitle=$_POST['videotitle'.$i];	
					  $videolink = $_POST['videolink'.$i];
					   $video_option_edit_id = $_POST['video_option_edit_id'.$i];
					  
 						if($videotitle!='') {
  
    if($video_option_edit_id != ''){
								    $urlQurey = "update ".TPLPrefix."knowledgecenter_video set `videotitle` = '".$videotitle."', `videolink`='".$videolink."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where videoid = '".$video_option_edit_id."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_video",$video_option_edit_id,"knowledgecenter_video Added Newly","knowledgecenter_video",$urlQurey);
									 
									  $insertvideoQurey = $db->insert($urlQurey);
								 
							 }else{
    $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."',1,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
							 }
						}
				 }
				 
				  #################### video - spanish #######################
			  for($i=0;$i<=$option_max_count_video_es;$i++) {				
					  $videotitle=$_POST['videotitle_es'.$i];	
					  $videolink = $_POST['videolink_es'.$i];
					   $video_option_edit_id_es = $_POST['video_option_edit_id_es'.$i];
					  
 						if($videotitle!='') {
							if($video_option_edit_id_es != ''){
								  $urlQurey = "update ".TPLPrefix."knowledgecenter_video set `videotitle` = '".$videotitle."', `videolink`='".$videolink ."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where videoid = '".$video_option_edit_id_es."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_video",$video_option_edit_id_es,"knowledgecenter_video Added Newly","knowledgecenter_video",$urlQurey);
									  $insertvideoQurey = $db->insert($urlQurey);
								 
							 }else{
  
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."',2,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);}
						}
				 }
				 
				 
				  #################### video - portuguese #######################
			  for($i=0;$i<=$option_max_count_video_pt;$i++) {				
					  $videotitle=$_POST['videotitle_pt'.$i];	
					  $videolink = $_POST['videolink_pt'.$i];
					  $video_option_edit_id_pt = $_POST['video_option_edit_id_pt'.$i];
 						if($videotitle!='') {
  
  	if($video_option_edit_id_pt != ''){
								   $videoQurey = "update ".TPLPrefix."knowledgecenter_video set `videotitle` = '".$videotitle."', `videolink`='".$videolink ."', `Modifieddate` = '".date('Y-m-d H:i:s')."' where videoid = '".$video_option_edit_id_pt."' ";
								 	
									$log = $db->insert_log("update","".TPLPrefix."knowledgecenter_video",$video_option_edit_id_pt,"knowledgecenter_video Added Newly","knowledgecenter_video",$urlQurey);
									 $insertvideoQurey = $db->insert($videoQurey);
								 
							 }else{
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."',3,'".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
							 }
						}
				 }

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
	  $str="update ".TPLPrefix."knowledgecenter set IsActive = ?, modifiedDate = ? , UserId=?  where knowledgecenterid = ? ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter deleted","knowledgecenter",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id)); 	 
	  
	  $str1=$db->insert("update ".TPLPrefix."knowledgecenter set IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' ");
			  $db->insert($str1); 
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		 		
			$str="update ".TPLPrefix."knowledgecenter set IsActive = ?, modifiedDate = ? , UserId=?  where knowledgecenterid = ? ";
			
			 $db->insert_log("update"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter Statuschanged","knowledgecenter",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 
			
			
			$str1=$db->insert("update ".TPLPrefix."knowledgecenter set IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."'  where parent_id = '".$edit_id."' ");
			  $db->insert($str1); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		 
			
	
	break;
	
	case 'remove_row_video':
	 $str="update ".TPLPrefix."knowledgecenter_video set IsActive = 2 where videoid = '".$videoid."'";
	 $db->insert_log("video","knowledgecenter_video",$videoid,"knowledgecenter_video Image delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
	
	case 'remove_row_pdf':
	 $str="update ".TPLPrefix."knowledgecenter_pdf set IsActive = 2 where pdfid = '".$pdfid."'";
	 $db->insert_log("pdf","knowledgecenter_pdf",$videoid,"knowledgecenter pdf delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
	
	 case 'remove_row_url':
	 $str="update ".TPLPrefix."knowledgecenter_url set IsActive = 2 where urlid = '".$urlid."'";
	 $db->insert_log("pdf","knowledgecenter_url",$videoid,"knowledgecenter url delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
}



?>