<?php 
   //print_r($getcorporatecustomer); exit;
 include ('includes/top.php') ?>
 <body class="productbg">
<?php include ('includes/header.php') ?>
  	<section class="pt-5 mt-4">
  		<div class="container mt-5">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home">Home</a></li>					
					  <li><a href="#">Order Failure </a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section >
		<div class="container">	
		<div class="login-section panel-group mt-4 p-4">	
			<!--<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center">
						<div class="formtitle">
							<h3><p>We find that you tried placing an order with us. We regret to inform that your order could not be completed. Please review your order and try again.</p> </h3>
							
						</div>											
						
						
						
					</div>
				</div> -->
				
				<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderconfirmation-wraper">
					
					
						
						<div class="username-container">
							<h2 class="mb-3"><span>Hey</span><span class="medium-font"><?php echo $_SESSION['First_name']; ?></span><h2>
						</div>
						<div class="orderconfirm-large alert alert-danger">
						 <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp; Order Failed.
						</div>
						
						<div class="orderconfirm-content text-center">
							We find that you tried placing an order with us. We regret to inform that your order could not be completed. Please review your order and try again.
						</div>
						
						
			
					</div>
				</div>
				<div class="row">
							<div class="col-sm-12 col-md-12">
							
							<div class="orderinfo">
						
						
						<div class="amountsplit-single mt-3">
							<p>
								Order Id
							</p>
								<p class="cartitem-value"><?php echo $orderrefid['order_reference']; ?></p>
						
						</div>
					
						
					</div>
							</div>
							
					
						
					
						
						<div class="col-sm-12 col-md-12 pt-4 pb-4 bottombtn-wraper">
							<a class="placeorder-btn common-btn" style="width: auto; padding: 12px 20px;" href="<?php echo BASE_URL;?>myorders/view/<?php echo $orderrefid['order_reference'];?>">View or Manage Order</a>
					</div>
							
							
						
						</div>
			</div>
		</div>
	</section>
<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>


  </body>
</html>
