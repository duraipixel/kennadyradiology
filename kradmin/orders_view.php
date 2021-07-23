<?php 

$productdisp = "order";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeOrders($db,'');
include_once "includes/pagepermission.php";

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END


$id=$_REQUEST['orderId'];
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
 

 $str_all= " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.payment_method='COD' then 'Unsuccess' else 'Success' end) as paymentstatus,t4.product_sku,t4.order_product_id,t4.product_name,t4.product_qty,t4.product_price,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool, t4.CustomtoolImg  FROM  ".TPLPrefix."orders t1  left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive=1
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where  t1.IsActive=1 and t1.order_id= '".$id."' group by t4.order_product_id "; 
//echo $str_all; exit;	 
$res_ed = $db->get_rsltset($str_all);
//echo "<pre>"; print_r($res_ed); exit;

$edit_id = $res_ed['order_id'];


$qryconfig="SELECT  *  FROM ".TPLPrefix."configuration 
					WHERE IsActive <>2 and uniCode = 'store_address'  ";

$resinfo=$db->get_a_line($qryconfig);
//echo "<pre>"; print_r($resinfo['value']); exit;		

$chk='';
if($res_ed['IsActive']=='1')
{
	$chk='checked';
}

}


?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
  <div class="overlay"></div>
  <div class="cs-overlay"></div>
  
  <!--  BEGIN SIDEBAR  -->
  
  <?php include "includes/sidebar.php";?>
  <link href="assets/css/ecommerce/invoice.css" rel="stylesheet" type="text/css" />
  <!--  END SIDEBAR  --> 
  
  <!--  BEGIN CONTENT PART  -->
  <div id="content" class="main-content">
    <div class="container" >
      <div class="page-header hidden-print">
        <div class="page-title">
          <h3>Orders</h3>
          <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
              <li><a href="dashboard.php"><i class="flaticon-home-fill"></i></a></li>
              <li><a href="#">Orders Management</a></li>
              <li><a href="orders_mng.php">Manage Orders</a></li>
              <li class="active"><a href="#">View Orders</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row layout-spacing">
        <div class="col-lg-12">
          <div class="statbox widget box box-shadow">
            <div class="row margin-bottom-120 invoice-print">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="statbox widget box box-shadow">
                  <div class="widget-content invoice">
                    <div class="widget-content-area head-section mb-4">
                      <div class="row">
                        <div class="col-sm-6 col-12 text-sm-left text-center">
                          <h3 class="in-heading mt-2 mb-2">Invoice</h3>
                        </div>
                        <div class="col-sm-6 col-12 text-sm-right text-center hidden-print"> <a class="btn btn-warning btn-rounded send-invoice"  id="btn" onClick="printInvoice('content')"><i class="flaticon-square-menu mr-1"></i> Print Invoice</a><!-- <a class="btn btn-primary btn-rounded send-invoice" onClick="convertpdf('<?php echo $id; ?>')" href="javascript:void(0);"><i class="flaticon-mail-13"></i> Send Mail</a> --> <a class="btn btn-default btn-rounded send-invoice"  href="orders_mng.php"><i class="flaticon-back-arrow"></i> Back</a> </div>
                      </div>
                    </div>
                    <div class="widget-content-area content-section" >
                      <div class="row invoice-top-section">
                        <div class="col-sm-12 mb-5"> <img src="assets/img/logo-3.png" width="180" />
                          <?php //echo $resinfo['value']; ?>
                        </div>
                        <div class="col-sm-6 mb-4">
                          <h5 class="invoice-info-title">Invoice Info</h5>
                          <p class="invoice-serial-number">#<?php echo $res_ed[0]['order_reference']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-4 text-sm-right">
                          <p class="invoice-order-status">Order Status: <?php echo $res_ed[0]['status']; ?></p>
                          <p class="invoice-order-date">Order Date: <?php echo $res_ed[0]['date']; ?>, <?php echo $res_ed[0]['time']; ?> </p>
                          <?php if($res_ed[0]['payment_gstno']!=''){ ?>
                          <p class="invoice-order-status">GST: <?php echo $res_ed[0]['payment_gstno']; ?> </p>
                          <?php }?>
                        </div>
                      </div>
                      <div class="row mt-5 mb-5">
                        <div class="col-md-6 col-sm-6 invoice-from">
                          <h5 class="invoice-from-title mb-4">Bill From</h5>
                          <div class="row">
                            <div class="col-12 mb-4">
                              <p><?php echo $res_ed[0]['firstname']; ?>&nbsp;<?php echo $res_ed[0]['lastname']; ?></p>
                            </div>
                            <div class="col-12 mb-4">
                              <p><?php echo $res_ed[0]['payment_address_1']; ?></p>
                              <p><?php echo $res_ed[0]['payment_city']; ?>,<?php echo $res_ed[0]['payment_postcode']; ?>,<?php echo $res_ed[0]['billingstate']; ?>,<?php echo $res_ed[0]['billingcountry']; ?></p>
                            </div>
                            <div class="col-12 mb-4">
                              <p>Email: <?php echo $res_ed[0]['email']; ?></p>
                              <p>Mobile: <?php echo $res_ed[0]['payment_telephone']; ?></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 invoice-to text-sm-right">
                          <h5 class="invoice-to-title mb-3">Bill To</h5>
                          <div class="row mb-5">
                            <div class="col-12 mb-4">
                              <p><?php echo $res_ed[0]['shipping_firstname']; ?>&nbsp;<?php echo $res_ed[0]['shipping_lastname']; ?> </p>
                            </div>
                            <div class="col-12 mb-4">
                              <p><?php echo $res_ed[0]['shipping_address_1']; ?></p>
                              <p><?php echo $res_ed[0]['shipping_city']; ?>,<?php echo $res_ed[0]['shipping_postcode']; ?>,<?php echo $res_ed[0]['shippingstate']; ?>,<?php echo $res_ed[0]['shippingcountry']; ?>.</p>
                            </div>
                            <div class="col-12 mb-4">
                              <p>Email: <?php echo $res_ed[0]['email']; ?></p>
                              <p>Mobile: <?php echo $res_ed[0]['shipping_telephone']; ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Item Code</th>
                            <th>HSN Code</th>
                            <th>Price</th>
                            <th>Printing</th>
                            <th>GST</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Discount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
									    $tax=0;
										$subtotal=0;
										$price_total =0;
										$price_pro_attr =0;
										$tax_total=0;
										$grant_total=0;
										//echo "<pre>"; print_r($res_ed);
									  foreach($res_ed as $vieworder) { 
									
									
									$select_pro_attri = "select Attribute_Name,Attribute_value_name,Attribute_price from ".TPLPrefix."orders_products_attribute where order_product_id='".$vieworder['order_product_id']."' ";
                                    $pro_attri_details=$db->get_rsltset($select_pro_attri);
									
									$pro_attr_price = "select sum(Attribute_price) as amount from ".TPLPrefix."orders_products_attribute where order_product_id='".$vieworder['order_product_id']."' group by order_product_id"; 
                                    $attr_price=$db->get_a_line($pro_attr_price);
									
								

									  ?>
                          <tr>
                            <td><a class="cartprd-image" href="javascript:void(0);">
                              <?php if($vieworder['IsCustomtool']==1) { ?>
                              <img  style="width:55px; heigth:55px;" class="img-responsive center-block" src="<?php echo IMG_BASE_URL;?>finalcustomimg/<?php echo $vieworder['CustomtoolImg']; ?>" alt="<?php echo $vieworder['product_name']; ?>">
                              <?php } else { ?>
                              <img style="width:55px; heigth:55px;" alt="product" class="img-responsive center-block" src="<?php echo IMG_BASE_URL;?>productassest/<?php echo $vieworder['product_id']; ?>/photos/<?php echo $vieworder['img_path']; ?>">
                              <?php } ?>
                              </a></td>
                            <td><?php if($vieworder['IsCustomtool']==1) { ?>
                              <div class="tdsingle-row"> <?php echo $vieworder['product_name']; ?> <br/>
                                Customized </div>
                              <div>
                                <?php 
													 if(count($pro_attri_details)>0){
				                                     foreach($pro_attri_details as $value) { 
													 echo $value['Attribute_Name'].': '.$value['Attribute_value_name'];
													 echo"<br/>";
                                                     } }
													?>
                              </div>
                              <?php } else { ?>
                              <div class="tdsingle-row"> <?php echo $vieworder['product_name']; ?> </div>
                              <div>
                                <?php 
													 if(count($pro_attri_details)>0){
				                                     foreach($pro_attri_details as $value) { 
													 echo $value['Attribute_Name'].': '.$value['Attribute_value_name'];
													 echo"<br/>";
                                                     } }
													?>
                              </div>
                              <?php } ?></td>
                            <td class=""><?php 
												echo ($vieworder['product_sku'] != '')? $vieworder['product_sku'] : '&nbsp;'; ?></td>
                            <td class=""><?php 
												echo ($vieworder['hsncode'] != '') ? $vieworder['hsncode'] : '&nbsp;'; ?></td>
                            <td class=""><span><i class="fa fa-inr"></i></span> <span class="price">
                              <?php 
												echo  number_format(round($vieworder['product_price']),2); ?>
                              </span></td>
                            <td class=""><span><i class="fa fa-inr"></i></span> <span class="price">
                              <?php 
												if($attr_price['amount']!=''){
												echo  number_format(round($attr_price['amount']),2);
												}else{
													echo 'N/A';
												}
												 ?>
                              </span></td>
                            <td class="tax_col"><span><i class="fa fa-inr"></i></span> <span class="taxes" id="taxs0">
                              <?php 
												
												if($vieworder['tax_type']=='P'){
													$tax = (($vieworder['product_price']+$attr_price['amount'])*$vieworder['tax_value'])/100;
												}
												else
												{   
											        $tax = $vieworder['tax_value'];
												}
												
												
												echo number_format(round($tax),2); ?>
                              </span></td>
                            <td><span class="price"><?php echo $vieworder['product_qty']; ?></span></td>
                            <td class="total_col"><span><i class="fa fa-inr"></i></span> <span><span class="total_price">
                              <?php
												
												  $prodprice = (($vieworder['product_price']+$attr_price['amount']) * $vieworder['product_qty']);
												  
												$discount =0;
												if(!empty($vieworder['discount_slab']) && $vieworder['discount_slab']!="")
												{
														$discount = ($prodprice*$vieworder['discount_slab'])/100;
														$prodprice = $prodprice-$discount;
												}
											  
												if( strtoupper($vieworder['tax_type'])=="P"){											
													$totaprice = $prodprice + (($prodprice * $vieworder['tax_value'])/100);
												 }	
												 else if(strtoupper($vieworder['tax_type'])=="F"){
													$totaprice = $prodprice +  $vieworder['tax_value'];
												 }
												else{
													$totaprice = $prodprice;
												}	
												
												
												echo number_format(round($totaprice),2); ?>
                              </span></span></td>
                            <td><?php 
												 //echo $vieworder['discount_slab'];
												if($vieworder['discount_slab']!="" && !empty($vieworder['discount_slab']))
												{ ?>
                              <i class="fa fa-inr"></i><?php echo number_format($discount,2).'('.$vieworder['discount_slab'].'%)'; ?>
                              <?php	
												} else {	
												?>
                              N/A
                              <?php } ?></td>
                          </tr>
                          <?php 
                                         
										
									  } ?>
                        </tbody>
                      </table>
                      <div class="row mt-4">
                        <div class="col-12">
                          <div class="invoice-total-amounts text-right">
                            <div class="row">
                              <div class="col-sm-10 col-7 text-right">
                                <p  class="mb-3">Price (<?php echo $res_ed[0]['total_products']; ?> items) </p>
                              </div>
                              <div class="col-sm-2 col-5">
                                <p class="mb-3"><i class="fa fa-inr"></i> <?php echo number_format(round($res_ed[0]['cart_total']),2); ?></p>
                              </div>
                              <?php if($res_ed[0]['coupon_discount']>0){ ?>
                              <div class="col-sm-10 col-7 text-right">
                                <p  class="mb-3">Coupon Discount(-) </p>
                              </div>
                              <div class="col-sm-2 col-5">
                                <p class="mb-3"><i class="fa fa-inr"></i> <?php echo number_format($res_ed[0]['coupon_discount'],2); ?></p>
                              </div>
                              <?php }  ?>
                              <div class="col-sm-10 col-7 text-right">
                                <p  class="mb-3">Shipping On Product Price(+) </p>
                              </div>
                              <div class="col-sm-2 col-5">
                                <p class="mb-3"><i class="fa fa-inr"></i> <?php echo number_format($res_ed[0]['shippint_cost'],2); ?></p>
                              </div>
                              <div class="col-sm-10 col-7 text-right">
                                <h4 class="mb-3">Grand Total: </h4>
                              </div>
                              <div class="col-sm-2 col-5">
                                <h4 class="mb-3"><i class="fa fa-inr"></i> <?php echo number_format(round($res_ed[0]['grand_total']),2); ?></h4>
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

