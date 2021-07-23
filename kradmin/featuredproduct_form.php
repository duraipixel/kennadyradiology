<?php 
$menudisp = "featuredproduct";
include "includes/header.php"; 
 include "includes/Mdme-functions.php";
 
//$id=$_REQUEST['id'];
$id=base64_decode($_REQUEST['pid']);

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


$str_ed_prod = "SELECT * FROM  `".TPLPrefix."product` t1	where t1.product_id = '".$id."'";				
$prod_res_ed = $db->get_a_line($str_ed_prod);


 
  $str_ed = "select * from ".TPLPrefix."product_feature where IsActive != ? and product_id = ? ";
  $res_ed = $db->get_a_line_bind($str_ed,array(2,$id));
  
    $edit_id = $res_ed['featureid'];
    
    $chk='';
    if($res_ed['IsActive']=='1')
    {
    	$chk='checked';
    }
	
	if($edit_id == ''){
		$operation="Add";
		$act="insert";
		$btn='Submit';
	}else{
		$operation="Edit";
		$act="update";
		$btn='Update';
	}
    
 	 
}
else
{
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
          <h3>Featured Product</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
            <li><a href="product_mng.php">Manage Product</a></li>
              <li><a href="product_form.php?act=edit&id=<?php echo base64_encode($prod_res_ed['product_id']);?>"><?php echo $prod_res_ed['product_name'];?></a></li>
              <li class="active"><a href="#"><?php //echo $operation; ?> Featured Product</a> </li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 mt-1">
                 <div class="row">
                      <div class="col col-md-12">
                        <div class="control-group mb-4 "> <h4><span class="typo-section-head">Product Name:</span> <?php echo $prod_res_ed['product_name'];?></h4> <h4><span class="typo-section-head">Product SKU:</span> <?php echo $prod_res_ed['sku'];?></h4></div>
                         </div>
                         </div>
                </div>
              </div>
            </div>
           </div>
         </div>
      
        <div class="col-lg-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4><?php echo $operation; ?> Featured Product</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmFeatured" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $id;?>" />
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Choose Theme</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls"> <?php echo getSelectBox_theme($db,'themeid','',$res_ed['themeid'],'required onchange="themedisplay(this.value)"');	?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row" id="showimage">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          &nbsp;
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls"> 
                         
						  <div class="popup-gallery" id="themeimg">
                               <!--     <a href="<?php echo IMG_BASE_URL;?>theme/theme1.png" class="mr-0 image-popup-fit-width" title="Theme 1">
                                        <img alt="image-gallery" src="<?php echo IMG_BASE_URL;?>theme/theme1.png" class="mr-0" width="130" height="100">
                                    </a>
                                    <a href="<?php echo IMG_BASE_URL;?>theme/theme2.png" class="mr-0 image-popup-fit-width" title="Theme 2">
                                        <img alt="image-gallery" src="<?php echo IMG_BASE_URL;?>theme/theme2.png" class="mr-0" width="130" height="100">
                                    </a>
                                    <a href="<?php echo IMG_BASE_URL;?>theme/theme3.png" class="mr-0 image-popup-fit-width"  title="Theme 3">
                                        <img alt="image-gallery" src="<?php echo IMG_BASE_URL;?>theme/theme3.png" class="mr-0" width="130" height="100">
                                    </a>-->
                                    
                                </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row shwd">&nbsp;</div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner image<?php echo $res_ed['backgroundimage']; ?></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <input type="file" name="thembanner" id="thembanner" class="common_upload_style" <?php if($act == 'insert'){?> required <?php }?> />
                            <p class="help-block"></p>
                          </div>
                          <?php 
									if (!empty($res_ed['bannerimage']) && ($act == 'update')) { 
									  if(file_exists("../uploads/featureuploads/banner/".$res_ed['bannerimage']))
									   { ?>
                           <span class="simple">
                                    <a href="<?php echo IMG_BASE_URL;?>featureuploads/banner/<?php echo $res_ed['bannerimage']; ?>" class="mr-0 image-popup-vertical-fit" >
                                        <img alt="image-popup-vertical-fit" src="<?php echo IMG_BASE_URL;?>featureuploads/banner/<?php echo $res_ed['bannerimage']; ?>" class="mr-0" width="80" height="30">
                                    </a>
                                    </span><br /><br />
                                    
                                 <!--   <img src="../uploads/featureuploads/banner/<?php echo $res_ed['bannerimage']; ?>" width="30px" align="absmiddle"/>-->
                          <?php
									   }
									   else{ ?>
                          <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                          <?php }
									 } 
									 ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Title</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <input type="text" class="form-control" required name="bannertitle" id="bannertitle" value="<?php echo $res_ed['bannertitle']; ?>"/>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Liner</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <input type="text" class="form-control" required name="bannerlinar" id="bannerlinar" value="<?php echo $res_ed['bannerlinar']; ?>"/>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row"> <span class="typo-section-head">
                      <h6><i class="fa fa-th"></i>Special Feature </h6>
                      </span>
                      <div></div>
                    </div>
                    
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Specification Liner Title</label>
                        </div>
                      </div>
                      <div class="col col-md-8">
                        <div class="control-group">
                          <div class="controls">
                           <textarea class="form-control texteditor"  name="mspecificationtitle" id="mspecificationtitle" required><?php echo $res_ed['mspecificationtitle']; ?></textarea>
                         
                             <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Specification Liner Description</label>
                        </div>
                      </div>
                      <div class="col col-md-8">
                        <div class="control-group">
                          <div class="controls">
                           <textarea class="form-control texteditor" name="mspecificationdesc" id="mspecificationdesc" required><?php echo $res_ed['mspecificationdesc']; ?></textarea>
                         
                         
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="row">
                    
                    
                      <div id="specialoptionDiv">
                        <?php  $str_special = "select * from ".TPLPrefix."product_specialfeature where featureid = '".$edit_id."' and IsActive=1 ";
	  $specialfeature = $db->get_rsltset($str_special);
	  if(count($specialfeature)=='0'){ ?>
                        <div class="" id="row0">
                          <div class="row" style="font-weight:bold">
                            <div class="col-sm-3">Short Description</div>
                            <div class="col-sm-3">&nbsp;&nbsp;&nbsp;Background image</div>
                            <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Icons</div>
                            <div class="col-sm-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorting</div>
                            <div class="col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3 no-padding-right">
                            <input type="text" class="dropdownClass form-control" name="shortdescription0" id="shortdescription0" required/>
                          </div>
                          <div class="col-sm-3 no-padding-right">
                            <div class="col-sm-10">
                              <input id="featureattributebanner0" class="common_upload_style" name="featureattributebanner0" type="file"   <?php if($act == 'insert'){?>  <?php }?>/>
                            </div>
                          </div>
                          <div class="col-sm-3 no-padding-right">
                            <div class="col-sm-10">
                              <input id="featureImages0" class="common_upload_style" name="featureImages0" type="file"   <?php if($act == 'insert'){?> required <?php }?>/>
                            </div>
                            <!--   <label for="featureImages0" class="browseimg" > Browse</label>--> 
                          </div>
                          <div class="col-sm-1 no-padding-right">
                            <input type="text" class="form-control" name="dropdownSort0" id="dropdownSort0" onkeypress="return isNumber(event)" required/>
                          </div>
                          <div class="col-sm-2"> <a href="javascript:add_special_option();" class="add_front"><i class="flaticon-add-circle-outline"></i></a> </div>
                        </div>
                        <input type="hidden" name="special_option_count" id="special_option_count" value="1" />
                        <input type="hidden" name="special_option_max_count" id="special_option_max_count" value="1" />
                        <?php }else{ 
								$j=0;
								foreach($specialfeature as $specialfeatureval){ ?>
                        <input type="hidden" name="option_edit_id<?php echo $j; ?>" id="option_edit_id<?php echo $j; ?>" value="<?php echo $specialfeatureval['specialid']; ?>" />
                        <div class="" id="row_option<?php echo $j; ?>">
                          <?php if($j == 0){?>
                          <div class="row" style="font-weight:bold">
                            <div class="col-sm-3">Short Description</div>
                            <div class="col-sm-3">&nbsp;&nbsp;&nbsp;Background image</div>
                            <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Icons</div>
                            <div class="col-sm-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorting</div>
                            <div class="col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</div>
                          </div>
                          <?php }?>
                          <div class="row">
                            <div class="col-sm-3 no-padding-right">
                              <input type="text" class="dropdownClass form-control" value="<?php echo $specialfeatureval['shortdescription'];?>" name="shortdescription<?php echo $j; ?>" id="shortdescription<?php echo $j; ?>" required/>
                            </div>
                            <div class="col-sm-3 no-padding-right">
                              <div class="col-sm-10">
                                <input id="featureattributebanner<?php echo $j; ?>" class="common_upload_style" name="featureattributebanner<?php echo $j; ?>" type="file"   <?php if($act == 'insert'){?>  <?php }?>/>
                                <?php 
									if (!empty($specialfeatureval['backgroundimage']) && ($act == 'update')) { 
									  if(file_exists("../uploads/featureuploads/specialfeature/banner/".$specialfeatureval['dropdown_images']))
									   { ?>
                                       <span class="simple">
                                    <a href="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/banner/<?php echo $specialfeatureval['backgroundimage']; ?>" class="mr-0 image-popup-vertical-fit" >
                                        <img alt="image-popup-vertical-fit" src="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/banner/<?php echo $specialfeatureval['backgroundimage']; ?>" class="mr-0" width="30" height="30">
                                    </a>
                                    </span>
                              <!--  <img src="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/banner/<?php echo $specialfeatureval['backgroundimage']; ?>" width="30px" align="absmiddle"/>
                             -->   <?php
									   }
									   else{ ?>
                                <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                                <?php }
									 } 
									 ?>
                              </div>
                            </div>
                            <div class="col-sm-3 no-padding-right">
                              <div class="col-sm-10">
                                <input id="featureImages<?php echo $j; ?>" class="common_upload_style" name="featureImages<?php echo $j; ?>" type="file"   <?php if($act == 'insert'){?> required <?php }?>/>
                                <?php 
									if (!empty($specialfeatureval['featureicon']) && ($act == 'update')) { 
									  if(file_exists("../uploads/featureuploads/specialfeature/icon/".$specialfeatureval['featureicon']))
									   { ?>
                                       
                                       <span class="simple">
                                    <a href="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/icon/<?php echo $specialfeatureval['featureicon']; ?>" class="mr-0 image-popup-vertical-fit" >
                                        <img alt="image-popup-vertical-fit" src="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/icon/<?php echo $specialfeatureval['featureicon']; ?>" class="mr-0 img-border " width="30" height="30">
                                    </a>
                                    </span>
                                    
                                    
                           <!--     <img class="img-border" src="<?php echo IMG_BASE_URL;?>featureuploads/specialfeature/icon/<?php echo $specialfeatureval['featureicon']; ?>" width="30px" align="absmiddle"/>-->
                                <?php
									   }
									   else{ ?>
                                <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                                <?php }
									 } 
									 ?>
                              </div>
                              <!--   <label for="featureImages0" class="browseimg" > Browse</label>--> 
                            </div>
                            <div class="col-sm-1 no-padding-right">
                              <input type="text"  value="<?php echo $specialfeatureval['sortingorder'];?>" class="form-control" name="dropdownSort<?php echo $j; ?>" id="dropdownSort<?php echo $j; ?>" onkeypress="return isNumber(event)" required/>
                            </div>
                            <div class="col-sm-2">
                              <?php if($j!=0){
									// if(trim($res_modm_prm['DeletePrm'])=="1") {?>
                              <a class="remove_front" href="javascript:void(0)" onclick="remove_special_option('<?php echo $j; ?>','<?php echo $specialfeatureval['specialid']; ?>');" ><i class="flaticon-delete-1"></i></a>
                              <?php //}
			 }else{?>
                              <a class="add_front" href="javascript:add_special_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; &nbsp;
                              <?php }?>
                            </div>
                          </div>
                        </div>
                        <?php 
											$j++;
										}  ?>
                        <input type="hidden" name="special_option_count" id="special_option_count" value="<?php echo count($specialfeature); ?>" />
                        <input type="hidden" name="special_option_max_count" id="special_option_max_count" value="<?php echo count($specialfeature); ?>" />
                        <?php } ?>
                        <div id="special_option_div"> </div>
                      </div>
                    </div>
                    
                    <!--- specification--->
                    
                    <div class="control-group mb-4"> &nbsp; </div>
                    <div class="row"> <span class="typo-section-head">
                      <h6><i class="fa fa-th"></i>Specifications </h6>
                      </span>
                      <div></div>
                    </div>
                    <div class="row">
                      <div id="specificationoptionDiv">
                        <?php  $str_specification = "select * from ".TPLPrefix."feature_specification where featureid = '".$edit_id."' and IsActive=1 ";
	  $res_specification = $db->get_rsltset($str_specification);
	  
	  if(count($res_specification)=='0'){ ?>
                        <div class="" id="specificationrow0">
                          <div class="row" style="font-weight:bold">
                            <div class="col-sm-3">Title</div>
                            <div class="col-sm-3">&nbsp;&nbsp;&nbsp;Image</div>
                            <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Value</div>
                            <div class="col-sm-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorting</div>
                            <div class="col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3 no-padding-right">
                            <input type="text" class="dropdownClass form-control" name="specificationtitle0" id="specificationtitle0" required/>
                          </div>
                          <div class="col-sm-3 no-padding-right">
                            <div class="col-sm-10">
                              <input id="specimage0" class="common_upload_style" name="specimage0" type="file" />
                            </div>
                          </div>
                          <div class="col-sm-3 no-padding-right">
                            <div class="col-sm-10">
                              <input id="specvalue0" class="form-control" name="specvalue0" type="text" required/>
                            </div>
                          </div>
                          <div class="col-sm-1 no-padding-right">
                            <input type="text" class="form-control" name="specdropdownSort0" id="specdropdownSort0" onkeypress="return isNumber(event)" required/>
                          </div>
                          <div class="col-sm-2"> <a href="javascript:add_specification_option();" class="add_front"><i class="flaticon-add-circle-outline"></i></a> </div>
                        </div>
                        <input type="hidden" name="specification_option_count" id="specification_option_count" value="1" />
                        <input type="hidden" name="specification_option_max_count" id="specification_option_max_count" value="1" />
                        <?php }else{ 
								$m=0;
								foreach($res_specification as $res_specificationval){ ?>
                        <input type="hidden" name="specification_option_edit_id<?php echo $m; ?>" id="specification_option_edit_id<?php echo $m; ?>" value="<?php echo $res_specificationval['specificationid']; ?>" />
                        <div class="" id="specification_row_option<?php echo $m; ?>">
                          <?php if($m == 0){?>
                          <div class="row" style="font-weight:bold">
                            <div class="col-sm-3">Title</div>
                            <div class="col-sm-3">&nbsp;&nbsp;&nbsp;Image</div>
                            <div class="row col-sm-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Value</div>
                            <div class="col-sm-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorting</div>
                            <div class="col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</div>
                          </div>
                          <?php }?>
                          <div class="row">
                            <div class="col-sm-3 no-padding-right">
                              <input type="text" class="dropdownClass form-control" name="specificationtitle<?php echo $m; ?>" id="specificationtitle<?php echo $m; ?>" required value="<?php echo $res_specificationval['spectitle'];?>"/>
                            </div>
                            <div class="col-sm-3 no-padding-right">
                              <div class="col-sm-10">
                                <input id="specimage<?php echo $m; ?>" class="common_upload_style" name="specimage<?php echo $m; ?>" type="file"  <?php if($act == 'insert'){?>  <?php }?>/>
                                <?php 
									if (!empty($res_specificationval['specimage']) && ($act == 'update')) { 
									  if(file_exists("../uploads/featureuploads/specification/".$res_specificationval['specimage']))
									   { ?>
                                        <span class="simple">
                                    <a href="<?php echo IMG_BASE_URL;?>featureuploads/specification/<?php echo $res_specificationval['specimage']; ?>" class="mr-0 image-popup-vertical-fit" >
                                        <img alt="image-popup-vertical-fit" src="<?php echo IMG_BASE_URL;?>featureuploads/specification/<?php echo $res_specificationval['specimage']; ?>" class="mr-0" width="30" height="30">
                                    </a>
                                    </span>
                                    
<!--                                <img src="<?php echo IMG_BASE_URL;?>featureuploads/specification/<?php echo $res_specificationval['specimage']; ?>" width="30px" align="absmiddle"/>
-->                                <?php
									   }
									   else{ ?>
                                <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                                <?php }
									 } 
									 ?>
                              </div>
                            </div>
                            <div class="col-sm-3 no-padding-right">
                              <div class="col-sm-10">
                                <input id="specvalue<?php echo $m; ?>" class="form-control" name="specvalue<?php echo $m; ?>" type="text" required value="<?php echo $res_specificationval['specvalue'];?>"/>
                              </div>
                            </div>
                            <div class="col-sm-1 no-padding-right">
                              <input type="text" class="form-control" name="specdropdownSort<?php echo $m; ?>" id="specdropdownSort<?php echo $m; ?>" onkeypress="return isNumber(event)" required value="<?php echo $res_specificationval['sortingorder'];?>"/>
                            </div>
                            <div class="col-sm-2">
                              <?php if($m!=0){
									// if(trim($res_modm_prm['DeletePrm'])=="1") {?>
                              <a class="remove_front" href="javascript:void(0)" onclick="remove_specification_option('<?php echo $m; ?>','<?php echo $res_specificationval['specificationid']; ?>');" ><i class="flaticon-delete-1"></i></a>
                              <?php //}
			 }else{?>
                              <a class="add_front" href="javascript:add_specification_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; &nbsp;
                              <?php }?>
                            </div>
                          </div>
                        </div>
                        <?php 
											$m++;
										}  ?>
                        <input type="hidden" name="specification_option_count" id="specification_option_count" value="<?php echo count($res_specification); ?>" />
                        <input type="hidden" name="specification_option_max_count" id="specification_option_max_count" value="<?php echo count($res_specification); ?>" />
                        <?php } ?>
                        <div id="specification_option_div"> </div>
                      </div>
                    </div>
                    
                    <!--- additional feature--->
                    
                    <div class="control-group mb-4"> &nbsp; </div>
                    <div class="row"> <span class="typo-section-head">
                      <h6><i class="fa fa-th"></i>Additional Feature Section </h6>
                      </span> <br />
<!--                      <small class="text-red">&nbsp;(For All feature images size should be 600*535 | Video image size should be 1600 * 680 | Full width image size should be 970 * 800)</small>
-->                      <div></div>
                    </div>
                    <div class="row">
                      <div id="additionalfeatoptionDiv">
                        <?php 
	 $str_additionalfeature = "select * from ".TPLPrefix."feature_additional where featureid = '".$edit_id."' and IsActive=1 ";
	  $res_addtionalfeature = $db->get_rsltset($str_additionalfeature);
	if(count($res_addtionalfeature)=='0'){ ?>
                        <div class="row">
                          <div class="col-sm-3 no-padding-right">
                            <select class="dropdownClass form-control select2" name="featuretype0" id="featuretype0" required onchange="return featurtypeSelection(this.value,0)" >
                              <option value="">Select Format</option>
                              <option value="1">Image</option>
                              <option value="2">Video</option>
                            </select>
                          </div>
                          <div class="col-sm-6 no-padding-right">
                            <input type="text" class="dropdownClass form-control" placeholder="Title" name="addfeaturetitle0" id="addfeaturetitle0" required/>
                          </div>
                          <div class="col-sm-3 no-padding-right imgscls" id="imgscls0">
                            <div class="col-sm-10">
                              <input id="addfeatureimage0" class="common_upload_style" name="addfeatureimage0" type="file"  required/>
                            </div>
                          </div>
                          <!--<div class="col-sm-3 no-padding-right">
                            <div class="col-sm-10">
                              <select name="alignmenttype0" id="alignmenttype0" class="form-control select2" required>
                                <option value="">Select Alignment</option>
                                <option value="1">Left</option>
                                <option value="2">Right</option>
                                <option value="3">Full Width</option>
                              </select>
                            </div>
                          </div>-->
                         
                          <div class="col-sm-5 no-padding-right">
                            <input type="text" class="form-control buturlcls" name="addfeabuttonurl0" id="addfeabuttonurl0" placeholder="Redirect URL" />
                          </div>
                          <div class="col-sm-5 no-padding-right vidcls" id="vidcls0">
                            <input type="text" class="form-control videocls" name="videolink0" id="videolink0" placeholder="Video URL" />
                          </div>
                          <div class="col-sm-1 no-padding-right">
                            <input type="text" class="form-control" name="addfeadropdownSort0" id="addfeadropdownSort0" onkeypress="return isNumber(event)"  required/>
                          </div>
                          <div class="control-group mb-4"> &nbsp; </div>
                           <div class="col-sm-12 no-padding-right">
                            <textarea class="form-control texteditor" name="addfeadescription0" id="addfeadescription0" placeholder="Short Description" required></textarea>
                          </div>
                          <div class="col-sm-2"> <a href="javascript:add_additionalfeat_option();" class="add_front btn btn-success"><i class="flaticon-add-circle-outline"></i></a> </div>
                        </div>
                        <input type="hidden" name="additionalfeat_option_count" id="additionalfeat_option_count" value="1" />
                        <input type="hidden" name="additionalfeat_option_max_count" id="additionalfeat_option_max_count" value="1" />
                        <?php }else{ 
								$n=0;
								foreach($res_addtionalfeature as $res_addtionalfeatureval){ ?>
                        <input type="hidden" name="additionalfeat_option_edit_id<?php echo $n; ?>" id="additionalfeat_option_edit_id<?php echo $n; ?>" value="<?php echo $res_addtionalfeatureval['addid']; ?>" />
                        <div class="" id="additional_row_option<?php echo $n; ?>">
                          <div class="row">
                            <div class="col-sm-3 no-padding-right">
                              <select class="dropdownClass form-control select2" name="featuretype<?php echo $n; ?>" id="featuretype<?php echo $n; ?>" required onchange="return featurtypeSelection(this.value,0)" >
                                <option value="">Select Format</option>
                                <option value="1" <?php if($res_addtionalfeatureval['featuretype'] == 1){?> selected<?php }?>>Image</option>
                                <option value="2"  <?php if($res_addtionalfeatureval['featuretype'] == 2){?> selected<?php }?>>Video</option>
                              </select>
                            </div>
                            <div class="col-sm-6 no-padding-right">
                              <input type="text" class="dropdownClass form-control" placeholder="Title" name="addfeaturetitle<?php echo $n; ?>" id="addfeaturetitle<?php echo $n; ?>" value="<?php echo $res_addtionalfeatureval['featuretitle'];?>" required/>
                            </div>
                            <div class="col-sm-3 no-padding-right imgscls" id="imgscls0">
                              <div class="col-sm-10">
                                <input id="addfeatureimage<?php echo $n; ?>" class="common_upload_style" name="addfeatureimage<?php echo $n; ?>" type="file"   <?php if($act == 'insert'){?> required <?php }?>/>
                                <?php 
									if (!empty($res_addtionalfeatureval['featureimage']) && ($act == 'update')) { 
									  if(file_exists("../uploads/featureuploads/additionalfeature/".$res_addtionalfeatureval['featureimage']))
									   { ?>
                                        <span class="simple">
                                    <a href="<?php echo IMG_BASE_URL;?>featureuploads/additionalfeature/<?php echo $res_addtionalfeatureval['featureimage']; ?>" class="mr-0 image-popup-vertical-fit" >
                                        <img alt="image-popup-vertical-fit" src="<?php echo IMG_BASE_URL;?>featureuploads/additionalfeature/<?php echo $res_addtionalfeatureval['featureimage']; ?>" class="mr-0" width="30" height="30">
                                    </a>
                                    </span>
                                    
<!--                                <img src="<?php echo IMG_BASE_URL;?>featureuploads/additionalfeature/<?php echo $res_addtionalfeatureval['featureimage']; ?>" width="30px" align="absmiddle"/>
-->                                <?php
									   }
									   else{ ?>
                                <img src="../uploads/NoImageAvailable.png" width="30px" align="absmiddle"/>
                                <?php }
									 } 
									 ?>
                              </div>
                            </div>
                            <!--<div class="col-sm-3 no-padding-right">
                              <div class="col-sm-10">
                                <select name="alignmenttype<?php echo $n; ?>" id="alignmenttype<?php echo $n; ?>" class="form-control select2" required>
                                  <option value="">Select Alignment</option>
                                  <option value="1"  <?php if($res_addtionalfeatureval['aligntype'] == 1){?> selected<?php }?>>Left</option>
                                  <option value="2"  <?php if($res_addtionalfeatureval['aligntype'] == 2){?> selected<?php }?>>Right</option>
                                  <option value="3"  <?php if($res_addtionalfeatureval['aligntype'] == 3){?> selected<?php }?>>Full Width</option>
                                </select>
                              </div>
                            </div>-->
                          
                            <div class="col-sm-5 no-padding-right">
                              <input type="text" class="form-control buturlcls"  value="<?php echo $res_addtionalfeatureval['buttonurl'];?>" name="addfeabuttonurl<?php echo $n; ?>" id="addfeabuttonurl<?php echo $n; ?>" placeholder="Redirect URL" />
                            </div>
                            <div class="col-sm-5 no-padding-right vidcls" id="vidcls0">
                              <input type="text" class="form-control videocls"  value="<?php echo $res_addtionalfeatureval['videolink'];?>" name="videolink<?php echo $n; ?>" id="videolink<?php echo $n; ?>" placeholder="Video URL" />
                            </div>
                            <div class="col-sm-1 no-padding-right">
                              <input type="text" class="form-control"  value="<?php echo $res_addtionalfeatureval['sortingorder'];?>" name="addfeadropdownSort<?php echo $n; ?>" id="addfeadropdownSort<?php echo $n; ?>" onkeypress="return isNumber(event)"  required/>
                            </div>
                            <div class="control-group mb-4"> &nbsp; </div>
                              <div class="col-sm-12 no-padding-right">
                              <textarea class="form-control texteditor" name="addfeadescription<?php echo $n; ?>" id="addfeadescription<?php echo $n; ?>" placeholder="Short Description" required><?php echo $res_addtionalfeatureval['shortdescription'];?></textarea>
                            </div>
                            
                            
                            <div class="col-sm-2">
                              <?php if($n!=0){
									// if(trim($res_modm_prm['DeletePrm'])=="1") {?>
                              <a class="remove_front btn btn-danger" href="javascript:void(0)" onclick="remove_additionalfeat_option('<?php echo $m; ?>','<?php echo $res_addtionalfeatureval['addid']; ?>');" ><i class="flaticon-delete-1"></i></a>
                              <?php if($n == count($res_addtionalfeature)-1){?>
                              <a class="add_front btn btn-success" href="javascript:add_additionalfeat_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; &nbsp;
                              <?php }?>
                              <?php //}
			 }else{?>
                              <a class="add_front btn btn-success" href="javascript:add_additionalfeat_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; &nbsp;
                              <?php }?>
                            </div>
                          </div>
                        </div>
                        <?php //if($n == 0){?>
                        <div class="control-group mb-4"> &nbsp; </div>
                        <?php //}?>
                        <?php 
											$n++;
										}  ?>
                        <input type="hidden" name="additionalfeat_option_count" id="additionalfeat_option_count" value="<?php echo count($res_addtionalfeature); ?>" />
                        <input type="hidden" name="additionalfeat_option_max_count" id="additionalfeat_option_max_count" value="<?php echo count($res_addtionalfeature); ?>" />
                        <?php } ?>
                        <div id="additionalfeat_option_div"> </div>
                      </div>
                    </div>
                    
                    <!-- /////////////////////////////////// -->
                    
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-12">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmtWithImg('frmFeatured','featureproduct_actions.php','jvalidate','productfeature','featuredproduct_form.php?act=edit&pid=<?php echo $_REQUEST['pid'];?>');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmFeatured','jvalidate','productfeature','product_mng.php');">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
 <link href="plugins/popup/magnific-popup.css" rel="stylesheet" type="text/css" />
 <script src="plugins/popup/jquery.magnific-popup.min.js"></script>
    <script src="plugins/popup/custom-maginfic-popup.js"></script>
<script>
<?php if($res_ed['themeid'] != ''){?>
themedisplay('<?php echo $res_ed['themeid'];?>');
<?php }?>


jQuery(document).ready(function($){
//	$('.imgscls').hide();
	//$('.vidcls').hide();
		
 	$("#datatype").change(function(){
		if( $(this).val() == "number") {
			$(".dropdownClass ").addClass("number");
		}
		else{
			$(".dropdownClass ").removeClass("number");
		}		
	});
	
});



function featurtypeSelection(typeid,id){
	/*if(typeid == 1){
		$('#imgscls'+id).show();
		$('#vidcls'+id).hide();
	}else if(typeid == 2){
		$('#imgscls'+id).hide();
		$('#vidcls'+id).show();
	}*/
}


function add_special_option(){
	 
		var j = $('#special_option_count').val() ;
			$("#special_option_div").append('<div class="row"  id="row_option' + j + '"><div class="col-sm-3 no-padding-right"><input type="text" class="dropdownClass form-control" name="shortdescription'+j+'" id="shortdescription'+j+'" /></div><div class="col-sm-3 no-padding-right"><div class="col-sm-10"><input id="featureattributebanner'+j+'" class="specail_common_upload_style'+j+'"  name="featureattributebanner'+j+'" type="file"  onchange="return imageformatcheck(this.value,'+j+')" /></div></div><div class="col-sm-3 no-padding-right"><div class="col-sm-10"><input id="featureImages'+j+'"  class="specail_common_upload_style'+j+'" name="featureImages'+j+'" type="file"  onchange="return imageformatcheck(this.value,'+j+')" /></div></div><div class="col-sm-1 no-padding-right"><input type="text" class="form-control" name="dropdownSort'+j+'" id="dropdownSort'+j+'" onkeypress="return isNumber(event)" /></div><div class="col-sm-2"> <a class="add_front" href="javascript:add_special_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:special_remove_row_option('+j+');" ><i class="flaticon-delete-1"></i></a> </div></div>');
			
			 	$(".specail_common_upload_style"+j).filer({
					extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
					limit: 1
				});	
			j++;
			$('#special_option_count').val(j);
			$('#special_option_max_count').val(j);
			
		
		 
}

function special_remove_row_option(button_id){
	$('#row_option' + button_id + '').remove();
		var jj = $('#special_option_count').val();
		jj--;
		$('#special_option_count').val(jj);
}


function remove_special_option(row,specialid){
	swal({
			title: 'Are you sure?',
			text: "Do you want to delete this row?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
			
			var urls ="featureproduct_actions.php?action=remove_special_option";
				  var m_data = 'specialid='+specialid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 1){
							special_remove_row_option(row);
							$("#specialoptionDiv").load(location.href+" #specialoptionDiv>*");
							
							$("#specialoptionDiv .common_upload_style").filer({
								extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
								limit: 1
							});	 
							
							$('.select2').select2();
							
							swal("Success!", 'Special feature Deleted Successfully', "success");
					  }else{
						  swal("Failure!", 'Error in Special feature deletion', "warning");
					  }
							unloading();
					  }
					});
			
	   }
      })
	}
	
