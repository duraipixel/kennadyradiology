<?php 
$menudisp = "user";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeUser($db,'');
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

$str_ed = "select * from ".tbl_users." where IsActive != '2' and user_ID = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['user_ID'];

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
              <li><a href="#">User Settings</a></li>
              <li><a href="userinfo_mng.php">User</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> User</a> </li>
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
                  <h4><?php echo $operation; ?> User</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="user-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">First Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtuser_firstname" id="txtuser_firstname" value="<?php echo $res_ed['user_firstname']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Last Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtuser_lastname" id="txtuser_lastname" value="<?php echo $res_ed['user_lastname']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Email Id / User ID <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="email" class="form-control email" required  name="txtuser_email" id="txtuser_email"  value="<?php echo $res_ed['user_email']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mobile Number <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="tel" minlength = "10" required autocomplete="off" maxlength = "10" class="form-control" onkeypress="return isNumber(event)" name="txtuser_mobile" id="txtuser_mobile" value="<?php echo $res_ed['user_mobile']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 	if ($act == 'insert') {?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Password <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="password" class="form-control password" required name="txtuser_password" id="txtuser_password" value="" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Role <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php   echo getSelectBox_rolelist($db,'txtRoleId','',$res_ed['RoleId'],'required');?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
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
                            <input type="file" class="form-control-file common_upload_style" id="user_photo" name="user_photo">
                            <p class="help-block"></p>
                          </div>
                          <?php  if (!empty($res_ed['user_photo']) && ($act == 'update')) { ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span><img class= "align-self-end mr-sm-3 rounded" id="preview_img" src="<?php echo IMG_BASE_URL;?>adminusers/<?php echo $res_ed['user_photo']; ?>" width="250" height="250" align="absmiddle"/> </span> </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <?php  } ?>
                        </div>
                      </div>
                    </div>
                    <?php 	if (($act == 'update')) {  ?>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Password <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-default btn-rounded" data-toggle="modal" onclick="clearform()" data-target="#fadeinModal">Change Password</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
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
                            <button type="button"  class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmtWithImg('frmUser','userinfo_actions.php','jvalidate','User','userinfo_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmUser','jvalidate','User','userinfo_mng.php');">Cancel</button>
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

<div id="fadeinModal" class="modal animated fadeInDown" role="dialog">
  <div class="modal-dialog">
    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?> "  />
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form name="change-password" id="change-password">
          <div class="row">
            <div class="col col-md-4">
              <div class="control-group mb-4">
                <label class="control-label">New Password <span class="required-class">* </span></label>
              </div>
            </div>
            <div class="col col-md-6">
              <div class="control-group mb-4">
                <div class="controls">
                  <input type="password" class="form-control " required name="newpwd" id="newpwd" value=""/>
                  <p class="help-block"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-md-4">
              <div class="control-group mb-4">
                <label class="control-label">Confirm Password <span class="required-class">* </span></label>
              </div>
            </div>
            <div class="col col-md-6">
              <div class="control-group mb-4">
                <div class="controls">
                  <input type="password" class="form-control " required name="newcnfrmpwd" id="newcnfrmpwd" value=""/>
                  <p class="help-block"></p>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer md-button">
        <button type="button" class="btn btn-warning btn-rounded" onclick="pwdchange();">Update</button>
        <button type="button" class="btn btn-dark btn-rounded" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
<!--  END FOOTER  -->

<script type="text/javascript"> 
function clearform(){
	 $("#change-password")[0].reset(); 
}
 
function pwdchange(){	  
if ($('#change-password').valid()) {
	
	if($('#newpwd').val() == '' || $('#newcnfrmpwd').val() == ''){
 		 toast({type: 'warning',title: 'Please enter a password and confirm it'});
 	}	
	else if($('#newpwd').val()!=$('#newcnfrmpwd').val()){
		 toast({type: 'warning',title: 'Passwords do not match.'});
 	}
	else{
		var user_id = $('#edit_id').val(); 
		var user_email = $('#txtuser_email').val();
		var new_pwd = $('#newpwd').val();
		$.ajax({
			url: 'userinfo_pwdchange.php',
			type: 'POST',
			data: 'user_id='+user_id+'&user_email='+user_email+'&new_pwd='+new_pwd+'',
			success: function(result) {	 														
			
					if(result =='success'){	
						toast({type: 'success',title: 'The password has been changed successfully.'});
 						$('#fadeinModal').modal('hide');						
						
		 		    }						
					else {
						toast({type: 'warning',title: result});
                        //alert(result);	
					} 
					$('#newpwd').val('');
						$('#newcnfrmpwd').val('');  
					
			}
		}); 				
	}
}
 }



</script>
<style type="text/css">
.modal-title {
	color: #ED1846;
	font-weight:bold
}
</style>
