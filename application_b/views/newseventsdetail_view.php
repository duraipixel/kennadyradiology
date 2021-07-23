<?php 

//echo "<pre>"; print_r($newseventsdetails); exit;
 include ('includes/top.php') ?>
 <body>
<?php include ('includes/header.php') ?>
		<section class="">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-12">
  					<ul class="breadcrumb">
					  <li><a href="<?php echo BASE_URL; ?>/home">Home</a></li>
					  <li><a href="#">News & Events</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
  	</section>
	<section class="showrooms-section newseventspage-section commontop-section">
		<div class="container">
		
			<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12  section-title">
			News & Events
			</div>
		<div class="col-md-12 col-sm-12 col-xs-12 newseventslist-wraper">
			
			<div class="col-md-12 col-sm-12 col-xs-12 nopad newseventslist">
			<div class="row">
				
				<div class="col-md-12 col-sm-12 col-xs-12 newsevents-detail">
					
					
					
					<div class="content-para">
					<div class="row">
							
						<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 newsdet-left">
							<div class="form-group">
							<div class="newsdetail-imagewraper ">
							<div class="newsdetail-slider ">
							<?php  foreach($newseventsdetails as $newsdetails) { ?>
								<div class="newsdetail-single ">
									<img src="<?php echo BASE_URL;?>uploads/newsevents/detailpage/<?php echo $newsdetails['img_path']; ?>" class="img-responsive" alt="slider1">
								</div>
							<?php } ?>
								
							</div>
							</div>
					</div>
					</div>
						<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
							<div class="dateformat"><?php echo $newseventsdetails[0]['sdate']; ?></div>
							
							<div class="form-group">
								<div class="newsdetail-title">
									<?php echo $newseventsdetails[0]['eventtitle']; ?>
								</div>
								<p>
									<?php echo $newseventsdetails[0]['description']; ?>
								</p>
								
							</div>
							</div>
							
							
							
						</div>
						</div>
							
				</div>
				<?php
				//echo $helper->displayDiscountSlap('col-md-2');
				?>
			
				
			</div>
			</div>
		</div>
	
		</div>
		</div>
	</section>
	
<!-- Our Member Of Section Start -->
<section class=" commontop-section">
		<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php include ('partial/ourclients.php') ?>
			</div>
			
		</div>
			
	</div>
	</section>
<!-- Our Member Of Section Start -->
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>

<script>

	/*for home slider*/
				$('.newsdetail-slider').owlCarousel({
					autoplay: 3000,
					items:1,
					infinite: true,
					loop: $('.newsdetail-slider').children().length > 1 ? true : false,
					smartSpeed: 1500,
					dots: true
				});
				/*for home slider*/

</script>
</body>
</html>