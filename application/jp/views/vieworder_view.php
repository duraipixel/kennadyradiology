<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');  ?>

<section class="light-gray-bg">
<div class="container">
<div id="divid">
<div class="row showroom-single">
  <div class="col-md-12 col-sm-12 col-xs-12 section-title" >
    <div class="row align-items-center">
      <div class="col-sm-6 mb-4"> <img src="<?php echo img_base;?>static/images/logo.svg" class="img-responsive" alt="logo"> </div>
      <div class="col-sm-6 text-right mb-4"> <a href="javascript:void(0);" id="btn" class="blue-btn mr-3 mb-4" onClick="printInvoice('divid')" style="box-shadow: none;" > <i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $orderdisplaylanguage['print'];?></a> <a href="<?php echo BASE_URL;?>my-orders" class="blue-btn1 mb-4"> <span> <i class="fa fa-angle-left"></i> <?php echo $commondisplaylanguage['back'];?></span> </a> </div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 ">
    <div class="bg-white p-4 shadow">
      <div class="shipping-wraper invoicetop-wraper">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
            <h1 class="heading1 blue-bg text-center text-white pt-2 pb-2" ><?php echo $orderdisplaylanguage['invoicetitle'];?></h1>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 mb-5 pb-4 border-bottom">
            <div class="row invoice-address"> <?php echo $helper->getStoreConfigvalue('store_address'); ?> </div>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 mb-5 pb-4 border-bottom addside-wraper invoiceright-top">
            <div class="invoice-order-details">
              <div class="">
                <h4><?php echo $orderdisplaylanguage['orderid'];?>
                   #<?php echo $getorderdetails_vieworder[0]['order_reference']; ?>  </h4></div>
              <div class="">
                <label><?php echo $orderdisplaylanguage['datetime'];?> </label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['date']; ?>, <?php echo $getorderdetails_vieworder[0]['time']; ?> </span> </div>
              <?php if($getorderdetails_vieworder[0]['payment_gstno']!=''){ ?>
              <div class="">
                <label><?php echo $orderdisplaylanguage['gstno'];?> </label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['payment_gstno']; ?> </span> </div>
              <?php } ?>
             <!-- <div class="">
                <label><?php echo $orderdisplaylanguage['paymentstatus'];?></label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['paymentstatus']; ?> </span> </div>-->
				<div class="">
                <label><?php echo $orderdisplaylanguage['orderstatus'];?></label>
                <span> : </span> <span> <?php echo $getorderdetails_vieworder[0]['order_statusName']; ?> </span> </div>
				 
            </div>
          </div>
        </div>
      </div>
      <div class="shipping-wraper mb-5">
        <form id="frmshipping" name="frmshipping" action="#" method="post">
          <input type="hidden" name="action" id="action" value="insert">
          <input type="hidden" name="userid" id="userid" value="">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 pb-4 border-bottom addside-wraper">
              <div class="invoice-billingaddress">
                <h4> <?php echo $orderdisplaylanguage['billingaddress'];?> </h4>
                <div class="addrlist-container addscroll-div pt-3">
                  <div class="row form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 addrsingle">
                      <div class="radio">
                        <label>
                        <p class="addrname"><?php echo $getorderdetails_vieworder[0]['firstname']; ?>&nbsp;<?php echo $getorderdetails_vieworder[0]['lastname']; ?> </p>
                        <p> <?php echo $getorderdetails_vieworder[0]['payment_address_1']; ?><br>
                        </p>
                        <p><?php echo $getorderdetails_vieworder[0]['payment_city']; ?>,<?php echo $getorderdetails_vieworder[0]['payment_postcode']; ?>,<?php echo $getorderdetails_vieworder[0]['billingstate']; ?>,<?php echo $getorderdetails_vieworder[0]['billingcountry']; ?>.</p>
                        <p><?php echo $orderdisplaylanguage['orderemail'];?>: <?php echo $getorderdetails_vieworder[0]['email']; ?></p>
                        <p><?php echo $orderdisplaylanguage['ordermobile'];?>: <?php echo $getorderdetails_vieworder[0]['payment_telephone']; ?></p>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 pb-4 border-bottom addside-wraper">
              <div class="invoice-shippingaddress">
                <h4> <?php echo $orderdisplaylanguage['shippingaddress'];?> </h4>
                <div class="addrlist-container addscroll-div pt-3">
                  <div class="row form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 addrsingle">
                      <div class="radio">
                        <label>
                        <p class="addrname"><?php echo $getorderdetails_vieworder[0]['shipping_firstname']; ?>&nbsp;<?php echo $getorderdetails_vieworder[0]['shipping_lastname']; ?> </p>
                        <p> <?php echo $getorderdetails_vieworder[0]['shipping_address_1']; ?><br>
                        </p>
                        <p><?php echo $getorderdetails_vieworder[0]['shipping_city']; ?>,<?php echo $getorderdetails_vieworder[0]['shipping_postcode']; ?>,<?php echo $getorderdetails_vieworder[0]['shippingstate']; ?>,<?php echo $getorderdetails_vieworder[0]['shippingcountry']; ?>.</p>
                        <p><?php echo $orderdisplaylanguage['orderemail'];?>: <?php echo $getorderdetails_vieworder[0]['email']; ?></p>
                        <p><?php echo $orderdisplaylanguage['ordermobile'];?>: <?php echo $getorderdetails_vieworder[0]['shipping_telephone']; ?></p>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 nopad vieworder-table">
          <div class="">
            <div class="table-responsive">
              <div class="orderhis cart bgwhite cartleftht ">
                <div class="tbl-header ">
                  <table cellpadding="0" cellspacing="0" border="0" >
                    <thead>
                      <tr>
                        <th><?php echo $cartdisplaylanguage['cartimage'];?></th>
                        <th><?php echo $cartdisplaylanguage['cartproduct'];?></th>
                        <th><?php echo $cartdisplaylanguage['itemcode'];?> </th>
                        <th><?php echo $cartdisplaylanguage['cartprice'];?></th>
                        <th><?php echo $cartdisplaylanguage['cartgst'];?></th>
                        <th class="centrie"><?php echo $commondisplaylanguage['quantity'];?></th>
                        <th><?php echo $commondisplaylanguage['carttotal'];?></th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tbl-content scrlcnt"  id="ordertab">
                  <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                      <?php 
									    $tax=0;
										$subtotal=0;
										$price_total =0;
										$tax_total=0;
										$grant_total=0;
									require_once(APP_DIR .'helpers/common_function.php');
	                                 $helper=new common_function;
									 
									
									 
									  foreach($getorderdetails_vieworder as $vieworder) { 
									//  print_r($vieworder); die();
									$pro_attri_details =  $helper->displayattributecolor($vieworder['order_product_id']);
									//print_r($pro_attri_details); die();
                                   // $attr_price = $helper->getProducctAttribute_price($vieworder['order_product_id']);
									  ?>
                      <tr>
                        <td><a class="cartprd-image" href="javascript:void(0);">
                          <?php if($vieworder['IsCustomtool']==1) { ?>
                          <img  class="img-responsive center-block" src="<?php echo img_base;?>uploads/finalcustomimg/<?php echo $vieworder['CustomtoolImg']; ?>" alt="<?php echo $vieworder['product_name']; ?>">
                          <?php } else { 
					 // if( $vieworder['attr_images']!=''){
						  ?>
                          <!--   <img alt="product" class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $vieworder['product_id']; ?>/photos/<?php echo $vieworder['attr_images']; ?>">-->
                          <?php
					 // }					  else 
					 if( $vieworder['img_path']!=''){?>
                          <img alt="product" class="img-responsive center-block" src="<?php echo img_base;?>uploads/productassest/<?php echo $vieworder['product_id']; ?>/photos/<?php echo $vieworder['img_path']; ?>">
                          <?php } else{?>
                          <img alt="product" class="img-responsive center-block" src="<?php echo img_base;?>uploads/noimage/photos/thumb/noimage.png">
                          <?php }
												}?>
                          </a></td>
                        <td><?php if($vieworder['IsCustomtool']==1) { } ?></td>
                        <td><span class="price"><?php echo $vieworder['product_sku']; ?></span></td>
                        <td class="price_col"><span><?php echo PRICE_SYMBOL;?></span> <span class="price">
                          <?php 
												echo  number_format(round($vieworder['prod_attr_price']),2); ?>
                          </span></td>
                        <!--	<td class="price_col"><span><?php echo PRICE_SYMBOL;?></span> <span class="price"><?php 
												if($attr_price!=''){
												echo  number_format($attr_price,2);  }else{ echo "N/A"; }?></span></td> -->
                        
                        <td class="tax_col"><span><?php echo PRICE_SYMBOL;?></span> <span class="taxes" id="taxs0">
                          <?php 
												
												if($vieworder['tax_type']=='P'){
													//$tax = ($vieworder['product_price']*$vieworder['tax_value'])/100;
													$tax = (($vieworder['prod_attr_price']+$attr_price)*$vieworder['tax_value'])/100;
												}
												else
												{   
											        $tax = $vieworder['tax_value'];
												}
												
												
												echo number_format(round($tax),2); ?>
                          </span></td>
                        <td class="centrie"><span class="price"><?php echo $vieworder['product_qty']; ?></span></td>
                        <td class="total_col"><span><?php echo PRICE_SYMBOL;?></span> <span><span class="total_price">
                          <?php
												
												  //$prodprice = ($vieworder['product_price'] * $vieworder['product_qty']);
												  $prodprice = (($vieworder['prod_attr_price']) * $vieworder['product_qty']);
												  
												$discount =0;
												if(!empty($getorderdetails_vieworder[0]['discount_slab']) && $getorderdetails_vieworder[0]['discount_slab']!="")
												{
														$discount = ($prodprice*$getorderdetails_vieworder[0]['discount_slab'])/100;
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
												
												
												echo number_format(round($vieworder['prod_sub_total']),2); ?>
                          </span></span></td>
                      </tr>
                      <?php 
                                         
										
									  } ?>
                    </tbody>
                  </table>
                </div>
                <div class="tbl-header table-responsive pricebottom-table">
                  <table cellpadding="0" cellspacing="0" border="0" >
                    <tfoot>
                      <tr>
                        <td colspan="8"><div class="tdsingle-row text-uppercase text-left"> <?php echo $commondisplaylanguage['carttotal'];?> </div></td>
                        <td><span> <?php echo PRICE_SYMBOL;?> </span> <span> <span id="subtot"> <?php echo number_format(round($getorderdetails_vieworder[0]['cart_total']),2); ?> </span> </span></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 nopad-right pricebottom-table">
          <div class="">
            <div class="table-responsive">
              <div class="orderhis cart cartrt bgwhite cartleftrt">
                <div class="tbl-header ">
                  <table cellpadding="0" cellspacing="0" border="0" >
                    <thead>
                    <col width="100%">
                    <tr>
                      <th><?php echo $orderdisplaylanguage['cartsummary'];?> </th>
                    </tr>
                      </thead>
                    
                  </table>
                </div>
                <div class="tbl-content mb30 lastd"  id="ordertab">
                  <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <col width="60%">
                    <col width="40%">
                    <tr>
                      <td><?php echo $cartdisplaylanguage['cartprice'];?> (<?php echo $getorderdetails_vieworder[0]['total_products']; ?> <?php echo $commondisplaylanguage['items'];?>)</td>
                      <td><?php echo PRICE_SYMBOL;?> <?php echo number_format(round($getorderdetails_vieworder[0]['cart_total']),2); ?></td>
                    </tr>
                    <?php if($getorderdetails_vieworder[0]['coupon_discount']>0){ ?>
                    <tr>
                      <td><?php echo $checkoutdisplaylanguage['coupondiscount'];?>(-)</td>
                      <td><?php echo PRICE_SYMBOL;?> <?php echo number_format($getorderdetails_vieworder[0]['coupon_discount'],2); ?></td>
                    </tr>
                    <?php }  ?>
                    <tr>
                      <td><?php echo $orderdisplaylanguage['shippingproduct'];?>(+)</td>
                      <td><?php echo PRICE_SYMBOL;?> <?php echo number_format($getorderdetails_vieworder[0]['shippint_cost'],2); ?></td>
                    </tr>
                      </tbody>
                    
                  </table>
                </div>
                <div class="tbl-header tblhed table-responsive brb0 ftrfnt">
                  <table cellpadding="0" cellspacing="0" border="0" >
                    <thead>
                    <col width="60%">
                    <col width="40%">
                    <tr>
                      <th><?php echo $orderdisplaylanguage['amountpaid'];?></th>
                      <th><?php echo PRICE_SYMBOL;?> <?php echo number_format($getorderdetails_vieworder[0]['grand_total'],2); ?></th>
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
  </div>
</div>
<div > </div>
</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
$(document).ready(function(){
	/**/
	$('.scrlcnt').overlayScrollbars({});
});

function printInvoice(divId) {
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head></head><body>" + printContents + "</body>";
       window.print();
       document.body.innerHTML = originalContents;
   }

</script>
</body>
</html>
