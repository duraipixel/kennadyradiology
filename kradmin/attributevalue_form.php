<?php 
$menudisp = "menu";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeAttibutevalue($db,'attributevalue_mng.php?attid='.$_REQUEST['attid']);
 $attid=$_REQUEST['attid'];
 
$str_eds = "select unitdisplay,iconsdisplay from ".TPLPrefix."m_attributes  where  attributeId = ?  and IsActive <> ? ";
$res_eds = $db->get_a_line_bind($str_eds,array(base64_decode($attid),'2'));
//print_r($res_eds); exit;
$unitdisplay = $res_eds['unitdisplay'];
$iconsdisplay = $res_eds['iconsdisplay'];

include_once "includes/pagepermission.php";

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

$str_ed = "select * from ".TPLPrefix."dropdown where isactive != ? and dropdown_id = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',base64_decode($id)));

$edit_id = $res_ed['dropdown_id'];

$chk='';
if($res_ed['isactive']=='1')
{
	$chk='checked';
}

}
else
{
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
          <h3>Attributevalue</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Attribute</a></li>
              <li><a href="attributevalue_mng.php?attid=<?php echo $_REQUEST['attid'];?>">Branding Option</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> <?php if($_REQUEST['attid'] == 'MjA='){ echo "Colour";}else {?>Branding <?php }?> Attribute</a> </li>
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
                  <h4><?php echo $operation; ?> <?php if($_REQUEST['attid'] == 'MjA='){ echo "Colour";}else {?>Branding <?php }?> Attribute</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <input type="hidden" name="attid" value="<?php echo base64_decode($_REQUEST['attid']); ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Dropdown Values <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="dropdown_values" id="dropdown_values" value="<?php echo $res_ed['dropdown_values']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Dropdown Unit <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="dropdown_unit" id="dropdown_unit" value="<?php echo $res_ed['dropdown_unit']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     
                      
                    <?php if($iconsdisplay==1){ ?>
                    <!--<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Photo <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input id="dropdown_images" name="dropdown_images" type="file" class="common_upload_style"/>
                            <p class="help-block"></p>
                          </div>
                          <?php  if (!empty($res_ed['dropdown_images']) && ($act == 'update')) {
						    
						  if(file_exists("../uploads/attributes/" .$res_ed['dropdown_images'])) { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span> <img src="../uploads/attributes/<?php echo $res_ed['dropdown_images']; ?>" width="250" id="250" align="absmiddle"/> </span> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php }
							  } ?>
                        </div>
                      </div>
                    </div>-->
                    <?php }?>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="sortingOrder" id="sortingOrder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
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
                            <?php if($iconsdisplay==1){ ?>
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  id="savevalue" type="button" onClick="javascript:funSubmtWithImg('frmAttributevalue','attributevalue_actions.php','jvalidate','Attributevalue','attributevalue_mng.php?attid=<?php echo $_REQUEST['attid']; ?>');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                            <?php } else { ?>
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  id="savevalue" type="button" onClick="javascript:funSubmt('frmAttributevalue','attributevalue_actions.php','jvalidate','Attributevalue','attributevalue_mng.php?attid=<?php echo $_REQUEST['attid']; ?>');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                            <?php } ?>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmAttributevalue','jvalidate','Attributevalue','attributevalue_mng.php?attid=<?php echo $_REQUEST['attid']; ?>');" >Cancel</button>
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