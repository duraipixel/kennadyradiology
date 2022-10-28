<?php 
$menudisp = "featurestories";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmefeaturestories($db,'');
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


$str_ed = "select * from ".TPLPrefix."feature_stories where IsActive != ? and FsId = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(2,base64_decode($id)));


$str_ed_es = "select * from ".TPLPrefix."feature_stories where IsActive != ? and parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_ed_es,array(2,base64_decode($id)));


$str_ed_pt = "select * from ".TPLPrefix."feature_stories where IsActive != ? and parent_id = ? and lang_id = 3 ";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array(2,base64_decode($id)));

$edit_id = $res_ed['FsId'];
$edit_id_es = $res_ed_es['FsId'];
$edit_id_pt = $res_ed_pt['FsId'];

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
          <h3>Feature Stories</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="featurestories_mng.php">Feature Stories</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Feature Stories</a> </li>
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
                  <h4><?php echo $operation; ?> Feature Stories</h4>
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
                          <label class="control-label">Story Title  <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtStoryTitle" id="txtStoryTitle" value="<?php echo $res_ed['StoryTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?>  Story Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtStoryTitle_es" id="txtStoryTitle_es" value="<?php echo $res_ed_es['StoryTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Story Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                             <input type="text" class="form-control" required name="txtStoryTitle_pt" id="txtStoryTitle_pt" value="<?php echo $res_ed_pt['StoryTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Date <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <!--<input type="text" class="form-control" required name="txtStoryDate" id="txtStoryDate" value="<?php echo $res_ed['StoryDate']; ?>"  />
                            <p class="help-block"></p>-->

                            <div class="input-control text" data-role="datepicker"   data-format="dd-mm-yyyy">
                              <input type="text" placeholder="From" name="txtStoryDate" id="txtStoryDate"   value="<?php echo $res_ed['StoryDate']!=''? date($GLOBALS['stroedateformat']['phpformat'],strtotime($res_ed['StoryDate'])): date($GLOBALS['StoryDate']['phpformat']); ?>" readonly required>
                              <button class="button"><span class="flaticon-calendar-1"></span></button>
                            </div>
                            <p class="help-block"></p>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Story URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" name="txtStoryURL" id="txtStoryURL" value="<?php echo $res_ed['StoryURL']; ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Story URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" name="txtStoryURL_es" id="txtStoryURL_es" value="<?php echo $res_ed_es['StoryURL']; ?>"  />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"> <?php echo Portuguese; ?> Story URL</label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <input type="text" class="form-control" name="txtStoryURL_pt" id="txtStoryURL_pt" value="<?php echo $res_ed_pt['StoryURL']; ?>"  />
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
                           <textarea class="form-control texteditor" required name="txtStoryDescription" id="txtStoryDescription" ><?php echo $res_ed['StoryDescription']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <textarea class="form-control texteditor" required name="txtStoryDescription_es" id="txtStoryDescription_es"><?php echo $res_ed_es['StoryDescription']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Description <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                           <textarea class="form-control texteditor" required name="txtStoryDescription_pt" id="txtStoryDescription_pt"><?php echo $res_ed_pt['StoryDescription']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    


                   <!-- <div class="row">
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
                                <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"   onClick="javascript:funSubmt('frmFeatureStories','featurestories_actions.php','jvalidate','Feature Stories','featurestories_mng.php');"><?php echo $btn; ?></button>
                                        
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmFeatureStories','jvalidate','Feature Stories','featurestories_mng.php');">Cancel</button>
                                        
                           
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