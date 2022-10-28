 <?php 
include 'session.php';
extract($_REQUEST);
$act=$action;
include 'includes/image_thumb.php';
if($chkstatus !=null)
	$status =1;
else
	$status =0;
$today=date("Y-m-d H:i:s");
$getlanguage = getLanguages($db);

$getsize = getimagesize_large($db,'news','large');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
list($width, $height, $type, $attr) = getimagesize($_FILES["newsimage"]['tmp_name']);
switch($act)
{
	case 'insert':
	if(!empty($txtnewstitle) ) {
		$strChk = "select count(newsid) from ".TPLPrefix."news where newstitle = ? and IsActive != ? ";		
 		$reslt = $db->get_a_line_bind($strChk,array($txtnewstitle,2));
		if($reslt[0] == 0) {
		    
		    $newsimage='';
				/*if(isset($_FILES["newsimage"])){
				
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["newsimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $newsimage=str_replace(' ','_',$_FILES['newsimage']['name']);
					  $newsimage=time().rand(0,9).$newsimage;	
					  $target_file = '../uploads/news/'.$newsimage;
					 
					  move_uploaded_file($_FILES["newsimage"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}*/
				
				if(isset($_FILES["newsimage"])){
				    if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
				        
                            //validate image file allowed (jpg,png,gif)
                            $file_info = getimagesize($_FILES["newsimage"]['tmp_name']);
                            $file_mime = explode('/',$file_info['mime']);				
                            if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
                            echo json_encode(array("rslt"=>"7"));
                            exit();
                            }	
                            
                            $exten  =$_FILES["newsimage"]["type"];
                            $obj=new Gthumb();	
                            
                            $newsimage =	$obj->resize_image($sizes,'news',$exten,$_FILES['newsimage']);
				    
				        
				    }else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				
				
				
			}
			
				$parentidval = 0;
				foreach($getlanguage as $languageval){
					
						
				$newscode = clean(trim($_POST['txtnewstitle'.$languageval['languagefield']]));
$newscode =urlencode(strtolower($newscode));


			$str="insert into ".TPLPrefix."news(newstitle,newsdate,newsdescription,newsurl,newsvideourl,newsimage,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id,newscode) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtnewstitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txtnewsdate']),getRealescape($_POST['txtnewsdescription'.$languageval['languagefield']]),getRealescape($_POST['txtnewsurl']),getRealescape($_POST['txtnewsvideourl']),$newsimage,$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$newscode));	
			//print_r($db); exit;
		 
			if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
			
			}
			
			$log = $db->insert_log("insert"," ".TPLPrefix."news","","News Added Newly","news",$str);
			
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
	if(!empty($txtnewstitle) ) {
		$strChk = "select count(newsid) from ".TPLPrefix."news where newstitle = ? and IsActive != ? and newsid != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtnewstitle,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
		    
		   $update_sql='';
			/*	if(isset($_FILES["newsimage"])){
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["newsimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname=str_replace(' ','_',$_FILES['newsimage']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/news/'.$imgname;
					 
					  move_uploaded_file($_FILES["newsimage"]["tmp_name"], $target_file);
						$update_sql.= " ,newsimage='".getRealescape($imgname)."'";
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}*/
				
				if(isset($_FILES["newsimage"])){
				    if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
				        
                        //validate image file allowed (jpg,png,gif)
                        $file_info = getimagesize($_FILES["newsimage"]['tmp_name']);
                        $file_mime = explode('/',$file_info['mime']);				
                        if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
                        echo json_encode(array("rslt"=>"7"));
                        exit();
                        }	
                        
                        $exten  =$_FILES["newsimage"]["type"];
                        $obj=new Gthumb();	
                        
                        $path =	$obj->resize_image($sizes,'news',$exten,$_FILES['newsimage']);
                        
                        $update_sql.= " ,newsimage='".getRealescape($path)."'";
				        
				        
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}
				        
				
			}
			
						
				$newscode = clean(trim($txtnewstitle));
$newscode =urlencode(strtolower($newscode));

				
                $str = "update ".TPLPrefix."news set newsurl='".getRealescape($txtnewsurl)."',newsvideourl='".getRealescape($txtnewsvideourl)."',newstitle = '".getRealescape($txtnewstitle)."' , newsdate = '".getdateFormat($db,$txtnewsdate)."' , newsdescription = '".getRealescape($txtnewsdescription)."',  IsActive = '".$status."' , modifiedDate = '".$today."' , UserId = '".$_SESSION["UserId"]."',newscode='".$newscode."' ".$update_sql." where newsid = '".$edit_id."' "; 
                $db->insert_log("update"," ".TPLPrefix."news",$edit_id,"News updated","news",$str);
                $db->insert($str);


				$newscode_es = clean(trim($txtnewstitle_es));
