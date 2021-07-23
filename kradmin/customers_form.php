<?php 
$menudisp = "customers";
$headcss='<link type="text/css" href="css/multiple-select.css" rel="stylesheet" />';
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeCustomers($db,'');
$mdme = getMdmeCustomers($db,'customers_mng.php?cusid='.$_REQUEST['id']);
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	//header("Location:".admin_public_url."error.php");
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

$str_ed = "select * from ".TPLPrefix."customers where 1=1 and customer_id = ? ";
$res_ed = $db->get_a_line_bind($str_ed,array(base64_decode($id)));
$edit_id = $res_ed['customer_id'];

 

$rslt_cusaddress1 ="SELECT t1.*,t2.statename,t3.countryname FROM ".TPLPrefix."cus_address t1
inner join ".TPLPrefix."state t2 on t1.stateid = t2.stateid 
inner join ".TPLPrefix."country t3 on t1.countryid = t3.countryid 
WHERE 1=1 and t1.customer_id = ? ";

$rslt_cusaddress =  $db->get_rsltset_bind($rslt_cusaddress1,array($edit_id));
$address_cnt= count($rslt_cusaddress);	

//shopping cart product
$rslt_cusProduct1 = "select t1.*,t2.customerId, t3.product_name, t4.img_path
from ".TPLPrefix."custcart_product t1
inner join ".TPLPrefix."custcart t2 on t1.cartId = t2.cartId and IsActive =1
inner join ".TPLPrefix."product t3 on t1.productId = t3.product_id
left join ".TPLPrefix."product_images t4 on t3.product_id = t4.product_id and t4.isthumbdefault = 1
where 1=1 and t2.customerId = ? ";
$rslt_cusProduct =  $db->get_rsltset_bind($rslt_cusProduct1,array($edit_id));

$cusProduct_cnt = count($rslt_cusProduct);	

