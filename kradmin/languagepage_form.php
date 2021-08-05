<?php 
$menudisp = "languagelabel";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmelanguagepage($db,'');
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

$str_ed = "select ci.* from ".TPLPrefix."language_pages ci  where ci.IsActive != ? and ci.pageid = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array('2',getRealescape(base64_decode($id))));
$edit_id = $res_ed['pageid'];



$str_edes = "select ci.* from ".TPLPrefix."language_pages ci  where ci.IsActive != ? and ci.parent_id = ? and lang_id = 2";
$res_ed_es = $db->get_a_line_bind($str_edes,array('2',getRealescape(base64_decode($id))));
$edit_id_es = $res_ed_es['pageid'];
	 
	 
$str_ed_pt = "select ci.* from ".TPLPrefix."language_pages ci  where ci.IsActive != ? and ci.parent_id = ? and lang_id = 3";
$res_ed_pt = $db->get_a_line_bind($str_ed_pt,array('2',getRealescape(base64_decode($id))));
$edit_id_pt = $res_ed_pt['pageid'];

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
          <h3>Language Page</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Masters</a></li>
              <li><a href="city_mng.php">Language Page</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Language Page</a> </li>
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
                  <h4><?php echo $operation; ?> Language Page</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCity" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                     <input type="hidden" name="edit_id_es" value="<?php echo $edit_id_es; ?> "  />
					  <input type="hidden" name="edit_id_pt" value="<?php echo $edit_id_pt; ?> "  />
                     <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Name <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                          <input type="text" class="form-control jsrequired" required name="pagename" id="pagename" value="<?php echo $res_ed['pagename'];  ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Page Code <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                          <input type="text" class="form-control jsrequired" required name="pagecode" id="pagecode" value="<?php echo $res_ed['pagecode'];  ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					
                    
					 <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="pagecontent" name = "pagecontent" class="texteditor"><?php echo  $res_ed['pagecontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					<div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Spanish; ?> Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="pagecontent_es" name = "pagecontent_es" class="texteditor"><?php echo  $res_ed_es['pagecontent']; ?></textarea>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                       
					   <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label"><?php echo Portuguese; ?> Description<span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-8">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <textarea id="pagecontent_pt" name = "pagecontent_pt" class="texteditor"><?php echo  $res_ed_pt['pagecontent']; ?></textarea>
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
                              <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt('frmCity','languagepage_actions.php','jvalidate','Language Page','languagepage_mng.php');"><?php echo $btn; ?></button>
										<button type="button" class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" onClick="javascript:funCancel('frmCity','jvalidate','Language Page','languagepage_mng.php');">Cancel</button>
									 
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