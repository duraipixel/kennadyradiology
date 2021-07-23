<?php 
include 'session.php';
 extract($_REQUEST);
 $act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
	
if($chkdispstatus !=null)
	$dispstatus =1;
else
	$dispstatus =0;

if($chktrendingcategorys !=null)
	$trending_categorys =1;
else
	$trending_categorys =0;
	
	$getlanguage = getLanguages($db);
	
include 'includes/image_thumb.php';
$today=date("Y-m-d H:i:s");
$getsize = getimagesize_large($db,'categorybanner','category');

$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
	
list($width, $height) = getimagesize($_FILES['categoryImage']['tmp_name'][0]);
list($widthpt, $heightpt) = getimagesize($_FILES['categoryImage_pt']['tmp_name'][0]);
list($widthes, $heightes) = getimagesize($_FILES['categoryImage_es']['tmp_name'][0]);

//mobile image start
$getsizes = getimagesize_large($db,'categorymobileimage','categorymobileimage');
$imagevals = explode('-',$getsizes);
$imgheights = $imagevals[1];
$imgwidths = $imagevals[0];

list($widths, $heights, $type, $attr) = getimagesize($_FILES['mobimage']['tmp_name'][0]);
list($widthspt, $heightspt, $type, $attr) = getimagesize($_FILES['mobimage_pt']['tmp_name'][0]);
list($widthses, $heightses, $type, $attr) = getimagesize($_FILES['mobimage_es']['tmp_name'][0]);
//mobile image end

 
//category menu start
$getsizescat = getimagesize_large($db,'categorymenuimage','categorymenuimage');
$imagevalscat = explode('-',$getsizescat);
$imgheightscat = $imagevalscat[1];
$imgwidthscat = $imagevalscat[0];

list($widthscat, $heightscat, $type, $attr) = getimagesize($_FILES['categorymenuimage']['tmp_name'][0]);
list($widthscatpt, $heightscatpt, $type, $attr) = getimagesize($_FILES['categorymenuimage_pt']['tmp_name'][0]);
list($widthscates, $heightscates, $type, $attr) = getimagesize($_FILES['categorymenuimage_es']['tmp_name'][0]);
//end category menu

if(isset($_REQUEST['filefield'])){
	 
if($_REQUEST['filefield'] == 'geteventImage'){ 

	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."categoryimage where categoryID = ? and lang_id = 1 and IsActive = 1 order by ordering asc ";
         		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;?>
            <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['catimage'] != ''){								
				?>
              
  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
          <img width="250" height="250" src="<?php echo IMG_BASE_URL."category/".$valimages['catimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="deleventImg('<?php echo base64_encode($valimages['catimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>

              <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['catimgid']; ?>" />  
				 
				<?php
				$counter++;
			}
			}
			?>
            </ul>
</div>
			  		 
			<?php
		}									
	}	
	exit();
}

else if($_REQUEST['filefield'] == 'geteventImage_es'){
	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."categoryimage where categoryID = ? and lang_id = 2  and IsActive = 1 order by ordering asc ";
         		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;?>
            <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['catimage'] != ''){								
				?>
              
  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
          <img width="250" height="250" src="<?php echo IMG_BASE_URL."category/".$valimages['catimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="deleventImg('<?php echo base64_encode($valimages['catimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>

              <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['catimgid']; ?>" />  
				 
				<?php
				$counter++;
			}
			}
			?>
            </ul>
</div>
			  		
			<?php
		}									
	}	
	exit();
}


else if($_REQUEST['filefield'] == 'geteventImage_pt'){ 
	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."categoryimage where categoryID = ? and lang_id = 3  and IsActive = 1 order by ordering asc ";
         		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;?>
            <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['catimage'] != ''){								
				?>
              
  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
          <img width="250" height="250" src="<?php echo IMG_BASE_URL."category/".$valimages['catimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="deleventImg('<?php echo base64_encode($valimages['catimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>

              <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['catimgid']; ?>" />  
				 
				<?php
				$counter++;
			}
			}
			?>
            </ul>
</div>
			  		 
			<?php
		}									
	}	
	exit();
}

}


if(isset($_REQUEST['mobfilefield'])){
if($_REQUEST['mobfilefield'] == 'getmobileImage'){
	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."category_mobimage where categoryID = ? and lang_id = 1  and IsActive = 1 order by ordering asc ";
          		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;
			?>
             <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['cat_mobimgid'] != ''){								
				?>
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."categorymobileimage/".$valimages['mobimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="delmobileImg('<?php echo base64_encode($valimages['cat_mobimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>
  <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['cat_mobimgid']; ?>" />
		 		
				<?php
				$counter++;
			}
			}
			?>
            </ul></div>
			    
			<?php
		}									
	}	
	exit();
}

else if($_REQUEST['mobfilefield'] == 'getmobileImage_es'){
	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."category_mobimage where categoryID = ? and lang_id = 2  and IsActive = 1 order by ordering asc ";
          		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;
			?>
             <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['cat_mobimgid'] != ''){								
				?>
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."categorymobileimage/".$valimages['mobimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="delmobileImg('<?php echo base64_encode($valimages['cat_mobimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>
  <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['cat_mobimgid']; ?>" />
		 		
				<?php
				$counter++;
			}
			}
			?>
            </ul></div>
			    
			<?php
		}									
	}	
	exit();
}

