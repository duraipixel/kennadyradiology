<?php 
   //print_r($getcorporatecustomer); exit;
 include ('includes/top.php') ?>
 <body class="productbg">
<?php include ('includes/header.php') ?>
	<section class="login">
		<div class="container pl-0 pr-0 pt-5">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL;?>home"> Home</a></li>
					  <li><a href="#"> Verification  </a></li> 
					</ul>
  				</div>
  			</div>
  		</div>
		<div class="container">	
		<div class="login-section pt-5 pb-5">	
			<div class="row">
				<div class="col-md-12 col-md-offset-3 text-center">
						<div class="formtitle">
							<?php if($Register_activation>0){ ?>
							<h4>Congratulations! Your account has been activated.</h4>
							<a href="<?php echo BASE_URL;?>login" >Login</a>
						<?php } else{ ?>
						  <h4>Your account is already activated.</h4>
						<?php } ?>
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