//review parameter result
$rslt_cusReview1 = "select t4.product_id,t4.product_name,t4.sku,t2.CustomerName,t2.Message,t5.img_path, group_concat(t3.ParameterTitel, ' : ', t1.Value ) as disppara, t2.IsActive as approvestatus, t2.ReviewId as dispReviewId  from ".TPLPrefix."reviewparametervalue t1 
inner join ".TPLPrefix."productreview t2 on t1.ReviewId = t2.ReviewId
inner join ".TPLPrefix."reviewparameter t3 on t1.ParameterId = t3.ParameterId
inner join ".TPLPrefix."product t4 on t2.ProductId = t4.product_id
left join ".TPLPrefix."product_images t5 on t4.product_id = t5.product_id and t5.isthumbdefault = 1
where 1=1 and t2.CustomerId = ? group by t1.ReviewId ";
$rslt_cusReview =  $db->get_rsltset_bind($rslt_cusReview1,array($edit_id));
$cusReview_cnt = count($rslt_cusReview);






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
          <h3>Customer</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flatcustomer-info-fill"></i></a></li>
              <li><a href="#">Customers</a></li>
              <li><a href="customfields_mng.php">Customer</a></li>
              <li class="active"><a href="#"><?php echo $operation; ?> Customer</a> </li>
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
                  <h4><?php echo $operation; ?> Custom Fields</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">
              <div class="row">
                <div class="col-md-11 mx-auto">
                  <form class="form-horizontal form-val-1" id="jvalidate" name="frmCountry" action="#" novalidate="">
                    <input type="hidden" name="action" value="<?php echo $act; ?>" />
                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>"  />
                    <ul class="nav nav-tabs  mb-3 mt-3" id="iconTab" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" id="customer-info-tab" data-toggle="tab" href="#customer-info" role="tab" aria-controls="customer-info" aria-selected="true"><i class="flaticon-user-11"></i> Customer Basic Info</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="address-info-tab" data-toggle="tab" href="#address-info" role="tab" aria-controls="address-info" aria-selected="false"><i class="flaticon-map"></i> Address Info</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="product-info-tab" data-toggle="tab" href="#product-info" role="tab" aria-controls="product-info" aria-selected="false"><i class="flaticon-menu-list"></i> Product Info</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="product-info-tab" data-toggle="tab" href="#wishlist-info" role="tab" aria-controls="product-info" aria-selected="false"><i class="flaticon-like-12"></i> Wish-list Info</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="product-info-tab" data-toggle="tab" href="#review-info" role="tab" aria-controls="product-info" aria-selected="false"><i class="flaticon-notes"></i> Review Info</a> </li>
                    </ul>
                    <div class="tab-content" id="iconTabContent-1">
                      <div class="tab-pane fade show active" id="customer-info" role="tabpanel" aria-labelledby="customer-info-tab">
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group">
                              <label class="control-label">Customer Group <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group">
                              <div class="controls">
                                <?php 
							 echo getSelectBox_Customergroups($db,'selCusGroupid','jsrequired',$res_ed['customer_group_id']);
							?>
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">First Name <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control jsrequired" name="fname" id="fname" value="<?php echo $res_ed['customer_firstname']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Last Name <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control " name="lname" id="lname" value="<?php echo $res_ed['customer_lastname']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Email <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="email" class="form-control jsrequired email" name="txtCusemail" id="txtCusemail" value="<?php echo $res_ed['customer_email']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row file">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Mobile Number <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control jsrequired" name="mobileno" id="mobileno" value="<?php echo $res_ed['mobileno']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php if($res_ed['customer_group_id']=='2'){ ?>
                        <div class="row file">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Discount Percentage <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="text" class="form-control jsrequired" name="discount" id="discount" value="<?php echo $res_ed['discount']; ?>" <?php if($_SESSION["RoleId"]!=1){ echo "readonly"; } ?>  />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">GST Document <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input id="gstdocument" name="gstdocument" type="file" accept="" <?php if($res_ed['gstdocument'] == ''){?> required <?php }?> class="form-control-file common_upload_style"  />
                                <p class="help-block"></p>
                              </div>
                              <?php  if (!empty($res_ed['gstdocument']) && ($act == 'update')) { 
						  if(file_exists("../uploads/gstdocument/".$res_ed['gstdocument']))
						   { ?>
                              <div class="jFiler-items jFiler-row">
                                <ul class="jFiler-items-list jFiler-items-grid">
                                  <li class="jFiler-item" data-jfiler-index="0" style="">
                                    <div class="jFiler-item-container">
                                      <div class="jFiler-item-inner">
                                        <div class="jFiler-item-thumb">
                                          <div class="jFiler-item-thumb-image"> <span> <img src="../uploads/gstdocument/<?php echo $res_ed['gstdocument']; ?>" width="250" height="250" align="absmiddle"/></span> </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <?php  }
						   }?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Business Card <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input id="businesscard" name="businesscard" type="file" accept=""  class="common_upload_style" onchange="return imageformatcheck(this.value,'image')" <?php if($res_ed['businesscard'] == ''){?> required <?php }?>>
                                <p class="help-block"></p>
                              </div>
                              <?php  if (!empty($res_ed['businesscard']) && ($act == 'update')) { 
						  if(file_exists("../uploads/businesscard/".$res_ed['businesscard']))
						   { ?>
                              <div class="jFiler-items jFiler-row">
                                <ul class="jFiler-items-list jFiler-items-grid">
                                  <li class="jFiler-item" data-jfiler-index="0" style="">
                                    <div class="jFiler-item-container">
                                      <div class="jFiler-item-inner">
                                        <div class="jFiler-item-thumb">
                                          <div class="jFiler-item-thumb-image"> <span> <img src="../uploads/businesscard/<?php echo $res_ed['businesscard']; ?>" width="250" height="250" align="absmiddle"/></span> </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <?php  }
						   }?>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if($act != "update"){ ?>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Password <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="password" class="form-control jsrequired pwdchk" name="txtPwd" id="txtPwd" value="<?php echo $res_ed['first_name']; ?>" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col col-md-3">
                            <div class="control-group mb-4">
                              <label class="control-label">Confirm Password <span class="required-class">* </span></label>
                            </div>
                          </div>
                          <div class="col col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <input type="password" class="form-control jsrequired" name="txtConfirmPwd" id="txtConfirmPwd" value="<?php echo $res_ed['first_name']; ?>" equalto="#txtPwd" />
                                <p class="help-block"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                        
                        <!-- Data load dynamically -->
                        <div id="corporate"></div>
                        <!-- End -->
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
                          <div class="col col-md-6">
                            <div class="control-group mb-4"> &nbsp; </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="control-group mb-4">
                              <div class="controls">
                                <button  class="btn btn-warning btn-rounded snackbar-txt-warning mb-4" type="button" onClick="javascript:funSubmtWithImg('frmcustomer','customers_actions.php','jvalidate','Customer','customers_mng.php?cusid=<?php echo $_REQUEST['id']; ?>','selCusGroupid');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                                <button class="btn btn-dark btn-rounded snackbar-bg-dark mb-4" type="reset" onClick="javascript:funCancel('frmcustomer','jvalidate','Customer','customers_mng.php?cusid=<?php echo $_REQUEST['id']; ?>');" >Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="address-info" role="tabpanel" aria-labelledby="address-info-tab">
                        <div class="addressrow">
                          <div class="box box-solid" style="padding:10px;">
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-3">
                                  <input type="text" class="form-control" name="txt_firstname" id="txt_firstname" placeholder="First Name" />
                                </div>
                                <div class="col-md-3">
                                  <input type="text" class="form-control" name="txt_lastname" id="txt_lastname" placeholder="Last Name" />
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="txt_address" id="txt_address" placeholder="Address" />
                                </div>
                                <div class="col-sm-3">
                                  <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Email" />
                                </div>
                              </div>
                              <div class="row"> &nbsp;</div>
                              <div class="row">
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="txt_city" id="txt_city" placeholder="City" />
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="txt_postcode" id="txt_postcode" placeholder="Post Code" />
                                </div>
                                <div class="col-sm-3">
                                  <?php 
									 echo getSelectBox_countrylist_To_cus_address($db,'sel_country','');
									?>
                                </div>
                                <div class="col-sm-3">
                                  <select class="form-control select2" id="sel_state" name="sel_state" >
                                    <option value=""> Select State </option>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="txt_landmark" id="txt_landmark" placeholder="Landmark" />
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="txt_telephone" id="txt_telephone" placeholder="Telephone" />
                                </div>
                                <div class="col-sm-2">&nbsp;</div>
                                <div class="col-sm-4">
                                  <input type="hidden" name="hdnact" value="cusaddress"  />
                                  <input type="hidden" name="hdn_editaddressid" id="hdn_editaddressid" value=""  />
                                  <button class="btn btn-dark margin pull-right clearico" type="button" onclick="CancelAddress();"><i class="fa fa-eraser"></i> Clear</button>
                                  <button class="btn bg-warning margin pull-right addico" type="button" onclick="addAddress();"><span id="btn_address"><i class="fa fa-plus"></i> Add Address</span></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row"> &nbsp;</div>
                          <div class="row"> &nbsp;</div>
                          <div class="row"> &nbsp;</div>
                        </div>
                        <div class="row" id="address_list">
                          <?php 						 
						 if($act=="update"){	
							if($address_cnt >0){
								$i =1;
								foreach($rslt_cusaddress as $rslt_cusaddress_S){
								?>
                          <div class="widget portlet-widget col-md-4" id="address_row_<?php echo $rslt_cusaddress_S['cus_addressid']; ?>">
                            <div class="widget-content widget-content-area">
                              <div class="portlet portlet-warning">
                                <div class="portlet-title portlet-warning d-flex justify-content-between">
                                  <div class="caption  align-self-center"> <span class="caption-subject text-uppercase white ml-1"> Address <?php echo $i++;?></span> </div>
                                  <div class="actions  align-self-center"> <a href="javascript:;" onclick="edit_address(<?php echo $rslt_cusaddress_S['cus_addressid']; ?>)" class="btn btn-red btn-circle"> <i class="flaticon-edit-7"></i> </a> <a href="javascript:;" onclick="remove_address(<?php echo $rslt_cusaddress_S['cus_addressid']; ?>)" class="btn btn-red btn-circle"> <i class="flaticon-delete"></i> </a> </div>
                                </div>
                                <div class="portlet-body portlet-common-body">
                                  <address>
                                  <div class="row">
                                    <div class="col-md-12"><b>First Name</b> : <?php echo $rslt_cusaddress_S['firstname']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Last Name</b> : <?php echo $rslt_cusaddress_S['lastname']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Address</b> : <?php echo $rslt_cusaddress_S['address']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Email</b> : <?php echo $rslt_cusaddress_S['emailid']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>City</b> : <?php echo $rslt_cusaddress_S['city']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Postal code</b> : <?php echo $rslt_cusaddress_S['postalcode']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>State</b> : <?php echo $rslt_cusaddress_S['statename']; ?> </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Country</b> : <?php echo $rslt_cusaddress_S['countryname']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Landmark</b> : <?php echo $rslt_cusaddress_S['landmark']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12"><b>Telephone</b> : <?php echo $rslt_cusaddress_S['telephone']; ?></div>
                                  </div>
                                  </address>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php	
								}
							}
						 }						
						?>
                        </div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                      </div>
                      <div class="tab-pane fade" id="wishlist-info" role="tabpanel" aria-labelledby="product-info-tab">
                        <?php 
						if($act=="update"){	
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Wish-list Info</h4></div>";
						}
						else{
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Wish-list Info - N/A</h4></div>";
						}
					?>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                      </div>
                      <div class="tab-pane fade" id="review-info" role="tabpanel" aria-labelledby="product-info-tab">
                        <?php 
					if($act=="update"){	
						if($cusReview_cnt > 0){ 
							?>
                        <div class="box-body">
                          <table id="tblresult" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Product Img</th>
                                <th>Product Name</th>
                                <th>Product SKU</th>
                                <th>Customer Name</th>
                                <th>Message</th>
                                <th>Parameter</th>
                                <th>Status</th>
                                <th>Bulk Approve</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php	
							foreach($rslt_cusReview as $rslt_cusReview_S){
								$approvestatus = "";
								$bulkdelete = "";
								
								if($rslt_cusReview_S['approvestatus'] == "0"){
									$approvestatus = "<button class='btn btn-block btn-info'>Pending</button>";
									$bulkdelete ='<div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                                <input type="checkbox" required class="new-control-input"    name="chkApproveparameter[]" value="'.$rslt_cusReview_S['dispReviewId'].'">
                                <span class="new-control-indicator"></span>&nbsp; </label>
                            </div>';
								}
								else if($rslt_cusReview_S['approvestatus'] == "1"){
									$approvestatus = "<button class='btn btn-success btn-rounded snackbar-txt-warning mb-4'  >Approved</button>";
								}
								else if($rslt_cusReview_S['approvestatus'] == "2"){
									$approvestatus = "<button class='btn btn-danger btn-rounded snackbar-txt-warning mb-4'>Deleted</button>";
								}
							?>
                              <tr>
                                <td><img src="<?php echo image_public1_url; ?>productassest/<?php echo $rslt_cusReview_S['product_id']; ?>/photos/thumb/<?php echo $rslt_cusReview_S['img_path']; ?>" alt="Product Image <?php echo $rslt_cusReview_S['product_id']; ?>" width="100px" height="100px" /></td>
                                <td><?php echo $rslt_cusReview_S['product_name']; ?></td>
                                <td><?php echo $rslt_cusReview_S['sku']; ?></td>
                                <td><?php echo $rslt_cusReview_S['CustomerName']; ?></td>
                                <td><?php echo $rslt_cusReview_S['Message']; ?></td>
                                <td><?php echo $rslt_cusReview_S['disppara']; ?></td>
                                <td><?php echo $approvestatus; ?></td>
                                <td><?php echo $bulkdelete; ?></td>
                              </tr>
                              <?php									
							}
						   ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <div class="row">
                          <div class="col-md-6">&nbsp;</div>
                          <div class="col-md-6">
                            <button  class="btn btn-success btn-rounded snackbar-txt-warning mb-4" type="button" onclick="select_all(1);" name="selectall" id="selectall" >Select All</button>
                            <button class="btn btn-info btn-rounded snackbar-txt-warning mb-4"   type="button" onclick="select_all(0);" name="unselectall" id="unselectall" >UnSelect All</button>
                            <button class="btn btn-primary btn-rounded snackbar-txt-warning mb-4"   type="button" onclick="approve_selected();" name="approve" id="approve" >Approve Selected</button>
                            <button class="btn btn-danger btn-rounded snackbar-txt-warning mb-4"   type="button" onclick="delete_selected();" name="delete" id="delete" >Delete Selected</button>
                          </div>
                        </div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <div class="row"> &nbsp;</div>
                        <?php	
						}
						else {
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Review Parameter Info</div>";
						}	
					}
					else {
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Review Parameter Info - N/A</div>";
						}		
					?>
                      </div>
                      <div class="tab-pane fade" id="product-info" role="tabpanel" aria-labelledby="product-info-tab">
                        <?php 
					if($act=="update"){	
						if($cusProduct_cnt > 0){ 
							?>
                        <div class="box-body">
                          <table id="tblresult" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Image</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php							
							foreach($rslt_cusProduct as $rslt_cusProduct_S){
							?>
                              <tr>
                                <td><?php echo $rslt_cusProduct_S['quantity']; ?></td>
                                <td><?php echo $rslt_cusProduct_S['product_name']; ?></td>
                                <td><img src="<?php echo image_public1_url; ?>productassest/<?php echo $edit_id; ?>/photos/thumb/<?php echo $rslt_cusProduct_S['img_path']; ?>" alt="Product Image" width="100px" height="100px" /></td>
                              </tr>
                              <?php								
							}
							?>
                            </tbody>
                          </table>
                        </div>
                        <?php		
						}
						else {
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Product Info</div>";
						}		
					}
					else {
							echo "<div class='col-md12 text-danger mb-4 text-center padding35'><h4>Product Info - N/A</div>";
					}		
					?>
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

$(function(){
	$("#selCusGroupid").change(function(){
		var id = $("#selCusGroupid").val();
		
		var eid = $("#edit_id").val();
		    if(eid!='')
			{
				var editid = eid;
			}
			else
			{
				var editid = '';
			}
		  
			$.ajax({
			type: "POST",
			data : 'hdnact=getcustomergrouplist&customerid='+id+'&edit_id='+editid,
			dataType : 'json',
			url: 'common/ajax-functions.php',
			beforesend:loading(), 	
			success: function(response){ 
			$("#corporate").html(response.rslt);
			loadjfiller(response.filecnt,response.acctype);
			unloading();
				 var dateFormat = "<?php echo $GLOBALS['stroedateformat']['dateformat']; ?>";
				$(".datepicker_today_max" ).datepicker({
				dateFormat: dateFormat,
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				maxDate:new Date
				});
		
			
			 $('input[type=radio]').change(function(){
					 
					 $('input[type=radio]').next("label.error").removeClass("error");
			 });
			$(function(){
					$(".multiselect").multipleSelect({ width: 460}).multipleSelect("checkAll");
			});


					
					
			}			
		});	
	})
	
	

	var cusid ='';
	<?php if($edit_id != ""){ ?>		
	    
		cusid = '<?php echo base64_encode($edit_id); ?>';
	<?php } ?>	
	
		var id = $("#selCusGroupid").val();
		var eid = $("#edit_id").val();
		 if(eid!='')
			{
				var editid = eid;
			}
			else
			{
				var editid = '';
			}
			$.ajax({
			type: "POST",
			data : 'hdnact=getcustomergrouplist&customerid='+id+'&edit_id='+editid,
			dataType : 'json',
			url: 'common/ajax-functions.php',
			beforesend:loading(), 	
			success: function(response){ 
			$("#corporate").html(response.rslt);
			loadjfiller(response.filecnt,response.acctype);
			
			unloading();
				 var dateFormat = "<?php echo $GLOBALS['stroedateformat']['dateformat']; ?>";
				$(".datepicker_today_max" ).datepicker({
				dateFormat: dateFormat,
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				maxDate:new Date
				});
			 $.post("customers_actions.php",{cusid:cusid,getcusImage:'getcusImage'},function(data){
						$("#uploadedcustomer").html(data);
					});	
					
					
			}			
		});		
	
});

var flag_state = -1;
 $(function () {
   $('.hasDatepicker').datepicker({					
		/*dateFormat: "mm-dd-yy",		*/	
		format: '<?php echo DATFORMAT;?>',		
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+20",
		autoclose: true,
		maxDate: new Date			
	});			
	
	$(".select2").css("width","100%");
	
 });
  
 function getstate(countryid){	 
   if(countryid != null && countryid != ""){
		$.ajax({
			type: "POST",
			data : 'hdnact=getStatelist&countryid='+countryid,
			dataType : 'text',
			url: 'common/ajax-functions.php',
			beforesend:loading(), 	
			success: function(msg){ 
				$("#sel_state").html(msg);
				if(flag_state != -1){
					$("#sel_state").select2("val", flag_state);
				}
				unloading();		
			}			
		});	
   }
 }
 
 // Address Script Start
 function addAddress(){
	 var cus_id = $("#edit_id").val();
	 if(cus_id != null && cus_id !=""){
		 
		var chk_validate = validate();	
		
		if(chk_validate == true){
						
			//save to db
			$.ajax({
				type: "POST",
				data : $("#jvalidate").serialize(),
				dataType : 'json',
				url: 'common/ajax-functions.php',
				beforesend:loading(), 	
				success: function(msg){ 
					if(msg.rslt_operation == "update"){
						var row_id = $("#hdn_editaddressid").val();
						$("#address_row_"+row_id).html(msg.rslt_html);			
					}
					else{
						$("#address_list").append(msg.rslt_html);						
					}
					
					$("#hdn_editaddressid").val("");
					$("#btn_address").html("Add Address");					
					flag_state = -1;
					addressfields_clear();		
					unloading();		
				}			
			});				
			
		}	 
		
	 }
	 else{
		  toast({type: 'warning',title: 'Please Save Customer Basic Information',padding: '1em'}); 
 	 }
	 
 }
 

 function validate(){	 	 
	 var first_name = $("#txt_firstname").val();
	 var address = $("#txt_address").val();
	 var city = $("#txt_city").val();
	 var postalcode = $("#txt_postcode").val();
	 var country = $("#sel_country").val();
	 var state = $("#sel_state").val();
	 
	 if(first_name == ""){
		  toast({type: 'warning',title:'Please Enter First Name',padding: '1em'}); 
		 
		 return false;
	 }
	 else if(address == ""){
		 toast({type: 'warning',title:'Please Enter Address Details',padding: '1em'}); 
 		 return false;
	 }
	 else if(city == ""){
		 toast({type: 'warning',title:'Please Enter City Details',padding: '1em'}); 
 		 return false;
	 }
	 else if(postalcode == ""){
		 toast({type: 'warning',title:'Please Enter Postal Code Details',padding: '1em'}); 
 		 return false;
	 }
	 else if(country == ""){
		 toast({type: 'warning',title:'Please Select Country Details',padding: '1em'}); 
 		 return false;
	 }
	 else if(state == ""){
		 toast({type: 'warning',title:'Please Select State Details',padding: '1em'}); 
 		 return false;
	 }
	 else{
		return true; 
	 }
	 
 }
 
 function addressfields_clear(){
	 $("#txt_firstname").val("");
	 $("#txt_lastname").val("");
	 $("#txt_address").val("");
	 $("#txt_email").val("");
	 $("#txt_city").val("");
	 $("#txt_postcode").val("");
	 $("#txt_landmark").val("");
	 $("#txt_telephone").val("");
	 
	 $("#sel_country").select2("val", "");
	 $("#sel_state").select2("val", "");	
	 
	// $("#dpRole").select2("val", $(this).find("RoleId").text());
 }
 
 function remove_address(cus_addressid){
	 
	  swal({
			title: "Are you sure?",
			text: "You will not be able to recover this details!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: "Okay",
			padding: '0.5em'
     	 }).then(function(result) {
			if (result.value) {		
			$.ajax({
			type: "POST",
			data : 'hdnact=removeCusaddress&cusAddressid='+cus_addressid,
			dataType : 'text',
			url: 'common/ajax-functions.php',
			beforesend:loading(), 	
			success: function(msg){ 
			var delmsg = 'Deleted successfully';
			 toast({type: 'success',title:delmsg,padding: '1em'}); 
			 	
				document.getElementById("address_row_"+cus_addressid).remove();	
				$("#hdn_editaddressid").val("");
				$("#btn_address").html("Add Address");					
				flag_state = -1;
				addressfields_clear();			
				unloading();		
			}			
		});	
			
			}
		 });
	
 }
 
 function edit_address(cus_addressid){
	if(cus_addressid != null && cus_addressid !="" ){
		$("#hdn_editaddressid").val(cus_addressid);
				
			$.ajax({
				type: "POST",
				data : 'hdnact=editaddress&cusAddressid='+cus_addressid,
				dataType : 'json',
				url: 'common/ajax-functions.php',
				beforesend:loading(), 	
				success: function(msg){
					$("#btn_address").html("Update");	
					//$("#sel_state").html(msg);
					//unloading();	
					$("#txt_firstname").val(msg.r_firstname);
					$("#txt_lastname").val(msg.r_lastname);
					$("#txt_address").val(msg.r_address);
					$("#txt_email").val(msg.r_email);
					$("#txt_city").val(msg.r_city);
					$("#txt_postcode").val(msg.r_postalcode);
					$("#txt_landmark").val(msg.r_landmark);
					$("#txt_telephone").val(msg.r_telephone);
					
					flag_state = msg.r_stateid;
					$("#sel_country").select2("val", msg.r_countryid);				

					unloading();		
						
				}			
			});	
		 
	}	
 }
 
 function CancelAddress(){
	$("#hdn_editaddressid").val("");
	$("#btn_address").html("Add Address");					
	flag_state = -1;
	addressfields_clear();			
 }
 // Address Script end
 function select_all(value){
	var chks = document.getElementsByName('chkApproveparameter[]');	
	for (var i = 0; i < chks.length; i++)
	{	
		if (value == '1') {             
			chks[i].checked = true;			
		}
		else{
			chks[i].checked = false;
		}
	}
	
	$('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
     });	 
	 
  }
  
  function approve_selected(){
	 loading();  
	 var chks = document.getElementsByName('chkApproveparameter[]');
	 var hasChecked = false;
	 var delID_list;
	 for (var i = 0; i < chks.length; i++)
		{
			if (chks[i].checked)
			{
				hasChecked = true;
				if(!delID_list){
					delID_list = chks[i].value;
				}
				else{
					delID_list +=","+chks[i].value;	
				}					
			}
		}
		if (hasChecked == false)
		{
			 toast({type: 'warning',title:'Please select at least one.',padding: '1em'}); 
			 
 			unloading();
		}
		else{						
			//alert(delID_list);
			$.ajax({
				type: "POST",
				data : 'hdnact=reviewapprove&approveidlist='+delID_list,
				dataType : 'text',
				url: 'common/ajax-functions.php',
				beforesend:loading(), 	
				success: function(msg){ 
				  location.reload();						
				}			
			});		
		}	
	unloading();
 }
  
 
 function delete_selected(){
	 loading();  
	 var chks = document.getElementsByName('chkApproveparameter[]');
	 var hasChecked = false;
	 var delID_list;
	 for (var i = 0; i < chks.length; i++)
		{
			if (chks[i].checked)
			{
				hasChecked = true;
				if(!delID_list){
					delID_list = chks[i].value;
				}
				else{
					delID_list +=","+chks[i].value;	
				}					
			}
		}
		if (hasChecked == false)
		{
			 toast({type: 'success',title:'Please select at least one',padding: '1em'}); 
 			unloading();
		}
		else{						
			//alert(delID_list);
			$.ajax({
				type: "POST",
				data : 'hdnact=deletereview&approveidlist='+delID_list,
				dataType : 'text',
				url: 'common/ajax-functions.php',
				beforesend:loading(), 	
				success: function(msg){ 
				  location.reload();						
				}			
			});		
		}	
	unloading();
 } 
  
 var id = $("#selCusGroupid").val();