else if($_REQUEST['mobfilefield'] == 'getmobileImage_pt'){
	$id = base64_decode($_REQUEST['eventsid']);
	if($id != null){
		$str_ed_images = "SELECT * FROM  ".TPLPrefix."category_mobimage where categoryID = ? and lang_id = 3  and IsActive = 1 order by ordering asc ";
          		
		$res_ed_images = $db->get_rsltset_bind($str_ed_images,array($id));		
		if(count($res_ed_images)){
			$counter = 1;
			?>
             <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
              <?php
			foreach($res_ed_images as $valimages){	
			if($valimages['cat_mobimgid'] != ''){								
				?>
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."categorymobileimage/".$valimages['mobimage']; ?>" />
          </div>
        </div>
        <div class="jFiler-item-assets jFiler-row">
          <ul class="list-inline pull-left">
            <li></li>
          </ul>
          <ul class="list-inline pull-right">
            <li><a onclick="delmobileImg('<?php echo base64_encode($valimages['cat_mobimgid']) ?>','<?php echo base64_encode($id); ?>')"  href='javascript:void(0);' class="icon-jfi-trash jFiler-item-trash-action"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </li>
  <input type="hidden" class="productImgOrder" name="productImgOrder" value="<?php echo $valimages['cat_mobimgid']; ?>" />
		 		
				<?php
				$counter++;
			}
			}
			?>
            </ul></div>
			    
			<?php
		}									
	}	
	exit();
}


}


