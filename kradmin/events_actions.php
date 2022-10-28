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

$getsize = getimagesize_large($db,'events','large');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
list($width, $height, $type, $attr) = getimagesize($_FILES["eventsimages"]['tmp_name']);

$getsize_es = getimagesize_large($db,'events','large');
$imageval_es = explode('-',$getsize_es);
$imgheight_es = $imageval_es[1];
$imgwidth_es = $imageval_es[0];
list($width_es, $height_es, $type_es, $attr_es) = getimagesize($_FILES["eventsimages_es"]['tmp_name']);


$getsize_pt = getimagesize_large($db,'events','large');
$imageval_pt = explode('-',$getsize_pt);
$imgheight_pt = $imageval_pt[1];
$imgwidth_pt = $imageval_pt[0];
list($width_pt, $height_pt, $type_pt, $attr_pt) = getimagesize($_FILES["eventsimages_pt"]['tmp_name']);

switch($act)
{
	case 'insert':
	if(!empty($txteventtitle) ) {
		$strChk = "select count(eventid) from ".TPLPrefix."events where eventtitle = ? and IsActive != ? ";		
 		$reslt = $db->get_a_line_bind($strChk,array($txteventtitle,2));
		if($reslt[0] == 0) {
		    
		    $eventsimages='';
				if(isset($_FILES["eventsimages"])){
				
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["eventsimages"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $eventsimages=str_replace(' ','_',$_FILES['eventsimages']['name']);
					  $eventsimages=time().rand(0,9).$eventsimages;	
					  $target_file = '../uploads/events/'.$eventsimages;
					 
					  move_uploaded_file($_FILES["eventsimages"]["tmp_name"], $target_file);
						//image upload path - ends	
					}else{
						$round1 = round($imgheight%$imgwidth);
						$round = round($imgheight/$imgwidth);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' size not matched'));  //no values
						exit();						
					}
				}
				if(isset($_FILES["eventsimages_es"])){
				
					if(($width_es >= $imgwidth_es && $height_es >= $imgheight_es) && $height_es == round($width_es * $imgheight_es / $imgwidth_es)){
						//validate image file allowed (jpg,png,gif)
						$file_info_es = getimagesize($_FILES["eventsimages_es"]['tmp_name']);
						$file_mime_es = explode('/',$file_info_es['mime']);				
						if(!in_array($file_mime_es[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $eventsimages_es=str_replace(' ','_',$_FILES['eventsimages_es']['name']);
					  $eventsimages_es=time().rand(0,9).$eventsimages_es;	
					  $target_file_es = '../uploads/events/'.$eventsimages_es;
					 
					  move_uploaded_file($_FILES["eventsimages_es"]["tmp_name"], $target_file_es);
						//image upload path - ends	
					}else{
						$round1_es = round($imgheight_es%$imgwidth_es);
						$round_es = round($imgheight_es/$imgwidth_es);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth_es.' & '.$imgheight_es.' size not matched'));  //no values
						exit();						
					}
				}
				if(isset($_FILES["eventsimages_pt"])){
				
					if(($width_pt >= $imgwidth_pt && $height_pt >= $imgheight_pt) && $height_pt == round($width_pt * $imgheight_pt / $imgwidth_pt)){
						//validate image file allowed (jpg,png,gif)
						$file_info_pt = getimagesize($_FILES["eventsimages_pt"]['tmp_name']);
						$file_mime_pt = explode('/',$file_info_pt['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $eventsimages_pt=str_replace(' ','_',$_FILES['eventsimages_pt']['name']);
					  $eventsimages_pt=time().rand(0,9).$eventsimages_pt;	
					  $target_file_pt = '../uploads/events/'.$eventsimages_pt;
					 
					  move_uploaded_file($_FILES["eventsimages_pt"]["tmp_name"], $target_file_pt);
						//image upload path - ends	
					}else{
						$round1_pt = round($imgheight_pt%$imgwidth_pt);
						$round_pt = round($imgheight_pt/$imgwidth_pt);
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth_pt.' & '.$imgheight_pt.' size not matched'));  //no values
						exit();						
					}
				}
			
				$parentidval = 0;
			foreach($getlanguage as $languageval){
				
				$eventcode = clean(trim($_POST['txteventtitle'.$languageval['languagefield']]));
$eventcode =urlencode(strtolower($eventcode));
			
			

			$str="insert into ".TPLPrefix."events(eventtitle,eventdate,eventdescription,eventurl,eventvideourl,eventimage,IsActive,UserId,createdDate,modifiedDate,parent_id,lang_id,eventcode) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txteventtitle'.$languageval['languagefield']]),getdateFormat($db,$_POST['txteventdate']),getRealescape($_POST['txteventdescription'.$languageval['languagefield']]),getRealescape($_POST['txteventurl']),getRealescape($_POST['txteventvideourl']),$eventsimages.$languageval['languagefield'],$status,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$eventcode));	
			//print_r($db); exit;
		 
			if($languageval['languageid'] == 1){
					$lastInserId = $db->insert_id;
					$parentidval = $lastInserId;
				}
                if($languageval['languageid'] == 2){
                    $str_es = "update ".TPLPrefix."events set eventimage='".getRealescape($eventsimages_es)."' where parent_id = '".$parentidval."' and lang_id = 2 ";
                    $db->insert($str_es);
                }
                
                if($languageval['languageid'] == 3){
                    $str_pt = "update ".TPLPrefix."events set eventimage='".getRealescape($eventsimages_pt)."' where parent_id = '".$parentidval."' and lang_id = 3 ";
                    $db->insert($str_pt);
                }
				    
			
			
			
			}
			
			$log = $db->insert_log("insert"," ".TPLPrefix."events","","Eevents Added Newly","events",$str);
			
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
	if(!empty($txteventtitle) ) {
		$strChk = "select count(eventid) from ".TPLPrefix."events where eventtitle = ? and IsActive != ? and eventid != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txteventtitle,2,$edit_id));
 		//print_r($reslt); exit;
		if($reslt[0] == 0) {
		    
		   		$update_sql='';
		   		$update_sql_es='';
		   		$update_sql_pt='';
		   		
				if(isset($_FILES["eventsimages"])){
					if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["eventsimages"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname=str_replace(' ','_',$_FILES['eventsimages']['name']);
					  $imgname=time().rand(0,9).$imgname;	
					  $target_file = '../uploads/events/'.$imgname;
					 
					  move_uploaded_file($_FILES["eventsimages"]["tmp_name"], $target_file);
						$update_sql.= " ,eventimage='".getRealescape($imgname)."'";
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
						exit();						
					}	
						
				}
				
				if(isset($_FILES["eventsimages_es"])){
					if(($width_es >= $imgwidth_es && $height_es >= $imgheight_es) && $height_es == round($width_es * $imgheight_es / $imgwidth_es)){
						//validate image file allowed (jpg,png,gif)
						$file_info_es = getimagesize($_FILES["eventsimages_es"]['tmp_name']);
						$file_mime_es = explode('/',$file_info_es['mime']);				
						if(!in_array($file_mime_es[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname_es=str_replace(' ','_',$_FILES['eventsimages_es']['name']);
					  $imgname_es=time().rand(0,9).$imgname_es;	
					  $target_file_es = '../uploads/events/'.$imgname_es;
					 
					  move_uploaded_file($_FILES["eventsimages_es"]["tmp_name"], $target_file_es);
						$update_sql_es.= " ,eventimage='".getRealescape($imgname_es)."'";
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth_es.' & '.$imgheight_es.' or Ratio ('.round($imgheight_es/$imgwidth_es).': '.round($imgheight_es%$imgwidth_es).') size not matched'));  //no values
						exit();						
					}	
						
				}
				if(isset($_FILES["eventsimages_pt"])){
					if(($width_pt >= $imgwidth_pt && $height_pt >= $imgheight_pt) && $height_pt == round($width_pt * $imgheight_pt / $imgwidth_pt)){
						//validate image file allowed (jpg,png,gif)
						$file_info_pt = getimagesize($_FILES["eventsimages_pt"]['tmp_name']);
						$file_mime_pt = explode('/',$file_info_pt['mime']);				
						if(!in_array($file_mime_pt[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
					
					  $imgname_pt=str_replace(' ','_',$_FILES['eventsimages_pt']['name']);
					  $imgname_pt=time().rand(0,9).$imgname_pt;	
					  $target_file_pt = '../uploads/events/'.$imgname_pt;
					 
					  move_uploaded_file($_FILES["eventsimages_pt"]["tmp_name"], $target_file_pt);
						$update_sql_pt.= " ,eventimage='".getRealescape($imgname_pt)."'";
					
				    }else{
						echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth_pt.' & '.$imgheight_pt.' or Ratio ('.round($imgheight_pt/$imgwidth_pt).': '.round($imgheight_pt%$imgwidth_pt).') size not matched'));  //no values
						exit();						
					}	
						
				}
				
				
				$eventcode = clean(trim($txteventtitle));
$eventcode =urlencode(strtolower($eventcode));

				
                $str = "update ".TPLPrefix."events set eventurl='".getRealescape($txteventurl)."',eventvideourl='".getRealescape($txteventvideourl)."',eventtitle = '".getRealescape($txteventtitle)."' , eventdate = '".getdateFormat($db,$txteventdate)."' , eventdescription = '".getRealescape($txteventdescription)."',  IsActive = '".$status."' , modifiedDate = '".$today."' , UserId = '".$_SESSION["UserId"]."',eventcode='".$eventcode."' ".$update_sql." where eventid = '".$edit_id."' ";
                $db->insert_log("update"," ".TPLPrefix."events",$edit_id,"Eevents updated","events",$str);
                $db->insert($str);

			
$eventcode_es = clean(trim($txteventtitle_es));
$eventcode_es =urlencode(strtolower($eventcode_es));

$str_es = "update ".TPLPrefix."events set eventurl='".getRealescape($txteventurl_es)."',eventvideourl='".getRealescape($txteventvideourl_es)."',eventtitle = '".getRealescape($txteventtitle_es)."', eventdate = '".getdateFormat($db,$txteventdate)."' , eventdescription ='".getRealescape($txteventdescription_es)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',eventcode='".$eventcode_es."' ".$update_sql_es." where parent_id = '".$edit_id."' and lang_id = 2 ";
//$rslt_es = $db->insert_bind($str_es,array(getRealescape($txteventtitle_es),getdateFormat($db,$txteventdate),getRealescape($txteventdescription_es),$status,$today,$_SESSION["UserId"],$edit_id));
$db->insert($str_es);
			
//print_r($db); exit;


$eventcode_pt = clean(trim($txteventtitle_pt));
$eventcode_pt =urlencode(strtolower($eventcode_pt));
			
$str_pt = "update ".TPLPrefix."events set eventurl='".getRealescape($txteventurl_pt)."',eventvideourl='".getRealescape($txteventvideourl_pt)."',eventtitle = '".getRealescape($txteventtitle_pt)."', eventdate = '".getdateFormat($db,$txteventdate)."' , eventdescription ='".getRealescape($txteventdescription_pt)."', IsActive = '".$status."', modifiedDate = '".$today."' , UserId='".$_SESSION["UserId"]."',eventcode='".$eventcode_pt."' ".$update_sql_pt." where parent_id = '".$edit_id."'   and lang_id = 3";
//$rslt_pt = $db->insert_bind($str_pt,array(getRealescape($txteventtitle_pt),getdateFormat($db,$txteventdate),getRealescape($txteventdescription_pt),$status,$today,$_SESSION["UserId"],$edit_id));
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
	  $str="update ".TPLPrefix."events set IsActive = ?, modifiedDate = ? , UserId=?  where eventid = ? and eventid NOT IN(?) ";
	  
	  $db->insert_log("delete"," ".TPLPrefix."events",$edit_id,"Eevents deleted","events",$str);
	  
	  $db->insert_bind($str,array(2,$today,$_SESSION["UserId"],$edit_id,1)); 	 
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		//$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" ){			
			$str="update ".TPLPrefix."events set IsActive = ?, modifiedDate = ? , UserId=?  where eventid = ? and eventid NOT IN(?) ";
			
			 $db->insert_log("update"," ".TPLPrefix."events",$edit_id,"event Statuschanged","events",$str);
			
            $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id,1)); 
		   
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
	
	case 'SingledeleteImg':
	 $str="update kr_events set eventsimages = '' where eventid = '".$edit_id."'";
	 $db->insert_log("image","kr_events",$edit_id,"Eevents Image delete","delete",$str);
	 $db->insert($str); 	
	 echo "1";
	break;
	
	case 'moreimage':
	    //print_r($_POST);
	     //print_r($_FILES); exit;
		$a = 1;				
		for($i=0;$i<count($_FILES["eventsimages"]["name"]);$i++){	
			if( $_FILES["eventsimages"]["name"][$i] != ''){	
				 $_FILES["eventsimages"]["name"][$i]."<br>";
				 $extension  =$_FILES["eventsimages"]["type"][$i];				
				 $obj=new Gthumb();	
				 $path = $obj->resize_image_bulk($sizes,'events',$extension,$_FILES['eventsimages'],$i);
						if($path != ''){
						 	$str = "INSERT INTO kr_eventsimage(eventid,imgname,imgorder,IsActive,CreatedDate,lang_id) values	('".$edit_id."','".$path."','".$i."',1,'".$created."','1') "; 
							 
							$rslt = $db->insert($str);			
							$log = $db->insert_log("insert","kr_eventsimage","","Eevents Image Added Newly","events",$str);
						}
				}
			}

    //exit;
			$a_es = 1;				
		for($i=0;$i<count($_FILES["eventsimages_es"]["name"]);$i++){	
			if( $_FILES["eventsimages_es"]["name"][$i] != ''){	
				$_FILES["eventsimages_es"]["name"][$i]."<br>";
				 $extension_es  =$_FILES["eventsimages_es"]["type"][$i];				
				 $obj_es=new Gthumb();	
				 $path_es = $obj_es->resize_image_bulk($sizes,'events',$extension_es,$_FILES['eventsimages_es'],$i);
						if($path_es != ''){
							$str_es = "INSERT INTO kr_eventsimage(eventid,imgname,imgorder,IsActive,CreatedDate,lang_id) values	('".$edit_id."','".$path_es."','".$i."',1,'".$created."','2') ";
							 
							$rslt_es = $db->insert($str_es);			
							$log_es = $db->insert_log("insert","kr_eventsimage","","Eevents Image Added Newly","events",$str_es);
						}
				}
			}


			$a_pt = 1;				
		for($i=0;$i<count($_FILES["eventsimages_pt"]["name"]);$i++){	
			if( $_FILES["eventsimages_pt"]["name"][$i] != ''){	
				 $_FILES["eventsimages_pt"]["name"][$i]."<br>";
				 $extension_pt  =$_FILES["eventsimages_pt"]["type"][$i];				
				 $obj_pt=new Gthumb();	
				 $path_pt = $obj_pt->resize_image_bulk($sizes,'events',$extension_pt,$_FILES['eventsimages_pt'],$i);
						if($path_pt != ''){
							$str_pt = "INSERT INTO kr_eventsimage(eventid,imgname,imgorder,IsActive,CreatedDate,lang_id) values	('".$edit_id."','".$path_pt."','".$i."',1,'".$created."','3') ";
							 
							$rslt_pt = $db->insert($str_pt);			
							$log_pt = $db->insert_log("insert","kr_eventsimage","","Eevents Image Added Newly","events",$str_pt);
						}
				}
			}
			//exit;
			echo json_encode(array("rslt"=>"1")); //success
	break;
	
	
	case "moreimageupdate":
 	 $var=explode(',',$productimgid);
	 foreach($var as $i)
	 {
		if($_REQUEST["imagestatus".$i]!=""){
			$getimg = $db->get_a_line("select * from kr_eventsimage where eventidimgid='".$_REQUEST['image'.$i.'id']."'");
			$getsiz = $db->get_rsltset("select  foldername from kr_imageconfig where IsActive = 1 and imageconfigModule = 'events'");
		
			foreach($getsiz as $sizval) {
 				unlink("../uploads/events/".$sizval['foldername']."/".$getimg['imgname']); 
				unlink("../uploads/events/".$getimg['imgname']); 
			}
			
			$sql1= " imgname='',";
			$log = $db->insert_log("deleted","kr_eventsimage","","Eevents Image deleted","events",$str);
 			$db->query("delete from kr_eventsimage where eventidimgid='".$_REQUEST['image'.$i.'id']."'");
		}
		else
		{
			$sql1 = " imgname='".$_REQUEST['productim'.$i]."',";
 			if($_REQUEST['status'.$i] == '')
			$statuss = '0';
			else
			$statuss = $_REQUEST['status'.$i];
  								 
 			$str1=$db->insert("update  kr_eventsimage set imgorder='".$_REQUEST['image1order'.$i]."',$sql1 IsActive='".$statuss."' where eventidimgid='".$_REQUEST['image'.$i.'id']."'");
		}
	 }
					
		$log = $db->insert_log("insert","kr_eventsimage","","Updated","eventsimages",$str);
 		echo json_encode(array("rslt"=>"2")); //success
	break;	
}



?>