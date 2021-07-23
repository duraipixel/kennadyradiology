<?php 
$menudisp = "category";
include "includes/header.php"; 
 include "includes/Mdme-functions.php";
$mdme = getMdmeCategory($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$getsize = getimagesize_large($db,'categorybanner','category');

$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

$getsizes = getimagesize_large($db,'categorymobileimage','categorymobileimage');
$imagevals = explode('-',$getsizes);
$imgheights = $imagevals[1];
$imgwidths = $imagevals[0];

$getsizemenuimage = getimagesize_large($db,'categorymenuimage','categorymenuimage');

$imagevalmenuimage = explode('-',$getsizemenuimage);
$imgheightmenuimage = $imagevalmenuimage[1];
$imgwidthmenuimage = $imagevalmenuimage[0];

$id=$_REQUEST['id'];
if($id!="")
{
//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {
?>
<script>
  window.location="error.php";
</script>
<?php	
}
//check edit permission - END	
$operation="Edit";
$act="update";
$btn='Update';

$str_ed = "select * from ".TPLPrefix."category where IsActive != ? and categoryID = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));

$str_ed_es = "select * from ".TPLPrefix."category where parent_id = '".$res_ed['categoryID']."' and lang_id='2' ";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_pt = "select * from ".TPLPrefix."category where parent_id = '".$res_ed['categoryID']."' and lang_id='3' ";
$res_ed_pt = $db->get_a_line($str_ed_pt);


$edit_id = $res_ed['categoryID'];
$edit_id_es = $res_ed_es['categoryID']; 
$edit_id_pt = $res_ed_pt['categoryID'];

 
 $qrycustgroup=" select group_concat(CustomerGrupId) as CustomerGrupId from ".TPLPrefix."category_custgrp where IsActive != '2' and categoryID = '".base64_decode($id)."' ";
$res_custgroup = $db->get_a_line($qrycustgroup); 

//echo $edit_id; exit;
	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
	}
	
	$trendingcat_chk='';
	if($res_ed['trending_categorys']=='1'){	
	$trendingcat_chk='checked';
	}
}
else
{
if(trim($res_modm_prm['AddPrm'])=="0") {
?>
<script>
  window.location="error.php";
</script>
<?php	
}
	//check edit permission - END
	$operation="Add";
	$act="insert";
	$btn='Submit';
}
?>
<?php include "common/dpselect-functions.php";?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php";?>
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Catalog</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li><a href="category_mng.php">Category</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Category</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4><?php echo $operation; ?> Category</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
			
			<div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs  mb-3 mt-3" id="iconTab" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" id="generals" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="flaticon-user-11"></i> English</a> </li>
                     
                      <li class="nav-item"> <a class="nav-link"  data-toggle="tab" id="related" href="#relatedpro" role="tab" aria-controls="relatedpro" aria-selected="false"><i class="flaticon-map"></i> Spanish</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="suggested" data-toggle="tab" href="#suggestedpro" role="tab" aria-controls="suggestedpro" aria-selected="false"><i class="flaticon-menu-list"></i> Portuguese</a> </li>
					
                    </ul>
					 
                    <div class="tab-content"> 
               
                <!--English - START -->
                    <div class="tab-pane active" id="general">
                     
                      <div class="row box-body fillterbtn" id="" style="" >
                        <div class="row">
                <div class="col-md-11 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtcategory" id="txtcategory"  value="<?php echo $res_ed['categoryName']; ?>" onblur="generateslug(this.value,'categoryCode');" onChange="generateslug(this.value,'categoryCode');" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Parent Category <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php 		 	$IsCatParentChildOnly=getQuerys($db,"IsCatParentChildOnly")['value'];
										
										  if($act=="update"){
											  if (isset($chk_Ref_there)) {
										  ?>
                            <input type="hidden" name="parentcategory" value="<?php echo $res_ed['categoryID']; ?>" />
                            <?php	
											  
											  if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],$res_ed['categoryID'],'disabled');
											  else	
												echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0',$res_ed['parentId'],$res_ed['categoryID'],'disabled');	  
											  }
											  else{
												if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],$res_ed['categoryID']);
											  else	
												echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0',$res_ed['parentId'],$res_ed['categoryID']);   
											  }							  
										  }
										  else{
											   if($IsCatParentChildOnly==1)
												 echo getSelectBox_categoryparentonly($db,'parentcategory','jsrequired','',$res_ed['parentId'],'');
											 else
												 echo getSelectBox_categorylist($db,'parentcategory','jsrequired','0','0'); 
										  }
										 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control alphaonly" required name="categoryCode" id="categoryCode" value="<?php echo $res_ed['categoryCode']; ?>">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">HSN Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="hsncode" id="hsncode"  value="<?php echo $res_ed['hsncode']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="categoryDesc" name = "categoryDesc" class="texteditor"><?php echo  $res_ed['categoryDesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Menu Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categorymenuimage" name="categorymenuimage" type="file" fi-type=""  >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedmenuimage">
                                <?php
			 
			if($res_ed['categorymenuimage'] != ''){								
				?>
                              <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
            
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."category/categorymenuimage/".$res_ed['categorymenuimage']; ?>" />
          </div>
        </div>
        
      </div>
    </div>
  </li> 
		 
			
            </ul></div>
                              
                            	<?php
			}
			?>  </div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidthmenuimage.'*'.$imgheightmenuimage; ?>) </small>
                        </div>
                      </div>
                      
                      
                       </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Banner<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categoryImage" name="categoryImage[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedevents">		</div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small>
                        </div>
                      </div>
                      
                      
                       </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Category Mobile Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="mobimage" name="mobimage[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                           
                          </div>
                          <div class="form-upload" id="uploadedmobileimage">					
                        </div>
                          <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small>
                        </div>
                      </div>
                      </div>
					  
					 <div class="row" style="display:none">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Customer Group</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <?php echo getmutlipleselect_Customergroups($db,'customer_group_id','multiselect',$res_custgroup['CustomerGrupId']);  ?>
                            
                          </div>
                        </div>
                      </div>
                    </div> 
					  
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Title</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetatitle" id="categoryMetatitle" value="<?php echo $res_ed['categoryMetatitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Description</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="categoryMetadesc" id="categoryMetadesc" ><?php echo $res_ed['categoryMetadesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetakey" id="categoryMetakey" value="<?php echo $res_ed['categoryMetakey']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Trending Category </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"  class="new-control-input" value="1" name="chktrendingcategorys" id="chktrendingcategorys" <?php echo $trendingcat_chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" required class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                 
                </div>
              </div>
                      </div>
					  
					  
					     <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onclick="return formvalidationcat(1)">Next</button> 
										
                          
                           
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <!-- /.col --> 
					  </form>
                    </div>
                    
                    
                    <!--Spanish - START -->
                    <div class="tab-pane" id="relatedpro">
                     <form name="esformcat" id="esformcat" method="post">
                      <div class="row box-body fillterbtn" id="" style="" >
                            <div class="row">
                <div class="col-md-11 mx-auto">
                 
                    <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?>"  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Category Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtcategory_es" id="txtcategory_es"  value="<?php echo $res_ed_es['categoryName']; ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                 
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> HSN Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="hsncode_es" id="hsncode_es"  value="<?php echo $res_ed_es['hsncode']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="categoryDesc_es" name = "categoryDesc_es" class="texteditor"><?php echo  $res_ed_es['categoryDesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Category Menu Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categorymenuimage_es" name="categorymenuimage_es" type="file" fi-type=""  >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedmenuimage_es">
                                <?php
			 
			if($res_ed_es['categorymenuimage'] != ''){								
				?>
                              <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
            
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."category/categorymenuimage/".$res_ed_es['categorymenuimage']; ?>" />
          </div>
        </div>
        
      </div>
    </div>
  </li> 
		 
			
            </ul></div>
                              
                            	<?php
			}
			?>  </div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidthmenuimage.'*'.$imgheightmenuimage; ?>) </small>
                        </div>
                      </div>
                      
                      
                       </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Category Banner<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categoryImage_es" name="categoryImage_es[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedevents_es">		</div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small>
                        </div>
                      </div>
                      
                      
                       </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Category Mobile Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="mobimage_es" name="mobimage_es[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                           
                          </div>
                          <div class="form-upload" id="uploadedmobileimage_es">					
                        </div>
                          <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small>
                        </div>
                      </div>
                      </div>
			 
					  
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Meta Title</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetatitle_es" id="categoryMetatitle_es" value="<?php echo $res_ed_es['categoryMetatitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Meta Description</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="categoryMetadesc_es" id="categoryMetadesc_es" ><?php echo $res_ed_es['categoryMetadesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetakey_es" id="categoryMetakey_es" value="<?php echo $res_ed_es['categoryMetakey']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                </div>
              </div>
                      
                      </div>
                      
                      <!-- /.col --> 
					  </form>
					    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onclick="return formvalidationcat(2)">Next</button> 
										
                          
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    
                    <!--Portuguese - START -->
                    <div class="tab-pane" id="suggestedpro">
                      <form name="ptformcat" id="ptformcat" method="post">
                      <div class="row box-body fillterbtn"  style="" >
                         <div class="row">
                <div class="col-md-11 mx-auto">
                 
                    <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?>"  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Category Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtcategory_pt" id="txtcategory_pt"  value="<?php echo $res_ed_pt['categoryName']; ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                 
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> HSN Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="hsncode_pt" id="hsncode_pt"  value="<?php echo $res_ed_pt['hsncode']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="categoryDesc_pt" name = "categoryDesc_pt" class="texteditor"><?php echo  $res_ed_pt['categoryDesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Category Menu Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categorymenuimage_pt" name="categorymenuimage_pt" type="file" fi-type=""  >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedmenuimage_pt">
                                <?php
			 
			if($res_ed_pt['categorymenuimage'] != ''){								
				?>
                              <div class="jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid">
            
                
                  <li class="jFiler-item" data-jfiler-index="0" style="">
    <div class="jFiler-item-container">
      <div class="jFiler-item-inner">
        <div class="jFiler-item-thumb">
         
          <div class="jFiler-item-thumb-image">
         	<img width="250" height="250" src="<?php echo IMG_BASE_URL."category/categorymenuimage/".$res_ed_pt['categorymenuimage']; ?>" />
          </div>
        </div>
        
      </div>
    </div>
  </li> 
		 
			
            </ul></div>
                              
                            	<?php
			}
			?>  </div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidthmenuimage.'*'.$imgheightmenuimage; ?>) </small>
                        </div>
                      </div>
                      
                      
                       </div>
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Category Banner<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="categoryImage_pt" name="categoryImage_pt[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                            
                           
                            
                          </div>
                              <div class="form-upload" id="uploadedevents_pt">		</div> <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Category Mobile Image<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="categoryImage" <?php if($act=="insert"){?>required<?php }?> id="mobimage_pt" name="mobimage_pt[]" type="file" fi-type="" multiple="multiple" >
                            <p class="help-block"></p>
                           
                          </div>
                          <div class="form-upload" id="uploadedmobileimage_pt">					
                        </div>
                          <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small>
                        </div>
                      </div>
                      </div>
			 
					  
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Meta Title</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetatitle_pt" id="categoryMetatitle_pt" value="<?php echo $res_ed_pt['categoryMetatitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Meta Description</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="categoryMetadesc_pt" id="categoryMetadesc_pt" ><?php echo $res_ed_pt['categoryMetadesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="categoryMetakey_pt" id="categoryMetakey_pt" value="<?php echo $res_ed_pt['categoryMetakey']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                </div>
              </div>
                      </div>
                      <!-- /.box-body --> 
					  
					     <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmtWithImg('frmCategory','category_actions.php','jvalidate','category','category_mng.php');"><?php echo $btn; ?></button>
                             <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmCategory','jvalidate','category','category_mng.php');">Cancel</button>
										
                          
                           
                          </div>
                        </div>
                      </div>
                    </div>
					
					  </form>
                    </div>
                    <!-- /.box --> 
					
					
                  
                  </div>
                 
                  
                </div>
              </div>
            </div>
          </div>     
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  END CONTENT PART  --> 
</div>
<!-- END MAIN CONTAINER --> 

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->

 <script type="text/javascript" src="assets/js/multiple-select.js"></script>
<script>

function funSubmtWithImg($frm, $urll, $acts, $stats, $lodlnk) {
         
         if ($('#' + $acts).valid()) {
        
            var m_data = new FormData();

            var formdatas = $("#" + $acts+',#esformcat,#ptformcat').serializeArray();

            $.each(formdatas, function(key, value) {
                m_data.append(value.name, value.value);
            });
						     
			if($stats == 'productfeature'){	
    		    
    				
                  	var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){    				
    				 	m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
    			  	}    				
    			
    		}
			
			 
			 if($stats == 'product'){	
    		    
    				
                  	var inputs = $("input[type=file]");			
    			  	for(var i=0; i<inputs.length; i++){    				
    				 	m_data.append(inputs[i].name, $("input[type=file]")[i].files[0]);
    			  	}    				
    			
    		}
			
    		
    		if($stats == 'category'){	
			//m_data.append('menuimage', $('input[name=categorymenuimage]')[0].files[0]);
				
				var fileInputm = document.getElementById ("categorymenuimage");
                var messagem = "";
                if ('files' in fileInputm) {
                    if (fileInputm.files.length == 0) {
                        messagem = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm.files.length; i++) {
                            messagem += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm.files[i];
                            m_data.append('menuimage', file);                       
                        }
                    }
                }
				
				
				var fileInputm_es = document.getElementById ("categorymenuimage_es");
                var messagem_es = "";
                if ('files' in fileInputm_es) {
                    if (fileInputm_es.files.length == 0) {
                        messagem_es = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm_es.files.length; i++) {
                            messagem_es += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm_es.files[i];
                            m_data.append('menuimage_es', file);                       
                        }
                    }
				}
					
				var fileInputm_pt = document.getElementById ("categorymenuimage_pt");
                var messagem_pt = "";
                if ('files' in fileInputm_pt) {
                    if (fileInputm_pt.files.length == 0) {
                        messagem_pt = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInputm_pt.files.length; i++) {
                            messagem_pt += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInputm_pt.files[i];
                            m_data.append('menuimage_pt', file);                       
                        }
                    }
                }
				
    		
    			var fileInput = document.getElementById ("categoryImage");
                var message = "";
                if ('files' in fileInput) {
                    if (fileInput.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput.files.length; i++) {
                            message += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput.files[i];
                            m_data.append('categoryImage[]', file);                       
                        }
                    }
                }	
				
				var fileInput_es = document.getElementById ("categoryImage_es");
                var messagees = "";
                if ('files' in fileInput_es) {
                    if (fileInput_es.files.length == 0) {
                        messagees = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_es.files.length; i++) {
                            messagees += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_es.files[i];
                            m_data.append('categoryImage_es[]', file);                       
                        }
                    }
                }
				
				var fileInput_pt = document.getElementById ("categoryImage_pt");
                var messagept = "";
                if ('files' in fileInput_pt) {
                    if (fileInput_pt.files.length == 0) {
                        messagept = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_pt.files.length; i++) {
                            messagept += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_pt.files[i];
                            m_data.append('categoryImage_pt[]', file);                       
                        }
                    }
                }
    			
    			var fileInput = document.getElementById ("mobimage");
    			
                var message = "";
                if ('files' in fileInput) {
                    if (fileInput.files.length == 0) {
                        message = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput.files.length; i++) {
                            message += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput.files[i];
                            m_data.append('mobimage[]', file);                       
                        }
                    }
                }

