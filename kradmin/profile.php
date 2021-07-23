<?php 
$menudisp = "user";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
 include_once "includes/pagepermission.php";
 
$id=$_REQUEST['id'];
if($id!="")
{
	
//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {
?>
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
<!--<script>
  window.location="error.php";
</script>
-->
<?php	
}
	//check edit permission - END
	$operation="Add";
	$act="insert";
	$btn='Save';
}
 $str_ed = "select * from ".tbl_users." where IsActive != '2' and user_ID = '".$_SESSION['UserId']."' ";
$res_ed = $db->get_a_line($str_ed);

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
          <h3>Profile</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li class="active"><a href="#">Profile</a> </li>
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
                  <h4>Update Profile</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-12 layout-spacing">
                  <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area icon-pill">
                   <ul class="nav nav-tabs  mb-3 " id="iconTab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" id="icon-pills-home-tab" data-toggle="pill" href="#icon-pills-home" role="tab" aria-controls="icon-pills-home" aria-selected="true"><i class="flaticon-home-fill-1"></i> Profile</a> </li>
                        <li class="nav-item"> <a class="nav-link " id="icon-pills-profile-tab" data-toggle="pill" href="#icon-pills-profile" role="tab" aria-controls="icon-pills-profile" aria-selected="false"><i class="flaticon-lock-3"></i> Password</a> </li>
                      </ul>
                      <div class="tab-content" id="icon-pills-tabContent">
                        <div class="tab-pane fade active show" id="icon-pills-home" role="tabpanel" aria-labelledby="icon-pills-home-tab">
                          <form class="form-horizontal form-val-1" id="jvalidate" name="user-form" action="#" novalidate="">
                                <input type="hidden" name="action" value="profileupdate" />
                           <input type="hidden" name="edit_id" value="<?php echo $_SESSION['UserId']; ?> "  /> 
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
                                    <input type="email" readonly="readonly" required class="form-control email" name="txtuser_email" id="txtuser_email"  value="<?php echo $res_ed['user_email']; ?>" />
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
                            <div class="row">
                              <div class="col col-md-3">
                                <div class="control-group mb-4">
                                  <label class="control-label">Photo </label>
                                </div>
                              </div>
                              <div class="col col-md-6">
                                <div class="control-group mb-4">
                                  <div class="controls">
                                    <input type="file" class="form-control-file common_upload_style" id="user_photo" name="user_photo">
                                    <p class="help-block"></p>
                                  </div>
                                  <?php  if (!empty($res_ed['user_photo'])) { ?>
                            <span><img class= "align-self-end mr-sm-3 rounded" id="preview_img" src="<?php echo IMG_BASE_URL;?>adminusers/<?php echo $res_ed['user_photo']; ?>" width="75px" align="absmiddle"/> </span>
                             <?php  } ?>
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
                                    <button type="button"  class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmtWithImg('frmUser','userinfo_actions.php','jvalidate','profile','profile.php');"><?php echo $btn; ?></button>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane fade" id="icon-pills-profile" role="tabpanel" aria-labelledby="icon-pills-profile-tab"> 
                        
                        <form class="form-horizontal form-val-1" id="jvalidatep" name="user-form" action="#" novalidate="">
                           <input type="hidden" name="action" value="profilepwd" />
                 			 <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_SESSION['UserId']; ?> "  />
                              <input type="hidden" name="txtuser_email" id="txtuser_email" value="<?php echo $res_ed['user_email']; ?> "  />
                                <input type="hidden" name="franchiseeids" id="franchiseeids" value="<?php echo $res_ed['franchiseeid']; ?>"  />
                            <div class="row">
                              <div class="col col col-md-3">
                                <div class="control-group mb-4">
                                  <label class="control-label">New Password <span class="required-class">* </span></label>
                                </div>
                              </div>
                              <div class="col col col-md-6">
                                <div class="control-group mb-4">
                                  <div class="controls">
                                   <input type="password" class="form-control " required name="newpwd" id="newpwd" value=""/>
                                    <p class="help-block"></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col col-md-3">
                                <div class="control-group mb-4">
                                  <label class="control-label">Re-type New Password <span class="required-class">* </span></label>
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
                            
                            <div class="row">
                              <div class="col col-md-3">
                                <div class="control-group mb-4"> &nbsp; </div>
                              </div>
                              <div class="col col-md-6">
                                <div class="control-group mb-4">
                                  <div class="controls">
                                    <button type="button"  class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onclick="pwdchange();">Change Password</button>
                                   
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
 
function pwdchange(){
	  if ($('#jvalidatep').valid()) {	  
	if($('#newpwd').val() == '' || $('#newcnfrmpwd').val() == ''){
		toast({type: 'warning',title: 'Please enter a password and confirm it',padding: '2em',}); 
	}	
	else if($('#newpwd').val()!=$('#newcnfrmpwd').val()){
		toast({type: 'warning',title: 'Passwords do not match.',padding: '2em',}); 
	}
	else{
		var user_id = $('#edit_id').val(); 
		var user_email = $('#txtuser_email').val();
		var new_pwd = $('#newpwd').val();
		var franchiseeid = $('#franchiseeids').val();
		$.ajax({
			url: 'userinfo_pwdchange.php',
			type: 'POST',
			data: 'user_id='+user_id+'&user_email='+user_email+'&new_pwd='+new_pwd+'&franchiseeid='+franchiseeid,
			success: function(result) {	 														
					if(result =='success'){	
							toast({type: 'success',title: 'The password has been changed successfully.',padding: '2em',}); 
							 
							setTimeout(function() { location.reload();  }, 1200 );
							
					 }						
					else {
                      swal("error!","Error");	
					}   
			}
		}); 				
	}
	  }
 }

</script> 