switch($act)
{
	case 'insert':
	if(!empty($txtcategory)) {
	$strChk = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory' and  parentId='".$parentcategory."' and IsActive != '2' and parent_id='0' ";
		$reslt = $db->get_a_line($strChk);
		
		$strChk_sp = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory_es' and IsActive != '2'";
 		$reslt_sp = $db->get_a_line($strChk_sp);
		
		$strChk_bt = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory_pt' and IsActive != '2'";
 		$reslt_bt = $db->get_a_line($strChk_bt);

		if($reslt[0] == 0 && $reslt_sp[0] == 0 && $reslt_bt[0] == 0) {	
		////for image upload from here
			$path = '';						 	
			if(isset($_FILES["categoryImage"]) && isset($_FILES["categoryImage_es"])  && isset($_FILES["categoryImage_pt"]) ){
				//validate image file allowed (jpg,png,gif)
				if(!(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth) && ($widthpt >= $imgwidth && $heightpt >= $imgheight) && $heightpt == round($widthpt * $imgheight / $imgwidth) && ($widthes >= $imgwidth && $heightes >= $imgheight) && $heightes == round($widthes * $imgheight / $imgwidth)))
				{
					
				echo json_encode(array("rslt"=>"8",'msg'=>'Category Banner Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				    exit();	
				}
			}
		 
		if(isset($_FILES["mobimage"]) && isset($_FILES["mobimage_pt"]) && isset($_FILES["mobimage_es"])){
				//validate image file allowed (jpg,png,gif)
				/*echo $widths .'>='. $imgwidths .'&&'. $heights .'>='. $imgheights;
				echo "\n\n";
				echo $heights .'=='. round($widths * $heights .'/'. $imgwidths);
				echo "pt\n\n";
				echo "\n\n";echo ($widthspt .'>='. $imgwidths .'&&'. $heightspt .'>='. $imgheights);
				echo "\n\n";
				echo $heightspt .'=='. round($widthspt * $imgheights / $imgwidths) ;
				echo "\n\n";
				echo "es\n\n";
				echo ($widthses .'>='. $imgwidths .'&&'. $heightses .'>='. $imgheights) ;echo "\n\n";
				echo $heightses .'=='. round($widthses * $imgheights / $imgwidths);
				echo "\n\n";
				die();*/
				
				if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths) && ($widthspt >= $imgwidths && $heightspt >= $imgheights) && $heightspt == round($widthspt * $imgheights / $imgwidths) && ($widthses >= $imgwidths && $heightses >= $imgheights) && $heightses == round($widthses * $imgheights / $imgwidths)))
				{					
				    echo json_encode(array("rslt"=>"8",'msg'=>'Mobile Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}
			}
			
			
		if(isset($_FILES["categorymenuimage"]) && isset($_FILES["categorymenuimage_pt"]) && isset($_FILES["categorymenuimage_es"])){
				//validate image file allowed (jpg,png,gif)
				if(!(($widthscat >= $imgwidthscat && $heightscat >= $imgheightscat) && $heightscat == round($widthscat * $imgheightscat / $imgwidthscat) && ($widthscatpt >= $imgwidthscat && $heightscatpt >= $imgheightscat) && $heightscatpt == round($widthscatpt * $imgheightscat / $imgwidthscat) && ($widthsescat >= $imgwidthscat && $heightscates >= $imgheightscat) && $heightscates == round($widthscates * $imgheightscat / $imgwidthscat)))
				{					
				    echo json_encode(array("rslt"=>"8",'msg'=>'Menu Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}
			}
				
			/*if(isset($_FILES["categoryImage"]) && isset($_FILES["categoryImage_es"]) && isset($_FILES["categoryImage_pt"]) ){
				//validate image file allowed (jpg,png,gif)
				if(!(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth) && ($widthpt >= $imgwidth && $heightpt >= $imgheight) && $heightpt == round($widthpt * $imgheight / $imgwidth)))
				{
					
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				    exit();	
				}
			}*/
			
		/*	if(empty($_FILES['mobimage'])){
			echo json_encode(array("rslt"=>"9","text"=>"Category Mobile Image"));
			    exit();
		    }*/
			
			/*if(isset($_FILES["mobimage"])){
				//validate image file allowed (jpg,png,gif)
				if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths)))
				{
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}
			}*/
		////for image upload till here
		

				
		
		//for category code uniqueness from here
		$strunicode = "select count(*) as keycnt from ".TPLPrefix."category where categoryCode = ? and IsActive != ? ";
		$reslt = $db->get_a_line_bind($strunicode,array($categoryCode,'2'));
		
		if($reslt['keycnt'] > 0)
		$categoryCode = $categoryCode;
		//for category code uniqueness till here
			
			$parentidval = 0;$uploadPortfolio = '';
				foreach($getlanguage as $languageval){
					
					$menuimagedata='';
				if(isset($_FILES["menuimage".$languageval['languagefield']])){
					 
						//validate image file allowed (jpg,png,gif)
						$file_info = getimagesize($_FILES["menuimage".$languageval['languagefield']]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}
						
					  $menuimage=str_replace(' ','_',$_FILES['menuimage'.$languageval['languagefield']]['name']);
					   $menuimagedata=time().rand(0,9).$menuimage;	
					   $target_file = '../uploads/category/categorymenuimage/'.$menuimagedata;
					 
					  move_uploaded_file($_FILES["menuimage".$languageval['languagefield']]["tmp_name"], $target_file);
						//image upload path - ends	
					 
				}			
			
			if($languageval['languageid'] != 1 && $parentcategory != 0){
				$getparentcat = $db->get_a_line("select categoryID from ".TPLPrefix."category where parent_id = '".getRealescape($parentcategory)."' and lang_id = '".$languageval['languageid']."' and IsActive = 1");
			$parentcategoryval = $getparentcat['categoryID'];	
			}else{
				$parentcategoryval = $parentcategory;
			}
			
			$str="insert into ".TPLPrefix."category(categoryName,categoryDesc,hsncode, parentId,IsActive,UserId,IsTop,categoryCode,sortingOrder,categoryMetatitle,categoryMetadesc,categoryMetakey,CreatedDate,ModifiedDate,categorymenuimage,trending_categorys,parent_id,lang_id)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			//echo $str; exit;
			 
			$rslt = $db->insert_bind($str,array(getRealescape($_POST['txtcategory'.$languageval['languagefield']]),getRealescape($_POST['categoryDesc'.$languageval['languagefield']]),getRealescape($_POST['hsncode'.$languageval['languagefield']]),getRealescape($parentcategoryval),$status,$_SESSION["UserId"],$dispstatus,getRealescape($categoryCode),$txtSortingorder,$_POST['categoryMetatitle'.$languageval['languagefield']],$_POST['categoryMetadesc'.$languageval['languagefield']],$_POST['categoryMetakey'.$languageval['languagefield']],$today,$today,$menuimagedata,$trending_categorys,$parentidval,$languageval['languageid']));	
			$insert_id=	$db->insert_id;
			
if($languageval['languageid'] == 1){
					$lastInserId = $insert_id;
					$parentidval = $lastInserId;
				}
$imagefilename  = 'categoryImage'.$languageval['languagefield'];
 uploadPortfolio($insert_id,$db,'categoryImage'.$languageval['languagefield'],$languageval['languageid']);
			 uploadPortfoliomob($insert_id,$db,'mobimage'.$languageval['languagefield'],$languageval['languageid']);
			 
				}
			$log = $db->insert_log("insert"," ".TPLPrefix."category","","Category Added Newly","category",$str);
			
			
		   
			
			//Category display against customer groups
			if(count($customer_group_id)>0){
				for($jj=0;$jj<count($customer_group_id);$jj++)
				{	
					$updateQry =" insert into ".TPLPrefix."category_custgrp (CategoryId ,CustomerGrupId, IsActive,  UserId, createdDate,modifiedDate ) values('".$insert_id."','".
								$customer_group_id[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."' ) ";
						$db->insert($updateQry); 
					 $db->insert_log("insert","".TPLPrefix."category_custgrp",$insert_id," Category Customer group added ","Category Customer Group",$updateQry);	
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
	if(!empty($txtcategory)) {
		
		$strChk = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory' and  parentId='".$parentcategory."'  and IsActive != '2' and lang_id=1 and categoryID != '".$edit_id."' and parent_id='0' ";
 		$reslt = $db->get_a_line($strChk);
		
		$strChk_sp = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory_es' and IsActive != '2' and parent_id != '".$edit_id."' and lang_id=2 ";
 		$reslt_sp = $db->get_a_line($strChk_sp);
		
		$strChk_bt = "select count(categoryID) from ".TPLPrefix."category where categoryName = '$txtcategory_pt' and IsActive != '2' and parent_id != '".$edit_id."' and lang_id=3"; 
 		$resl_bt = $db->get_a_line($strChk_bt);		
		
		if($edit_id==$parentcategory)
				{
				//echo json_encode(array("rslt"=>"3",'msg'=>'Wrongly Matching Category and Parent Category'));  //no values
				  //  exit();	
				}
		
		if($reslt[0] == 0) {
			//
			
				if(isset($_FILES["categoryImage"]) && isset($_FILES["categoryImage_es"])  && isset($_FILES["categoryImage_pt"]) ){
				//validate image file allowed (jpg,png,gif)
				if(!(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth) && ($widthpt >= $imgwidth && $heightpt >= $imgheight) && $heightpt == round($widthpt * $imgheight / $imgwidth) && ($widthes >= $imgwidth && $heightes >= $imgheight) && $heightes == round($widthes * $imgheight / $imgwidth)))
				{
					
				echo json_encode(array("rslt"=>"8",'msg'=>'Category Banner Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				    exit();	
				}
			}
		
		if(isset($_FILES["mobimage"]) && isset($_FILES["mobimage_pt"]) && isset($_FILES["mobimage_es"])){
				//validate image file allowed (jpg,png,gif)
				
				if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths * $imgheights / $imgwidths) && ($widthspt >= $imgwidths && $heightspt >= $imgheights) && $heightspt == round($widthspt * $imgheights / $imgwidths) && ($widthses >= $imgwidths && $heightses >= $imgheights) && $heightses == round($widthses * $imgheights / $imgwidths)))
				{					
				    echo json_encode(array("rslt"=>"8",'msg'=>'Mobile Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}
			}
			
			
		if(isset($_FILES["categorymenuimage"]) && isset($_FILES["categorymenuimage_pt"]) && isset($_FILES["categorymenuimage_es"])){
				//validate image file allowed (jpg,png,gif)
				if(!(($widthscat >= $imgwidthscat && $heightscat >= $imgheightscat) && $heightscat == round($widthscat * $imgheightscat / $imgwidthscat) && ($widthscatpt >= $imgwidthscat && $heightscatpt >= $imgheightscat) && $heightscatpt == round($widthscatpt * $imgheightscat / $imgwidthscat) && ($widthsescat >= $imgwidthscat && $heightscates >= $imgheightscat) && $heightscates == round($widthscates * $imgheightscat / $imgwidthscat)))
				{					
				    echo json_encode(array("rslt"=>"8",'msg'=>'Menu Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}
			}
				
			if(isset($_FILES["categoryImage"])){
				//validate image file allowed (jpg,png,gif)
				/*if(!(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)))
				{
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				    exit();	
				}*/
			}
		if(isset($_FILES["mobimage"])){
				//validate image file allowed (jpg,png,gif)
				/*if(!(($widths >= $imgwidths && $heights >= $imgheights) && $heights == round($widths  * $imgheights / $imgwidths)))
				{
				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidths.' & '.$imgheights.' or Ratio ('.round($imgwidths/100).': '.round($imgheights/100).') size not matched'));  //no values
				    exit();	
				}*/
			}
			 
			/*
			$menuimagedata = array();	
				if(isset($_FILES["menuimage"])){
						$file_info = getimagesize($_FILES["menuimage"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $menuimage=str_replace(' ','_',$_FILES['menuimage']['name']);
					  $menuimage=time().rand(0,9).$menuimage;	
					  $target_file = '../uploads/category/categorymenuimage/'.$menuimage;
					 
					  move_uploaded_file($_FILES["menuimage"]["tmp_name"], $target_file);
					
						$menuimagefld = " ,categorymenuimage= '".getRealescape($menuimage)."' ";	
				}	
				
				if(isset($_FILES["menuimage_es"])){
						$file_info = getimagesize($_FILES["menuimage_es"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $menuimage_es=str_replace(' ','_',$_FILES['menuimage_es']['name']);
					  $menuimage_es=time().rand(0,9).$menuimage_es;	
					  $target_file = '../uploads/category/categorymenuimage/'.$menuimage_es;
					 
					  move_uploaded_file($_FILES["menuimage_es"]["tmp_name"], $target_file);
					
						$menuimagefld_es = " ,categorymenuimage= '".getRealescape($menuimage_es)."' ";	
				}	
				if(isset($_FILES["menuimage_pt"])){
						$file_info = getimagesize($_FILES["menuimage_pt"]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $menuimage_pt=str_replace(' ','_',$_FILES['menuimage_pt']['name']);
					  $menuimage_pt=time().rand(0,9).$menuimage_pt;	
					  $target_file = '../uploads/category/categorymenuimage/'.$menuimage_pt;
					 
					  move_uploaded_file($_FILES["menuimage_pt"]["tmp_name"], $target_file);
					
						$menuimagefld_pt = " ,categorymenuimage= '".getRealescape($menuimage_pt)."' ";	
				}	
				*/
				
		 $strunicode = "select count(*) as keycnt from ".TPLPrefix."category where categoryCode = ? and IsActive != ? and categoryID != ? ";
		
		$reslt = $db->get_a_line_bind($strunicode,array($categoryCode,'2',$edit_id));   
		
		
		if($reslt['keycnt'] > 0)
		$categoryCode = $categoryCode;//.'_'.$reslt['keycnt'];
		
	 
		
		foreach($getlanguage as $languageval){
			
			if(isset($_FILES["menuimage".$languageval['languageid']])){
						$file_info = getimagesize($_FILES["menuimage".$languageval['languageid']]['tmp_name']);
						$file_mime = explode('/',$file_info['mime']);				
						if(!in_array($file_mime[1],array('jpg','jpeg','png') ) ){
							echo json_encode(array("rslt"=>"7"));
							exit();
						}

					  $menuimage_es=str_replace(' ','_',$_FILES["menuimage".$languageval['languageid']]['name']);
					  $menuimage_es=time().rand(0,9).$menuimage_es;	
					  $target_file = '../uploads/category/categorymenuimage/'.$menuimage_es;
					 
					  move_uploaded_file($_FILES["menuimage".$languageval['languageid']]["tmp_name"], $target_file);
					//	$menuimagedata[] = getRealescape($menuimage);
						$menuimagefld = " ,categorymenuimage= '".getRealescape($menuimage_es)."' ";	
				}	
				
				
			//if($languageval['languageid'] != 1 && $parentcategory != 0){
			 
				$getparentcat = $db->get_a_line("select categoryID from ".TPLPrefix."category where parent_id = '".getRealescape($parentcategory)."' and lang_id = '".$languageval['languageid']."' and IsActive = 1");
				if($languageval['languageid'] == 1){
					$parentcategoryval = $parentcategory;
				}else{
			$parentcategoryval = $getparentcat['categoryID'];	
				}
				//}
		
			
	
			/*$str = "update ".TPLPrefix."category set categoryName = '".getRealescape($txtcategory)."', categoryDesc = '".getRealescape($categoryDesc)."',hsncode='".getRealescape($hsncode)."', parentId='".getRealescape($parentcategory)."', UserId='".$_SESSION["UserId"]."',categoryCode='".getRealescape($categoryCode)."', IsActive = '".$status."', IsTop = '".$dispstatus."', sortingOrder = '".$txtSortingorder."',categoryMetatitle = '".getRealescape($categoryMetatitle)."',categoryMetadesc= '".getRealescape($categoryMetadesc)."',categoryMetakey ='".getRealescape($categoryMetakey)."',ModifiedDate = '".$today."' ".$menuimagefld.", trending_categorys = '".$trending_categorys."' where categoryID = '".$edit_id."' ";
			$db->insert_log("update"," ".TPLPrefix."category",$edit_id,"Category updated","Category",$str);
			$rslt = $db->insert_bind($str);*/
			
			
			$str_es = "update ".TPLPrefix."category set categoryName = '".getRealescape($_POST['txtcategory'.$languageval['languagefield']])."', categoryDesc = '".getRealescape($_POST['categoryDesc'.$languageval['languagefield']])."',hsncode='".getRealescape($_POST['hsncode'.$languageval['hsncode']])."', parentId='".getRealescape($parentcategoryval)."', UserId='".$_SESSION["UserId"]."',categoryCode='".getRealescape($categoryCode)."', IsActive = '".$status."', IsTop = '".$dispstatus."', sortingOrder = '".$txtSortingorder."',categoryMetatitle = '".getRealescape($_POST['categoryMetatitle'.$languageval['languagefield']])."',categoryMetadesc= '".getRealescape($_POST['categoryMetadesc'.$languageval['languagefield']])."',categoryMetakey ='".getRealescape($_POST['categoryMetakey'.$languageval['languagefield']])."',ModifiedDate = '".$today."' ".$menuimagefld.", trending_categorys = '".$trending_categorys."' where categoryID = '".$_POST['edit_id'.$languageval['languagefield']]."' ";
			$db->insert_log("update"," ".TPLPrefix."category",$edit_id,"Category updated","Category",$str_es);
			$rslt = $db->insert_bind($str_es);

			//echo $_POST['edit_id'.$languageval['languagefield']];
			
			uploadPortfolio($_POST['edit_id'.$languageval['languagefield']],$db,'categoryImage'.$languageval['languagefield'],$languageval['languageid']);
				uploadPortfoliomob($_POST['edit_id'.$languageval['languagefield']],$db,'mobimage'.$languageval['languagefield'],$languageval['languageid']);
		}
		/*
			$str_es = "update ".TPLPrefix."category set categoryName = '".getRealescape($txtcategory_es)."', categoryDesc = '".getRealescape($categoryDesc_es)."',hsncode='".getRealescape($hsncode_es)."', parentId='".getRealescape($parentcategory)."', UserId='".$_SESSION["UserId"]."',categoryCode='".getRealescape($categoryCode)."', IsActive = '".$status."', IsTop = '".$dispstatus."', sortingOrder = '".$txtSortingorder."',categoryMetatitle = '".getRealescape($categoryMetatitle_es)."',categoryMetadesc= '".getRealescape($categoryMetadesc_es)."',categoryMetakey ='".getRealescape($categoryMetakey_es)."',ModifiedDate = '".$today."' ".$menuimagefld_es.", trending_categorys = '".$trending_categorys."' where categoryID = '".$edit_id_es."' ";
			$db->insert_log("update"," ".TPLPrefix."category",$edit_id,"Category updated","Category",$str_es);
			$rslt = $db->insert_bind($str_es);
			
			$str_pt= "update ".TPLPrefix."category set categoryName = '".getRealescape($txtcategory_pt)."', categoryDesc = '".getRealescape($categoryDesc_pt)."',hsncode='".getRealescape($hsncode_pt)."', parentId='".getRealescape($parentcategory)."', UserId='".$_SESSION["UserId"]."',categoryCode='".getRealescape($categoryCode)."', IsActive = '".$status."', IsTop = '".$dispstatus."', sortingOrder = '".$txtSortingorder."',categoryMetatitle = '".getRealescape($categoryMetatitle_pt)."',categoryMetadesc= '".getRealescape($categoryMetadesc_pt)."',categoryMetakey ='".getRealescape($categoryMetakey_pt)."',ModifiedDate = '".$today."' ".$menuimagefld_pt.", trending_categorys = '".$trending_categorys."' where categoryID = '".$edit_id_pt."' ";
			$db->insert_log("update"," ".TPLPrefix."category",$edit_id,"Category updated","Category",$str_pt);
			$rslt = $db->insert_bind($str_pt);
			
		*/	//$db->insert_bind($str,array(getRealescape($txtcategory),getRealescape($categoryDesc),getRealescape($hsncode),getRealescape($parentcategory),$_SESSION["UserId"],getRealescape($categoryCode),$status,$dispstatus,$txtSortingorder,getRealescape($categoryMetatitle),getRealescape($categoryMetadesc),getRealescape($categoryMetakey),$today,$edit_id));
			/*foreach($getlanguage as $languageval){
				uploadPortfolio($edit_id,$db,'categoryImage'.$languageval['languagefield'],$languageval['languageid']);
				uploadPortfoliomob($edit_id,$db,'mobimage'.$languageval['languagefield'],$languageval['languageid']);
			 
			} */
			//Category display against customer groups 
			/*
			for($jj=0;$jj<count($customer_group_id);$jj++)
			{
					$chkmodulethere_ed = $db->get_a_line("select Id from ".TPLPrefix."category_custgrp where CategoryId = '".$edit_id."' and CustomerGrupId = '".$customer_group_id[$jj]."'  and  IsActive=1  ");
						$chk_attrmapid = $chkmodulethere_ed['Id'];
										
					
					$updateQry =" insert into ".TPLPrefix."category_custgrp (Id,CategoryId ,CustomerGrupId, IsActive,  UserId, createdDate,modifiedDate ) values('".$chk_attrmapid."','".$edit_id."','".$customer_group_id[$jj]."','1','".$_SESSION["UserId"]."','".$today."', '".$today."' ) 
					ON DUPLICATE KEY UPDATE CategoryId='".$edit_id."',CustomerGrupId='".$customer_group_id[$jj]."',IsActive='1',modifiedDate ='".$today."',UserId='".$_SESSION["UserId"]."' ";
					
					$db->insert($updateQry); 
				   $db->insert_log("insert","".TPLPrefix."category_custgrp",$insert_id," Category Customer group added ","Category Customer Group",$updateQry);	
			}	
		
		
		
		$selqry = "select group_concat(CustomerGrupId) as id from   ".TPLPrefix."category_custgrp  where CategoryId = '".$edit_id."' and IsActive=1 "; 
		$resattributeId=$db->get_a_line($selqry);
		$resattributeId=explode(",",$resattributeId['id']);
		
		$delattribute=array_diff($resattributeId,$customer_group_id);
	
		if(count($delattribute)>0)
		{
			foreach($delattribute as $d){
				
			   $str = "update ".TPLPrefix."category_custgrp set IsActive = 2, UserId='".$_SESSION["UserId"]."',modifiedDate='".$today."'  where CategoryId = '".$edit_id."' and CustomerGrupId= '".$d."' "; 
			    $db->insert_log("delete","".TPLPrefix."category_custgrp",$edit_id,"Category Customer group deleted","Category Customer Group",$str);
			   $db->insert($str);
			  
			}
			
		}			 
		*/	
		//Category display against customer groups end

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
	  $chkReference_ed_qry = "select categoryID from ".TPLPrefix."category where parentId = ? and IsActive != ? ";
	  $chkReference_ed = $db->get_a_line_bind($chkReference_ed_qry,array($edit_id,'2'));
	  $chk_Ref_there = $chkReference_ed['categoryID'];
	  
	  $chkReference_ed_qry = "select product_id from ".TPLPrefix."product_categoryid where categoryID = '".$edit_id."' and IsActive<>2 ";
	  $chkReference_ed = $db->get_a_line_bind($chkReference_ed_qry,array($edit_id,'2'));
	  $chk_Ref_productid = $chkReference_ed['product_id'];
	 
	  if (isset($chk_Ref_there) || isset($chk_Ref_productid)) {
		  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
		  exit;
	  }
	  else{	  	  
		  $str="update ".TPLPrefix."category set IsActive = ?,modifiedDate = ?, UserId= ?  where categoryID = ? ";
		   $db->insert_log("delete"," ".TPLPrefix."category",$edit_id,"Category deleted","Category",$str);
		  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		 $str="update ".TPLPrefix."category set IsActive = ?,modifiedDate = ?, UserId= ?  where parent_id = ? ";
		  $db->insert_bind($str,array('2',$today,$_SESSION["UserId"],$edit_id)); 
		  
		  echo json_encode(array("rslt"=>"5")); //deletion
	  }
	  	 		
	break;
	
		case 'deleteImg':
				
	$eId = base64_decode($_REQUEST['eId']);
	$eventImgId = base64_decode($_REQUEST['eventsImgId']);
	$str_ed = "SELECT * FROM  ".TPLPrefix."categoryimage where categoryID = ? and catimgid = ?  ";									
	$res_ed = $db->get_a_line_bind($str_ed,array($eId,$eventImgId));
	
	//deleteing  the image from db and server
	 $str_delid = "DELETE FROM  ".TPLPrefix."categoryimage where categoryID = ? and catimgid = ?  ";	
     
    $db->insert_log("delete"," ".TPLPrefix."categoryimage",$edit_id,"categoryimage deleted","categoryimage",$str_delid); 
	$res_delid = $db->get_a_line_bind($str_delid,array($eId,$eventImgId));	
	
	/*$target_dir	= '../uploads/category/'.$eId."/photos/".$res_ed['catimage'];
	$target_dirt	= '../uploads/category/'.$eId."/photos/thumb/".$res_ed['catimage'];
	$target_dirm	= '../uploads/category/'.$eId."/photos/medium/".$res_ed['catimage'];
	$target_dirb	= '../uploads/category/'.$eId."/photos/base/".$res_ed['catimage'];
	unlink($target_dir);
	unlink($target_dirt);
	unlink($target_dirm);
	unlink($target_dirb);*/
    $target_dir	= '../uploads/category/'.$res_ed['catimage'];
    unlink($target_dir);
	
	//header("Location: product_form.php?act=edit&id=".$_REQUEST['prodId']);
	exit;
	break;
	
	
	case 'deletemobileImg':
				
	$eId = base64_decode($_REQUEST['eId']);
	$eventImgId = base64_decode($_REQUEST['eventsImgId']);
	$str_ed = "SELECT * FROM  ".TPLPrefix."category_mobimage where categoryID = ? and cat_mobimgid = ?  ";									
	$res_ed = $db->get_a_line_bind($str_ed,array($eId,$eventImgId));
	
	//deleteing  the image from db and server
	 $str_delid = "DELETE FROM  ".TPLPrefix."category_mobimage where categoryID = ? and cat_mobimgid = ?  ";	
     
    $db->insert_log("delete"," ".TPLPrefix."category_mobimage",$edit_id,"category_mobimage deleted","category_mobimage",$str_delid); 
	$res_delid = $db->get_a_line_bind($str_delid,array($eId,$eventImgId));	
	
	/*$target_dir	= '../uploads/categorymobileimage/'.$eId."/photos/".$res_ed['mobimage'];
	$target_dirt	= '../uploads/categorymobileimage/'.$eId."/photos/thumb/".$res_ed['mobimage'];
	$target_dirm	= '../uploads/categorymobileimage/'.$eId."/photos/medium/".$res_ed['mobimage'];
	$target_dirb	= '../uploads/categorymobileimage/'.$eId."/photos/base/".$res_ed['mobimage'];
	unlink($target_dir);
	unlink($target_dirt);
	unlink($target_dirm);
	unlink($target_dirb);*/
	
	$target_dir	= '../uploads/categorymobileimage/';
	unlink($target_dir);
	//header("Location: product_form.php?act=edit&id=".$_REQUEST['prodId']);
	exit;
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  //$today = date("Y-m-d");
	  $status = $actval;
	  $chkReference_ed_qry = "select categoryID from ".TPLPrefix."category where parentId = ? and IsActive != ? ";
	  $chkReference_ed = $db->get_a_line_bind($chkReference_ed_qry,array($edit_id,'2'));
	  $chk_Ref_there = $chkReference_ed['categoryID'];
	 
		  $str="update ".TPLPrefix."category set IsActive = ?,modifiedDate =?, UserId=?  where categoryID = ? ";
		  $db->insert_log("update"," ".TPLPrefix."category",$edit_id,"Status Changed","Category",$str);
		  $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		  $str="update ".TPLPrefix."category set IsActive = ?,modifiedDate =?, UserId=?  where parent_id = ? ";		  
		  $db->insert_bind($str,array($status,$today,$_SESSION["UserId"],$edit_id)); 	 
		  
		  echo json_encode(array("rslt"=>"6")); //status change
	
	  	 		
	break;
	
	
}


function uploadPortfolio($edit_id,$db,$filename,$lang_id){
 
	/*echo "<br>";
	echo $_FILES[$filename]["name"][0];*/
$getsize = getimagesize_large($db,'categorybanner','category');

$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
	
list($width, $height) = getimagesize($_FILES[$filename]['tmp_name'][0]);
	
$today=date("Y-m-d H:i:s");	
	if(isset($_FILES) && count($_FILES)){
       
    		/*if (!file_exists('../uploads/category/'.$edit_id)) {
    			mkdir('../uploads/category/'.$edit_id, 0777, true);
    		}
    		if (!file_exists('../uploads/category/'.$edit_id."/photos")) {
    			mkdir('../uploads/category/'.$edit_id."/photos", 0777, true);
    		}
    	
    		if (!file_exists('../uploads/category/'.$edit_id."/photos/menu")) {
    			mkdir('../uploads/category/'.$edit_id."/photos/menu", 0777, true);
    		}
    		if (!file_exists('../uploads/category/'.$edit_id."/photos/banner")) {
    			mkdir('../uploads/category/'.$edit_id."/photos/banner", 0777, true);
    		}*/
       //  $edit_id = 1;
		//echo $_FILES[$filename]["name"][0];die();
		if(isset($_FILES[$filename])){
            	
            /*if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth))
			{	*/
		   
				//$target_dir	= '../uploads/category/'.$edit_id."/photos/";
				$target_dir	= '../uploads/category/';
				//echo $target_dir; exit;
				for($i=0;$i<count($_FILES[$filename]["name"]); $i++){
						
				  	$target_file_t = $target_dir.basename($_FILES[$filename]["name"][$i]);					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					  $filenameed = $edit_id."_".$i."_".time().".".$imageFileType;				
				$target_file = $target_dir . $filenameed;	
					//echo $target_file; exit;
					
					/*try{
						move_uploaded_file($_FILES[$filename]["tmp_name"][$i], $target_file);
					}
					catch(Exception $e)
					{
						print_r($e); 
						die();
					}
                     exit;*/
						
				
					if(move_uploaded_file($_FILES[$filename]["tmp_name"][$i], $target_file))						
					{	
					 
							
						    $str = "INSERT INTO ".TPLPrefix."categoryimage(categoryID,catimage,ordering,IsActive,createdDate,modifiedDate,lang_id) values(?,?,?,?,?,?,?) ";
						
						$db->insert_bind($str,array($edit_id,$filenameed,($i+1),'1',$today,$today,$lang_id));
						 $strChk = "select * from ".TPLPrefix."imageconfig where imageconfigModule = ? and IsActive != ? ";		
						$reslt = $db->get_rsltset_bind($strChk,array('categorybanner','2'));
						$counter = 0;
					
						for($mm=0;$mm<count($reslt);$mm++)
						{
							
							list($width, $height) = getimagesize($target_file);
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
							
							if ($_FILES[$filename]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/png")
							$image = imagecreatefrompng($target_file);
						
						
							
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							
						
							
							if($counter == 0)
								 $location = $target_dir."banner/".$filename;
							else if($counter == 1)
								$location = $target_dir."menu/".$filename;
							
						
							if ($_FILES[$filename]["type"][$i] == "image/gif")
								imagegif($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpeg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/png")
								imagepng($image_p,$location, 9);
							
							$counter++;
						}
					}										
				}	
		/*	}
            else
			{
				
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			}*/				
		}			
	}	
}



function uploadPortfoliomob($edit_id,$db,$filename,$lang_id){
	
$getsize = getimagesize_large($db,'categorymobileimage','categorymobileimage');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
//echo $imgheight;
//echo $imgwidth;

list($width, $height, $type, $attr) = getimagesize($_FILES[$filename]['tmp_name'][0]);
//echo "h:". $height;
//echo "w:". $width;

$today=date("Y-m-d H:i:s");	
	if(isset($_FILES) && count($_FILES)){                			
		if(isset($_FILES[$filename])){
           
				$target_dir	= '../uploads/categorymobileimage/';
				for($i=0;$i<count($_FILES[$filename]["name"]); $i++){
						
							$target_file_t = $target_dir.basename($_FILES[$filename]["name"][$i]);					
					$imageFileType = pathinfo($target_file_t,PATHINFO_EXTENSION);
					  $filenameed = $edit_id."_".$i."_".time().".".$imageFileType;				
				$target_file = $target_dir . $filenameed;	
				 
											
					
					if(move_uploaded_file($_FILES[$filename]["tmp_name"][$i], $target_file))	
					{
								
						$str = "INSERT INTO ".TPLPrefix."category_mobimage(categoryID,mobimage,ordering,IsActive,createdDate,modifiedDate,lang_id) values(?,?,?,?,?,?,?) ";
						
						$db->insert_bind($str,array($edit_id,$filenameed,($i+1),'1',$today,$today,$lang_id));
						 $strChk = "select * from ".TPLPrefix."imageconfig where imageconfigModule = ? and IsActive != ? ";		
						$reslt = $db->get_rsltset_bind($strChk,array('categorymobileimage','2'));
						$counter = 0;
					
						for($mm=0;$mm<count($reslt);$mm++)
						{
							
							list($width, $height) = getimagesize($target_file);
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
							
							if ($_FILES[$filename]["type"][$i] == "image/gif")
							$image = imagecreatefromgif($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpeg")
							$image = imagecreatefromjpeg($target_file);
							elseif ($_FILES[$filename]["type"][$i] == "image/png")
							$image = imagecreatefrompng($target_file);
						
						
							
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							
						
							
							if($counter == 0)
								 $location = $target_dir."thumb/".$filename;
							else if($counter == 1)
								$location = $target_dir."medium/".$filename;
							else if($counter == 2)
								$location = $target_dir."base/".$filename;
						
							if ($_FILES[$filename]["type"][$i] == "image/gif")
								imagegif($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/jpeg")
								imagejpeg($image_p,$location, 50);
							elseif ($_FILES[$filename]["type"][$i] == "image/png")
								imagepng($image_p,$location, 9);
							
							$counter++;
						}
					}										
				}	
			/*}
            else
			{
                 echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgwidth/100).': '.round($imgheight/100).') size not matched'));  //no values
				 exit();			
			}*/				
		}			
	}	
}



?>