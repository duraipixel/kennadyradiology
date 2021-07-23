<?php 
$menudisp = "manageclient";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeMangeclient($db,'');
include_once "includes/pagepermission.php";

$getsize = getimagesize_large($db,'ourclient','mcimage');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
/*
//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END
*/
$id=$_REQUEST['id'];
if($id!="")
{
/*	
//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {
?>
<script>
  window.location="error.php";
</script>
<?php	
}
//check edit permission - END	
*/
$operation="Edit";
$act="update";
$btn='Update';

$str_ed = "select * from ".TPLPrefix."manageclient where IsActive != '2' and mcid = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['mcid'];

$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
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
          <h3>Videos</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Banner</a></li>
              <li><a href="videos_mng.php">Client</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Client</a> </li>
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
                  <h4><?php echo $operation; ?> Client</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Client Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="mcname" id="mcname" value="<?php echo $res_ed['mcname']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Client URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " required name="mcurl" id="mcurl" value="<?php echo $res_ed['mcurl']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Client Image <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="file" class="form-control-file common_upload_style" <?php if($act != 'update'){?>required <?php }?> id="mcimage" name="mcimage">
                            <p class="help-block"></p>
                          </div>
                          <?php if (!empty($res_ed['mcimage']) && ($act == 'update')) { 
						  if(file_exists("../uploads/mcimage/".$res_ed['mcimage']))
						   { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span><img class= "align-self-end mr-sm-3 rounded" id="preview_img" src="<?php echo IMG_BASE_URL;?>mcimage/<?php echo $res_ed['mcimage']; ?>" width="100" height="100" align="absmiddle"/> </span> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php  }
						  }?>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col col-md-2"> &nbsp;</div>
                      <div class="col col-md-8"> <small style='padding-left: 56px;'>Image file extension jpg, jpeg, gif, png and Image size ( <?php echo $imgwidth.'*'.$imgheight; ?>) </small> </div>
                    </div>
                    <br />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" id="txtSortingOrder" class="form-control" name="txtSortingOrder" value="<?php echo $res_ed['SortingOrder']; ?>" onkeypress="return isNumber(event)"/>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status  </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
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
                            
                    <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  type="button" onClick="javascript:funSubmtWithImg('frmclient','manageclient_actions.php','jvalidate','client','manageclient_mng.php');" > <?php echo $btn; ?> </button>
                     <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4"  type="reset" onClick="javascript:funCancel('frmclient','jvalidate','client','manageclient_mng.php');" >Cancel</button>
                    
              
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