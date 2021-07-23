<?php 
$menudisp = "bulkproductupload";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeimportexportawb($db,'');

$btn = 'Upload';?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php";?>
  
  <!--  END SIDEBAR  --> 
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container">
      <div class="page-header">
        <div class="page-title">
          <h3>AWB Upload</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Order Management</a></li>
              <li class="active"><a href="#">AWB Upload</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-md-8">
                  <h4> AWB Bulk Upload</h4>
                </div>
                <div class="col-md-4 align-right">
                  <h4> <a  class="btn btn-warning btn-rounded mb-4 mr-2" href="orderexport.php"><i class="fa fa-download"></i> Download Orders</a></h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <?php if($_REQUEST['msg'] == 1){?>
              <center>
                <b class="text-success"> Uploaded Successfully !!</b>
              </center>
              <br clear="all" />
              <?php }?>
              <?php  if($_REQUEST['msg'] == 2){?>
              <div class="form-group errordiv" >
                <div class="col-md-2"></div>
                <div class="col-md-8"> Please try again ! The following Id are errors in the uploaded excel <br />
                  <?php  if(count($_SESSION['errorproduct']) > 0){?>
                  <ul>
                    <?php
				foreach($_SESSION['errorproduct'] as $values){?>
                    <li><?php echo $values;?></li>
                    <?php }?>
                  </ul>
                  <?php
				}
					?>
                </div>
              </div>
              <?php
				  
			  }?>
              <form id="jvalidate" name="frmUploadcsv" role="form" class="form-horizontal" action="order_importupdate.php"  method="post" enctype="multipart/form-data" >
                <input type="hidden" name="hdnact" id="hdnact" value="productcsv_upload" />
                <div class="form-group">
                  <div class="col-sm-12" align="center">
                    <input type="file" name="excelfile" id="excelfile" accept=".xls,.xlsx" class="common_upload_style_xl" required='' />
                    <label class="col-sm-3 control-label" for="uploadfile">Upload your File (.xlsx)</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12" align="center">
                    <button class="btn btn-dark btn-rounded mb-4 mr-2" type="reset">Cancel</button>
                    <button class="btn btn-warning btn-rounded mb-4 mr-2" type="submit"  onclick="buttonsubmit();" ><span id="spSubmit"><i class="fa fa-save"></i> Upload</span></button>
                  </div>
                </div>
                <!-- /.box-footer -->
                
              </form>
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

function buttonsubmit(){
	if ($('#productadd_form').valid()) {
 		return true;
	}else{
 		return false;
	}
}

</script>
<style type="text/css">
.errordiv {
	border:2px solid #F60;
	padding:10px;
	font-weight:bold;
}
</style>
