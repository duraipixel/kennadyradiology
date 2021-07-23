<?php 
$productdisp = "product";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeProduct($db,'');


$btn = 'Continue';
?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "common/dpselect-functions.php";include "includes/sidebar.php";?>
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>Catalog</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Catalog</a></li>
              <li><a href="product_mng.php">Manage Product</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Product Type</a> </li>
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
                  <h4><?php echo $operation; ?> Product Type</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                   <form id="jvalidate" name="frmProduct" role="form" class="form-horizontal" action="#" method="post" >
                  <input type="hidden" name="action_" value="attribute_groupID" />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Product Type to Upload <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls"> <?php echo getSelectBox_attrgrouplistRadio($db,"attribute_groupID","jsrequired"); ?>
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
                            <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtNoMsg('frmProduct','product_actions.php','jvalidate','product','product_form.php');"><span id="spSubmit"><?php echo $btn; ?></span></button>
                            <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4"type="reset" onClick="javascript:funCancel('frmProduct','jvalidate','product','product_mng.php');" >Cancel</button>
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
<script>
jQuery(document).ready(function(){
	$("#attribute_groupID").change(function(){
		attributeCollection($(this).val());
	});	
	attributeCollection($("#attribute_groupID").val());
});

function attributeCollection(attribute_Mapid){	
	url = "product_actions.php";	
	$.post(url,{attribute_Mapid:attribute_Mapid,"attribCollection":"attribCollection"},function(response){		
		$("#attributeCollection").html(response);
		 $(".select2").select2();
	})
}

</script>