function convertpdf(id)
{
	
		var urll = 'phptopdfgenerate.php'
		$.ajax({
		url        : urll,
		method     : 'POST',
		dataType   : 'json',   
		data       : 'action=pdffile&orderid='+id,
		beforeSend: function() {
			//alert("responseb");
			//loading();
		},
		success: function(response){
			
			if(response.rslt==1){
				toast({type: 'success',title: 'Invoice Mail send successfully',padding: '2em',});
				 
			}
			else{
				 toast({type: 'warning',title: 'Invoice Mail error',padding: '2em',});
				 //swal("Failure!","Invoice Mail error!", "warning");
			}
		},

	});
}

function printInvoice(divId) {
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = '<html><head></head><body>' + printContents + '</body>';
	   /* document.body.innerHTML = '<html><head><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"><link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="assets/css/plugins.css" rel="stylesheet" type="text/css" /><link href="assets/css/ecommerce-dashboard/timeline.css" rel="stylesheet" type="text/css" /><link href="assets/css/ecommerce-dashboard/style.css" rel="stylesheet" type="text/css" /><link href="plugins/loaders/csspin.css" rel="stylesheet" type="text/css" /><link href="plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css"><link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_miscellaneous.css"><link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" /><link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" /><link href="assets/css/ui-kit/custom-sweetalert.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="plugins/jquery-validation/css/screen.css"><link rel="stylesheet" href="plugins/jquery-validation/css/cmxform.css"><link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" /><link href="assets/css/modals/component.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css"><link href="plugins/editors/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" /><link href="plugins/editors/summernote/custom-summernote-bs4.css" rel="stylesheet" type="text/css" /><link href="assets/css/design-css/design.css" rel="stylesheet" type="text/css" /><link href="plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css" rel="stylesheet" type="text/css"><link href="plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"><link href="plugins/timepicker/jquery.timepicker.css" rel="stylesheet" type="text/css"><link rel="stylesheet" type="text/css" href="assets/css/components/custom-page_style_datetime.css"><link href="plugins/filer/css/jquery.filer.css" rel="stylesheet"><link href="plugins/filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"><link href="assets/css/design-css/design.css" rel="stylesheet"><link href="plugins/treeview/default/style.min.css" rel="stylesheet"><link href="assets/css/ui-kit/custom-tree_view.css" rel="stylesheet" type="text/css" /><link href="assets/css/components/portlets/portlet.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" href="assets/css/easy-autocomplete.css" type="text/css"  /><link rel="stylesheet" href="assets/css/easy-autocomplete.min.css" type="text/css"  /><link rel="stylesheet" href="assets/css/easy-autocomplete.themes.css" type="text/css"   /><link type="text/css" href="assets/css/font-awesome.min.css" rel="stylesheet" />  </head><body>' + printContents + '</body>';*/
       window.print();
       document.body.innerHTML = originalContents;
   }
</script>
<style type="text/css">
@media print {
  .hidden-print {
    display: none !important;
  }
}</style>