<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');?>

<?php //echo count($getbannerdisplay);// echo "<pre>";print_r($getbannerdisplay);?>
<div id="home-banner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
   <!--Indicators-->
   <ol class="carousel-indicators">
        <?php $i = 0;foreach($getbannerdisplay as $bannerslider) { ?>
	  <li data-target="#home-banner-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
	  <?php $i++;}?>
   </ol>
   <!--Slides-->
   <div class="carousel-inner" role="listbox">
    <?php $i = 1;foreach($getbannerdisplay as $bannerslider) { ?>
	  <div class="carousel-item <?php echo ($i == 1) ? 'active' : '';?>">
	   <?php if($bannerslider[''] != 'banner_link'){$banlink = $bannerslider['banner_link'];}else{$banlink='javascript:void(0);';}?>
	   
         <picture>
            <source media="(max-width:960px)" srcset="<?php echo BASE_URL;?>uploads/banners/mobile/<?php echo $bannerslider['mobileimage'];?>" />
            <img src="<?php echo BASE_URL;?>uploads/banners/<?php echo $bannerslider['bannerimage'];?>"class="d-block w-100" alt="" />
         </picture>
         <div class="carousel-caption">
       <?php if($bannerslider['banner_title'] != '' && $bannerslider['banner_title'] != '#'){?>
		   <h1><?php echo $bannerslider['banner_title'];?></h1>
	   <?php }?>
            <div class="animated fadeInUp"><a href="<?php echo $banlink;?>" class="banner-btn">Shop Now<i class="flaticon-right-arrow"></i></a></div>
         </div>
      </div>
	<?php $i++;}?>
      <a class="carousel-control-prev" href="#home-banner-carousel" role="button" data-slide="prev">
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#home-banner-carousel" role="button" data-slide="next">
      <span class="sr-only">Next</span>
      </a> 
   </div>
</div>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
   <div class="container">
      <div class="row">
         <div class="col">
            <h2 class="text-center">Categories</h2>
            <h3 class="text-center"><span>Explore Our Products</span></h3>
            <div class="explore-products">
			<?php foreach($trendingcategorys as $trendingcat){ 
				
				if($trendingcat['parentId']=='0'){
					$slug = $trendingcat['categoryCode'];
				}else{
					$slug = $trendingcat['parentslug'].'/'.$trendingcat['categoryCode'];
				}
			
			?>
			
			 
			   
               <div>
			   <a href="<?php echo BASE_URL.$slug; ?>">
                  <?php if($trendingcat['categorymenuimage']!=''){ ?>
					<img src="<?php echo img_base_url."category/categorymenuimage/".$trendingcat['categorymenuimage']; ?>" alt="" />
				<?php } else{ ?>
					<img src="<?php echo img_base_url;?>noimage/photos/base/noimage.png"  alt="" />
				<?php } ?>
                  <h4><?php echo $trendingcat['categoryName']; ?></h4>
				  </a>
			</div><?php }?>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
    $hmslider=$helper->displayhomeslider('2','2');
		/*foreach( $hmslider as $s)
		{	
			$allpath='';
			if($s['type']==1){	
				$arrpath=array();			
				$helper->getProductPath($s['categoryid'],$arrpath); 
				$allpath =$helper->pathrevise($arrpath);
			}				
			$data=$helper->displayproductsilder($s['categoryid'],'homeslider',$s['title'],$allpath,'5','',$s['title'],'clsbestseller',$s['subtitle']);	 

		}*/?>
		
		
