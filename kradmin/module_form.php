<?php 
$menudisp = "module";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeModule($db,'');
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

$str_ed = "select * from ".tbl_modules." where IsActive != '2' and ModuleId = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(getRealescape(base64_decode($id))));
$edit_id = $res_ed['ModuleId'];
	$chk='';
	if($res_ed['IsActive']=='1'){	
	$chk='checked';
	}
	$IsAddchk='';
	if($res_ed['IsAdd']=='1'){	
	$IsAddchk='checked';
	}
	$IsEditchk='';
	if($res_ed['IsEdit']=='1'){	
	$IsEditchk='checked';
	}
	$IsDeletechk='';
	if($res_ed['IsDelete']=='1'){	
	$IsDeletechk='checked';
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
          <h3>Module</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">User Settings</a></li>
              <li><a href="module_mng.php">Module</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Module</a> </li>
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
                  <h4><?php echo $operation; ?> Module</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form action="#" name="frmModule" method="post" id="jvalidate"class="form-horizontal form-val-1">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Module Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtModulename" id="txtModulename" value="<?php echo $res_ed['ModuleName']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" required name="txtModuledescription" id="txtModuledescription"><?php echo $res_ed['Description']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Module Path <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtModulepath" id="txtModulepath" value="<?php echo $res_ed['ModulePath']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   <!-- <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Add</label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="checkbox ml-2 d-inline-block">
                              <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                <input type="checkbox" class="custom-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>  name="chkIsAdd" id="chkIsAdd" <?php echo $IsAddchk; ?> >
                                <label class="custom-control-label" for="chkIsAdd">Red</label>
                              </div>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Edit</label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="checkbox ml-2 d-inline-block">
                              <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                <input type="checkbox" class="custom-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>  name="chkIsEdit" id="chkIsEdit" <?php echo $IsEditchk; ?> >
                                <label class="custom-control-label" for="chkIsEdit">Red</label>
                              </div>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Is Delete</label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="checkbox ml-2 d-inline-block">
                              <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                <input type="checkbox" class="custom-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>  name="chkIsDelete" id="chkIsDelete" <?php echo $IsDeletechk; ?> >
                                <label class="custom-control-label" for="chkIsDelete">Red</label>
                              </div>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>-->
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
                                      <span class="new-control-indicator"></span>&nbsp;
                                    </label>
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
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmModule','module_actions.php','jvalidate','Module','module_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmModule','jvalidate','Module','module_mng.php');">Cancel</button>
                            
                            <!--     <button type="submit" class="btn btn-gradient-dark mb-4 mt-2">Test Validation <i class="icon-ok icon-white"></i></button>--> 
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