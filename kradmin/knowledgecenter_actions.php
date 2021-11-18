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
 
$getsize = getimagesize_large($db,'knowledgecenter','large');
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
                            if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
                            echo json_encode(array("rslt"=>"7"));
                            exit();
                            }	
                            
                            $exten  =$_FILES["knowledgecenterimage"]["type"];
                            $obj=new Gthumb();	
                            
                            $knowledgecenterimage =	$obj->resize_image($sizes,'knowledgecenter',$exten,$_FILES['knowledgecenterimage']);
				    
				        
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
					$knowledgecentercode = cleanurl($_POST['txtknowledgecentertitle'.$languageval['languagefield']]);
					  $str="insert into ".TPLPrefix."knowledgecenter(knowledgecentertitle,knowledgecenterdate,knowledgecenterdescription,knowledgecenterimage,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id,knowledgecentercode) values(?,?,?,?,?,?,?,?,?,?,?)";
					
					//echo implode('"',array(getRealescape($_POST['txtknowledgecentertitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txtknowledgecenterdate']),getRealescape($_POST['txtknowledgecenterdescription'.$languageval['languagefield']]),$knowledgecenterimage,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$knowledgecentercode));
					//echo "<br>";
					
					$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtknowledgecentertitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txtknowledgecenterdate']),getRealescape($_POST['txtknowledgecenterdescription'.$languageval['languagefield']]),$knowledgecenterimage,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$knowledgecentercode));	
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
			 for($i=0;$i<=$option_max_count;$i++) {				
					  $qtitle=$_POST['qtitle'.$i];	
 						if($qtitle!='') {
							 
							$pdfimage = $_FILES['q1pdffile'.$i]['name'];
							
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimage;
					 
					 		 move_uploaded_file($_FILES['q1pdffile'.$i]["tmp_name"], $target_file);
					  
						echo	 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."','".$qtitle."','".$pdfimages."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
				 
			
				 
				 #################### Pdf file - spanish #######################
			 for($i=0;$i<=$option_max_count_es;$i++) {				
					  $qtitle=$_POST['qtitle_es'.$i];	
 						if($qtitle!='') {
							 
							$pdfimage = $_FILES['q1pdffile_es'.$i]['name'];
							
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimage;
					 
					 		 move_uploaded_file($_FILES['q1pdffile_es'.$i]["tmp_name"], $target_file);
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."','".$qtitle."','".$pdfimages."',2,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
				 
				  #################### Pdf file - portugueses #######################
			 for($i=0;$i<=$option_max_count_pt;$i++) {				
					  $qtitle=$_POST['qtitle_pt'.$i];	
 						if($qtitle!='') {
							 
							$pdfimage = $_FILES['q1pdffile_pt'.$i]['name'];
							
							 $target_file = '../uploads/knowledgecenter/pdf/'.$pdfimage;
					 
					 		 move_uploaded_file($_FILES['q1pdffile_pt'.$i]["tmp_name"], $target_file);
					  
							 $pdfQurey = "insert into ".TPLPrefix."knowledgecenter_pdf (`knowledgecenterid`, `lang_id`, `pdftitle`, `pdffile`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."','".$qtitle."','".$pdfimages."',3,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($pdfQurey);
							$pdfinsertid = $db->insert_id; 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_pdf",$pdfinsertid,"PDF Added Newly","PDF",$pdfQurey);
						}
				 }
			######################## pdf file #############
				 
				 
				 
				 #################### url - english #######################
			 for($i=0;$i<=$option_max_count_url;$i++) {				
					  $urltitle=$_POST['urltitle'.$i];	
					  $urllink = $_POST['urllink'.$i];
					  
 						if($urltitle!='') {
  
  echo $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."','".$urltitle."','".$urllink."',1,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### url - spanish #######################
			 for($i=0;$i<=$option_max_count_url_es;$i++) {				
					  $urltitle=$_POST['urltitle_es'.$i];	
					  $urllink = $_POST['urllink_es'.$i];
					  
 						if($urltitle!='') {
  
   $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."','".$urltitle."','".$urllink."',2,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### url - portuguese #######################
			 for($i=0;$i<=$option_max_count_url_pt;$i++) {				
					  $urltitle=$_POST['urltitle_pt'.$i];	
					  $urllink = $_POST['urllink_pt'.$i];
					  
 						if($urltitle!='') {
  
   $urlQurey = "insert into ".TPLPrefix."knowledgecenter_url (`knowledgecenterid`, `lang_id`, `urltitle`, `urllink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."','".$urltitle."','".$urllink."',3,'".$created."','".$created."')";	
							$insertpdfQurey = $db->insert($urlQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_url",$pdfinsertid,"URL Added Newly","URL",$urlQurey);
						}
				 }
				 
				  #################### video - english #######################
			 for($i=0;$i<=$option_max_count_video;$i++) {				
					  $videotitle=$_POST['videotitle'.$i];	
					  $videolink = $_POST['videolink'.$i];
					  
 						if($videotitle!='') {
  
 echo  $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsert."','".$videotitle."','".$videolink."',1,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
						}
				 }
				 
				  #################### video - spanish #######################
			  for($i=0;$i<=$option_max_count_video_es;$i++) {				
					  $videotitle=$_POST['videotitle_es'.$i];	
					  $videolink = $_POST['videolink_es'.$i];
					  
 						if($videotitle!='') {
  
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertes."','".$videotitle."','".$videolink."',2,'".$created."','".$created."')";	
							$insertvideoQurey = $db->insert($videoQurey);
							 
							$log = $db->insert_log("insert","".TPLPrefix."knowledgecenter_video",$pdfinsertid,"knowledgecenter_video Added Newly","knowledgecenter_video",$videoQurey);
						}
				 }
				 
				 
				  #################### video - portuguese #######################
			  for($i=0;$i<=$option_max_count_video_pt;$i++) {				
					  $videotitle=$_POST['videotitle_pt'.$i];	
					  $videolink = $_POST['videolink_pt'.$i];
					  
 						if($videotitle!='') {
  
   $videoQurey = "insert into ".TPLPrefix."knowledgecenter_video (`knowledgecenterid`, `lang_id`, `videotitle`, `videolink`, `IsActive`, `Createddate`, `Modifieddate`) VALUES ('".$lastinsertpt."','".$videotitle."','".$videolink."',3,'".$created."','".$created."')";	
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
		$strChk = "select count(knowledgecenterid) from ".TPLPrefix."knowledgecenter where knowledgecentertitle = ? and IsActive != ? and knowledgecenterid != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtknowledgecentertitle,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
		    
		   $update_sql='';
			/*	if(isset($_FILES["knowledgecenterimage"])){
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["knowledgecenterimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname=str_replace(' ','_',$_FILES['knowledgecenterimage']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/knowledgecenter/'.$imgname;
					 
					  move_uploaded_file($_FILES["knowledgecenterimage"]["tmp_name"], $target_file);
						$update_sql.= " ,knowledgecenterimage='".getRealescape($imgname)."'";
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}*/
				
				if(isset($_FILES["knowledgecenterimage"])){
				    if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
				        
                        //validate image file allowed (jpg,png,gif)
                        $file_info = getimagesize($_FILES["knowledgecenterimage"]['tmp_name']);
                        $file_mime = explode('/',$file_info['mime']);				
                        if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
                        echo json_encode(array("rslt"=>"7"));
                        exit();
                        }	
                        
                        $exten  =$_FILES["knowledgecenterimage"]["type"];
                        $obj=new Gthumb();	
                        
                        $path =	$obj->resize_image($sizes,'knowledgecenter',$exten,$_FILES['knowledgecenterimage']);
                        
                        $update_sql.= " ,knowledgecenterimage='".getRealescape($path)."'";
				        
				        
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}
				        
				
			}
				
                $str = "update ".TPLPrefix."knowledgecenter set knowledgecenterurl='".getRealescape($txtknowledgecenterurl)."',knowledgecentervideourl='".getRealescape($txtknowledgecentervideourl)."',knowledgecentertitle = '".getRealescape($txtknowledgecentertitle)."' , knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription = '".getRealescape($txtknowledgecenterdescription)."',  IsActive = '".$status."' , modifiedDate = '".$today."' , UserId = '".$_SESSION["UserId"]."' ".$update_sql." where knowledgecenterid = '".$edit_id."' "; 
                $db->insert_log("update"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter updated","knowledgecenter",$str);
                $db->insert($str);

			
$str_es = "update ".TPLPrefix."knowledgecenter set knowledgecenterurl='".getRealescape($txtknowledgecenterurl)."',knowledgecentervideourl='".getRealescape($txtknowledgecentervideourl)."',knowledgecentertitle = '".getRealescape($txtknowledgecentertitle_es)."', knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription ='".getRealescape($txtknowledgecenterdescription_es)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."' ".$update_sql." where parent_id = '".$edit_id."' and lang_id = 2 ";
//$rslt_es = $db->insert_bind($str_es,array(getRealescape($txtknowledgecentertitle_es),getdateFormat($db,$txtknowledgecenterdate),getRealescape($txtknowledgecenterdescription_es),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_es);
			
//print_r($db); exit;
			
$str_pt = "update ".TPLPrefix."knowledgecenter set knowledgecenterurl='".getRealescape($txtknowledgecenterurl)."',knowledgecentervideourl='".getRealescape($txtknowledgecentervideourl)."',knowledgecentertitle = '".getRealescape($txtknowledgecentertitle_pt)."', knowledgecenterdate = '".getdateFormat($db,$txtknowledgecenterdate)."' , knowledgecenterdescription ='".getRealescape($txtknowledgecenterdescription_pt)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."' ".$update_sql." where parent_id = '".$edit_id."'   and lang_id = 3";
//$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txtknowledgecentertitle_pt),getdateFormat($db,$txtknowledgecenterdate),getRealescape($txtknowledgecenterdescription_pt),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_pt);


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
	  $str="update ".TPLPrefix."knowledgecenter set IsActive = ?, modifiedDate = ? , UserId=?  where knowledgecenterid = ? and knowledgecenterid NOT IN(?) ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter deleted","knowledgecenter",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id,1)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" ){			
			$str="update ".TPLPrefix."knowledgecenter set IsActive = ?, modifiedDate = ? , UserId=?  where knowledgecenterid = ? and knowledgecenterid NOT IN(?) ";
			
			 $db->insert_log("update"," ".TPLPrefix."knowledgecenter",$edit_id,"knowledgecenter Statuschanged","knowledgecenter",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id,1)); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
	
	case 'SingledeleteImg':
	 $str="update tri_knowledgecenter set knowledgecenterimage = '' where knowledgecenterid = '".$edit_id."'";
	 $db->insert_log("image","tri_knowledgecenter",$edit_id,"knowledgecenter Image delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
	
	case 'moreimage':
	    
		$a = 1;				
		for($i=0;$i<count($_FILES["knowledgecenterimage"]["name"]);$i++){	
			if( $_FILES["knowledgecenterimage"]["name"][$i] != ''){	
				 $_FILES["knowledgecenterimage"]["name"][$i]."<br>";
				 $extension  =$_FILES["knowledgecenterimage"]["type"][$i];				
				 $obj=new Gthumb();	
				 $path = $obj->resize_image_bulk($sizes,'knowledgecenter',$extension,$_FILES['knowledgecenterimage'],$i);
						if($path != ''){
							$str = "INSERT INTO kr_knowledgecenterimage(knowledgecenterid,imgname,imgorder,IsActive,CreatedDate) values	('".$edit_id."','".$path."','".$a."',1,'".$created."') ";
							 
							$rslt = $db->insert($str);			
							$log = $db->insert_log("insert","kr_knowledgecenterimage","","knowledgecenter Image Added Newly","knowledgecenter",$str);
						}
				}
			}
			echo json_encode(array("rslt"=>"1")); //success
	break;
	
	
	case "moreimageupdate":
 	 $var=explode(',',$productimgid);
	 foreach($var as $i)
	 {
		if($_REQUEST["imagestatus".$i]!=""){
			$getimg = $db->get_a_line("select * from kr_knowledgecenterimage where knowledgecenterimgid='".$_REQUEST['image'.$i.'id']."'");
			$getsiz = $db->get_rsltset("select  foldername from kr_imageconfig where IsActive = 1 and imageconfigModule = 'knowledgecenter'");
		
			foreach($getsiz as $sizval) {
 				unlink("../uploads/knowledgecenter/".$sizval['foldername']."/".$getimg['imgname']); 
				unlink("../uploads/knowledgecenter/".$getimg['imgname']); 
			}
			
			$sql1= " imgname='',";
			$log = $db->insert_log("deleted","kr_knowledgecenterimage","","knowledgecenter Image deleted","knowledgecenter",$str);
 			$db->query("delete from kr_knowledgecenterimage where knowledgecenterimgid='".$_REQUEST['image'.$i.'id']."'");
		}
		else
		{
			$sql1 = " imgname='".$_REQUEST['productim'.$i]."',";
 			if($_REQUEST['status'.$i] == '')
			$statuss = '0';
			else
			$statuss = $_REQUEST['status'.$i];
  								 
 			$str1=$db->insert("update  kr_knowledgecenterimage set imgorder='".$_REQUEST['image1order'.$i]."',$sql1 IsActive='".$statuss."' where knowledgecenterimgid='".$_REQUEST['image'.$i.'id']."'");
		}
	 }
					
		$log = $db->insert_log("insert","kr_knowledgecenterimage","","Updated","knowledgecenterimage",$str);
 		echo json_encode(array("rslt"=>"2")); //success
	break;	
}



?>