var fileInput_es = document.getElementById ("mobimage_es");
    			
                var message_es = "";
                if ('files' in fileInput_es) {
                    if (fileInput_es.files.length == 0) {
                        message_es = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_es.files.length; i++) {
                            message_es += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_es.files[i];
                            m_data.append('mobimage_es[]', file);                       
                        }
                    }
                }
				
				var fileInput_pt = document.getElementById ("mobimage_pt");
    			
                var message_pt = "";
                if ('files' in fileInput_pt) {
                    if (fileInput_pt.files.length == 0) {
                        message_pt = "Please browse for one or more files.";
                    } else {
                        for (var i = 0; i < fileInput_pt.files.length; i++) {
                            message_pt += "<br /><b>" + (i+1) + ". file</b><br />";
                            var file = fileInput_pt.files[i];
                            m_data.append('mobimage_pt[]', file);                       
                        }
                    }
                }	

				
    		}    		
			 
	 
		
 

            $.ajax({
                url: $urll,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: m_data,
                beforeSend: function() {
                  
				  // loading();
                },
                success: function(response) {
						// $('button').removeAttr("disabled");
                    if (response.rslt == "1") {
						
						 toast({type: 'success',title:$stats + ' ' + sucmsg,padding: '1em'});
                         $("#" + $acts)[0].reset();

                        setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    } 
					else if (response.rslt == "2") {
						 toast({type: 'success',title:$stats + ' ' + upmsg,padding: '1em'});
						 $("#" + $acts)[0].reset();
						 
                         setTimeout(function() {
                            window.location.href = $lodlnk;
                        }, 1200);
                    }                                        
                    else if (response.rslt == "3") {
						 toast({type: 'warning',title:exsmsg,padding: '1em'});
                    }
					else if (response.rslt == "4") {
                        toast({type: 'warning',title:$stats + ' ' + reqmsg,padding: '1em'});						
                    } 
					else if (response.rslt == '7') {
                         toast({type: 'warning',title:exsmsg_refstats,padding: '1em'});
                    }
					else if (response.rslt == '17') {
                         toast({type: 'warning',title:"Image field required",padding: '1em'});
                    }
					else if (response.rslt == "8") {
                        toast({type: 'warning',title:$stats + ' ' + response.msg,padding: '1em'});
                    } 
					else if (response.rslt == "9") {
                        $("#bulk_upload_result").css({
                            "background-color": "#FFC0C0",
                            "color": "#800000"
                        });
                        $("#bulk_upload_result").show();
                        $("#bulk_upload_result").empty();
                        $("#bulk_upload_result").append("<br><h4><b>&nbspUpload Summary : Error List</b></h4><br>");
						
                        $("#bulk_upload_result").append(response.all_error + "<br>");
                    }
					else if (response.rslt == "11") {
						 toast({type: 'warning',title:".xls is the only allowed file format.",padding: '1em'});
                    }
					else {
                        toast({type: 'warning',title:othmsg,padding: '1em'});
                    }

                    if (response.rslt != "1" && response.rslt != "2") {
					
					unloading();
					}
                 
				//  $("button").attr('disabled',false); 

                }
            });
        }
    }

