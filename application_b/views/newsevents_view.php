<?php 

//echo "<pre>"; print_r($getnewseventslist); exit;
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
				<?php foreach($getnewseventslist as $newsevents){ ?>
				<div class="col-md-6 col-sm-6 col-xs-6 newsevents-single">
					<a href="<?php echo BASE_URL; ?>news-events/<?php echo $newsevents['eventsslug']; ?>" class="news-single">
								<div class="newsimage">
								<img src="<?php echo BASE_URL;?>uploads/newsevents/homepage/<?php echo $newsevents['img_path']; ?>" class="img-responsive" alt="">
								</div>
								<div class="newscontent">
									<div class="dateformat"><?php echo $newsevents['sdate']; ?></div>
									<div class="news-content"><?php echo $newsevents['eventtitle']; ?></div>
									<div class="readmore-wraper"><span class="readmore-span">Read More <i class="fa fa-angle-right"></i></span></div>
								</div>
							</a>
				</div>
				<?php } ?>
			
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

</script>
</body>
</html>