<?php

 include ('includes/top.php') ?>

<body>
<?php include ('includes/header.php') ?>
<div class="banner">
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators">
      <?php $i = 0;foreach($getbannerdisplay as $bannerslider) { ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
      <!--  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
      <?php $i++;}?>
    </ol>
    <div class="carousel-inner">
      <?php $i = 1;foreach($getbannerdisplay as $bannerslider) { ?>
      <div class="carousel-item <?php echo ($i == 1) ? 'active' : '';?>" >
      <?php if($bannerslider[''] != 'banner_link'){$banlink = $bannerslider['banner_link'];}else{$banlink='javascript:void(0);';}?>
         <a href="<?php echo $banlink;?>"> <img class="carousel-img d-none d-xl-block d-lg-block d-sm-block" src="<?php echo BASE_URL;?>uploads/banners/<?php echo $bannerslider['bannerimage'];?>" alt="First slide"></a>
		 <a href="<?php echo $banlink;?>"> <img class="carousel-img d-block d-sm-none" src="<?php echo BASE_URL;?>uploads/banners/mobile/<?php echo $bannerslider['mobileimage'];?>" alt="First slide"></a>
      </div>
      <?php $i++;}?>
    </div>
  </div>
</div> 

<!-- Trending Categories Section -->
<section class="white-bg">
	<div class="container">
		<div class="row">
		
			<div class="col-sm-12 col-md-12">
			  <div class="best-title" style="padding-top: 40px;">
				<h2 class="main-title-dark">Trending Categories</h2>
			  </div>
			</div>
			<?php foreach($trendingcategorys as $trendingcat){ 
				
				if($trendingcat['parentId']=='0'){
					$slug = $trendingcat['categoryCode'];
				}else{
					$slug = $trendingcat['parentslug'].'/'.$trendingcat['categoryCode'];
				}
			
			?>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<a href="<?php echo BASE_URL.$slug; ?>" class="trending-categories">
					<?php if($trendingcat['categorymenuimage']!=''){ ?>
					<img src="<?php echo img_base_url."category/categorymenuimage/".$trendingcat['categorymenuimage']; ?>" class="img-responsive" alt="" />
				<?php } else{ ?>
					<img src="<?php echo img_base_url;?>noimage/photos/base/noimage.png" class="img-responsive" alt="" />
				<?php } ?>
					<h4><?php echo $trendingcat['categoryName']; ?></h4>
				</a>
			</div>
			<?php } ?>

		</div>	
	</div>
	</section>

<!-- BEST SELLERS Section -->

<?php 
		 $hmslider=$helper->displayhomeslider('1','1');
 		 foreach( $hmslider as $s){	

			$allpath='';

			if($s['type']==1){	

				$arrpath=array();			

				$helper->getProductPath($s['categoryid'],$arrpath);
 			    $allpath =$helper->pathrevise($arrpath);
 			}

			$data=$helper->displayproductsilder($s['categoryid'],'homeslider',$s['title'],$allpath,'5','',$s['title'],'clsbestseller',$s['subtitle']);	 
		}

 ?>
 
 <?php 
