<?php 
$menudisp = "Banners";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeBanners($db,'');
include_once "includes/pagepermission.php";
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$getsize = getimagesize_large($db,'destopbanner','banners');

//print_r($getsize); exit;
$imageval = explode('-',$getsize);

$imgheight = $imageval[1];
$imgwidth = $imageval[0];

$getsize1 = getimagesize_large($db,'mobilebanner','mobile');

//print_r($getsize); exit;
$imageval1 = explode('-',$getsize1);

$imgheight1 = $imageval1[1];
$imgwidth1 = $imageval1[0];


$getsizepro = getimagesize_large($db,'destopbanner','banners');

//print_r($getsize); exit;
$imagevalpro = explode('-',$getsizepro);

$imgheightpro = $imagevalpro[1];
$imgwidthpro = $imagevalpro[0];

$getsize1pro = getimagesize_large($db,'mobilebanner','mobile');

//print_r($getsize); exit;
$imageval1pro = explode('-',$getsize1pro);

$imgheight1pro = $imageval1pro[1];
$imgwidth1pro = $imageval1pro[0];



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

$str_ed = "select * from ".TPLPrefix."banners   where IsActive != ? and bannerid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',getRealescape(base64_decode($id))));

$str_ed_es = "select * from ".TPLPrefix."banners   where IsActive != ? and parent_id = ?  and lang_id='2' ";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array('2',getRealescape(base64_decode($id))));

$str_ed_pt = "select * from ".TPLPrefix."banners   where IsActive != ? and parent_id = ?  and lang_id='3' ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array('2',getRealescape(base64_decode($id))));

