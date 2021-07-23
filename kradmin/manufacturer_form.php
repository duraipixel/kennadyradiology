<?php 
$menudisp = "Brands";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmemanufacturer($db,'');
include_once "includes/pagepermission.php";
$getsize = getimagesize_large($db,'manufacturer','manufacturer');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];
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

$str_ed = "select * from ".TPLPrefix."manufacturer where IsActive != '2' and manufacturerId = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['manufacturerId'];

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
          <h3>Brands</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Master</a></li>
              <li><a href="manufacturer_mng.php">Manage Brands</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Brand</a> </li>
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
                  <h4><?php echo $operation; ?> Brands</h4>
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
                          <label class="control-label">Brand Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control jsrequired" required name="txtManufacturer" onblur="generateslug(this.value,'manucode');" id="txtManufacturer" value="<?php echo $res_ed['manufacturerName']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Parent Brand</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
                            echo getSelectBox_parentList($db,'parentId',$edit_id,$res_ed['parentId']);
                        ?>
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
                            <textarea class="form-control" name="txtdescription" id="txtdescription"><?php echo $res_ed['description']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Brands URL <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input class="form-control jsrequired alphaonly" required name="manucode" id="manucode" value="<?php echo $res_ed['manucode']; ?>">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Title</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " name="metatitle" id="metatitle" value="<?php echo $res_ed['metatitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Description</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control " name="metadesc" id="metadesc" ><?php echo $res_ed['metadesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Meta Keywords</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control " name="metakeyword" id="metakeyword" value="<?php echo $res_ed['metakeyword']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Photo <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input id="manufactImage" <?php if($res_ed['manufactImage'] == ''){?>required<?php }?> name="manufactImage" type="file" class="common_upload_style" />
                            <p class="help-block"></p>
                          </div>
                          <?php if (!empty($res_ed['manufactImage']) && ($act == 'update')) { 
						  if(file_exists("../uploads/manufacturer/".$res_ed['manufactImage'])){ ?>
                          <div class="jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid">
                              <li class="jFiler-item" data-jfiler-index="0" style="">
                                <div class="jFiler-item-container">
                                  <div class="jFiler-item-inner">
                                    <div class="jFiler-item-thumb">
                                      <div class="jFiler-item-thumb-image"> <span> <img src="../uploads/manufacturer/<?php echo $res_ed['manufactImage']; ?>" width="250px" height="250" align="absmiddle"/> </span> </div>
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
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status</label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"  class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
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
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtWithImg('frmManufacturer','manufacturer_actions.php','jvalidate','manufacturer','manufacturer_mng.php');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmManufacturer','jvalidate','manufacturer','manufacturer_mng.php');" >Cancel</button>
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
 		 toast({type: 'warning',title: 'Please enter a password and confirm it',padding: '2em',});
 	}	
	else if($('#newpwd').val()!=$('#newcnfrmpwd').val()){
		 toast({type: 'warning',title: 'Passwords do not match.',padding: '2em',});
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
						toast({type: 'success',title: 'The password has been changed successfully.',padding: '2em',});
 						$('#fadeinModal').modal('hide');						
						
		 		    }						
					else {
						toast({type: 'warning',title: result,padding: '2em',});
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
