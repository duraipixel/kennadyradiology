<?php  	
//echo "<pre>"; print_r($productdetails); exit;
include ('includes/top.php');
 
 ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/theme1.css">

<!--      
--><!-- Icon Font -->

<?php include ('includes/header.php') ?>

<!-- Main Banner Starts -->
<section class="theme1">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/banner/<?php echo $productfeaturedetail[0]['bannerimage'];?>" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>

<!-- Main Banner End --> 
<!-- Product Carousel Starts -->
<section class="product-carousel">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-8">
        <div id="ProductCarousel" class="carousel slide" data-ride="carousel"  data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"> 
          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active"> <img src="<?php echo BASE_URL;?>static/images/theme1/headphone1.png" id="ProductImage1" alt="" />
              <ul class="product-colors">
                <li class="yellow">
                  <button type="button" onclick="document.getElementById('ProductImage1').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
                <li class="red">
                  <button type="button" onclick="document.getElementById('ProductImage1').src='<?php echo BASE_URL;?>static/images/products/product-10.png'"></button>
                </li>
                <li class="blue">
                  <button type="button" onclick="document.getElementById('ProductImage1').src='<?php echo BASE_URL;?>static/images/products/product-11.png'"></button>
                </li>
                <li class="black">
                  <button type="button" onclick="document.getElementById('ProductImage1').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
              </ul>
              <p class="product-name">D250 CLEAR SOUND EARPHONE</p>
              <p class="product-price">Rs. 799/-</p>
              <p> <a href="" class="buy-now-bt">Buy Now</a> <a href="" class="add-to-cart-bt">Add to cart</a> </p>
            </div>
            <div class="carousel-item"> <img src="<?php echo BASE_URL;?>static/images/theme1/headphone1.png" alt="" id="ProductImage2" />
              <ul class="product-colors">
                <li class="yellow">
                  <button type="button" onclick="document.getElementById('ProductImage2').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
                <li class="red">
                  <button type="button" onclick="document.getElementById('ProductImage2').src='<?php echo BASE_URL;?>static/images/products/product-10.png'"></button>
                </li>
                <li class="blue">
                  <button type="button" onclick="document.getElementById('ProductImage2').src='<?php echo BASE_URL;?>static/images/products/product-11.png'"></button>
                </li>
                <li class="black">
                  <button type="button" onclick="document.getElementById('ProductImage2').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
              </ul>
              <p class="product-name">D250 CLEAR SOUND EARPHONE</p>
              <p class="product-price">Rs. 799/-</p>
              <p> <a href="" class="buy-now-bt">Buy Now</a> <a href="" class="add-to-cart-bt">Add to cart</a> </p>
            </div>
            <div class="carousel-item"> <img src="<?php echo BASE_URL;?>static/images/theme1/headphone1.png" alt="" id="ProductImage3" />
              <ul class="product-colors">
                <li class="yellow">
                  <button type="button" onclick="document.getElementById('ProductImage3').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
                <li class="red">
                  <button type="button" onclick="document.getElementById('ProductImage3').src='<?php echo BASE_URL;?>static/images/products/product-10.png'"></button>
                </li>
                <li class="blue">
                  <button type="button" onclick="document.getElementById('ProductImage3').src='<?php echo BASE_URL;?>static/images/products/product-11.png'"></button>
                </li>
                <li class="black">
                  <button type="button" onclick="document.getElementById('ProductImage3').src='<?php echo BASE_URL;?>static/images/products/product-9.png'"></button>
                </li>
              </ul>
              <p class="product-name">D250 CLEAR SOUND EARPHONE</p>
              <p class="product-price">Rs. 799/-</p>
              <p> <a href="" class="buy-now-bt">Buy Now</a> <a href="" class="add-to-cart-bt">Add to cart</a> </p>
            </div>
          </div>
          <!-- Left and right controls --> 
          <a class="carousel-control-prev" href="#ProductCarousel" data-slide="prev"> <i class="lni lni-arrow-left"></i> </a> <a class="carousel-control-next" href="#ProductCarousel" data-slide="next"> <i class="lni lni-arrow-right"></i> </a> </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Carousel End --> 