<!--- specification script ------------->

function add_specification_option(){
	 
		var j = $('#specification_option_count').val() ;
		
		
			$("#specification_option_div").append('<div class="row"  id="specification_row_option'+j+'"><div class="col-sm-3 no-padding-right"><input type="text" class="dropdownClass form-control" name="specificationtitle'+j+'" id="specificationtitle'+j+'" /></div><div class="col-sm-3 no-padding-right"><div class="col-sm-10"><input id="specimage'+j+'" class="spec_common_upload_style'+j+'"  name="specimage'+j+'" type="file"  onchange="return imageformatcheck(this.value,'+j+')"/></div></div><div class="col-sm-3 no-padding-right"><div class="col-sm-10"><input id="specvalue'+j+'"  class="form-control" name="specvalue'+j+'" type="text"/></div></div><div class="col-sm-1 no-padding-right"><input type="text" class="form-control" name="specdropdownSort'+j+'" id="specdropdownSort'+j+'" onkeypress="return isNumber(event)" /></div><div class="col-sm-2"> <a class="add_front" href="javascript:add_specification_option();" ><i class="flaticon-add-circle-outline"></i></a> &nbsp; | &nbsp; <a class="remove_front" href="javascript:remove_specification_row_option('+j+');" ><i class="flaticon-delete-1"></i></a> </div></div>');
			
			 	$(".spec_common_upload_style"+j).filer({
					extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
					limit: 1
				});	
			j++;
			$('#specification_option_count').val(j);
			$('#specification_option_max_count').val(j);
}