<section class="light-gray-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
   <div class="container">
      <div class="row">
         <div class="col">
            <h2 class="text-center">Products</h2>
            <h3 class="text-center"><span>Featured Products</span></h3>
            <div class="featured-products">
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image1.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image2.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image3.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image4.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image1.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items">
                    <div class="featured-products-image">
						<img src="<?php echo BASE_URL;?>/static/images/products/product-image2.png" alt="" class="img-fluid" />
                    </div>
                    <span class="featured-products-name">Coat Apron<strong>$240.99</strong></span>
                    <button type="button" data-mdb-toggle="tooltip" title="Add to Cart" class="add-to-cart-btn">
                        <i class="flaticon-cart-bag"></i>
                    </button>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
   <div class="container">
      <div class="row">
         <div class="col">
            <h2 class="text-center">Explore our products</h2>
            <h3 class="text-center"><span>Choose your Apron with below criteria</span></h3>
            <div class="choose-products">
               <div>
                  <div class="choose-products-content">
                     <h2 class="text-center">Choose apron size</h2>
                     <p class="choose-products-description">Surgical Dress<br/>For Patients &amp; doctors</p>
                     <div class="choose-products-image"><img src="<?php echo BASE_URL;?>/static/images/explore-products-image1.png" alt="" class="img-fluid" /></div>
                     <p class="pt-2 mb-0">Choose Size</p>
                     <div class="d-flex">
                        <div class="chiller_cb">
                           <input id="sizeCheckbox1" type="checkbox" checked>
                           <label for="sizeCheckbox1">Small</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb">
                           <input id="sizeCheckbox2" type="checkbox">
                           <label for="sizeCheckbox2">Medium</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb">
                           <input id="sizeCheckbox3" type="checkbox">
                           <label for="sizeCheckbox3">Large</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb">
                           <input id="sizeCheckbox4" type="checkbox">
                           <label for="sizeCheckbox4">XL</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb">
                           <input id="sizeCheckbox5" type="checkbox">
                           <label for="sizeCheckbox5">XXL</label>
                           <span></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="choose-products-content">
                     <h2 class="text-center">Choose apron Color</h2>
                     <p class="choose-products-description">Choose Your Apron<br/>Color According TO YOU</p>
                     <div class="choose-products-image"><img src="<?php echo BASE_URL;?>/static/images/explore-products-image2.png" alt="" class="img-fluid" /></div>
                     <p class="pt-2 mb-0">Choose Color</p>
                     <div class="d-flex">
                        <div class="chiller_cb color-white">
                           <input id="color1" type="checkbox">
                           <label for="color1">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-orange">
                           <input id="color2" type="checkbox">
                           <label for="color2">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-yellow">
                           <input id="color3" type="checkbox">
                           <label for="color3">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-green">
                           <input id="color4" type="checkbox" checked>
                           <label for="color4">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-purple">
                           <input id="color5" type="checkbox">
                           <label for="color5">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-blue">
                           <input id="color6" type="checkbox">
                           <label for="color6">&nbsp;</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb color-gray">
                           <input id="color7" type="checkbox">
                           <label for="color7">&nbsp;</label>
                           <span></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="choose-products-content">
                     <h2 class="text-center">Choose apron Material</h2>
                     <p class="choose-products-description">Material That Suits<br/>YOur Temperature</p>
                     <div class="choose-products-image"><img src="<?php echo BASE_URL;?>/static/images/explore-products-image3.png" alt="" class="img-fluid" /></div>
                     <p class="pt-2 mb-0">Choose Material</p>
                     <div class="d-flex">
                        <div class="chiller_cb">
                           <input id="materialCheckbox1" type="checkbox" checked>
                           <label for="materialCheckbox1">Semi-Synthetic</label>
                           <span></span>
                        </div>
                        <div class="chiller_cb">
                           <input id="materialCheckbox2" type="checkbox">
                           <label for="materialCheckbox2">Cotton</label>
                           <span></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
               <a href="#" class="yellow-btn">Explore Your Product</a>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="video-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
   <div class="container">
      <div class="row">
         <div class="col">
            <h2 class="text-center text-white">Categories</h2>
            <h3 class="text-center text-white"><span>Explore Our Products</span></h3>
            <div class="home-videos">
               <div>
                  <div class="home-videos-content">
                     <a data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA" class="home-videos-img">
                     <img src="<?php echo BASE_URL;?>/static/images/video-image1.jpg" alt="" class="img-fluid" />
                     <img src="<?php echo BASE_URL;?>/static/images/play-icon.png" alt="" class="play-icon" />
                     </a>
                     <h5>ceiling suspended drying rack</h5>
                     <div class="text-center">
                        <a class="youtube-btn" data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA"><i class="flaticon-youtube-play-fill"></i> Watch on Youtube</a>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="home-videos-content">
                     <a data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA" class="home-videos-img">
                     <img src="<?php echo BASE_URL;?>/static/images/video-image2.jpg" alt="" class="img-fluid" />
                     <img src="<?php echo BASE_URL;?>/static/images/play-icon.png" alt="" class="play-icon" />
                     </a>
                     <h5>ceiling suspended drying rack</h5>
                     <div class="text-center">
                        <a class="youtube-btn" data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA"><i class="flaticon-youtube-play-fill"></i> Watch on Youtube</a>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="home-videos-content">
                     <a data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA" class="home-videos-img">
                     <img src="<?php echo BASE_URL;?>/static/images/video-image3.jpg" alt="" class="img-fluid" />
                     <img src="<?php echo BASE_URL;?>/static/images/play-icon.png" alt="" class="play-icon" />
                     </a>
                     <h5>ceiling suspended drying rack</h5>
                     <div class="text-center">
                        <a class="youtube-btn" data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA"><i class="flaticon-youtube-play-fill"></i> Watch on Youtube</a>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="home-videos-content">
                     <a data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA" class="home-videos-img">
                     <img src="<?php echo BASE_URL;?>/static/images/video-image1.jpg" alt="" class="img-fluid" />
                     <img src="<?php echo BASE_URL;?>/static/images/play-icon.png" alt="" class="play-icon" />
                     </a>
                     <h5>ceiling suspended drying rack</h5>
                     <div class="text-center">
                        <a class="youtube-btn" data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA"><i class="flaticon-youtube-play-fill"></i> Watch on Youtube</a>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="home-videos-content">
                     <a data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA" class="home-videos-img">
                     <img src="<?php echo BASE_URL;?>/static/images/video-image2.jpg" alt="" class="img-fluid" />
                     <img src="<?php echo BASE_URL;?>/static/images/play-icon.png" alt="" class="play-icon" />
                     </a>
                     <h5>ceiling suspended drying rack</h5>
                     <div class="text-center">
                        <a class="youtube-btn" data-fancybox href="https://www.youtube.com/watch?v=YbWACG6PhAA"><i class="flaticon-youtube-play-fill"></i> Watch on Youtube</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
   <div class="container">
      <div class="row">
         <div class="col">
            <h3 class="heading1">What our customers say</h3>
            <div class="home-testimonials">
               <div>
                  <div class="home-testimonial-content">
                     <img src="<?php echo BASE_URL;?>/static/images/quote.png" alt="" class="quote" />
                     <div class="home-testimonial-image">
                        <img src="<?php echo BASE_URL;?>/static/images/testimonial-image1.png" alt="" class="img-fluid" />
                        <p class="home-testimonial-heading">Bibin Mathew<span>Business Manager</span></p>
                        <p class="home-testimonial-ratings">
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-half"></i>
                        </p>
                     </div>
                     <p class="home-testimonial-description">Pulvinar elementum integer enim neque volu Pellentesque ullamcorper dignissim tincidunt lobortis fateugiat. Pulvinar neque laoreet suspendisse interdum consecteid faucibus. In dictum consectetur erat lectus urna.</p>
                  </div>
               </div>
               <div>
                  <div class="home-testimonial-content">
                     <img src="<?php echo BASE_URL;?>/static/images/quote.png" alt="" class="quote" />
                     <div class="home-testimonial-image">
                        <img src="<?php echo BASE_URL;?>/static/images/testimonial-image2.png" alt="" class="img-fluid" />
                        <p class="home-testimonial-heading">Bibin Mathew<span>Business Manager</span></p>
                        <p class="home-testimonial-ratings">
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-half"></i>
                        </p>
                     </div>
                     <p class="home-testimonial-description">Pulvinar elementum integer enim neque volu Pellentesque ullamcorper dignissim tincidunt lobortis fateugiat. Pulvinar neque laoreet suspendisse interdum consecteid faucibus. In dictum consectetur erat lectus urna.</p>
                  </div>
               </div>
               <div>
                  <div class="home-testimonial-content">
                     <img src="<?php echo BASE_URL;?>/static/images/quote.png" alt="" class="quote" />
                     <div class="home-testimonial-image">
                        <img src="<?php echo BASE_URL;?>/static/images/testimonial-image1.png" alt="" class="img-fluid" />
                        <p class="home-testimonial-heading">Bibin Mathew<span>Business Manager</span></p>
                        <p class="home-testimonial-ratings">
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-half"></i>
                        </p>
                     </div>
                     <p class="home-testimonial-description">Pulvinar elementum integer enim neque volu Pellentesque ullamcorper dignissim tincidunt lobortis fateugiat. Pulvinar neque laoreet suspendisse interdum consecteid faucibus. In dictum consectetur erat lectus urna.</p>
                  </div>
               </div>
               <div>
                  <div class="home-testimonial-content">
                     <img src="<?php echo BASE_URL;?>/static/images/quote.png" alt="" class="quote" />
                     <div class="home-testimonial-image">
                        <img src="<?php echo BASE_URL;?>/static/images/testimonial-image2.png" alt="" class="img-fluid" />
                        <p class="home-testimonial-heading">Bibin Mathew<span>Business Manager</span></p>
                        <p class="home-testimonial-ratings">
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-full"></i>
                           <i class="flaticon-star-half"></i>
                        </p>
                     </div>
                     <p class="home-testimonial-description">Pulvinar elementum integer enim neque volu Pellentesque ullamcorper dignissim tincidunt lobortis fateugiat. Pulvinar neque laoreet suspendisse interdum consecteid faucibus. In dictum consectetur erat lectus urna.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>