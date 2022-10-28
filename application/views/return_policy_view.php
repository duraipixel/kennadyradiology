<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><?php echo $commondisplaylanguage['home'];?></a></li>
				<li class="breadcrumb-item active" aria-current="page"> 
				<?php echo $footdisplaylanguage['returnpolicy'];?></li>
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white"><?php echo $footdisplaylanguage['returnpolicy'];?></h1>
		 </div>
	  </div>
	</div>
</section>
<section class="light-gray-bg border-bottom my-account" style="position: relative;">
<img class="rellax swing1" data-rellax-speed="6" src="<?php echo img_base;?>/static/images/bg-2.png" alt="" />
   <div class="container">
        <div class="row">
			<?php include ('includes/information-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<?php echo $pagedisplaycontent;?>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>