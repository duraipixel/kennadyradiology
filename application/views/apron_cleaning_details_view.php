<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"> <?php echo $commondisplaylanguage['home'];?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Knowledge Center</li>
				<?php if($getknowledgecategory[0]['categoryname'] != ''){?>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $getknowledgecategory[0]['categoryname'];?></li>
				<?php }?>
			  </ol>
			</nav>
			<h1 class="heading1 text-center text-white"><?php echo ($getknowledgecategory[0]['categoryname'] != '')? $getknowledgecategory[0]['categoryname'] : 'Knowledge Center';?></h1>
		 </div>
	  </div>
	</div>
</section>

<section class="knowledge-center">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-sm-12 col-md-4 col-lg-3">
				<ul class="knowledge-center-links">
					<li>
						<a href="<?php echo img_base;?>knowledgecenter">FAQ’s</a>
					</li>
					<li class="active">
						<a href="<?php echo img_base;?>apron_cleaning_details">Apron Cleaning Details</a>
					</li>
					<li>
						<a href="#">Apron Warranty</a>
					</li>
					<li>
						<a href="#">Repairs &amp; Recycle</a>
					</li>
					<li>
						<a href="#">Why choose Flexback, S &amp; V, Lead composite &amp; Leadfree</a>
					</li>
					<li>
						<a href="#">Shipping &amp; Return Policy</a>
					</li>
					<li>
						<a href="#">Customisation Form</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="white-bg">
					<h3>Apron Cleaning Details</h3>
					
				</div>
			</div>
		</div>
	</div>
</section>

<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>