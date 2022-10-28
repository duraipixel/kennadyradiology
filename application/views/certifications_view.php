<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Certifications</li>
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white">Certifications</h1>
		 </div>
	  </div>
	</div>
</section>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
		<div class="row">
			<?php include ('includes/aboutus-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<p><img src="<?php echo img_base;?>/static/images/certifications.jpg" alt="" class="img-fluid" /></p>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-4">
							<a href="<?php echo img_base;?>/static/images/hpnw-apr-08-2022.pdf" target="_blank" class="cerification-box">
								<img src="<?php echo img_base;?>/static/images/hpnw-apr-08-2022.jpg" alt="" class="img-fluid" />
							</a>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-4">
							<a href="<?php echo img_base;?>/static/images/hpnw-jan-07-2022.pdf" target="_blank" class="cerification-box">
								<img src="<?php echo img_base;?>/static/images/hpnw-jan-07-2022.jpg" alt="" class="img-fluid" />
							</a>
						</div>
					</div>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>