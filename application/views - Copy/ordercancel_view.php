<?php include ('includes/style.php') ?>
<?php include ('includes/header.php'); ?>
  	<section class="pt-5 mt-5">
  		<div class="container pt-4">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>					
					  <li><a href="#">Order Cancel </a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section >
		<div class="container">	
		<div class="login-section">	
		<!--	<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center">
						<div class="formtitle">
							<h3><p>We have received your request for cancellation of Order <?php echo $orderrefid; ?>. If you have made the payment already, it will be credited back to your bank account soon. Please continue shopping with us!</p> </h3>
							
						</div>											
						
						
						
					</div>
				</div> -->
				
				<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderconfirmation-wraper">
					<div class="mt-4 panel-group">
					
					<div class="row">
					
						<div class="col-sm-12 col-xs-12 ">
						
						<div class="username-container">
							<h2 class="mb-3"><span>Hey</span><span class="medium-font"><?php echo $_SESSION['First_name']; ?></span></h2>
						</div>
						<div class="orderconfirm-large alert alert-danger">
						 <i class="fa fa-times-circle" aria-hidden="true"></i> Your Order is Cancelled.
						</div>
						
						<div class="orderconfirm-content text-center">
							<strong>We have received your request for cancellation of Order <?php echo $orderrefid['order_reference']; ?>. If you have made the payment already, it will be credited back to your bank account soon. Please continue shopping with us!</strong>
						</div>
					
						
						
						
						</div>
						
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  orderinfo-container">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							
							<div class="orderinfo">
						
						
						<div class="amountsplit-single">
						<div class="row pt-4 pb-4">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								Order Id
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
								<div class="cartitem-value"><?php echo $orderrefid['order_reference']; ?></div>
							</div>
							
						</div>
						</div>
					
					
						
					
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-4 bottombtn-wraper">
							<a class="placeorder-btn common-btn" style="width:auto; padding:12px 20px;" href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>">View or Manage Order</a>
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
	</section>
<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>


  </body>
</html>
