<?php
 //echo "<pre>"; print_r($addtowishlist); exit; 
//echo "<pre>"; print_r($addtocartlist); exit;
 include ('includes/top.php') ?>
 <link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
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
					  <li><a href="<?php echo BASE_URL;?>">Home</a></li>
					  <li><a href="#">My Wishlist</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section class="whislist-section">
		<div class="container">	
			<div class="infotitle mb5">
					<span><h3>My Wishlist</h3></span>
				</div>	
				<div class="cart-section">
					  <div class="row">
						<div class="col-md-12 ">																	
							<div class=" cart bgwhite cartleftht">
							<div class="table-responsive">
							<div class="orderhis">

								  <div id="wishlistpage">
                                 <?php include_once('partial/wishlist_table.php')?>
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
<script src="<?php echo BASE_URL; ?>static/js/jquery.fancybox.min.js"></script>


<script type="text/javascript">
	
	var tallness = $(".cartleftht").height();
	$(".cartleftrt").css("min-height" , tallness);

//$('.scrlcnt').overlayScrollbars({});


</script>
  </body>
</html>