<!-- Product Video Starts -->
<?php 
if(count($feature_additionalfeature) > 0){
foreach($feature_additionalfeature as $feature){
	if($feature['featuretype'] == 2){
	?>
<section class="product-video">
<div class="container-fluid p-0" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
<div class="row no-gutters">
  <div class="col">  <iframe width="1600" height="680" src="<?php echo $feature['videolink'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <!--<a href="#" data-toggle="modal" data-target="#VideoModal<?php echo $feature['addid'];?>"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature['featureimage'];?>" alt="" class="img-fluid" /> <i class="lni lni-play"></i> </a> --></div>
</div>
<div>
</section>

<!-- Video Modal -->
<!--<div class="modal fade opacity-animate3" id="VideoModal<?php echo $feature['addid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <iframe width="560" height="315" src="<?php echo $feature['videolink'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>-->
<?php }else{
	?>
<section class="features-banner">
  <div class="container-fluid p-0" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
    <div class="row no-gutters">
      <div class="col text-center"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature['featureimage'];?>" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>
<?php 
	
}
}
}?>

<!-- Product Video End --> 
<!-- Main Banner Starts --> 
<!-- Main Banner End --> 
<!-- Recently Viewed Starts -->
<section class="best-seller">
  <div class="container">
    <div class="best-seller-wrap">
      <div class="seller-slider">
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-1.png" alt="">
            <div class="seller-content">
              <h6>Rs. 1499/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-2.png" alt="">
            <div class="seller-content">
              <h6>Rs. 2999/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-3.png" alt="">
            <div class="seller-content">
              <h6>Rs. 599/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-4.png" alt="">
            <div class="seller-content">
              <h6>Rs. 999/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-1.png" alt="">
            <div class="seller-content">
              <h6>Rs. 1499/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-2.png" alt="">
            <div class="seller-content">
              <h6>Rs. 2999/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-3.png" alt="">
            <div class="seller-content">
              <h6>Rs. 599/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
        <div>
          <div class="sell-wrap"> <img src="<?php echo BASE_URL;?>static/images/products/product-4.png" alt="">
            <div class="seller-content">
              <h6>Rs. 999/-</h6>
              <a href="" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Recently Viewed End --> 
<!-- Image Text1 Starts -->

<?php 
if(count($additionalfeature_listtype) > 0){
foreach($additionalfeature_listtype as $addlisttype){
	if($addlisttype['aligntype'] == 1){
	?>
<section class="imageText1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-6" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $addlisttype['featureimage'];?>" alt="" class="img-fluid" /> </div>
      <div class="col-sm-12 col-md-6 col-lg-6" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
        <h2><?php echo $addlisttype['featuretitle'];?></h2>
        <br/>
        <p><?php echo $addlisttype['shortdescription'];?></p>
      </div>
    </div>
  </div>
</section>
<?php }else{
	?>
<section class="imageText2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-6" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $addlisttype['featureimage'];?>" alt="" class="img-fluid" /> </div>
      <div class="col-sm-12 col-md-6 col-lg-6 order-first" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000">
        <h2><?php echo $addlisttype['featuretitle'];?></h2>
        <br/>
        <p><?php echo $addlisttype['shortdescription'];?></p>
      </div>
    </div>
  </div>
</section>
<?php 
	
}
}

}?>
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>


var el = document.getElementById("tilt1")

/* Get the height and width of the element */
const height = el.clientHeight
const width = el.clientWidth

/*
  * Add a listener for mousemove event
  * Which will trigger function 'handleMove'
  * On mousemove
  */
el.addEventListener('mousemove', handleMove)

/* Define function a */
function handleMove(e) {
  /*
    * Get position of mouse cursor
    * With respect to the element
    * On mouseover
    */
  /* Store the x position */
  const xVal = e.layerX
  /* Store the y position */
  const yVal = e.layerY
  
  /*
    * Calculate rotation valuee along the Y-axis
    * Here the multiplier 20 is to
    * Control the rotation
    * You can change the value and see the results
    */
  const yRotation = 20 * ((xVal - width / 2) / width)
  
  /* Calculate the rotation along the X-axis */
  const xRotation = -20 * ((yVal - height / 2) / height)
  
  /* Generate string for CSS transform property */
  const string = 'perspective(500px) scale(1.2) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'
  
  /* Apply the calculated transformation */
  el.style.transform = string
}

/* Add listener for mouseout event, remove the rotation */
el.addEventListener('mouseout', function() {
  el.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
})
</script>
</body>
</html>