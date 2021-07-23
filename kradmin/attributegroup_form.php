<?php 
$menudisp = "Attribute";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeAttributegroup($db,'');
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

$str_ed = "select * from ".TPLPrefix."attributegroup where IsActive != ? and attribute_groupID = ? and parent_id='0' ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',getRealescape(base64_decode($id))));
 

$str_ed_es = "select * from ".TPLPrefix."attributegroup where IsActive != '2' and parent_id = '".$res_ed['attribute_groupID']."' and lang_id='2' ";
$res_ed_es = $db->get_a_line($str_ed_es);

$str_ed_pt = "select * from ".TPLPrefix."attributegroup where IsActive != '2' and parent_id = '".$res_ed['attribute_groupID']."' and lang_id='3' ";
$res_ed_pt = $db->get_a_line($str_ed_pt);


$edit_id = $res_ed['attribute_groupID'];
$edit_id_es = $res_ed_es['attribute_groupID'];
$edit_id_pt = $res_ed_pt['attribute_groupID'];

//echo $edit_id; exit;
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
          <h3>Attribute Group Master</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="attributegroup_mng.php">Attribute Group Master</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Attribute Group</a> </li>
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
                  <h4><?php echo $operation; ?> Attribute Group</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="menu-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
					 <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?>"  />
                   <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?>"  />
                    
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Attribute Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="txtAttrGroupName" id="txtAttrGroupName" value="<?php echo $res_ed['attribute_groupName']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Attribute Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control jsrequired" required name="txtAttrGroupName_es" id="txtAttrGroupName_es" value="<?php echo $res_ed_es['attribute_groupName']; ?>" />
                     <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Attribute Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control jsrequired" required name="txtAttrGroupName_pt" id="txtAttrGroupName_pt" value="<?php echo $res_ed_pt['attribute_groupName']; ?>" />
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
                            <textarea class="form-control" name="txtAttrGroupDesc" id="txtAttrGroupDesc"><?php echo $res_ed['attribute_groupdesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Description</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="txtAttrGroupDesc_es" id="txtAttrGroupDesc_es"><?php echo $res_ed_es['attribute_groupdesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Description</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control" name="txtAttrGroupDesc_pt" id="txtAttrGroupDesc_pt"><?php echo $res_ed_pt['attribute_groupdesc']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Sorting Order</label>
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
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmAttrGroup','attributegroup_actions.php','jvalidate','Attribute group','attributegroup_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmAttrGroup','jvalidate','Attribute group','attributegroup_mng.php');">Cancel</button>
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