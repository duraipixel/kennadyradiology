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
            <?php    $pro_img = explode('|',$productdetails['img_names']);?>
            <div class="carousel-item active"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" id="ProductImage1" alt="" /> </div>
            <?php $pro_img1 = explode('|',$productdetails['img_names']);
                           for($i=1;$i<=count($pro_img1);$i++){
							   if($pro_img1[$i] != ''){
							   ?>
            <div class="carousel-item"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img1[$i]; ?>" alt="" id="ProductImage2" /> </div>
            <?php }
						   }
						   ?>
          </div>
          <!-- Left and right controls --> 
          <a class="carousel-control-prev" href="#ProductCarousel" data-slide="prev"> <i class="lni lni-arrow-left"></i> </a> <a class="carousel-control-next" href="#ProductCarousel" data-slide="next"> <i class="lni lni-arrow-right"></i> </a> </div>
        <div class="theme1-carousel">
          <?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
          <div class="row">&nbsp;</div>
          <div class="productcolor-details" id="divcustomattr">
            <form id="frmcustomattr" >
              <?php 
			  
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								 
								 //print_r($productfilter); die();
								 
								 foreach($productfilter as $f) {
									 
									 
									 
									$fsku=$productdetails['sku'];
									if($f['sku']!='')
										$fsku=$f['sku'];
									switch($f['iconsdisplay']){
										 case "1":
												 if(in_array($f['attributeid'],$arrattr))
												 {
													  $clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did)  || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<li><div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div></li>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 //'.$f['attributename'].'
														$strattrHTML.='<div class="row">
																		<div class="col-md-12">
																	 
																			<ul class="product-colors">
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did)  || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<li><div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div></li>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 //'.$f['attributename'].'
														 $strattrHTML.='<div class="col-md-12">
																		 
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did)  || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<li><div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div></li>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
									 
												$arrattr[]=$f['attributeid'];
												$prevtype=$f['iconsdisplay'];
												 break;			
											} 

								  }
								  if($prevtype==0)
								  {
									   $strattrHTML.='</select>';
									   $strattrHTML.='</div></div>';
								  }
								  else
								  {
									   $strattrHTML.='</div></div>';
									  
								  }
								 echo $strattrHTML; 	
								?>
            </form>
          </div>
          <?php }?>
          <p class="product-name"><?php echo $productdetails['product_name']; ?></p>
          <div id="detailspricewraper">
            <p class="product-price">
              <?php if($productdetails['final_price_tax']>0): ?>
              <?php if($productdetails['soldout']==0) : ?>
              <?php if($productdetails['totpent']>0): ?>
            <p class="offerspan"><?php echo $productdetails['totpent']; ?>%</p>
            <?php ENDIF; ?>
            <p class="product-details-price">
              <?php if($productdetails['final_price']>0): ?>
              <?php if($productdetails['totpent']>0): ?>
              <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($productdetails['final_orgprice']),2);  ?></span> <i class="fa fa-inr"></i> <?php echo  number_format(round($productdetails['final_price_tax']),2); ?>
              <?php ELSE : ?>
              <i class="fa fa-inr"></i> <?php echo number_format(round($productdetails['final_price_tax']),2);  ?>
              <?php ENDIF; ?>
              <?php ELSE : ?>
              --
              <?php ENDIF; ?>
              <?php ENDIF; ?>
              <?php ENDIF; ?>
            </p>
          </div>
          <p> <a href="javascript:void(0)" onClick="buynow('<?php echo $productdetails['product_id'];?>')"; class="buy-now-bt">Buy Now</a> <a href="javascript:void(0)" onClick="addtocart('<?php echo $productdetails['product_id'];?>')" class="add-to-cart-bt">Add to cart</a> </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Carousel End --> 
<!-- Product Video Starts -->
<?php if(count($feature_additional_list_video) > 0){?>
<section class="product-video">
<div class="container-fluid p-0" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
<div class="row no-gutters">
  <div class="col">
    <iframe width="1600" height="680" src="<?php echo $feature_additional_list_video[0]['videolink'];?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>
<div>
</section>
<?php }?>
<?php if($feature_additional_list_image[0]['featureimage'] != ''){?>
<section class="features-banner">
  <div class="container-fluid p-0" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
    <div class="row no-gutters">
      <div class="col text-center"> <img src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[0]['featureimage'];?>" alt="" class="img-fluid" /> </div>
    </div>
  </div>
</section>
<?php 
}?>