$newscode_es =urlencode(strtolower($newscode_es));

			
$str_es = "update ".TPLPrefix."news set newsurl='".getRealescape($txtnewsurl)."',newsvideourl='".getRealescape($txtnewsvideourl)."',newstitle = '".getRealescape($txtnewstitle_es)."', newsdate = '".getdateFormat($db,$txtnewsdate)."' , newsdescription ='".getRealescape($txtnewsdescription_es)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',newscode='".$newscode_es."' ".$update_sql." where parent_id = '".$edit_id."' and lang_id = 2 ";
//$rslt_es = $db->insert_bind($str_es,array(getRealescape($txtnewstitle_es),getdateFormat($db,$txtnewsdate),getRealescape($txtnewsdescription_es),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_es);
			
//print_r($db); exit;

$newscode_pt = clean(trim($txtnewstitle_pt));
$newscode_pt =urlencode(strtolower($newscode_pt));
			
$str_pt = "update ".TPLPrefix."news set newsurl='".getRealescape($txtnewsurl)."',newsvideourl='".getRealescape($txtnewsvideourl)."',newstitle = '".getRealescape($txtnewstitle_pt)."', newsdate = '".getdateFormat($db,$txtnewsdate)."' , newsdescription ='".getRealescape($txtnewsdescription_pt)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',newscode='".$newscode_pt."' ".$update_sql." where parent_id = '".$edit_id."'   and lang_id = 3";
//$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txtnewstitle_pt),getdateFormat($db,$txtnewsdate),getRealescape($txtnewsdescription_pt),$status,$today,$_SESSION["UserId"],$edit_id));
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
	  $str="update ".TPLPrefix."news set IsActive = ?, modifiedDate = ? , UserId=?  where newsid = ? and newsid NOT IN(?) ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."news",$edit_id,"News deleted","news",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id,1)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" ){			
			$str="update ".TPLPrefix."news set IsActive = ?, modifiedDate = ? , UserId=?  where newsid = ? and newsid NOT IN(?) ";
			
			 $db->insert_log("update"," ".TPLPrefix."news",$edit_id,"news Statuschanged","news",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id,1)); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
	
	case 'SingledeleteImg':
	 $str="update tri_news set newsimage = '' where newsid = '".$edit_id."'";
	 $db->insert_log("image","tri_news",$edit_id,"News Image delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
	
	case 'moreimage':
	    
		$a = 1;				
		for($i=0;$i<count($_FILES["newsimage"]["name"]);$i++){	
			if( $_FILES["newsimage"]["name"][$i] != ''){	
				 $_FILES["newsimage"]["name"][$i]."<br>";
				 $extension  =$_FILES["newsimage"]["type"][$i];				
				 $obj=new Gthumb();	
				 $path = $obj->resize_image_bulk($sizes,'news',$extension,$_FILES['newsimage'],$i);
						if($path != ''){
							$str = "INSERT INTO kr_newsimage(newsid,imgname,imgorder,IsActive,CreatedDate) values	('".$edit_id."','".$path."','".$a."',1,'".$created."') ";
							 
							$rslt = $db->insert($str);			
							$log = $db->insert_log("insert","kr_newsimage","","News Image Added Newly","news",$str);
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
			$getimg = $db->get_a_line("select * from kr_newsimage where newsimgid='".$_REQUEST['image'.$i.'id']."'");
			$getsiz = $db->get_rsltset("select  foldername from kr_imageconfig where IsActive = 1 and imageconfigModule = 'news'");
		
			foreach($getsiz as $sizval) {
 				unlink("../uploads/news/".$sizval['foldername']."/".$getimg['imgname']); 
				unlink("../uploads/news/".$getimg['imgname']); 
			}
			
			$sql1= " imgname='',";
			$log = $db->insert_log("deleted","kr_newsimage","","News Image deleted","news",$str);
 			$db->query("delete from kr_newsimage where newsimgid='".$_REQUEST['image'.$i.'id']."'");
		}
		else
		{
			$sql1 = " imgname='".$_REQUEST['productim'.$i]."',";
 			if($_REQUEST['status'.$i] == '')
			$statuss = '0';
			else
			$statuss = $_REQUEST['status'.$i];
  								 
 			$str1=$db->insert("update  kr_newsimage set imgorder='".$_REQUEST['image1order'.$i]."',$sql1 IsActive='".$statuss."' where newsimgid='".$_REQUEST['image'.$i.'id']."'");
		}
	 }
					
		$log = $db->insert_log("insert","kr_newsimage","","Updated","newsimage",$str);
 		echo json_encode(array("rslt"=>"2")); //success
	break;	
}



?>