<?php  	
//echo "<pre>"; print_r($productdetails); exit;
include ('includes/top.php');
 
 ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/theme2.css">

<!--      
--><!-- Icon Font -->

<?php include ('includes/header.php') ?>

<!-- Main Banner Starts -->
<section class="theme2">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/banner/<?php echo $productfeaturedetail[0]['bannerimage'];?>" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>
<!-- Main Banner End --> 
<!-- More Power Section Starts -->
<?php if(count($feature_specialfeature) > 0){?>
<section class="more-power pt-5 pb-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-12 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
       <?php echo $productfeaturedetail[0]['mspecificationtitle'];?>
        <p class="text-center"><?php echo $productfeaturedetail[0]['mspecificationdesc'];?></p>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <ul>
        <?php
		foreach($feature_specialfeature as $specialfeature){
		 if($specialfeature['featureicon'] != ''){?>
          <li data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"> <a href="#"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/specialfeature/icon/<?php echo $specialfeature['featureicon'];?>" alt="" /> <?php echo $specialfeature['shortdescription'];?> </a> </li>
          <?php }
		  }?> 
        </ul>
      </div>
    </div>
  </div>
</section>
<?php }?>  

<!-- More Power Section End --> 
<!-- Video Section Starts -->
<section class="video pt-5 pb-5">
  <div class="container">
