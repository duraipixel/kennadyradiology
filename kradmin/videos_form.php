<?php 
$menudisp = "videos";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeVideos($db,'');
include_once "includes/pagepermission.php";

$getsize = getimagesize_large($db,'videoimage','videoimages');
                   
$imageval = explode('-',$getsize);
$imgheights = $imageval[1];
$imgwidths = $imageval[0];

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

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

$str_ed = "select * from ".TPLPrefix."videos where IsActive != '2' and video_id = '".base64_decode($id)."'and parent_id = 0 ";
$res_ed = $db->get_a_line($str_ed);

$str_ed_es = "select * from ".TPLPrefix."videos where IsActive != '2'  and parent_id = '".base64_decode($id)."' and lang_id = 2 ";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_pt = "select * from ".TPLPrefix."videos where IsActive != '2'  and parent_id = '".base64_decode($id)."' and lang_id = 3 ";
$res_ed_pt = $db->get_a_line($str_ed_pt);

$edit_id = $res_ed['video_id'];
$edit_id_es = $res_ed_es['video_id'];
$edit_id_pt = $res_ed_pt['video_id'];

$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
}

$chkmain = '';
if($res_ed['chkmain']=='1')
{
	$chkmain='checked';
}


}
else
{
	
//check edit permission - START	
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
	$btn='Save';
}
?>
<?php include "common/dpselect-functions.php";include "includes/top.php";?>

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
          <h3>Videos</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Banner</a></li>
              <li><a href="videos_mng.php">Videos</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Videos</a> </li>
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
                  <h4><?php echo $operation; ?> Videos</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
					<input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
					<input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Video Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="video_title" id="video_title" value="<?php echo htmlentities($res_ed['video_title']); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Video Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="video_title_es" id="video_title_es" value="<?php echo htmlentities($res_ed_es['video_title']); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Video Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="video_title_pt" id="video_title_pt" value="<?php echo htmlentities($res_ed_pt['video_title']); ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Video Date <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                          
                         <!--   <div class="input-control text "  data-role="datepicker"   data-format="dd-mm-yyyy">-->
                              <input class="calldatepicker form-control" type="text" placeholder="From" name="video_date" id="video_date"  value="<?php echo (isset($res_ed['video_date']))? date("d-m-Y", strtotime($res_ed['video_date'])) : ''; ?>" readonly required>
                             <!-- <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>-->
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " name="video_url" id="video_url" required value="<?php echo $res_ed['video_url']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <a style="color:#000;cursor:pointer;" data-toggle="tooltip" title="Add Embed Link "><img src="images/BlueQuestion.png" style="vertical-align: sub;" /></a> 
					  </div>
					  
					  <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " name="video_url_es" id="video_url_es" required value="<?php echo $res_ed_es['video_url']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <a style="color:#000;cursor:pointer;" data-toggle="tooltip" title="Add Embed Link "><img src="images/BlueQuestion.png" style="vertical-align: sub;" /></a> 
					  </div>
					  
					  
					  <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Video URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " name="video_url_pt" id="video_url_pt" required value="<?php echo $res_ed_pt['video_url']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                      <a style="color:#000;cursor:pointer;" data-toggle="tooltip" title="Add Embed Link "><img src="images/BlueQuestion.png" style="vertical-align: sub;" /></a> 
					  </div>
					  
					  <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Photo</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" class="form-control-file common_upload_style" id="video_image" name="video_image">
                            <p class="help-block"></p>
                          </div>
                          <?php  if (!empty($res_ed['video_image']) && ($act == 'update')) { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span><img class= "align-self-end mr-sm-3 rounded" id="preview_img" src="<?php echo IMG_BASE_URL;?>videoimages/<?php echo $res_ed['video_image']; ?>" width="250" height="250" align="absmiddle"/> </span> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php  } ?>
                        </div>  <small>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidths.'*'.$imgheights; ?>) </small>
                    
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
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  type="button" onClick="javascript:funSubmtWithImg('frmvideos','videos_actions.php','jvalidate','Videos','videos_mng.php');" > <?php echo $btn; ?> </button>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmvideos','jvalidate','ideos','videos_mng.php');" >Cancel</button>
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