<?php 

 include ('includes/top.php') ?>

 <body>

<?php include ('includes/header.php') ?>

<!--		<section class="banner-section">

	<div class="banner-inner">

			<img src="<?php echo BASE_URL;?>static/images/banner/aboutus.jpg" class="img-responsive" alt="slider1">

			

	</div>

	</section> -->

	

	<section class="homeslider-section inn">

	<div class="">
 

		<div class="inner-banners">

			<img src="<?php echo BASE_URL;?>static/images/banner/media.jpg" class="img-responsive desktopimg" alt="slider1">


			 
		</div>
						<div class="inn-bancnt">
				<div class="container">
				
				<h4> Watch Our Campaigns </h4>
				
				</div>
				</div>
 
 

	</div> 

	</section>

	

	<section class="breadcrumb-section">

  		<div class="container">

  			<div class="row">

  				<div class="col-md-12">

  					<ul class="breadcrumb">

					  <li><a href="<?php echo BASE_URL;?>">Home</a></li>

					  <li><a href="#">Media</a></li>

					</ul>

  				</div>

  			</div>

  		</div>

  	</section>

	<section class="showrooms-section common-section">

		<div class="container">

			

			<div class="row">

		

		<div class="col-md-12 col-sm-12 col-xs-12 aboutus-container">

			

			

			<div class="row">

				

				<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="col-md-12 col-sm-12 col-xs-12 nopad inn section-title media-det text-center">

			<h5>Media  </h5>

			<ul>
			<li> 
			<a data-fancybox="gallery-1" href="https://www.youtube.com/embed/-jD1wZJBKtc" title="" rel="media-gallery"><img src="<?php echo BASE_URL;?>static/images/vid-1.jpg"></a>
			</li>
			<li> 
			<a data-fancybox="gallery-2" href="https://www.youtube.com/embed/unnu7wFTQE8" title="" rel="media-gallery"><img src="<?php echo BASE_URL;?>static/images/vid-2.jpg"></a>
			</li>
			<li> 
			<a data-fancybox="gallery-3" href="https://www.youtube.com/embed/FwicyEE_Gok" title="" rel="media-gallery"><img src="<?php echo BASE_URL;?>static/images/vid-3.jpg"></a>
			</li>
			<li> 
			<a data-fancybox="gallery-4" href="https://www.youtube.com/embed/DmWUK2fC6FY" title="" rel="media-gallery"><img src="<?php echo BASE_URL;?>static/images/vid-4.jpg"></a>
			</li>
			</ul>
			

			</div>

					<div class="col-md-12 col-sm-12 col-xs-12 nopad ">

 

					</div>

					

				</div>

			

 

			</div>

			

		</div>

		</div>

	

		</div>

	</section> 



<?php include('includes/footer.php')?>

<?php include('includes/script.php')?>



<script>

$(document).ready(function(){

			/*for home slider*/

				$('.homeslider-inner').owlCarousel({

					autoplay: 3000,

					items:1,

					infinite: true,

					loop: $('.homeslider-inner').children().length > 1 ? true : false,

					smartSpeed: 1500,

					dots: true

				});

				/*for home slider*/

				

				/*for home slider*/

				$('.tesimonial-slider').owlCarousel({

					autoplay: 3000,

					items:1,

					infinite: true,

					loop: $('.tesimonial-slider').children().length > 1 ? true : false,

					smartSpeed: 1500,

					dots: true

				});

				/*for home slider*/

	

});

</script>

</body>

</html>