$edit_id = $res_ed['bannerid'];
$edit_id_es = $res_ed_es['bannerid'];
$edit_id_pt = $res_ed_pt['bannerid'];

	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
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
          <h3>User</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Banner</a></li>
              <li><a href="banners_mng.php">Manage Banners</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Banners</a> </li>
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
                  <h4><?php echo $operation; ?> Banners</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="user-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
					<input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
					<input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
					
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="bannername" id="bannername" value="<?php echo $res_ed['bannername']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Banner Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="bannername_es" id="bannername_es" value="<?php echo $res_ed_es['bannername']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Banner Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="bannername_pt" id="bannername_pt" value="<?php echo $res_ed_pt['bannername']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Link <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_link" id="banner_link" value="<?php echo $res_ed['banner_link']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Banner Link <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_link_es" id="banner_link_es" value="<?php echo $res_ed_es['banner_link']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
					
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Banner Link <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_link_pt" id="banner_link_pt" value="<?php echo $res_ed_pt['banner_link']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_title" id="banner_title" value="<?php echo $res_ed['banner_title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                    
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Banner Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_title_es" id="banner_title_es" value="<?php echo $res_ed_es['banner_title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Banner Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_title_pt" id="banner_title_pt" value="<?php echo $res_ed_pt['banner_title']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
					
                   <!-- 
                    
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Button Text <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="banner_btn_txt" id="banner_btn_txt" value="<?php echo $res_ed['banner_btn_txt']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea  class="form-control texteditor" required name="banner_desc" id="banner_desc" ><?php echo $res_ed['banner_desc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>-->
                    
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Position <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php 
							//onchange="checkimagesize(this.value)
														echo getSelectBox_Bannerposition($db,'Bannerposition',' ',$res_ed['Bannerposition'],' required " '); 
													?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Image <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" class="common_upload_style" name="bannerimage" id="bannerimage" <?php if($res_ed['bannerimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.banner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed['bannerimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>banners/<?php echo $res_ed['bannerimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>
					
					  <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Banner Image <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" class="common_upload_style" name="bannerimage_es" id="bannerimage_es" <?php if($res_ed_es['bannerimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.banner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_es['bannerimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img_es" src="<?php echo IMG_BASE_URL;?>banners/<?php echo $res_ed_es['bannerimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>
					
					  <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Banner Image <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" class="common_upload_style" name="bannerimage_pt" id="bannerimage_pt" <?php if($res_ed_pt['bannerimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.banner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_pt['bannerimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img_pt" src="<?php echo IMG_BASE_URL;?>banners/<?php echo $res_ed_pt['bannerimage']; ?>" width="250"  height="250" align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php  } ?>
                          </div>
                          <small>(Image Size should be <span id="imgsize"><?php echo $imgwidth." * ".$imgheight ?></span>)</small> </div>
                      </div>
                    </div>
					
					
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Banner Mobile <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" name="mobileimage" class="common_upload_style" id="mobileimage" <?php if($res_ed['mobileimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.mbanner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed['mobileimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>banners/mobile/<?php echo $res_ed['mobileimage']; ?>"  width="250" height="250"  align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php //echo  $res_ed['CompanyLogo']; ?>
                            <?php  } ?>
                          </div>
                          <small> (Image Size should be <span id="imgsizemob"><?php echo $imgwidth1." * ".$imgheight1 ?></span>)</small> </div>
                      </div>
                    </div>
					
					   <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Banner Mobile <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" name="mobileimage_es" class="common_upload_style" id="mobileimage_es" <?php if($res_ed_es['mobileimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.mbanner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_es['mobileimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>banners/mobile/<?php echo $res_ed_es['mobileimage']; ?>"  width="250" height="250"  align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php //echo  $res_ed['CompanyLogo']; ?>
                            <?php  } ?>
                          </div>
                          <small> (Image Size should be <span id="imgsizemob"><?php echo $imgwidth1." * ".$imgheight1 ?></span>)</small> </div>
                      </div>
                    </div>
					
					   <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Banner Mobile <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" name="mobileimage_pt" class="common_upload_style" id="mobileimage_pt" <?php if($res_ed_pt['mobileimage'] == ''){?>required<?php }?> onchange="ValidateSingleInput('this') ; this.form.mbanner.value = this.files.length ? this.files[0].name : ''" />
                            <p class="help-block"></p>
                          </div>
                          <div class="col-md-1">
                            <?php  if (!empty($res_ed_pt['mobileimage']) && ($act == 'update')) { ?>
                            <div class="jFiler-items jFiler-row">
                              <ul class="jFiler-items-list jFiler-items-grid">
                                <li class="jFiler-item" data-jfiler-index="0" style="">
                                  <div class="jFiler-item-container">
                                    <div class="jFiler-item-inner">
                                      <div class="jFiler-item-thumb">
                                        <div class="jFiler-item-thumb-image"> <span><img id="preview_img" src="<?php echo IMG_BASE_URL;?>banners/mobile/<?php echo $res_ed_pt['mobileimage']; ?>"  width="250" height="250"  align="absmiddle"/> </span>
                                          <?php //echo  $res_ed['CompanyLogo']; ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <?php //echo  $res_ed['CompanyLogo']; ?>
                            <?php  } ?>
                          </div>
                          <small> (Image Size should be <span id="imgsizemob"><?php echo $imgwidth1." * ".$imgheight1 ?></span>)</small> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required onkeypress="return isNumber(event)" name="SortingOrder" id="SortingOrder" value="<?php echo $res_ed['SortingOrder']; ?>" />
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
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmtWithImg('frmbanner','banners_actions.php','jvalidate','Banner','banners_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmbanner','jvalidate','Banner','banners_mng.php');">Cancel</button>
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
 <script type="text/javascript">
 function checkimagesize(bannerpos){
	if(bannerpos == 1) {
		$('#imgsize').html('<?php echo $imgwidth." * ".$imgheight ?>');	
		$('#imgsizemob').html('<?php echo $imgwidth1." * ".$imgheight1 ?>');	
	}else{
		$('#imgsize').html('<?php echo $imgwidthpro." * ".$imgheightpro ?>');	
		$('#imgsizemob').html('<?php echo $imgwidth1pro." * ".$imgheight1pro ?>');	
	}
 }