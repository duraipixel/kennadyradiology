<?php 
$menudisp = "permissioninfo";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmePermissioninfo($db,'');
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
$edit_id = base64_decode($id);

$resrole_name = $db->get_a_line("  select r.RoleName from ".tbl_roles." r  where  r.IsActive <> 2 and r.RoleId='".$edit_id."' ");
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
          <h3>Permission</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">User Settings</a></li>
              <li><a href="permissioninfo_mng.php">Permission</a></li>
              <li class="active"><a href="#">Permission <?php echo $operation; ?></a> </li>
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
                  <h4>Permission <?php echo $operation; ?></h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="permission-form" action="#" novalidate="">
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
                            <input disabled id="txtRolename" class="form-control" required type="text" value="<?php echo $resrole_name['RoleName']; ?>" name="txtRolename">
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row"> <span class="typo-section-head">
                      <h6><i class="fa fa-th"></i> Permission List </h6>
                      </span> </div>
                    <div class="row">&nbsp;</div>
                    <div class="row">
                      <?php
									

									$mainmenu_list = $db->get_rsltset("select t1.MenuId,t2.MenuName from ".tbl_modulemenus." t1 inner join ".tbl_menus." t2 on t1.MenuId = t2.MenuId and t2.IsActive =1 
									 inner join ".tbl_modules." t3 on t1.ModuleId = t3.ModuleId and t3.IsActive =1 
									where 1=1 and t1.IsActive = 1 group by t1.MenuId");
									
									foreach($mainmenu_list as $mainmenu_list_S)
									{
								?>
                      <span class="typo-section-head">
                      <h6 class="box-title permission_subtitle"><?php echo $mainmenu_list_S['MenuName']; ?></h6>
                      </span>
                      <table id="tblresult" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th width="20%" style="vertical-align:super;">Page Name</th>
                            <th width="20%"><i class="fa fa-plus" style="font-size:12px;"></i> Add <br />
                             <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox"  class="custom-control-input"  id="AdPrm_<?php echo $mainmenu_list_S['MenuId']; ?>" >
                                  <label class="custom-control-label" for="AdPrm_<?php echo $mainmenu_list_S['MenuId']; ?>">&nbsp;</label>
                                </div>
                              </div>
                            </th>
                            <th width="20%"><i class="fa fa-pencil-square-o" style="font-size:13px;"></i> Edit <br />
                            
                             <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox"  class="custom-control-input"  id="EdPrm_<?php echo $mainmenu_list_S['MenuId']; ?>" >
                                  <label class="custom-control-label" for="EdPrm_<?php echo $mainmenu_list_S['MenuId']; ?>">&nbsp;</label>
                                </div>
                              </div>
                              
                              </th>
                            <th width="20%"><i class="fa fa-trash-o" style="font-size:13px;"></i> Delete <br />
                            
                             <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox"  class="custom-control-input"  id="DePrm_<?php echo $mainmenu_list_S['MenuId']; ?>" >
                                  <label class="custom-control-label" for="DePrm_<?php echo $mainmenu_list_S['MenuId']; ?>">&nbsp;</label>
                                </div>
                              </div>
                            </th>
                            <th width="20%"><i class="fa fa-eye" style="font-size:13px;"></i> View <br />
                            
                               <div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox"  class="custom-control-input"  id="ViPrm_<?php echo $mainmenu_list_S['MenuId']; ?>" >
                                  <label class="custom-control-label" for="ViPrm_<?php echo $mainmenu_list_S['MenuId']; ?>">&nbsp;</label>
                                </div>
                              </div> 
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
						   
									 $page_list =$db->get_rsltset("select t1.*,t2.MenuName,t3.ModuleName,t3.Description,t3.ModulePath from ".tbl_modulemenus." t1 
									 inner join ".tbl_menus." t2 on t1.MenuId = t2.MenuId and t2.IsActive =1 
									 inner join ".tbl_modules." t3 on t1.ModuleId = t3.ModuleId and t3.IsActive =1 
									 where 1=1  and t1.ModuleId  NOT IN (1,2,3) and  t1.IsActive =1 and t1.MenuId='".$mainmenu_list_S['MenuId']."' order by t1.moduleId asc ");
									 foreach($page_list as $page_list_S)
									 {
										// print_r($page_list_S); 
									   $pagepermission_all = $db->get_a_line("select * from ".tbl_useracl." where 1=1 and IsActive =1 and RoleId='".$edit_id."' and  ModuleMenuId='".$page_list_S['ModuleMenuId']."' ");									   
									 ?>
                          <tr>
                            <td style="text-align:left"><?php echo $page_list_S['Description']; ?></td>
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" required class="custom-control-input AdPrm_<?php echo $mainmenu_list_S['MenuId']; ?>"  name="AddPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  id="AddPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  <?php if($pagepermission_all['AddPrm'] == 1 ) echo "checked"; ?> >
                                  <label class="custom-control-label" for="AddPrm_<?php echo $page_list_S['ModuleMenuId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" required class="custom-control-input EditPrm_<?php echo $mainmenu_list_S['MenuId']; ?>"  name="EditPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  id="EditPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  <?php if($pagepermission_all['EditPrm_'] == 1 ) echo "checked"; ?> >
                                  <label class="custom-control-label" for="EditPrm_<?php echo $page_list_S['ModuleMenuId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" required class="custom-control-input DeletePrm_<?php echo $mainmenu_list_S['MenuId']; ?>"  name="DeletePrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  id="DeletePrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  <?php if($pagepermission_all['DeletePrm_'] == 1 ) echo "checked"; ?> >
                                  <label class="custom-control-label" for="DeletePrm_<?php echo $page_list_S['ModuleMenuId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                            <td><div class="checkbox ml-2 d-inline-block">
                                <div class="custom-control rounded-chk custom-checkbox checkbox-info">
                                  <input type="checkbox" required class="custom-control-input ViewPrm_<?php echo $mainmenu_list_S['MenuId']; ?>"  name="ViewPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  id="ViewPrm_<?php echo $page_list_S['ModuleMenuId']; ?>"  <?php if($pagepermission_all['ViewPrm_'] == 1 ) echo "checked"; ?> >
                                  <label class="custom-control-label" for="ViewPrm_<?php echo $page_list_S['ModuleMenuId']; ?>">&nbsp;</label>
                                </div>
                              </div></td>
                          </tr>
                          <?php	 
									 }
									?>
                        </tbody>
                      </table>
                      <div class="clearfix"></div>
                      <?php											
									}
								?>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-gradient-success btn-rounded mb-4 mr-2"  onClick="javascript:funSubmt('frmPermission','permissioninfo_actions.php','jvalidate','permissioninfo','permissioninfo_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-gradient-dark btn-rounded mb-4 mr-2" onClick="javascript:funCancel('frmPermission','jvalidate','permissioninfo','permissioninfo_mng.php');">Cancel</button>
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