<?php 
$menudisp = "shipping";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeFlatairShipping($db,''); //getMdmeFlatAirShipping
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$id=$_REQUEST['id'];
$shippingId = base64_decode($_REQUEST['shipping']);
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

 $str_ed = "select shp.*,flt.flatshippingId, flt.shippingTitle, flt.shippingCost, flt.customer_group_id, flt.IsActive, flt.countryid, flt.stateid, flt.sortingOrder,flt.pricetype from ".TPLPrefix."shippingmethods shp inner join ".TPLPrefix."shipping_flat flt on shp.shippingId = flt.shippingId where shp.IsActive <> 2 and flt.IsActive <> 2 and flt.flatshippingId = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['flatshippingId'];

$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
}

}
else
{
	//check edit permission - START	
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
	$btn='Save';
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
          <h3><?php echo $operation; ?> Air Rate Shipping</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Shipping</a></li>
              <li><a href="shippingflatair_mng.php">Shipping Module</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Air Rate Shipping</a> </li>
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
                  <h4><?php echo $operation; ?> Air Rate Shipping</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                    <input type="hidden" name="shippingId" value="<?php echo $shippingId; ?>" />
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Price Type <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <select name="pricetype" id="pricetype"  class="form-control select2" required onchange="chkPriceTyp()">
                              <option value=""> -- Select an option -- </option>
                              <?php
					              $con_id=$res_ed['pricetype'];
								  $sele="selected";
							?>
                              <option value="1" <?php  if($con_id=='1') echo $sele; ?> >Percentage</option>
                              <option value="2" <?php  if($con_id=='2') echo $sele; ?> >Fixed Amount</option>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Shipping Cost <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control numericvalidate" required name="shippingCost" id="shippingCost" value="<?php echo $res_ed['shippingCost']; ?>" onkeypress="return isNumberWithDOt(event)" onkeyup="chkPriceTyp()" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Title <span class="required-class">* </span></label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                            <input type="text" class="form-control" required name="shippingTitle" id="shippingTitle" value="<?php echo $res_ed['shippingTitle']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group mb-4">
                          <label class="control-label">Customer Group </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group	">
                          <div class="controls">
                            <?php 
						  if($act=="update"){
							  if (isset($chk_Ref_there)) {
						  ?>
                            <input type="hidden" name="customer_group_id" value="<?php echo $res_ed['customer_group_id']; ?>" />
                            <?php	
							  echo getSelectBox_Customergroups($db,'customer_group_id','',$res_ed['customer_group_id'],'disabled'); 	  
							  }
							  else{
								echo getSelectBox_Customergroups($db,'customer_group_id','',$res_ed['customer_group_id']);   
							  }							  
						  }
						  else{
							 echo getSelectBox_Customergroups($db,'customer_group_id','',$res_ed['customer_group_id']); 
						  }
						 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Country </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php 
						 
						  if($act=="update"){
							  if (isset($chk_Ref_there)) {
						  ?>
                            <input type="hidden" name="txtcountryid" value="<?php echo $res_ed['countryid']; ?>" />
                            <?php	
							  echo getSelectBox_countrylistMultiple($db,'txtcountryid','',$res_ed['countryid'],'disabled'); 	  
							  }
							  else{
								echo getSelectBox_countrylistMultiple($db,'txtcountryid','',$res_ed['countryid']);   
							  }							  
						  }
						  else{
							 echo getSelectBox_countrylistMultiple($db,'txtcountryid','',$res_ed['countryid']); 
						  }
						 ?>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">State </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <?php
                        if($act=="update"){
							  if (isset($chk_Ref_there)) {
						  ?>
                            <input type="hidden" name="txtstateid" value="<?php echo $res_ed['stateid']; ?>" />
                            <?php								  
							  //echo getSelectBox_statelist($db,'txtstateid','jsrequired',$res_ed['stateid'],'disabled');
							 echo getSelectBox_statelistShip($db,'txtstateid','',$res_ed['stateid'],'',$res_ed['countryid']);
							  }
							  else{
								//echo getSelectBox_statelist($db,'txtstateid','jsrequired',$res_ed['stateid']);
								echo getSelectBox_statelistShip($db,'txtstateid','',$res_ed['stateid'],'',$res_ed['countryid']);
							  }							  
						  }
						  else{
							// echo getSelectBox_statelist($db,'txtstateid','jsrequired',$res_ed['stateid']);
							echo getSelectBox_statelistShip($db,'txtstateid','',$res_ed['stateid'],'',$res_ed['countryid']);
						  }
						 ?>
                            <input type="hidden" name="cntyid" id="cntyid" value="<?php echo $res_ed['countryid']; ?>" />
                            <input type="hidden" name="sttid" id="sttid" value="<?php echo $res_ed['stateid']; ?>" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Sorting </label>
                        </div>
                      </div>
                      <div class="col col col-md-6">
                        <div class="control-group">
                          <div class="controls">
                            <input type="text" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingOrder']; ?>" onkeypress="return isNumber(event)" />
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group">
                          <label class="control-label">Status </label>
                        </div>
                      </div>
                      <div class="col col-md-3">
                        <div class="control-group">
                          <div class="controls">
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox"  class="new-control-input" <?php if(!$id){ ?> checked="checked" <?php  } ?>   name="chkstatus" id="chkstatus" <?php echo $chk; ?>>
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-3">
                        <div class="control-group"> &nbsp; </div>
                      </div>
                      <div class="col col-md-6">
                        <div class="control-group mb-4">
                          <div class="controls">
                       
                    <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="button" onClick="javascript:funSubmt('frmShipFlatAir','shippingflatair_actions.php','jvalidate','shippingflatair','shippingflatair_mng.php?shipping=Mw==');"><span id="spSubmit"><?php echo $btn; ?></span></button>  <button class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"type="reset" onClick="javascript:funCancel('frmShipFlatAir','jvalidate','shipping','shippingflatair_mng.php?shipping=Mw==');">Cancel</button>
                     
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