<?php 
$menudisp = "block";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCMSblock($db,'');
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

$str_ed = "select * from ".TPLPrefix."cms_block where 1=1 and cms_blockid = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['cms_blockid'];

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
          <h3>Menu</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">CMS Management</a></li>
              <li><a href="block_mng.php">Pages</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Block</a> </li>
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
                  <h4><?php echo $operation; ?> Block</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCmsblock" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Block Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtblockname" id="txtblockname" value="<?php echo $res_ed['cms_blockname']; ?>" <?php if($act == "insert") { ?>   onchange="getslug_name(this.value)" <?php } ?> />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Block Slug</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                              <input type="text" class="form-control alphaonly" required name="txtblockslug" id="txtblockslug" value="<?php echo $res_ed['cms_blogslug']; ?>" <?php if($act == "update") echo "readonly"; ?>  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Page Content <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="blockcontent" name="blockcontent" required class="texteditors"><?php echo  $res_ed['cms_blogdesc']; ?></textarea>	
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
                           
                    
                            <button  type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmt('frmCmsblock','block_actions.php','jvalidate','block','block_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4"onClick="javascript:funCancel('frmCmsblock','jvalidate','block','block_mng.php');" >Cancel</button>
                            
                                              
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
<script src="assets/js/libs/jquery-3.1.1.min.js"></script> 

<link type="text/css" href="plugins/jodit/jodit.min.css" rel="stylesheet" />
 <script src="plugins/jodit/jodit.min.js"></script>	

<?php include('includes/footer.php');?>
<style>
.jodit_toolbar_btn-fullsize{
display:none !important;
}
</style>	
<!--  END FOOTER  -->
 <script>
 $(function () {
	 var editors = [].slice.call(document.querySelectorAll('.texteditors'));
	
	 editors.forEach(function (div) {
			var editor = new Jodit(div, {
				textIcons: false,
				iframe: false,
				iframeStyle: '*,.jodit_wysiwyg {color:red;}',
				height: 300,
				defaultMode: Jodit.MODE_WYSIWYG,
				observer: {
					timeout: 100
				},
				uploader: {
					url: 'fileupload.php?action=fileUpload'
				},
				filebrowser: {
					// buttons: ['list', 'tiles', 'sort'],
					ajax: {
						url: 'includes/Get1.php'
					}
				},
				commandToHotkeys: {
					'openreplacedialog': 'ctrl+p'
				}
				// buttons: ['symbol'],
				// disablePlugins: 'hotkeys,mobile'
			});
	});
 });
 
</script>	