<?php 
$menudisp = "testimonial";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeTestimonial($db,'');
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
$str_ed = "select * from ".TPLPrefix."testimonial where IsActive != '2' and testimonialid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(getRealescape(base64_decode($id))));
$edit_id = $res_ed['testimonialid'];

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

include "common/dpselect-functions.php";
include "includes/top.php";?>

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
          <h3>Testimonial</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Reports</a></li>
              <li><a href="testimonial_mng.php">Testimonial</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Testimonial</a> </li>
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
                  <h4><?php echo $operation; ?> Testimonial</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="menu-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Customer Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="customername" id="customername" value="<?php echo $res_ed['customername']; ?>"/>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="testimonialcontent" id="testimonialcontent"><?php echo $res_ed['testimonialcontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Emailid <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" name="customeremailid" id="customeremailid" value="<?php echo $res_ed['customeremailid']; ?>" class="form-control" required="">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Language<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
						  <?php $getlanguage = getLanguages($db);?>
						  <select name="lang_id" id="lang_id" class="form-control select2">
						  <?php  foreach($getlanguage as $languageval){ ?>
						  <option value="<?php echo $languageval['languageid'];?>"><?php echo $languageval['languagename'];?></option>
						  <?php }?>						  
						  </select>                            
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" name="txtSortingorder" id="txtSortingorder" onkeypress="return isNumber(event)" value="<?php echo $res_ed['SortingOrder']; ?>" class="form-control number" required="">
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
                             <button  type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmTestimonial','testimonial_actions.php','jvalidate','Testimonial','testimonial_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmTestimonial','jvalidate','Testimonial','testimonial_mng.php');">Cancel</button>
							
							 
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