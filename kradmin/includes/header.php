<?php
  include "session.php";  
  $storeinfo=getQuerys($db,"storename");
  include_once "navmenu-functions.php"; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo $storeinfo['storeName']; ?> Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL_ADMIN;?>assets/images/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/ecommerce-dashboard/timeline.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ecommerce-dashboard/style.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <!----- loader Style--->
    <link href="plugins/loaders/csspin.css" rel="stylesheet" type="text/css" />
    <link href="plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <!-- loader style--->

	 <!-- BEGIN DATATABLE -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_miscellaneous.css">
 
 
	<link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ui-kit/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    
    <!--<link rel="stylesheet" type="text/css" href="plugins/jqvalidation/custom-jqBootstrapValidation.css">-->
 	
    <link rel="stylesheet" href="plugins/jquery-validation/css/screen.css">
	<link rel="stylesheet" href="plugins/jquery-validation/css/cmxform.css">
    
     <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/modals/component.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    
     <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
     
     <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="plugins/editors/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <link href="plugins/editors/summernote/custom-summernote-bs4.css" rel="stylesheet" type="text/css" />
    <!--  BEGIN CUSTOM STYLE FILE  -->
    
    
    <!-- BEGIN THEME GLOBAL STYLES -->
    
    <link href="assets/css/design-css/design.css" rel="stylesheet" type="text/css" />
    <link href="plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="plugins/timepicker/jquery.timepicker.css" rel="stylesheet" type="text/css">
<!--    <link href="plugins/date_time_pickers/custom_datetimepicker_style/custom_datetimepicker.css" rel="stylesheet" type="text/css">
-->    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="assets/css/components/custom-page_style_datetime.css">
    <!--  END CUSTOM STYLE FILE  -->
    
 
<!--    <link rel="stylesheet" href="plugins/treeview/gijgo.min.css">
-->
    <link href="plugins/filer/css/jquery.filer.css" rel="stylesheet">
	<link href="plugins/filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

   <link href="assets/css/design-css/design.css" rel="stylesheet">
    <link href="plugins/treeview/default/style.min.css" rel="stylesheet">
    <!-- END PAGE LEVEL PLUGINS -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/ui-kit/custom-tree_view.css" rel="stylesheet" type="text/css" />  
    
    <link href="assets/css/components/portlets/portlet.css" rel="stylesheet" type="text/css" />
    
    	<link rel="stylesheet" href="assets/css/easy-autocomplete.css" type="text/css"  />
	<link rel="stylesheet" href="assets/css/easy-autocomplete.min.css" type="text/css"  />
	<link rel="stylesheet" href="assets/css/easy-autocomplete.themes.css" type="text/css"   />
    
    <link type="text/css" href="assets/css/font-awesome.min.css" rel="stylesheet" />      
     
     <?php if(basename($_SERVER['PHP_SELF']) != 'fbmanagementdisplay_mng.php'){?>
    <link rel="stylesheet" type="text/css" href="assets/css/ecommerce/product.css">
    <?php }?>

	  <link href="assets/css/ui-kit/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
      
    <!-- Ionicons -->    
    
   <!-- END CSS SECTION -->
    <script type="text/javascript">	
		
    function loading() {			
        document.getElementById("load").style.display = 'block';
    }
    
    function unloading() {
        document.getElementById("load").style.display = 'none';
    }
    </script>
    
    <style>
    .jodit_toolbar_btn-fullsize {
        display:none !important;
    }
    .list-unstyled{
    text-transform: capitalize;	
    }
	
	
    </style>
    
</head>

<body>
<!-- loading div - START -->
<div id="load" style=" background:url(images/overly.png) repeat; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%;">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle"><table width="425" align="center"  style="border:0px solid #f0f0f0;"   border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="middle">
            	<div align="center" class="loading" style="border:0px solid #fff;"> 
                	<div class="cp-spinner cp-bubble"></div><br /><br/>
                <div id="convprogress"> </div>
              </div></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<!-- loading div - END -->