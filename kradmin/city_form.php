<?php 
$menudisp = "city";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCity($db,'');
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

$str_ed = "select ci.* from ".TPLPrefix."city ci  where ci.IsActive != ? and ci.cityid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',getRealescape(base64_decode($id))));
$edit_id = $res_ed['cityid'];
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
          <h3>City</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="city_mng.php">City</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> City</a> </li>
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
                  <h4><?php echo $operation; ?> City</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCity" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Country Name<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                          <?php 
						  if($act == 'update'){
														echo getSelectBox_countrylist($db,'CountryID','',$res_ed['countryid'],' required onchange = "stateList(this.value)" '); 
						  }else{
							  echo getSelectBox_countrylist($db,'CountryID','','',' required onchange = "stateList(this.value)" '); 
						  }
													?>	
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">State <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                           <?php if($act=="update") {
												?>
													<div id="stateDropDown">
													<?php	
														echo getSelectBox_statelist($db,'StateID','',$res_ed['stateid'],' required ',$res_ed['countryid']);
													?>
													</div>
												<?php } else { ?>
													<div id="stateDropDown">
														<select class='form-control select2' required id='StateID' name='StateID'>
															<option></option> 
														</select>
													</div>
												<?php } ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">City Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                          <input type="text" class="form-control jsrequired" required name="CityName" id="CityName" value="<?php echo $res_ed['cityname']; ?>" />
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
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmCity','city_actions.php','jvalidate','city','city_mng.php');"><?php echo $btn; ?></button>
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmCity','jvalidate','city','city_mng.php');">Cancel</button>
									 
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
	
	function stateList(CountryID) {
		$.ajax({
			url : "ajax_actions.php",
			type : "post",
			data : "action=stateList&CountryID="+CountryID,
			dataType : "json",
			success : function(stateDropDown) {
				$("#stateDropDown").empty();
				$("#stateDropDown").html(stateDropDown.statelist);
				$("#StateID").select2();
				
				 $('#StateID').change(function () {	 
					$('#jvalidate').validate().element($(this));  
				});
				
			}
		});
	}
	
</script>