function remove_specification_row_option(button_id){
	$('#specification_row_option' + button_id + '').remove();
		var jj = $('#specification_option_count').val();
		jj--;
		$('#specification_option_count').val(jj);
}


function remove_specification_option(row,specificationid){
	
	swal({
			title: 'Are you sure?',
			text: "Do you want to delete this row?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
			var urls ="featureproduct_actions.php?action=remove_specification_option";
				  var m_data = 'specificationid='+specificationid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 1){
							remove_specification_row_option(row);
							$("#specificationoptionDiv").load(location.href+" #specificationoptionDiv>*");
							
							$("#specificationoptionDiv .common_upload_style").filer({
								extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
								limit: 1
							});	 
							
							$('.select2').select2();
			
							swal("Success!", 'Special feature Deleted Successfully', "success");
					  }else{
						  swal("Failure!", 'Error in Special feature deletion', "warning");
					  }
							unloading();
					  }
					});
			
			  }
      })
	 
	} 



function add_additionalfeat_option(){
	 
		var j = $('#additionalfeat_option_count').val() ;
		/*<div class="col-sm-3 no-padding-right"><div class="col-sm-10"><select required name="alignmenttype'+j+'" id="alignmenttype'+j+'" class="form-control" required><option value="">Select Alignment</option><option value="1">Left</option><option value="2">Right</option><option value="3">Full Width</option></select></div></div>*/
		
		$("#additionalfeat_option_div").append('<div class="control-group mb-4"> &nbsp; </div><div class="row"  id="additional_row_option'+j+'"><div class="col-sm-3 no-padding-right"><select onchange="return featurtypeSelection(this.value,'+j+')" class="dropdownClass form-control select2" name="featuretype'+j+'" id="featuretype'+j+'" required><option value="">Select Format</option><option value="1">Image</option><option value="2">Video</option></select></div><div class="col-sm-6 no-padding-right"><input required type="text" placeholder="Title"  class="dropdownClass form-control" name="addfeaturetitle'+j+'" id="addfeaturetitle'+j+'" /></div><div class="col-sm-3 no-padding-right imgscls" id="imgscls'+j+'"><div class="col-sm-10"><input required id="addfeatureimage'+j+'" class="feat_common_upload_style'+j+'"  name="addfeatureimage'+j+'" type="file"  onchange="return imageformatcheck(this.value,'+j+')" /></div></div><div class="col-sm-5 no-padding-right"><input type="text" placeholder="Redirect URL" class="form-control" name="addfeabuttonurl'+j+'" id="addfeabuttonurl'+j+'" /></div><div class="col-sm-5 no-padding-right vidcls" id="vidcls'+j+'"><input type="text" class="form-control videocls" name="videolink'+j+'" id="videolink'+j+'" placeholder="Video URL"/></div><div class="col-sm-1 no-padding-right"><input type="text" required class="form-control" name="addfeadropdownSort'+j+'" placeholder="Sorting" id="addfeadropdownSort'+j+'" onkeypress="return isNumber(event)" /></div><div class="control-group mb-4"> &nbsp; </div><div class="col-sm-12 no-padding-right"><textarea required class="form-control texteditor'+j+'" name="addfeadescription'+j+'" id="addfeadescription'+j+'" placeholder="Short Description"></textarea></div><div class="col-sm-3"> <a class="add_front btn btn-success" href="javascript:add_additionalfeat_option();" ><i class="flaticon-add-circle-outline"></i></a><a class="remove_front btn btn-danger" href="javascript:remove_additional_row_option('+j+');" ><i class="flaticon-delete-1"></i></a></div></div>');
			
			 	$(".feat_common_upload_style"+j).filer({
					extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
					limit: 1
				});	
				
				$('#featuretype'+j).select2();
				 $('.texteditor'+j).summernote();
				$('#alignmenttype'+j).select2();
				
			j++;
			$('#additionalfeat_option_count').val(j);
			$('#additionalfeat_option_max_count').val(j);
}