$(function() {
 
    $(".multiselect").multipleSelect({
            width: 460
          
            
        })
		<?php if($res_custgroup['CustomerGrupId']=='') { ?>
		.multipleSelect("checkAll");
		<?php } ?>
		;
});
$(document).ready(function(){
	$(".categoryImage").filer({
		limit: null,
		maxSize: null,
		extensions: ['jpg', 'jpeg', 'png', 'gif'],
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
		showThumbs: true,
		theme: "dragdropbox",
		templates: {
			box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left">\
											<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
										</ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			canvasImage: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-items-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action'
			}
		},
		dragDrop: {
			dragEnter: null,
			dragLeave: null,
			drop: null,
			dragContainer: null,
		} 
	});
});
	
	

	$(".tree .expander").eq(0).remove();
	<?php if($edit_id != ""){ ?>		
		getEventsImages('<?php echo base64_encode($edit_id); ?>','uploadedevents','geteventImage');
		getEventsImages('<?php echo base64_encode($edit_id_es); ?>','uploadedevents_es','geteventImage_es');
		getEventsImages('<?php echo base64_encode($edit_id_pt); ?>','uploadedevents_pt','geteventImage_pt');
	<?php } ?>	
	
function getEventsImages(eventsid,fileata,filefield){
	$.post("category_actions.php",{eventsid:eventsid,filefield:filefield},function(data){
		$("#"+fileata).html(data);
		
		if(data == ''){
			$('#categoryImage').attr("required", "true");
		}else{
			
		}
	});
}