<!-- variation product Viewed Starts -->
<?php  //echo "<pre>";print_r($colorproductlists);?>
<?php if(count($colorproductlists['prod_list']) > 0){?>
<section class="best-seller">
  <div class="container">
    <div class="best-seller-wrap">
      <div class="seller-slider">
      
        <?php foreach($colorproductlists['prod_list'] as $colorvar){$pro_img_color = explode('|',$colorvar['img_names_color']);?>
         <form id="frmcustomattr<?php echo $colorvar['dropdown_id'];?>" >
        <div>
          <div class="sell-wrap"> 
          	<input style="display:none" type="radio" checked="checked"  id="color_<?php echo $colorvar['dropdown_id'];?>" name="iconatt_<?php echo $colorvar['dropdown_id'];?>" value="<?php echo $colorvar['dropdown_id'];?>">
            <input id="prices1_<?php echo $colorvar['product_id'];?>" name="prices1_<?php echo $colorvar['product_id'];?>" type="hidden" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
          <?php if($pro_img_color[0] != ''){?>
          <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $colorvar['product_id']; ?>/photos/medium/<?php echo $pro_img_color[0]; ?>" alt="">
          <?php }else{?>
           <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="simpleLens-big-image">
           <?php }?>
            <div class="seller-content">
              <h6>
                <?php 
   
$max_dp = ($colorvar['final_price']*$getmaximum_dp['max_discnt_slap'])/100;
$maxdiscountamtfp = ($colorvar['final_price'] - $max_dp);

  ?>
                <?php if($colorvar['soldout']==0) : ?>
                <?php if($colorvar['totpent']>0): ?>
                <p class="offerspan"><?php echo $colorvar['totpent']; ?>%</p>
                <?php ENDIF; ?>
                <p class="product-details-price">
                  <?php if($colorvar['final_price']>0): ?>
                  <?php if($colorvar['totpent']>0): ?>
                  <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($colorvar['final_orgprice']),2);  ?></span> <i class="fa fa-inr"></i> <?php echo  number_format(round($colorvar['final_price_tax']),2); ?>
                  <?php ELSE : ?>
                  <i class="fa fa-inr"></i> <?php echo number_format(round($colorvar['final_price_tax']),2);  ?>
                  <?php ENDIF; ?>
                  <?php ELSE : ?>
                  --
                  <?php ENDIF; ?>
                </p>
                <?php if($colorvar['totpent']>0): ?>
                <?php ELSE : ?>
                <?php ENDIF; ?>
                <?php ENDIF; ?>
              </h6>
              <a href="javascript:void(0)" onclick="addtocartcolor('<?php echo $colorvar['product_id'];?>','<?php echo $colorvar['dropdown_id'];?>');" class="common-btn white-btn mt-3">Add to cart</a> </div>
          </div>
        </div> </form>
        <?php }?>
       
      </div>
    </div>
  </div>
</section>
<?php }?>

<!-- variation product Viewed End --> 
<!-- Image Text1 Starts -->

<?php 
if(count($feature_additional_list_image) > 0){
	for($i=1;$i<count($feature_additional_list_image);$i++){	 
		if($i % 2 == 0){
	?>
<section class="imageText2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-6 text-center" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000"> <img class="max-hei-300" src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[$i]['featureimage'];?>" alt="" class="img-fluid" /> </div>
      <div class="col-sm-12 col-md-6 col-lg-6 order-first" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000">
        <h2><?php echo $feature_additional_list_image[$i]['featuretitle'];?></h2>
        <br/>
        <p><?php echo $feature_additional_list_image[$i]['shortdescription'];?></p>
      </div>
    </div>
  </div>
</section>
<?php }
else{
	?>
<section class="imageText1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-12 col-md-6 col-lg-6 text-center" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000"> <img class="max-hei-300" src="<?php echo BASE_URL;?>uploads/featureuploads/additionalfeature/<?php echo $feature_additional_list_image[$i]['featureimage'];?>" alt="" class="img-fluid" /> </div>
      <div class="col-sm-12 col-md-6 col-lg-6" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
        <h2><?php echo $feature_additional_list_image[$i]['featuretitle'];?></h2>
        <br/>
        <p><?php echo $feature_additional_list_image[$i]['shortdescription'];?></p>
      </div>
    </div>
  </div>
</section>
<?php 
}
}
}
?>
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

function prodattrchange(aid,sku,did)
	{
		
		var path =  '<?php echo BASE_URL; ?>ajax/prodattrchangetheme'
		var tsku='';
		if(sku=='')
			 tsku='<?php echo $sku;?>'
		else
			 tsku=sku;
		 var data="";
	 if(did!='')	 
	 {	
		if($("#color_"+did).length){
			$("#color_"+did). prop("checked", "checked");
		 } 
		
		
	 }
	 data="proid=<?php echo $productdetails['product_url']; ?>&sku="+tsku+"&"+$("#frmcustomattr").serialize();
	 //console.log(path);
	 // location.href=path;
	 
	 $.ajax({
				url        : path,
				contentType: "application/json",
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(data),
				beforeSend: function() {
					
				},
				success: function(response){
				
				$("#detailspricewraper").html("");	
				$("#detailspricewraper").html(response.rslt);
				
				if ($('.singleprd-slider').hasClass('slick-initialized')) {
					$('.singleprd-slider').slick('destroy');
				}
				if ($('.thumbnailprd-slider').hasClass('slick-initialized')) {
					$('.thumbnailprd-slider').slick('destroy');
				}
				

				$("#ProductCarousel").html("");
				$("#ProductCarousel").html(response.changeimg);
				
				if ($(window).width() > 767){
						$('.imgBox').imgZoom({
						boxWidth: 400,
						boxHeight: 400,
						marginLeft: 15,
						});
					}
				
			 
								
				
				
				},

			});
	 
	}
</script>
</body>
</html>