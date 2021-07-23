<?php 
$menudisp = "paymentgateway";
 include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmePaymentgateway($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END


//check edit permission - START	
if(trim($res_modm_prm['EditPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check edit permission - END

//check Add permission - START		
if(trim($res_modm_prm['AddPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check Add permission - END


//pg_id - 1 [cod payment], pg_id - 2 [CCAvenue], pg_id - 3 [EBS] 	

//payment gateway COD
$str_PGcod= "select * from ".TPLPrefix."paymentgateway_det where pg_det_id = 1 ";
$rslt_PGcod = $db->get_a_line($str_PGcod);

$chk_PGcod='';
if($rslt_PGcod['IsActive']=='1')
{
	$chk_PGcod='checked';
}

//payment gateway CCAvenue
$str_PGcca= "select * from ".TPLPrefix."paymentgateway_det where pg_det_id = 2  and lang_id=1";
$rslt_PGcca = $db->get_a_line($str_PGcca);

$str_PGcca_es= "select * from ".TPLPrefix."paymentgateway_det where parent_id = 2  and lang_id=2";
$rslt_PGcca_es = $db->get_a_line($str_PGcca_es);

$str_PGcca_pt= "select * from ".TPLPrefix."paymentgateway_det where parent_id = 2  and lang_id=3";
$rslt_PGcca_pt = $db->get_a_line($str_PGcca_pt);

$chk_PGcca='';
if($rslt_PGcca['IsActive']=='1')
{
	$chk_PGcca='checked';
}

//payment gateway EBS
$str_PGebs= "select * from ".TPLPrefix."paymentgateway_det where pg_det_id = 3 ";
$rslt_PGebs = $db->get_a_line($str_PGebs);

//payment gateway Master
$str_qry= "select * from ".TPLPrefix."payment_master where IsActive= 1 ";
$rslt_qry = $db->get_rsltset($str_qry);

$chk_PGebs='';
if($rslt_PGebs['IsActive']=='1')
{
	$chk_PGebs='checked';
}



// Payment gateway Razor Payy
$str_razpay= "select * from ".TPLPrefix."paymentgateway_det where pg_det_id = 4 ";
$rslt_razpay = $db->get_a_line($str_razpay);


$chk_razpay='';
if($rslt_razpay['IsActive']=='1')
{
	$chk_razpay='checked';
}

 include "common/dpselect-functions.php";?>
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
          <h3>Payment Gateway</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Payment Gateway</a></li>
              <li class="active"><a href="#">Payment Gateway</a> </li>
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
                  <h4>Manage Payment Gateway</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area icon-change-content">
                  <div id="toggleAccordion">
                    <?php foreach($rslt_qry as $value){ ?>
                    <?php if($value['paymentname']=='COD'){ ?>
                    <div class="card mb-1">
                      <div class="card-header" id="headingOne4">
                        <h5 class="mb-0 mt-0"> <span role="menu" class="" data-toggle="collapse" data-target="#iconChangeAccordionOne" aria-expanded="true" aria-controls="iconChangeAccordionOne"> COD <i class="flaticon-down-arrow float-right mt-1"></i> </span> </h5>
                      </div>
                      <div id="iconChangeAccordionOne" class="collapse" aria-labelledby="headingOne4" data-parent="#toggleAccordion">
                        <div class="row card-body">
                          <div class="col-md-11 mx-auto">
                            <form class="form-horizontal form-val-1" id="frm_PGcod" name="frm_PGcod" action="#" novalidate="">
                              <input type="hidden" name="hdn_update_pg" value="1"  />
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cod_title" id="cod_title" value="<?php echo $rslt_PGcod['title']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Order Status <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getSelectBox_orderstatus($db,'cod_orderstatus','jsrequired','',$rslt_PGcod['orderstatus']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Customer Group</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getmutlipleselect_Customergroups($db,'customer_group_ids','multiselect select2',$res_custgroup['CustomerGrupId']);  
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Minimum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cod_minAmt" id="cod_minAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcod['min_amt']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Maximum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cod_maxAmt" id="cod_maxAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcod['max_amt']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Countries</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecountries($db,'cod_excludecountry[]','', $rslt_PGcod['exclude_countries']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Categories</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecategories($db,'cod_excludecategory[]','',$rslt_PGcod['exclude_categories']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Sorting Order <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cod_sortingorder" id="cod_sortingorder" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcod['sortingorder']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Status</label>
                                  </div>
                                </div>
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-success">
                                          <input type="checkbox" class="new-control-input"  name="cod_chkstatus" id="cod_chkstatus" <?php echo $chk_PGcod; ?>>
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
                                      <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4"  onClick="javascript:funSubmt_COD_payment()">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }  else if($value['paymentname']=='CCAvenue'){?>
                    <div class="card mb-1">
                      <div class="card-header" id="headingTwo4">
                        <h5 class="mb-0 mt-0"> <span role="menu" class="collapsed" data-toggle="collapse" data-target="#iconChangeAccordionTwo" aria-expanded="false" aria-controls="iconChangeAccordionTwo"> CCAvenue <i class="flaticon-down-arrow float-right mt-1"></i> </span> </h5>
                      </div>
                      <div id="iconChangeAccordionTwo" class="collapse" aria-labelledby="headingTwo4" data-parent="#toggleAccordion">
                        <div class="row card-body">
                          <div class="col-md-11 mx-auto">
                            <form id="frm_PGccavenue" name="frm_PGccavenue" action="#" novalidate="">
                              <input type="hidden" name="hdn_update_pg" value="2"  />
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_title" id="cca_title" value="<?php echo $rslt_PGcca['title']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label"><?php echo Spanish; ?> Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_title_es" id="cca_title_es" value="<?php echo $rslt_PGcca_es['title']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label"><?php echo Portuguese; ?> Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_title_pt" id="cca_title_pt" value="<?php echo $rslt_PGcca_pt['title']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Order Status <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getSelectBox_orderstatus($db,'cca_orderstatus','jsrequired','',$rslt_PGcca['orderstatus']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Customer Group</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getmutlipleselect_Customergroups($db,'customer_group_id','multiselect select2',$res_custgroup['CustomerGrupId']);  
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Minimum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_minAmt" id="cca_minAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcca['min_amt']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Maximum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_maxAmt" id="cca_maxAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcca['max_amt']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Countries</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecountries($db,'cca_excludecountry[]','', $rslt_PGcca['exclude_countries']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Categories</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecategories($db,'cca_excludecategory[]','',$rslt_PGcca['exclude_categories']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Sorting Order <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_sortingorder" id="cca_sortingorder" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGcca['sortingorder']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Merchant ID <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_merchantid" id="cca_merchantid" value="<?php echo $rslt_PGcca['merchant_id']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Encrypt Key <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_encryptkey" id="cca_encryptkey" value="<?php echo $rslt_PGcca['encrypt_key']; ?>"/>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Access Code<span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="cca_accesscode" id="cca_accesscode" value="<?php echo $rslt_PGcca['access_code']; ?>"/>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Status</label>
                                  </div>
                                </div>
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-success">
                                          <input type="checkbox" class="new-control-input"  name="cca_chkstatus" id="cca_chkstatus" <?php echo $chk_PGcca; ?>>
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
                                      <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmt_CCA_payment()">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }else if($value['paymentname']=='EBS'){ ?>
                    <div class="card mb-4">
                      <div class="card-header" id="headingThree4">
                        <h5 class="mb-0 mt-0"> <span role="menu" class="collapsed" data-toggle="collapse" data-target="#iconChangeAccordionThree" aria-expanded="false" aria-controls="iconChangeAccordionThree"> EBS <i class="flaticon-down-arrow float-right mt-1"></i> </span> </h5>
                      </div>
                      <div id="iconChangeAccordionThree" class="collapse" aria-labelledby="headingThree4" data-parent="#toggleAccordion">
                        <div class="row card-body">
                          <div class="col-md-11 mx-auto">
                            <form id="frm_PGebs" name="frm_PGebs" action="#" novalidate="">
                              <input type="hidden" name="hdn_update_pg" value="3"  />
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_title" id="ebs_title" value="<?php echo $rslt_PGebs['title']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Order Status <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getSelectBox_orderstatus($db,'ebs_orderstatus','jsrequired','',$rslt_PGebs['orderstatus']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Minimum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_minAmt" id="ebs_minAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGebs['min_amt']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Maximum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_maxAmt" id="ebs_maxAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGebs['max_amt']; ?>"/>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Countries</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecountries($db,'ebs_excludecountry[]','', $rslt_PGebs['exclude_countries']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Categories</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                      <?php 
								echo getMultiSelectBox_Excludecategories($db,'ebs_excludecategory[]','',$rslt_PGebs['exclude_categories']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Sorting Order <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_sortingorder" id="ebs_sortingorder" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_PGebs['sortingorder']; ?>"/>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Account ID <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_accid" id="ebs_accid" value="<?php echo $rslt_PGebs['acc_id']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Secret Key <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control" required name="ebs_secretkey" id="ebs_secretkey" value="<?php echo $rslt_PGebs['secret_key']; ?>"/>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Status</label>
                                  </div>
                                </div>
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-success">
                                          <input type="checkbox" class="new-control-input"  name="ebs_chkstatus" id="ebs_chkstatus" <?php echo $chk_PGebs; ?>>
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
                                      <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmt_EBS_payment()">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 					
					}
					
					
					else if($value['paymentname']=='Razor Pay'){ ?>
                    <div class="card mb-4">
                      <div class="card-header" id="headingThree5">
                        <h5 class="mb-0 mt-0"> <span role="menu" class="collapsed" data-toggle="collapse" data-target="#iconChangeAccordionFour" aria-expanded="false" aria-controls="iconChangeAccordionThree">  RAZOR PAY <i class="flaticon-down-arrow float-right mt-1"></i> </span> </h5>
                      </div>
                      <div id="iconChangeAccordionFour" class="collapse" aria-labelledby="headingThree5" data-parent="#toggleAccordion">
                        <div class="row card-body">
                          <div class="col-md-11 mx-auto">
                            <form id="frm_PGccavenue" name="frm_PGccavenue" role="form" class="form-horizontal" action="#" method="post" >
						 <input type="hidden" name="hdn_update_pg" value="2"  />
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Title <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <input type="text" class="form-control jsrequired" required name="cca_title" id="cca_title" value="<?php echo $rslt_razpay['title']; ?>" /> 
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Order Status <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                    	<?php 
								echo getSelectBox_orderstatus($db,'cca_orderstatus','jsrequired','',$rslt_razpay['orderstatus']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                               <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Order Status <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                    	 <?php 
								echo getmutlipleselect_Customergroups($db,'customer_group_id','multiselect',$res_custgroup['CustomerGrupId']);  
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                             
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Minimum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                   	<input type="text" class="form-control jsrequired" required name="cca_minAmt" id="cca_minAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_razpay['min_amt']; ?>" />
                                      
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Maximum Amount</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                     <input type="text" class="form-control jsrequired" required name="cca_maxAmt" id="cca_maxAmt" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_razpay['max_amt']; ?>" />
                                    
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Countries</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                     <?php 
								echo getMultiSelectBox_Excludecountries($db,'cca_excludecountry[]','', $rslt_razpay['exclude_countries']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group">
                                    <label class="control-label">Exclude Categories</label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group">
                                    <div class="controls">
                                    <?php 
								echo getMultiSelectBox_Excludecategories($db,'cca_excludecategory[]','',$rslt_razpay['exclude_categories']); 
								?>
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Sorting Order <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                     <input type="text" class="form-control jsrequired" required name="cca_sortingorder" id="cca_sortingorder" onkeypress="return isNumberWithDOt(event)" value="<?php echo $rslt_razpay['sortingorder']; ?>" />
                                       
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Key <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                     <input type="text" class="form-control jsrequired" required name="cca_encryptkey" id="cca_encryptkey" value="<?php echo $rslt_razpay['encrypt_key']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Secret Key <span class="required-class">* </span></label>
                                  </div>
                                </div>
                                <div class="col col col-md-6">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                     <input type="text" class="form-control jsrequired" required name="secret_key" id="secret_key" value="<?php echo $rslt_razpay['secret_key']; ?>" />
                                      <p class="help-block"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <label class="control-label">Status</label>
                                  </div>
                                </div>
                                <div class="col col-md-3">
                                  <div class="control-group mb-4">
                                    <div class="controls">
                                      <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-success"> 
                                          <input type="checkbox" class="new-control-input"  name="cca_chkstatus" id="cca_chkstatus" <?php echo $chk_razpay; ?>>
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
                                 
                                     
                                      <button type="button" class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" onClick="javascript:funSubmt_Razorpay_payment()">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 					
					}
					
					}?>
                  </div>
                </div>
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
<script>

$(function() {
    <?php if($res_custgroup['CustomerGrupId']=='') { ?>
	 $(".multiselect > option").prop("selected","selected");
	 $(".multiselect").select2();
	<?php } ?>
	 
});	
</script>
<script type="text/javascript">
function funSubmt_COD_payment(){
	if ($('#frm_PGcod').valid()) {
		$.ajax({
			type: "POST",
			data : $("#frm_PGcod").serialize(),
			dataType : 'text',
			url: 'paymentgateway_actions.php',
			beforesend:loading(), 	
			success: function(result){ 
				if(result =='success'){	
					toast({type: 'success',title: 'COD Payment Details Update Successfully',padding: '5px'});
				}					
				else {
					 toast({type: 'warning',title: result}); 
				}
				unloading();						
			}			
		});		
	}	
}

function funSubmt_CCA_payment(){
	if ($('#frm_PGccavenue').valid()) {
		$.ajax({
			type: "POST",
			data : $("#frm_PGccavenue").serialize(),
			dataType : 'text',
			url: 'paymentgateway_actions.php',
			beforesend:loading(), 	
			success: function(result){ 
				if(result =='success'){	
					toast({type: 'success',title: 'CCAvenue Payment Details Update Successfully'});
				}					
				else {
					toast({type: 'warning',title: result}); 
				}
				unloading();												
			}			
		});		
	}	
}

function funSubmt_EBS_payment(){
	if ($('#frm_PGebs').valid()) {
		$.ajax({
			type: "POST",
			data : $("#frm_PGebs").serialize(),
			dataType : 'text',
			url: 'paymentgateway_actions.php',
			beforesend:loading(), 	
			success: function(result){ 
				if(result =='success'){	
					toast({type: 'success',title: 'EBS Payment Details Update Successfully'});
				}					
				else {
					toast({type: 'warning',title: result}); 
				}					
				unloading();			
			}			
		});		
	}	
}

function funSubmt_Razorpay_payment(){
	if ($('#frm_PGccavenue').valid()) {
		$.ajax({
			type: "POST",
			data : $("#frm_PGccavenue").serialize(),
			dataType : 'text',
			url: 'paymentgateway_actions.php',
			beforesend:loading(), 	
			success: function(result){ 
						if(result =='success'){	
							swal("Success!", "Razor pay Payment Details Update Successfully", "success");	
							unloading();						
						}					
						else {
							swal("Failure!", result, "warning");
							unloading();						
						}					
							
			}			
		});		
	}	
}
</script>