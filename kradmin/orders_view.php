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
 

 $str_all       = " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.payment_method='COD' then 'Unsuccess' else 'Success' end) as paymentstatus,t4.product_sku,t4.item_code,t4.order_product_id,t4.product_images,t4.product_name,t4.product_qty,t4.product_price,t4.prod_sub_total,t4.cancel_reason as product_cancel_reason,t4.prod_attr_price,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool,t4.IsActive as product_status,t4.CustomtoolImg  FROM  ".TPLPrefix."orders t1  left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive!=2
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where  t1.IsActive=1 and t1.order_id= '".$id."' group by t4.order_product_id "; 

$res_ed = $db->get_rsltset($str_all);
// echo "<pre>"; print_r($res_ed); exit;

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
                        <div class="col-sm-6 col-12 text-sm-right text-center">
                          <h3 class="in-heading mt-2 mb-2">Invoice</h3>
                        </div>
                        <div class="col-sm-6 col-12 text-sm-right text-center hidden-print"> <a class="btn btn-warning btn-rounded send-invoice"  id="btn" onClick="printInvoice('print-content')"><i class="flaticon-square-menu mr-1"></i> Print Invoice</a><!-- <a class="btn btn-primary btn-rounded send-invoice" onClick="convertpdf('<?php echo $id; ?>')" href="javascript:void(0);"><i class="flaticon-mail-13"></i> Send Mail</a> --> <a class="btn btn-default btn-rounded send-invoice"  href="orders_mng.php"><i class="flaticon-back-arrow"></i> Back</a> </div>
                      </div>
                    </div>
                    <div class="widget-content-area content-section" id="print-content">
                      <div class="row invoice-top-section">
                        <div class="col-sm-12 mb-5"> <img src="assets/img/logo-3.png" width="180" />
                          <?php 
                            // print_r( $res_ed[0] );
                          ?>
                        </div>
                        <div class="col-sm-6 mb-4">
                          <h5 class="invoice-info-title">Invoice Info</h5>
                          <p class="invoice-serial-number">#<?php echo $res_ed[0]['order_reference']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-4 text-sm-right">
                          <p class="invoice-order-status">Order Status: <?php echo $res_ed[0]['order_status']; ?></p>
                          <p class="invoice-order-date">Order Date: <?php echo $res_ed[0]['date']; ?>, <?php echo $res_ed[0]['time']; ?> </p>
                          <?php if($res_ed[0]['payment_gstno']!=''){ ?>
                          <p class="invoice-order-status">GST: <?php echo $res_ed[0]['payment_gstno']; ?> </p>
                          <?php }?>
                        </div>
                      </div>
                      <div class="row mt-5 mb-5">
                        <div class="col-md-6 col-sm-6 invoice-from">
                          <h5 class="invoice-from-title mb-4">Billing Address</h5>
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
                          <h5 class="invoice-to-title mb-3">Shipping Address</h5>
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
                            <th>SKU</th>
                            <th>Item Code</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          foreach( $res_ed as $vieworder ) { 
                            $delete_class = '';
                            $delete_badge = '';
                            if( $vieworder['product_status'] == 4 ) {
                              $delete_class = 'bg-gradient-danger text-white';
                              $delete_badge = '<span class="badge badge-danger"> Cancelled </span>';
                            }
									      ?>
                          <tr class="<?= $delete_class ?>">
                            <td>
                              <a class="cartprd-image" href="javascript:void(0);">
                                <img style="width:55px; heigth:55px;" alt="product" class="img-responsive center-block" src="<?php echo image_replace_url; ?><?php echo $vieworder['product_images']; ?>">
                              </a>
                            </td>
                            <td>
                              <div class="tdsingle-row"> 
                                <?php echo $vieworder['product_name']; ?>
                                <div><?= $delete_badge ?></div>
                              </div>
                              <div>
                                <?php 
                                  if(count($pro_attri_details)>0){
                                      foreach($pro_attri_details as $value) { 
                                        echo $value['Attribute_Name'].': '.$value['Attribute_value_name'];
                                        echo"<br/>";
                                      } 
                                    }
                                  ?>
                              </div>
                            </td>
                            <td class="">
                              <?php 
												        echo ($vieworder['product_sku'] != '')? $vieworder['product_sku'] : '&nbsp;'; ?>
                            </td>
                            <td class="">
                              <?php 
												        echo ($vieworder['item_code'] != '') ? $vieworder['item_code'] : '&nbsp;'; ?>
                            </td>
                            <td class="">
                              <span><i class="fa fa-inr"></i></span> 
                              <span class="price">
                              <?php 
												          echo  number_format(round($vieworder['product_price']),2); ?>
                              </span></td>
                            <td><span class="price"><?php echo $vieworder['product_qty']; ?></span></td>
                            <td class="total_col">
                              <span>
                                <i class="fa fa-inr"></i>
                              </span> 
                              <span>
                                <span class="total_price">
                                  <?php
                                  echo number_format(round($vieworder['prod_sub_total']),2); ?>
                                </span>
                                <?php 
                                if( $vieworder['product_status'] == 3 && $res_ed[0]['order_status_id'] != 40 ) {
                                ?>    
                                <span class="mx-2 float-right">
                                  <input type="hidden" id="product_<?= $vieworder['order_product_id'] ?>" value='<?= $vieworder['product_cancel_reason'] ?>'>
                                  <i class="fa fa-trash btn btn-danger" onclick="return cancelOrder( '<?= $vieworder['order_product_id'] ?>', 'product' )"></i>
                                </span>
                                <?php } ?>
                              </span>
                            </td>
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
                                <p class="mb-3"><i class="fa fa-inr"></i> <?php echo number_format(round($res_ed[0]['total_products_wt']),2); ?></p>
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
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                      <?php 
                                      if($res_ed[0]['order_status_id'] == 40 ) {
                                      ?>
                                      <input type="hidden" id="order_<?= $res_ed[0]['order_id']?>" value='<?= $res_ed[0]['cancel_reason'] ?>'>
                                      <button class="btn btn-sm btn-danger" onclick="return cancelOrder( '<?= $res_ed[0]['order_id']?>', 'order' )">Cancel Requested</button>
                                      <?php } ?>
                                    </div>
                                    <div class="col-sm-6"><h4 class="mb-3"> Grand Total: </h4></div>
                                </div>
                              </div>

                              <div class="col-sm-2 col-5">
                                <h4 class="mb-3">
                                  <i class="fa fa-inr"></i> 
                                  <?php echo number_format(round($res_ed[0]['grand_total']),2); ?>
                                </h4>
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are You sure to Cancel ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <h5> Cancel Reason </h5>
          <p id="cancel_reason"></p>
        </div>
        <div>
          <input type="hidden" name="cancel_type" id="cancel_type" >
          <input type="hidden" name="id" id="id" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="cancel-btn-order" onclick="return confirmCancelOrder()"> Cancel Order <span id="button-name"></span></button>
      </div>
    </div>
  </div>
</div>
<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>

<script>
function cancelOrder( id, cancel_type ) {
    $('#exampleModal' ).modal('show');
    var cancel_reason = $( '#'+cancel_type+'_'+id ).val();
    console.log( cancel_reason );
    $('#cancel_reason').html( cancel_reason );
    if( cancel_type == 'product' ) {
      $('#button-name').html( 'Products' );   
    }
    $('#cancel_type' ).val(cancel_type) ;
    $('#id' ).val(id) ;

    
}

function confirmCancelOrder() {
  var cancel_type = $('#cancel_type' ).val() ;
  var id = $('#id' ).val() ;
  swal({
        title: "Are you sure?",
        text: "You are trying to cancel this product!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Cancel it!",
        closeOnConfirm: false
    }).then(result => {
      console.log( result );
      if (result.value) {

        $.ajax({
          url: "orders_actions.php",
          type: "POST",
          data: {
            id: id, cancel_type:cancel_type, action: 'cancel_order'
          },
          dataType: "json",
          success: function (res) {
            
            if( res.error == 0 ) {
              if( res.cancel_type == 'product' ) {
                swal("Canceled!", "Your Product  has removed from Order.", "success");
              } else {
                swal("Canceled!", "Your Order has removed from Order History.", "success");
              }
              setTimeout(()=>{
                location.reload();
              }, 200);
              
            }
            
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("Error Cancelling!", "Please try again", "error");
          }
        });


        
      } 
      
    });
}

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