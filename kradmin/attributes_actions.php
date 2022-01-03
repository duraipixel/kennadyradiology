<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

$kk = 0;
/*print_r($dropdownValues);
print_r($dropdownUnits);
foreach($dropdownValues as $val){	
$dropdownUnits = '';
echo $val;
	echo		$dropdownUnits = $_REQUEST['dropdownUnits_'.$kk];
	$kk++;
}
die();*/

if($chkstatus !=null)
	$status =1;
else
	$status =0;


if($unitdisplay !=null)
	$unitdis =1;
else
	$unitdis =0;

if($iconsdisplay !=null)
	$iconsdis =1;
else
	$iconsdis =0;
	
	
	
	include 'includes/image_thumb.php';
$today=date("Y-m-d H:i:s");	
$getlanguage = getLanguages($db);	
switch($act)
{
	case 'insert':
	
	if(!empty($txtAttributesname)) {
		$strChk = "select count(attributeid) from ".TPLPrefix."m_attributes where attributename = ? and IsActive != ?";
 		$reslt = $db->get_a_line_bind($strChk,array($txtAttributesname,'2'));
		if($reslt[0] == 0) {
		
		 
		$strunicode = "select count(*) as keycnt from ".TPLPrefix."m_attributes where attributecode = ? and IsActive != ?";
		$reslt = $db->get_a_line_bind($strunicode,array($txtAttributesname,'2'));
		$attributecode = $txtAttributesname;
		
		if($reslt['keycnt'] > 0)
		$attributecode = $attributecode.'_'.$reslt['keycnt'];
	 	
			//English
		
			$parentidval = 0;
			$parentid = 0;
		foreach($getlanguage as $languageval){
		
			$str="insert into ".TPLPrefix."m_attributes(attributename,attribute_type,attributecode,data_type,IsActive,unitdisplay,iconsdisplay,UserId,CreatedDate,ModifiedDate,parent_id,lang_id,sortingOrder)values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtAttributesname'.$languageval['languagefield']]),getRealescape($attribute_type),getRealescape($attributecode),getRealescape($datatype),$status,$unitdis,$iconsdis,$_SESSION["UserId"],$today,$today,$parentidval,$languageval['languageid'],$txtSortingorder));		
			
			if($languageval['languageid'] == 1){
				$lastInserId = $db->insert_id;
				$parentidval = $lastInserId;
			}
			
			$lastInserIds =  $db->insert_id;
			$log = $db->insert_log("insert"," ".TPLPrefix."m_attributes","","Attributes Added Newly","Attributes",$str);	
		//}
            
			//Creating Dynamic module START
		   if($languageval['languageid'] == 1){  $modulepath = "attributevalue_mng.php?attid=".base64_encode($lastInserId)."";
		     $str="insert into ".TPLPrefix."modules(ModuleName,Description,ModulePath,IsActive,UserId,CreatedDate,ModifiedDate) values('".getRealescape($txtAttributesname)."','".getRealescape($txtAttributesname)."','".$modulepath."','".$status.      "','".$_SESSION["UserId"]."','".$today."','".$today."')";
		  $rslt = $db->insert($str);
		   }
		//Creating Dynamic module End
            			
			$kk = 0;
			
			foreach($dropdownValues as $val){			
			
			////for image upload from here
			$path = '';			
			if(isset($_FILES["attributeicons"])){		

			//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["attributeicons"]['tmp_name'][$kk]);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"17"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
				 $path=$obj->genThumbAttrIconImage('attributeicons', $db, $kk);						
				//image upload path - ends	
			}	
			
		////for image upload till here
		$dropdownValue_es ='';
		$dropdownValue_es = $dropdownValues_es[$kk];
		
		$dropdownValue_pt ='';
		$dropdownValue_pt = $dropdownValues_pt[$kk];
		
		$dropdownUnit = '';		
		$dropdownUnit = $dropdownUnits[$kk];
		
		$sortingOrdr = '0';
		$sortingOrdr = $dropdownSort[$kk];
				$tVal = trim($val); 
				$dropdownValue = trim($val); 
				
				if($tVal){
				//	foreach($getlanguage as $languageval){
					$str= "insert into ".TPLPrefix."dropdown(attributeId,dropdown_values,dropdown_images,dropdown_unit,sortingOrder,userid,isactive,createdate,modifieddate,lang_id,parent_id)values(?,?,?,?,?,?,?,?,?,?,?)";					 				
					$db->insert_bind($str,array($lastInserIds,getRealescape($_POST['dropdownValues'.$languageval['languagefield']][$kk]),$path,$dropdownUnit,$sortingOrdr,$_SESSION["UserId"],1,$today,$today,$languageval['languageid'],$parentid));	
					 if($languageval['languageid'] == 1){ 
					 $parentid = $db->insert_id;
					 }
					//}					
				}
				$kk++;				
			}						
		}
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
	if(!empty($txtAttributesname)) {
	$strChk = "select count(attributeid) from ".TPLPrefix."m_attributes where attributename = ? and IsActive != ? and attributeid != ? ";
 		$reslt = $db->get_a_line_bind($strChk,array($txtAttributesname,'2',$edit_id));
		if($reslt[0] == 0) {
			
			   //select module id
				$mpath = "attributevalue_mng.php?attid=".base64_encode($edit_id);
				
				$mid = "select ModuleId from ".TPLPrefix."modules where  IsActive != ? and ModulePath = ? ";
				
				$reslt = $db->get_a_line_bind($mid,array(2,$mpath));	
				 $moduleid = $reslt['ModuleId']; 
			
			    //Update module 
				$modulepath = "attributevalue_mng.php?attid=".base64_encode($edit_id);
				
				$str_module = "update ".TPLPrefix."modules set ModuleName = ?, Description = ?, ModulePath = ?, IsActive = ?, ModifiedDate = ? , UserId=?  where ModuleId = ? ";	
				//echo $str_module; exit;
				$db->insert_bind($str_module,array(getRealescape($txtAttributesname),getRealescape($txtAttributesname),$modulepath,$status,$today,$_SESSION["UserId"],$moduleid));
			 		
				$parentid = 0;
			 
			foreach($getlanguage as $languageval){
				
				$str = "update ".TPLPrefix."m_attributes set sortingOrder=?,attributename = ?, attribute_type = ?,data_type = ?,IsActive = ?,unitdisplay= ?,iconsdisplay= ?, UserId=?,ModifiedDate = ?  where attributeid = ?"; 
					  $strlang = "update ".TPLPrefix."m_attributes set sortingOrder=?,attributename = ?, attribute_type = ?,data_type = ?,IsActive = ?,unitdisplay= ?,iconsdisplay= ?, UserId=?,ModifiedDate = ?  where parent_id = ? and lang_id = ?"; 
			
			$db->insert_log("update"," ".TPLPrefix."m_attributes",$edit_id,"Attributes  updated","Attributes",$str);
			
			if($languageval['languageid'] == 1){
				$db->insert_bind($str,array($txtSortingorder,getRealescape($_POST['txtAttributesname'.$languageval['languagefield']]),getRealescape($attribute_type),$datatype,$status,$unitdis,$iconsdis,$_SESSION["UserId"],$today,$_POST['edit_id'.$languageval['languagefield']]));
			}else{ 
			 
				$db->insert_bind($strlang,array($txtSortingorder,getRealescape($_POST['txtAttributesname'.$languageval['languagefield']]),getRealescape($attribute_type),$datatype,$status,$unitdis,$iconsdis,$_SESSION["UserId"],$today,$_POST['edit_id'],$languageval['languageid']));
			}
			
			//}
		
			$lastid = $_POST['edit_id'.$languageval['languagefield']];
			$kk = 0;
			
			foreach($dropdownValues as $val){			
			$val;
			////for image upload from here
			$path = '';			
			if(isset($_FILES["attributeicons"])){		

			//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["attributeicons"]['tmp_name'][$kk]);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"17"));
					exit();
				}
				//image upload path - starts			
				$obj=new Gthumb();			
				 $path=$obj->genThumbAttrIconImage('attributeicons', $db, $kk);						
				//image upload path - ends	
			}	
			
		////for image upload till here
		$dropdownValue_es ='';
		$dropdownValue_es = $dropdownValues_es[$kk];
		
		$dropdownValue_pt ='';
		$dropdownValue_pt = $dropdownValues_pt[$kk];
		
		$dropdownUnit = '';		
		$dropdownUnit = $dropdownUnits[$kk];
		
		$sortingOrdr = '0';
		$sortingOrdr = $dropdownSort[$kk];
				$tVal = trim($val); 
				$dropdownValue = trim($val); 
				if($tVal){
					//	foreach($getlanguage as $languageval){
					$str= "insert into ".TPLPrefix."dropdown(attributeId,dropdown_values,dropdown_images,dropdown_unit,sortingOrder,userid,isactive,createdate,modifieddate,lang_id,parent_id)values(?,?,?,?,?,?,?,?,?,?,?)";					 				
					$db->insert_bind($str,array($lastid,getRealescape($_POST['dropdownValues'.$languageval['languagefield']][$kk]),$path,$dropdownUnit,$sortingOrdr,$_SESSION["UserId"],1,$today,$today,$languageval['languageid'],$parentid));
if($languageval['languageid'] == 1){ 
					 $parentid = $db->insert_id;
					 }					
					//}					
				}
				$kk++;				
			}	
		}			
			
			$jj=0;
			//print_r($editdropdownId);
			foreach($editdropdownId as $val){
			
		//echo $val."<br>";
				$tempunit = "editdropdownUnits".$val;	
				$tempsort = "dropdownSort".$val;
				$editdropdownValues = "editdropdownValues".$val;
				 			
				if($val)
				{
					$str= "update ".TPLPrefix."dropdown set dropdown_values ='".getRealescape($_REQUEST[$editdropdownValues])."',dropdown_unit = '".getRealescape($_REQUEST[$tempunit])."',parent_id='0',sortingOrder = '".getRealescape($_REQUEST[$tempsort])."'  ";
					
					$str_es= "update ".TPLPrefix."dropdown set dropdown_values='".$editdropdownValues_es[$jj]."',dropdown_unit = '".getRealescape($_REQUEST[$tempunit])."',parent_id='".$val."',sortingOrder = '".getRealescape($_REQUEST[$tempsort])."'  ";
					
					
					  $str_pt= "update ".TPLPrefix."dropdown set dropdown_values='".$editdropdownValues_pt[$jj]."',dropdown_unit = '".getRealescape($_REQUEST[$tempunit])."',parent_id='".$val."',sortingOrder = '".getRealescape($_REQUEST[$tempsort])."'  ";
						////for editing attributes icons from here
						$edtpath = array();		
						if(isset($_FILES["attributeicons_".$val])){		
						//validate image file allowed (jpg,png,gif)
							$file_info = getimagesize($_FILES["attributeicons_".$val]['tmp_name']);
							$file_mime = explode('/',$file_info['mime']);				
							if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
								echo json_encode(array("rslt"=>"7"));
								exit();
							}
							//image upload path - starts			
							$obj=new Gthumb();			
							 $edtpath =$obj->genThumbAttrIconImageEdt('attributeicons_'.$val, $db);	
							 
							 $str .= " ,dropdown_images = '".$edtpath."' " ;
							 $str_pt .= " ,dropdown_images = '".$edtpath."' " ;	
 $str_es .= " ,dropdown_images = '".$edtpath."' " ;								 
							//image upload path - ends	
						}	
						////for editing attributes icons till here
			
						$str .= " ,isactive = '1'  where dropdown_id = '".$val."' and lang_id='1' ";
						$str_pt .= " ,isactive = '1'  where dropdown_id = '".$editdropdownId_pt[$jj]."' and lang_id='3' ";
						$str_es .= " ,isactive = '1'  where dropdown_id = '".$editdropdownId_es[$jj]."' and lang_id='2' ";

					 if($val == 89){
			 
			//print_r($result_data);	
			}
			        // echo $str_pt; 
 					$rslt = $db->insert($str);
					$rslt = $db->insert($str_pt);
					$rslt = $db->insert($str_es);
					
					//$db->insert($str);							
				}	
	$jj++;				
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
	  $str="update ".TPLPrefix."m_attributes set IsActive = ?, UserId=?  where attributeid = ?";
	  $db->insert_log("delete","".TPLPrefix."m_attributes",$edit_id,"Attributes deleted","Attributes",$str);
	  $db->insert_bind($str,array('2',$_SESSION["UserId"],$edit_id)); 

        //select module id
	       $mpath = "attributevalue_mng.php?attid=".base64_encode($edit_id)." ";
           $mid = "select ModuleId from ".TPLPrefix."modules where  IsActive != '2' and ModulePath = '".$mpath."' ";
 	       $reslt = $db->get_a_line($mid);	
	       $moduleid = $reslt['ModuleId'];	

         //  delete module	
           $str="update ".TPLPrefix."modules set IsActive =?, ModifiedDate =? , UserId=?  where ModuleId = ?  and ModuleId NOT IN(1,2,3) ";
	       $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$moduleid));		 	  
	  
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	//$today = date("Y-m-d");
	$status = $actval;
	
	 $str="update ".TPLPrefix."m_attributes set IsActive = ?, UserId=?  where attributeid = ?";
	 $db->insert_log("update"," ".TPLPrefix."m_attributes",$edit_id,"Attributes Statuschanged","Attributes",$str);
	 $db->insert_bind($str,array($status,$_SESSION["UserId"],$edit_id)); 	
	 
	 $str1="update ".TPLPrefix."m_attributes set IsActive = ?, UserId=?  where parent_id = ?";	 
	 $db->insert_bind($str1,array($status,$_SESSION["UserId"],$edit_id)); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	case 'deloptionsvalue':		
	
	 $str = "delete from ".TPLPrefix."dropdown where  dropdown_id = ? limit 1 ";	 
	 $db->insert_bind($str,array($dropdown_id)); 

$str1 = "delete from ".TPLPrefix."dropdown where  parent_id = ? limit 1 ";	 
	 $db->insert_bind($str1,array($dropdown_id)); 	 
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
	
}



?>