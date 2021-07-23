<?php 
$menudisp = "modulemenu";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeModulemenu($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$id=$_REQUEST['id'];
if($id!=""){
//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {?>
<script>
  window.location="error.php";
</script>
<?php	
}
//check edit permission - END	

$operation="Edit";
$act="update";
$btn='Update';

$edit_id = base64_decode($id);
$str_ed = "select group_concat(`ModuleId`) as modulelist from ".tbl_modulemenus." where 1=1 and `IsActive`=1 and `MenuId` =".$edit_id."  ";
$res_ed = $db->get_a_line($str_ed);
$module_listall = $res_ed['modulelist'];
$module_listarray = explode(",",$module_listall); 


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
          <h3>Module Menu</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">User Settings</a></li>
              <li><a href="modulemenu_mng.php">ModuleMenu</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> ModuleMenu</a> </li>
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
                  <h4><?php echo $operation; ?> ModuleMenu</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmModuleMenu" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Menu Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <?php 
						  echo getSelectBox_menulist($db,'dpMenuId','','disabled required',$edit_id);
						 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <span class="typo-section-head">
                    <h5 class="box-title permission_title"><i class="fa fa-th"></i> Module List <a data-original-title="Select your Sub Menu from below list" style="color:#000;cursor:pointer;" data-toggle="tooltip" title=""><img src="images/BlueQuestion.png" style="vertical-align: sub;"></a></h5>
                    </span>
                    <div class="row">
                      <div class="col col-md-12">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
								  $module_list = $db->get_rsltset("select ModuleId,ModuleName from ".TPLPrefix."modules where 1=1 and IsActive = 1");
								  foreach($module_list as $module_list_S)
								  {
									  $chek='';
									  if (in_array($module_list_S['ModuleId'], $module_listarray)) {
											$chek = 'checked';
									  }
								?>
                            <div class="col-md-3 checkbox ml-2 d-inline-block">
                              <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                <input type="checkbox" required class="custom-control-input" name="modulecheck_list[]" value="<?php echo $module_list_S['ModuleId']; ?>" id="modulecheck_list<?php echo $module_list_S['ModuleId']; ?>" <?php echo $chek; ?> >
                                <label class="custom-control-label" for="modulecheck_list<?php echo $module_list_S['ModuleId']; ?>"><?php echo $module_list_S['ModuleName']; ?></label>
                              </div>
                            </div>
                            <?php	
								  }
								?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-4">
                        <div class="control-group">
                          <div class="controls">
                           
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript: return validate_all();" ><span id="spSubmit"><?php echo $btn; ?></span></button>
                             <button  class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmModuleMenu','jvalidate','Modulemenu','modulemenu_mng.php');" >Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                  <table id="tblresult_modulesorting" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Menu Name</th>
                        <th>Module Name</th>
                        <th>Sorting Order</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					    $modulesorting_list = $db->get_rsltset("select t1.*,t2.MenuName,t3.ModuleName,t3.Description,t3.ModulePath from ".TPLPrefix."modulemenus t1 inner join ".TPLPrefix."menus t2 on t1.MenuId = t2.MenuId and t2.IsActive =1 inner join ".TPLPrefix."modules t3 on t1.ModuleId = t3.ModuleId and t3.IsActive =1 where 1=1 and  t1.IsActive =1 and t1.MenuId='".$edit_id."' order by t1.SortingOrder asc ");
                        foreach($modulesorting_list as $modulesorting_list_S)
						{							
						?>
                      <tr>
                        <td><?php echo $modulesorting_list_S['MenuName']; ?></td>
                        <td><?php echo $modulesorting_list_S['Description']; ?></td>
                        <td><input type="text" value="<?php echo $modulesorting_list_S['SortingOrder']; ?>" class="form-control"  onkeypress="return isNumber(event)" onchange="changesortingorder('<?php echo $modulesorting_list_S['ModuleMenuId']; ?>',this.value)"  /></td>
                      </tr>
                      <?php			
						}
					   ?>
                    </tbody>
                  </table>
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
	$(function () {
		$('#tblresult_modulesorting').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
	});
	
  function validate_all(){ 
    var chkmodulesel=0;
	if(chkmodulesel == 0){	
		var chkModule=document.getElementsByName('modulecheck_list[]');
		for (var i = 0; i < chkModule.length; i++) {
				if(chkModule[i].checked == true){
					if(chkmodulesel ==0){
						chkmodulesel =1;
					}
				}	
		}
		if(chkmodulesel == 0){				
			toast({type: 'warning',title: 'Please selecte one or more module permission to this menu'});  
 			return false;	
		}
		else{
			funSubmt('frmModuleMenu','modulemenu_actions.php','jvalidate','Modulemenu','modulemenu_mng.php');
			return true;
		}		
	}     
  }	

  function changesortingorder(modulemenuId,txtval){	  
	  if(txtval !=""){		  
		  $.ajax({
			url        : 'others_actions.php',
			method     : 'POST',
			dataType   : 'json',
			data	   : 'pagename=modulemenusorting&modulemenuId='+modulemenuId+'&sort_value='+txtval+'',			
			success	   : function(response){ 						  		
			}
		});
		  
	  }  
  }
  
</script>