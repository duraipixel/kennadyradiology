<?php  include ('includes/top.php') ?>
 <body class="productbg">
<?php include ('includes/header.php') ?>
<?php
//echo $helper->displaymenu();
?>
  	<section>
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL; ?>home">Home</a></li>
					  <li><a href="#">Track Order</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section >
		<div  class="container">
		<?php include ('partial/leftsidebar.php') ?>
		
		<div class="col-md-9 nopad sss2">
			<div class="accountinfosec cataloguepad">
				<div class="cttitpad">
					<div class="row">
						<div class="col-md-6">
							<div class="infotitle">
								<h3>Track Order</h3>
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
