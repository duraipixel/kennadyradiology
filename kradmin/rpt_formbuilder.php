<?php 
$attributesdisp = "attributes";
include "includes/header.php"; 
include "includes/Mdme-functions.php";

$mdme = getMdmerptformbuilder($db,'rpt_formbuilder?formid='.$_REQUEST['formid']);

include_once "includes/pagepermission.php";
            
	    $formid = base64_decode($_REQUEST['formid']);		
        $str_alls="select  t1.* from ".TPLPrefix."formbuilder t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 ";
		$rescntchk =  $db->get_a_line($str_alls); 
		//print_r($rescntchk); 
		$tblname = $rescntchk['FormName'];
		//echo $tblname; exit;
		
		$str_alls="select  t1.AttributeCode  from ".TPLPrefix."fb_attributes t1  where  t1.FormId ='".$formid."'  and t1.IsActive <> 2 order by SortBy ";
		$rescntchk =  $db->get_rsltset($str_alls);
		
	     
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
          <h3> <?php echo $tblname; ?></h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Enquiry</a></li>
              <li class="active"><a href="#"> Manage <?php echo $tblname; ?>    </a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                
                  <div class="col-md-8"><h4>Manage <?php echo $tblname; ?>    </h4></div>
               
                
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="table-responsive mb-4">
                <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "rpt_formbuilder"; ?>" />
		    <input type="hidden" name="formbuilderid" id="formbuilderid" value="<?php echo base64_decode($_REQUEST['formid']); ?>" />
                <table id="tblresult" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
					  <?php foreach($rescntchk as $value){ ?>
						<th><?php echo $value['AttributeCode']; ?></th>
					  <?php } ?>
                        <th>Status</th>
						<th>Actions</th>
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