// alert(id);
</script>
<script type="text/javascript">
function loadjfiller(filecnt,acctype){
	//alert(acctype);
	var str='';
    var str = acctype;
    var res = str.split(',');
	
	$(".customfiledsfile").filer({	

		showThumbs: true,	
		addMore : true,
		limit:filecnt,
	    extensions: res,
		//extensions: ['jpg','png'],
		
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div> <div>Allowed Extension '+acctype+'</div></div>',
		
		theme: "dragdropbox",
		dragDrop : true,
		templates: {
				box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
				item: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left"></ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
				itemAppend: '<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-info">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
											</ul>\
											<ul class="list-inline pull-right">\
												<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
				itemAppendToEnd: false,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-items-list',
					item: '.jFiler-item',
					remove: '.jFiler-item-trash-action'
				}
		}
	});
 }	
 
 
 
//Save data to db all page common function - START		
function funSubmtWithImg($frm,$urll,$acts,$stats,$lodlnk,$id)
{ 
    var id = $("#"+$id).val();    
 
		
	if ($('#'+$acts).valid()) {
		$("button").attr('disabled',true);
		
		var m_data = new FormData();
		
		var formdatas = $("#"+$acts).serializeArray();	
		
		$.each( formdatas, function( key, value ) {
			 m_data.append( value.name, value.value);							 
		});
		
	var  message="";
	var arrfileds=[];
	$('input[type="file"]').each(function() {
		if(!inArray(this.id,arrfileds)){
		arrfileds.push(this.id);
		
		var fileInput = document.getElementById (this.id);		
				if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
					//console.log( fileInput.files);
                    for (var i = 0; i < fileInput.files.length; i++) {					
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];						
                        m_data.append(this.id+"[]", file);                       
                    }
                }
            }
		}
			
		});  
		
		
		
		$.ajax({
			url        : $urll,
			type	   : 'POST',
			dataType   : 'json',
			processData: false,
            contentType: false,
			data       : m_data,
			beforeSend: function() {
				loading();
 			},
			success: function(response){ 
			
			    if(response.rslt == "1"){
					toast({type: 'success',title: $stats +' '+ sucmsg,padding: '1em'}); 
 					$("#"+$acts)[0].reset();
					$(location).attr('href', $lodlnk);
				}
				else if(response.rslt == "2"){
					toast({type: 'success',title: $stats +' '+ sucmsg,padding: '1em'}); 
 					$("#"+$acts)[0].reset();
					$(location).attr('href', $lodlnk);
				}			
			    else if(response.rslt == "3"){
					toast({type: 'warning',title: $stats +' '+ exsmsg,padding: '1em'}); 
 				}
				else if(response.rslt == "4"){
					toast({type: 'warning',title: $stats +' '+ reqmsg,padding: '1em'}); 
 				}
				else if(response.rslt == "8"){
					 toast({type: 'warning',title: $stats +' '+ response.msg,padding: '1em'}); 
 				}
				else if(response.rslt == "9"){
					toast({type: 'warning',title: 'Customer Email already exits',padding: '1em'}); 
 				}
				else{
					toast({type: 'warning',title: othmsg,padding: '1em'}); 
 				}		
			
				unloading();
				$("button").attr('disabled',false); 
				
			}
		});
	}	
}

function inArray(needle,haystack)
{
    var count=haystack.length;
    for(var i=0;i<count;i++)
    {
        if(haystack[i]===needle){return true;}
    }
    return false;
}

$(".tree .expander").eq(0).remove();
	
function getCustomerImages(cusid){
	 $.post("customers_actions.php",{cusid:cusid,getcusImage:'getcusImage'},function(data){
						$("#uploadedcustomer").html(data);
	 });		
}	

function deleventImg(eventImgId,eId){		 
	  var action = "deleteImg";	
	  $.post("<?php echo BASE_URL; ?>customers_actions.php",{eventsImgId:eventImgId,"eId":eId,action:action},function(response){	
				getCustomerImages(eId);
			}
	  )
}
</script>