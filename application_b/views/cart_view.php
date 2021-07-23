<?php 
//echo "<pre>"; print_r($addtocartlist); exit;
 include ('includes/top.php') ?>
 <link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
 <body class="productbg restical">
<?php include ('includes/header.php') ?>
<?php
//echo $helper->displaymenu();
?>
  	<section class="cartView bg-white">
		<div class="container">	
			<div class="infotitle">
					<span><h3>Your Shopping Cart (<?php echo count($addtocartlist);?>)</h3></span>
					
				</div>	
				<div class="cart-section">
					  <div class="row">
						<div class="col-md-12 ">																	
							<div class=" cart bgwhite cartleftht">
								  <div id="cartpage" class="carttab-wraper">
                                 <?php include_once('partial/cart_table.php')?>
								</div>	
							</div>
						</div>
						<!-- <div class="col-md-3">
							<div class="orderhis cart cartrt bgwhite cartleftrt">
								<div class="tbl-header table-responsive">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="100%">
								        <tr>
								          <th>Cart Summary</th>
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
								          <td>Price (3items)</td>
								          <td><i class="fa fa-inr"></i> 49500.00</td>
								        </tr>
								        <tr>
								          <td>Delivery Charges</td>
								          <td><i class="fa fa-inr"></i> 150</td>
								        </tr>
								        <tr>
								          <td>Delivery Charges</td>
								          <td><i class="fa fa-inr"></i> 150</td>
								        </tr>
								        <tr>
								          <td>Delivery Charges</td>
								          <td><i class="fa fa-inr"></i> 150</td>
								        </tr>
								        
								      </tbody>
								    </table>
								  </div>

								  <div class="tbl-header tblhed table-responsive ftrfnt">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="60%">
								      	<col width="40%">
								        <tr>
								          <th>Amount Payable</th>
								          <th><i class="fa fa-inr"></i> 49500.00</th>
								        </tr>
								      </thead>
								    </table>
								  </div>
								</div>
						</div> -->
					</div>
				</div>
				<!--<div class="row justify-content-end">
					<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 order-summary">
						<div class="order-summary-bg">
							<h2>Order Summary</h2>
							<table class="table">
								<tbody>
									<tr>
										<td>Item Sub Total</td>
										<td>$ 12,899.00</td>
									</tr>
									<tr>
										<td>Shipping</td>
										<td>$ 99.00</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>Total (incl.GST)</td>
										<td>$ 12,998.00</td>
									</tr>
								</tfoot>
							</table>
							<p>* Actual tax will be calculated when your order is processed. Tax may vary slightly from what is displayed here.</p>
							<a class="common-btn white-btn btn-block btn-lg" id="show-coupon" href="#">Apply a Promo Code+</a>
							<div class="row mt-4" id="coupon" style="display:none;">							
								<div class="col-12">
									<h3>Enter Coupon Code</h3>
								</div>
								<div class="col-12">								
									<input type="text" class="form-control" placeholder="Enter Coupon Code" />
								</div>
								<div class="col-12">								
									<a class="common-btn white-btn btn-block btn-lg" href="#">Apply</a>
								</div>
							</div>
						</div>
						<a class="common-btn btn-block btn-lg" href="#">CHECK OUT</a>
					</div>
				</div>-->
		</div>
	</section>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script src="<?php echo BASE_URL; ?>static/js/jquery.fancybox.min.js"></script>


<script type="text/javascript">
	
	var tallness = $(".cartleftht").height();
	$(".cartleftrt").css("min-height" , tallness);

//$('.scrlcnt').overlayScrollbars({});

$("#show-coupon").click(function(){
  $("#coupon").show(1000);
});
</script>
  </body>
</html>