//single product show

 if(count($singlehomeproduct['prod_list'])>0){ ?>
 <section class="single-slider">
  <div class="container">
    <div class="slider-wrap">
      <div class="slider silder-left slider-nav">
        <?php foreach($singlehomeproduct['prod_list'] as $homeproductimg){
					$arrpath=array();
	     $helper->getProductPath($homeproductimg['categoryID'],$arrpath); $imgs=explode("|",$homeproductimg['img_names']);
					?>
        <div>
          <div class="acces-wrap">
            <?php if($imgs[0] != ''){?>
            <a href="<?php  echo $helper->pathrevise($arrpath).'/'.$homeproductimg['product_url']; ?>" > <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $homeproductimg['product_id']; ?>/photos/<?php echo $imgs[0]; ?>" alt=""></a>
            <?php }else{?>
            <a href="<?php  echo $helper->pathrevise($arrpath).'/'.$homeproductimg['product_url']; ?>" > <img src="<?php echo BASE_URL;?>uploads/noimage/photos/medium/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $homeproductimg['product_name']; ?>" alt="<?php echo $homeproductimg['product_name']; ?>" /></a>
            <?php }?>
          </div>
        </div>
        <?php }?>
      </div>
      <div class="slider slider-right slider-for">
        <?php foreach($singlehomeproduct['prod_list'] as $homeproductimg){?>
        <div>
          <div class="acces-content">
            <h2> <a href="<?php  echo $helper->pathrevise($arrpath).'/'.$homeproductimg['product_url']; ?>" ><?php echo $homeproductimg['product_name']; ?></a></h2>
            <!--    <h4>PRODUCT FEATURES</h4>
            <ul>
              <li> SKU: <?php //echo $homeproductimg['sku']; ?> </li>
            <li>
                                    Brand: <?php //echo $homeproductimg['brandname']; ?>
                                </li>
                                <li>
                                    Easy to Carry
                                </li>
            </ul>-->
            <!--<h3>SHIPPING & RETURNS</h3>-->
            
            <input id="prices1_<?php echo $homeproductimg['product_id'];?>" name="prices1_<?php echo $homeproductimg['product_id'];?>" type="hidden" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
          <!--  <h3>DESCRIPTION</h3>-->
            <div><?php echo substr($homeproductimg['description'],0,250); ?></div>
            <h5><i class="fa fa-inr"></i> <span><?php echo  number_format(round($homeproductimg['final_price_tax']),2); ?>/-</span></h5>
            <div class="button"><!-- <a href="javascript:void(0)"  onclick="buynow('<?php echo $homeproductimg['product_id'];?>');"  class="common-btn"> Buy Now </a>-->
            
             <a href="<?php  echo $helper->pathrevise($arrpath).'/'.$homeproductimg['product_url']; ?>"  class="common-btn"> View Detail </a>
             
              <a href="javascript:void(0)"  onclick="addtocart('<?php echo $homeproductimg['product_id'];?>');"  class="common-btn white-btn"> Add to cart </a> </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</section> 
<?php } ?>

<!-- Videos Section -->
<section class="dark-bg">
	<div class="container ">
		
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="best-title" style="margin:50px 0 0 0;">
					<h2 class="main-title-dark text-white">Videos</h2>
				</div>
				<div class="video-slider">
					<div>
						<div class="sell-wrap ">
							<div class="playvideo1" id="playvideo1">
							<img src="<?php echo BASE_URL;?>static/images/play-icon.png" alt="" />
							<img class="video-placeholder" src="<?php echo BASE_URL;?>static/images/video-bg-1.jpg" alt="" />
							<iframe id="video1" src="https://www.youtube.com/embed/mJAkRgcVrvc?autoplay=0&showinfo=0&controls=0&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>							
                            </div>							
							<div class="video-description text-white"><h4>Urban Fit Smartwatch Promo</h4><p>Features &amp; Specifications Explained | Best Smartwatch Under Rs 4000</p></div>
						</div>
					</div>
					<div>
						<div class="sell-wrap">
							<div class="playvideo2" id="playvideo2">
							<img src="<?php echo BASE_URL;?>static/images/play-icon.png" alt="" />
							<img class="video-placeholder" src="<?php echo BASE_URL;?>static/images/video-bg-2.jpg" alt="" />
						   <iframe id="video2" src="https://www.youtube.com/embed/UCX9sJSl-7g?autoplay=0&showinfo=0&controls=0&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="video-description text-white"><h4>Smartwatch Review</h4><p>Inbase Smart Watch Business ideas ain Tamil | Indian Brand - Inbase</p></div>
						</div>
					</div>
					<div>
						<div class="sell-wrap">
                        <div class="playvideo3" id="playvideo3">
							<img src="<?php echo BASE_URL;?>static/images/play-icon.png" alt="" />
							<img class="video-placeholder" src="<?php echo BASE_URL;?>static/images/video-bg-3.jpg" alt="" />
						   <iframe id="video3" src="https://www.youtube.com/embed/8YWj50Jg94E?autoplay=0&showinfo=0&controls=0&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                           </div>
						   <div class="video-description text-white"><h4>Inbase Urban Fit Smartwatch</h4><p>Official Video | Poorvika Mobiles</p></div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		

</div>
</section>
 
    
    <?php   //$hmslider=$helper->displayhomesCategorylider('1','1','Products');?>
 <?php
    $hmslider=$helper->displayhomeslider('2','2');
		foreach( $hmslider as $s)
		{	

			$allpath='';
			if($s['type']==1){	

				$arrpath=array();			

				$helper->getProductPath($s['categoryid'],$arrpath);

			//	print_r($arrpath); die();

			 $allpath =$helper->pathrevise($arrpath);

			}

			
			
			$data=$helper->displayproductsilder($s['categoryid'],'homeslider',$s['title'],$allpath,'5','',$s['title'],'clsbestseller',$s['subtitle']);	 

		}?>

<section class="portfolio">
  <div class="container">
    <div class="row">
    <?php echo $helper->getdisplayblock('home-block-1'); ?> 
    
      <!--<div class="col-md-6">
        <div class="port-list big-port"> <img src="<?php echo BASE_URL;?>static/images/portfolio-1.png" alt="">
          <div class="port-content">
            <h2 class="port-title">IB001 STEREO <span>EARPHONE</span></h2>
            <p class="port-description"> <span>Heavy Bass</span> <span>Crystal Clear Sound</span> <span>Theater Experience</span> </p>
          </div>
          <a href="" class="transparent-btn">Buy Now</a> </div>
      </div>-->
      <div class="col-md-6">
        <div class="row">
        <?php echo $helper->getdisplayblock('home-block-2'); ?> 
        <?php echo $helper->getdisplayblock('home-block-3'); ?> 
         <!-- <div class="col-md-12">
            <div class="port-list small-port"> <img src="<?php echo BASE_URL;?>static/images/portfolio-2.png" alt="">
              <div class="port-content">
                <h2 class="port-title">3.1A UNIVERSAL <span>CAR CHARGER</span></h2>
              </div>
              <a href="" class="transparent-btn">Buy Now</a> </div>
          </div>
          <div class="col-md-12">
            <div class="port-list medium-port"> <img src="<?php echo BASE_URL;?>static/images/portfolio-3.png" alt="">
              <div class="port-content">
                <h2 class="port-title">6000 MAH <span>POWER BANK</span></h2>
                <a href="" class="transparent-btn">Buy Now</a> </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</section>



       
					
				 
<?php include('partial/clientlist.php');?>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
  $('.testimonial-function').slick({
    dots: false,
    arrows: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    adaptiveHeight: true,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 999,
      settings: {
        slidesToShow: 1,
		arrows: false,		
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
 
  ]
});


  
  $('.video-slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: false,
    responsive: [
    {
      breakpoint: 1320,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
  });
</script>
<script>

$(document).ready(function(){

			/*for home slider*/

				/*$('.homeslider-inner').owlCarousel({

					autoplay: 3000,

					items:1,

					infinite: true,

					loop: $('.homeslider-inner').children().length > 1 ? true : false,

					smartSpeed: 1500,

					dots: true

				});*/

				$('.homeslider-inner').slick({

				autoplay: 3000,	

				dots: true,

				arrows: false,

				infinite: true,

				speed: 800,

				slidesToShow: 1,

				slidesToScroll: 1

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

$('#tab-3').trigger('click');	


</script>
 <script>
	$("#playvideo1").click(function () {
		$("#video1")[0].src += "?autoplay=1";
        $(".playvideo1").addClass("remove");
    });	
	
	$("#playvideo2").click(function () {
		$("#video2")[0].src += "?autoplay=1";
        $(".playvideo2").addClass("remove");
    });	
	
	$("#playvideo3").click(function () {
		$("#video3")[0].src += "?autoplay=1";
        $(".playvideo3").addClass("remove");
    });	
</script>
</body>
</html>