function deleventImg(eventImgId,eId){		 
	  var action = "deleteImg";	
	  $.post("<?php echo BASE_URL; ?>category_actions.php",{eventsImgId:eventImgId,"eId":eId,action:action},function(response){	
				getEventsImages(eId);
			}
	  )
}


<?php if($edit_id != ""){ ?>		 
	
		getmobileImages('<?php echo base64_encode($edit_id); ?>','uploadedmobileimage','getmobileImage');
		getmobileImages('<?php echo base64_encode($edit_id_es); ?>','uploadedmobileimage_es','getmobileImage_es');
		getmobileImages('<?php echo base64_encode($edit_id_pt); ?>','uploadedmobileimage_pt','getmobileImage_pt');
	<?php } ?>	

function getmobileImages(eventsid,fileata,filefield){
	$.post("category_actions.php",{eventsid:eventsid,mobfilefield:filefield},function(data){
		$("#"+fileata).html(data);
		if(data == ''){
			$('#mobimage').attr("required", "true");
		}else{
			
		}
	});
}


function delmobileImg(eventImgId,eId){		 
	  var action = "deletemobileImg";	
	  $.post("<?php echo BASE_URL; ?>category_actions.php",{eventsImgId:eventImgId,"eId":eId,action:action},function(response){	
				getmobileImages(eId);
			}
	  )
}
function formvalidationcat(formid){
//	$('#esformcat').valid() && $('#ptformcat').valid();
	
	if(formid == 1){
		if($('#jvalidate').valid()){
		$('#related').trigger('click');
		$('#esformcat').valid();
		}
	}else if(formid == 2){
		if($('#esformcat').valid()){
		$('#suggested').trigger('click');
		$('#ptformcat').valid();
		}else{ return false;
		}
	}
}
</script>
