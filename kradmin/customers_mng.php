<?php 
$customerid= base64_decode($_REQUEST['cusid']); 
$menudisp = "customers";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
//$mdme = getMdmeCustomers($db,'');
$mdme = getMdmeCustomers($db,'customers_mng.php?cusid='.$_REQUEST['cusid']);
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END
$module_title = getModuleTitle($db, basename($_SERVER['PHP_SELF']));
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
          <h3>Customer</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Customers</a></li>
              <li class="active"><a href="#"><?php if($_REQUEST['cusid'] == 'Mg=='){?>Business<?php }else{?>Individual<?php }?> Customers</a> </li>
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
                  <h4>Manage <?php if($_REQUEST['cusid'] == 'Mg=='){?>Business<?php }else{?>Individual<?php }?> Customers</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "customers"; ?>" />
                <input type="hidden" name="cusid" id="cusid" value="<?php echo base64_decode($_REQUEST['cusid']); ?>" />
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                  
                  <tr>
                    <th>Customer Firstname</th>
                    <th>Customer lastname</th>
                    <th>Customer Email</th>
                    <?php if($customerid==2){  ?>
                    <th>Discount</th>
                    <th>GST Document</th>
                    <th>Business Card</th>
                    <?php
						$qryattrbute=" select t1.*,t2.elementid,t2.element_type,t2.elementname from ".TPLPrefix."customfields_attributes t1 
						inner join ".TPLPrefix."m_elements t2 on t1.AttributeType = t2.elementid and t2.IsActive = 1  
						inner join ".TPLPrefix."customfield_custgrp t3 on t3.CustomFieldId=t1.AttributeId and t3.IsActive=1 
						inner join  ".TPLPrefix."customer_group t4  on t4.customer_group_id=t3.CustomerGrupId and t4.IsActive=1 and t4.customer_group_id='".$customerid."'
						where 1=1 and t1.IsActive =1  group by t1.AttributeCode order by t1.SortBy asc ";
						$resattrbute=$db->get_rsltset($qryattrbute);
						foreach($resattrbute as $att)
						{?>
                    <th><?php echo $att['AttributeName']; ?></th>
                    <?php 		
						}	
						?>
                    <?php } ?>
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