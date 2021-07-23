<?php 
$menudisp = "videos";
$baseFilename = basename($_SERVER['PHP_SELF']);
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeVideos($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$module_title = getModuleTitle($db, $baseFilename);
?>
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
          <h3>Videos</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Banner</a></li>
              <li class="active"><a href="#">Videos</a> </li>
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
                  <h4>Manage Videos</h4>
                </div>
                <?php  if(trim($res_modm_prm['AddPrm'])=="1") { ?>
                <div class="col-md-4 align-right">
                  <h4>
                    <button onclick="window.location='videos_form.php'" class="btn btn-warning btn-rounded mb-4 mr-2"><i class="fa fa-check"></i> Add</button>
                  </h4>
                </div>
                <?php }?>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "videos"; ?>" />
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Video Name</th>
                      <th>Video Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
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

<script>
      $(function () {       
		  datatblCal(dataGridHdn);
	  });
</script>