function remove_additional_row_option(button_id){
	$('#additional_row_option' + button_id + '').remove();
		var jj = $('#additionalfeat_option_count').val();
		jj--;
		$('#additionalfeat_option_count').val(jj);
}


function remove_additionalfeat_option(row,addid){
	swal({
			title: 'Are you sure?',
			text: "Do you want to delete this row?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Yes",
			padding: '0.5em'
     	 }).then(function(result) {
        if (result.value) {
			
			 var urls ="featureproduct_actions.php?action=remove_additionalfeat_option";
				  var m_data = 'addid='+addid;
					$.ajax({
					  url        : urls,
					  method     : 'POST',
					  dataType   : 'json',
					  data       : m_data,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  if(response.rslt == 1){
							remove_additional_row_option(row);
							$("#additionalfeatoptionDiv").load(location.href+" #additionalfeatoptionDiv>*");
							$("#additionalfeatoptionDiv .common_upload_style").filer({
								extensions: ['jpg', 'jpeg', 'png', 'gif', 'ico'],
								limit: 1
							});	 
							
							$('.select2').select2();
							
							swal("Success!", 'Additional feature deleted successfully', "success");
					  }else{
						  swal("Failure!", 'Error in additional feature deletion', "warning");
					  }
							unloading();
					  }
					});
					
					  }
      })
			 
	} 
	$('#showimage').hide();
	$('.shwd').hide();
	function themedisplay(themeid){
		$.ajax({
					  url        : "ajax_actions.php",
					  method     : 'POST',
					  dataType   : 'html',
					  data       : "action=themeview&themeid="+themeid,
					  beforeSend: function() {
						loading();
					  },
					  success: function(response){ 
					  unloading();
					  $('#showimage').show();$('.shwd').show();
					  $('#themeimg').html(response);
					  }
		});
	}

</script>

<style type="text/css">
.jFiler-theme-default .jFiler-input {
	width: 180px;
}

.img-border{
	border:1px solid #333;
	background-color:#CCC
}
.simple{
	padding-bottom:10px;
	float:left; 
}