<?php if(count($feature_additional_list_video) > 0){?>
    <div class="row">
      <div class="col text-center pt-5" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">  <iframe width="990" height="540" src="<?php echo $feature_additional_list_video[0]['videolink'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> </div>
    </div>
  <?php }?>   
   <!-- <div class="row">
      <div class="col">
        <h1 class="text-white text-center text-uppercase mt-5 mb-5"  data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Smarter Than Your<br/>
          Average Headphones</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"> <a href="#" class="video-image1"> <img src="<?php echo BASE_URL;?>static/images/theme2/video-image2.png" alt="" />
        <p class="vidoe-text1 text-center">Fusce velit risus, bibendum quis</p>
        <p class="video-text2 text-center">Fusce velit risus, bibendum quis arcu et, tempor congue risus. </p>
        </a> </div>
      <div class="col-sm-12 col-md-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"> <a href="#" class="video-image1"> <img src="<?php echo BASE_URL;?>static/images/theme2/video-image2.png" alt="" />
        <p class="vidoe-text1 text-center">Fusce velit risus, bibendum quis</p>
        <p class="video-text2 text-center">Fusce velit risus, bibendum quis arcu et, tempor congue risus. </p>
        </a> </div>
      <div class="col-sm-12 col-md-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000"> <a href="#" class="video-image1"> <img src="<?php echo BASE_URL;?>static/images/theme2/video-image2.png" alt="" />
        <p class="vidoe-text1 text-center">Fusce velit risus, bibendum quis</p>
        <p class="video-text2 text-center">Fusce velit risus, bibendum quis arcu et, tempor congue risus. </p>
        </a> </div>
    </div>-->
  </div>
</section>
<!-- Video Section End --> 
<!-- Specification Section Starts -->
<?php if(count($feature_specification) > 0 || $feature_additional_list_image[0]['featureimage'] != ''){?>
<section class="specification pt-5 pb-5 bg-white">
<?php if(count($feature_specification) > 0){?>
  <div class="container">
    <div class="row">
      <div class="col pt-5">
        <h1 class="text-uppercase mb-2" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Quality Headphones</h1>
        <h2 class="text-uppercase mb-5" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">See Specifications</h2>
      </div>
    </div>
    <div class="row">
      <!--<div class="col-sm-12 col-md-4 col-lg-3">
        <div class="spec-bg"> <img src="<?php echo BASE_URL;?>static/images/theme2/spec-image1.png" alt="" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000" /> <img src="<?php echo BASE_URL;?>static/images/theme2/spec-image2.png" alt="" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000" /> </div>
      </div>-->
      <div class="col-sm-12 col-md-8">
        <div class="table-responsive pt-2" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
          <table class="table">
            <tbody>
            <?php foreach($feature_specification as $specification){?>
              <tr>
                <td><strong><?php echo $specification['spectitle'];?></strong></td>
                <td><?php echo $specification['specvalue'];?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php }?>
  
  <?php if($feature_additional_list_image[0]['featureimage'] != ''){?>
  <div class="row no-gutters p-0">
    <div class="col-sm-12 col-md-12 col-lg-6 pb-5"  data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[0]['featureimage'];?>" alt="" class="img-fluid img-shadow" /> </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
      <div class="orange-bg">
        <h2 class="text-white pb-3" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"><?php echo $feature_additional_list_image[0]['featuretitle'];?><br/></h2>
        <p class="text-white" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"><?php echo $feature_additional_list_image[0]['shortdescription'];?></p>
        <div class="orange-bt" data-aos="fade-left" data-aos-delay="300" data-aos-duration="1000">
          <div class="eff"></div>
          <?php if($feature_additional_list_image[0]['buttonurl'] != ''){?>
          <a target="_blank" href="<?php echo $feature_additional_list_image[0]['buttonurl'];?>" class="text-uppercase">Learn More</a> 
          <?php }?>
          </div>
      </div>
    </div>
  </div>
   <?php }?>
</section>
<?php }?>
<!-- Specification Section End --> 
<!-- Main Features Section Starts -->
 <?php if($feature_additional_list_image[1]['featureimage'] != ''){?>
<section class="main-features pb-5 bg-white">
<div class="container">
<div class="row">
  <div class="col-12 col-md-6">
    <h1 class="text-uppercase mb-2" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Explore Functionality</h1>
    <h2 class="text-uppercase mb-5" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Main Features</h2>
    <?php echo $feature_additional_list_image[1]['shortdescription'];?>
  </div>
  <div class="col-12 col-md-6 pt-5" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[1]['featureimage'];?>" alt="" class="img-fluid" /> </div>
</div>
</section>
  <?php }?>
<!-- Main Features Section End --> 
<!-- Experience Section Starts -->
<?php if($feature_additional_list_image[2]['featureimage'] != ''){?>
<section class="experience">
  <div class="experience-image has-background-dim" style="background-image:url(<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[2]['featureimage'];?>)">
    <h2 data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000"><span><?php echo $feature_additional_list_image[2]['featuretitle'];?></span><br/>
     <?php echo $feature_additional_list_image[2]['shortdescription'];?><br/>
      <?php if($feature_additional_list_image[2]['buttonurl'] != ''){?> <a target="_blank" href="<?php echo $feature_additional_list_image[2]['buttonurl'];?>" class="text-uppercase">Discover Now</a><?php }?>
      </h2>
  </div>
</section>
<?php }?>
<!-- Experience Section End --> 
<!-- Choose Colors Section Starts -->
<!--<section class="choose-colors pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col pt-5">
        <h1 class="text-uppercase text-center mb-2" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Shop Headphones</h1>
        <h2 class="text-uppercase text-center mb-5" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">Choose Colors</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
        <div class="choose-colors-image text-center text-uppercase"> <img src="<?php echo BASE_URL;?>static/images/theme2/spec-image1.png" alt="" class="img-fluid bg-white p-5" />
          <h4 class="mt-3 mb-3">Orange Headphone</h4>
          <p class="choose-colors-price m-0">$156</p>
          <a href="#">Add to Cart</a> </div>
      </div>
      <div class="col-sm-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
        <div class="choose-colors-image text-center text-uppercase"> <img src="<?php echo BASE_URL;?>static/images/theme2/spec-image2.png" alt="" class="img-fluid bg-white p-5" />
          <h4 class="mt-3 mb-3">Orange Headphone</h4>
          <p class="choose-colors-price m-0">$156</p>
          <a href="#">Add to Cart</a> </div>
      </div>
      <div class="col-sm-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
        <div class="choose-colors-image text-center text-uppercase"> <img src="<?php echo BASE_URL;?>static/images/theme2/spec-image1.png" alt="" class="img-fluid bg-white p-5" />
          <h4 class="mt-3 mb-3">Orange Headphone</h4>
          <p class="choose-colors-price m-0">$156</p>
          <a href="#">Add to Cart</a> </div>
      </div>
    </div>
  </div>
</section>-->
<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
(function($) {
  /** change value here to adjust parallax level */
  var parallax = -0.5;

  var $bg_images = $(".experience-image");
  var offset_tops = [];
  $bg_images.each(function(i, el) {
    offset_tops.push($(el).offset().top);
  });

 


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