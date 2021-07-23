<?php 
$menudisp = "mailtemplate";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeMailtemplate($db,'');
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

$str_ed = "select * from ".TPLPrefix."mailtemplate where IsActive != ? and mtemid = ? and parent_id = 0 ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',getRealescape(base64_decode($id))));

$str_ed_es = "select * from ".TPLPrefix."mailtemplate where IsActive != ? and parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array('2',getRealescape(base64_decode($id))));

$str_ed_pt = "select * from ".TPLPrefix."mailtemplate  where IsActive != ? and parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array('2',getRealescape(base64_decode($id))));


$edit_id = $res_ed['mtemid'];

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
          <h3>Mailtemplate</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="mailtemplate_mng.php">Mailtemplate</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Mailtemplate</a> </li>
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
                  <h4><?php echo $operation; ?> Mailtemplate</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="menu-form" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mailtemplate Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls"> <?php echo getSelectBox_mailtemplate($db,'templatename','',$res_ed['masterid'],"required");?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row" id="mailtemblockid">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mail BCC <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="mailbcc" id="mailbcc" value="<?php echo $res_ed['mailbcc']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mail Subject <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="mailsub" id="mailsub" value="<?php echo $res_ed['mailsub']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mail Content <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailcontent" id="mailcontent"  ><?php echo $res_ed['mailcontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Mail Footer <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailfooter" id="mailfooter"  ><?php echo $res_ed['mailfooter']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					            
					
					<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Mail Subject <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="mailsub_es" id="mailsub_es" value="<?php echo $res_ed_es['mailsub']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Mail Content <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailcontent_es" id="mailcontent_es"  ><?php echo $res_ed_es['mailcontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Mail Footer <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailfooter_es" id="mailfooter_es"  ><?php echo $res_ed_es['mailfooter']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Mail Content <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailcontent_pt" id="mailcontent_pt"  ><?php echo $res_ed_pt['mailcontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					             
	

					
					<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Mail Subject <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="mailsub_pt" id="mailsub_pt" value="<?php echo $res_ed_pt['mailsub']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                   
					
					
					<div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Mail Footer <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-9">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea class="form-control texteditor" required name="mailfooter_pt" id="mailfooter_pt"  ><?php echo $res_ed_pt['mailfooter']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div> 
                    </div>
                    <?php if($act=="update" && $res_ed['isconfirmtable']==1){ ?>
                    <div class="row" id="orderdisp">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">After Table <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="aftertable" name = "aftertable" required class="texteditor"><?php echo  $res_ed['aftertable']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                    <div class="row col-md-12">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Status </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" class="new-control-input"  name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row col-md-12">
                      <div class="col col-md-3">
                        <div class="control-group mb-4"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmmailtemplate','mailtemplate_actions.php','jvalidate','Mailtemplate','mailtemplate_mng.php');"><?php echo $btn; ?></button>
                            <button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmmailtemplate','jvalidate','Mailtemplate','mailtemplate_mng.php');">Cancel</button>
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