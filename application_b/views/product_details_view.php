<?php  	
//echo "<pre>"; print_r($productdetails); exit;
include ('includes/top.php');
 
 ?>
<link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">

<!--      
--><!-- Icon Font -->

<?php include ('includes/header.php') ?>

<!-- Product Details Starts -->
<section class="product-details white-bg" id="default">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL;?>home">Home</a></li>
          <?php
							$arrbread=array();
							$helper->getProductBread($productdetails['categoryID'],$arrbread);
							
							$breadpath='';
							for($a=count($arrbread)-1;$a>=0;$a--){
								$breadpath.=$arrbread[$a]['code'].'/';
					?>
          <li><a href="<?php echo BASE_URL.$breadpath;?>"><?php echo $arrbread[$a]['name']; ?></a></li>
          <?php } ?>
          <li><a href="javascript:void(0);"><?php echo $productdetails['product_name']; ?></a></li>
        </ul>
      </div>
      <div class="col-12 col-md-12 col-lg-6 col-xl-5">
        <div id="productimage">
          <div class="simpleLens-gallery-container pt-5" id="product-gallery">
            <div class="simpleLens-container">
              <div class="simpleLens-big-image-container">
                <?php 
							/*echo "ggg";
							echo "<pre>";
							print_r($productdetails); die(); */
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                            // foreach($pro_img as $list_img){
						     ?>
                <a href="#"  class="simpleLens-lens-image" 
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" class="simpleLens-big-image" alt="product"> </a>
                <?php // }
			   } else { ?>
                <a data-lens-image="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="simpleLens-lens-image"> <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="simpleLens-big-image"> </a>
                <?php } ?>
              </div>
              <!-- data-toggle="modal" data-target="#CustomizeModal"-->
              <?php    if($productdetails['iscustomized'] == 1){?>
              <!--<a  href="javascript:openiframe()"  class="common-btn" >Customize this product</a> -->
              <?php }?>
            </div>
            <div class="simpleLens-thumbnails-container">
              <?php 
						$customimage='';
						if($productdetails['uploadecustomizedimg']!=''){
							 $customimage= BASE_URL.'uploads/customizedproduct/thumbnails/'.$productdetails['uploadecustomizedimg']; 
							
						}							
						if($productdetails['img_names']!=''){
						  $pro_img1 = explode('|',$productdetails['img_names']);
                           foreach($pro_img1 as $list_img1){
							if($customimage=="")   
							 $customimage= BASE_URL."uploads/productassest/".$productdetails['product_id']."/photos/base/".$list_img1;
						   	 
						?>
              <a href="#" class="simpleLens-thumbnail-wrapper"
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img1; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img1; ?>"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/thumb/<?php echo $list_img1; ?>"> </a>
              <?php } } else {  ?>
              <img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/noimage/photos/thumb/noimage.png" alt="product">
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-6 col-xl-7 pt-5">
        <h1><?php echo $productdetails['product_name']; ?></h1>
<!--        <p><?php echo $productdetails['sku']; ?></p>
-->
<div class="">
        <p class="product-details-text"> <?php echo $productdetails['description']; ?>
          <?php /* ?> <?php  foreach($productattributes as $attr) {
										if($attr['value']!='')
										{
										?>
										<div class="dettit">
											<?php echo $attr['attributename']; ?>	
										</div>
										<div class="detcnt">
										<?php echo $attr['value']; ?>	
										</div>
									<?php		
										}
									 }  ?>  <?php */ ?>
          <?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
								  </p>
								  </div>
        <div class="productcolor-details" id="divcustomattr">
		<h5 class="text-left mt-3 mb-1">Available Colors</h5>
          <form id="frmcustomattr" >
            <?php 
								//echo "<pre>"; 
								 // print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								 
								//  print_r($productfilter); die();
								 
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
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<li><div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" title="'.$f['dropdown_values'].'" />
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
																		<img title="'.$f['dropdown_values'].'" src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
																		<img title="'.$f['dropdown_values'].'" src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div></li>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
										case "0":
												if(in_array($f['attributeid'],$arrattr))
												 {
													 $clssel='';
													 if(in_array($f['dropdown_id'],$did)  || $f['isDefault'] == 1){
														  $clssel=' selected="selected" ';
													 }else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
													   $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
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
																		 
																			<select class="select2 form-control required" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<!--<option value="">None</option>-->
																			'; 
														$clssel='';
														if(in_array($f['dropdown_id'],$did)  || $f['isDefault'] == 1){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
														  $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
															 //	'.$f['attributename'].'
														 $strattrHTML.='<div class="col-md-12">
																		 
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
													 }													 
												 }
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
        <?php }
                                   $childsid= $helper->getChildsId();
							$arrexcludecat=explode(",",$childsid);
                              // print_r($productdetails); die(); 
								$max_dp = ($productdetails['final_price_tax']*$getmaximum_dp['max_discnt_slap'])/100;
								$maxdiscountamtfp = ($productdetails['final_price_tax'] - $max_dp);
                         
								  ?>
        <?php if($productdetails['final_price_tax']>0): ?>
        <?php if($productdetails['soldout']==0) : ?>
        <div id="detailspricewraper" class="detailsprice-wraper mt-3">
          <div class="pricewraper"> 
            <!--	<span class="tager">M.R.P. : </span><span class="actualprice"><i class="fa fa-inr"></i><?php echo round($productdetails['final_orgprice'],2); ?></span><br> -->
            <?php if($productdetails['totpent']>0): ?>
            <!--<p class="offerspan"><?php echo $productdetails['totpent']; ?>%</p>-->
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
              <?php ENDIF; ?><small>* Inclusive of GST</small>
            </p>
            <?php if($maincat != 'corporate-gifts'){?>
            
            <?php }?>
          </div>
          
          <!--
										
										 <div class="chk-avl">
									<div class="form-group">				   
									<div class="col-md-8 pl0">
									<form id="divcheckavail" onSubmit="return false">
									<div class="littit"><i class="fa fa-map-marker"></i> <small>Check Availability </small></div>
										<input type="hidden" name="checkout" value="checkoutaddress">
										<input type="text" class="form-control number required " value="<?php echo $_SESSION['shippincode'];?>" id="shippincode" name="shippincode" placeholder="Enter Deliver Pincode" required="" maxlength="6" data-parsley-error-message="Please enter valid pincode"   data-parsley-type="number" >
										<button type="submit" onClick="fnchkCodeAvailable();" class="button btn-primary">Check</button>
									</div> 
									</form>
									</div> 
								  </div>
								  <?php if(isset($_SESSION['shippincode']) || $_SESSION['shippincode']!='' ){	
										$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:block;'";
										//print_r($isshippingavail); die();
										if($isshippingavail==0)
										{
											$clserror=" Style=' display:block;'";
											$clssucess=" Style=' display:none;'";
										}
								      }	else{
											$clserror=" Style=' display:none;'";
										$clssucess=" Style=' display:none;'";
									  }										  
									?>
								  <div class="form-group mims" id="chkavallerror" <?php echo $clserror; ?>>				   
									<div class="col-md-8 pl0">
									<div class="error">
									<small>Delivery is not available in this Location <i class="fa fa-times" aria-hidden="true"></i> </small>
									</div>									
									</div> 
								  </div>
									
								   <div class="form-group mims" id="chkavallsucess" <?php echo $clssucess; ?>>				   
									<div class="col-md-8 pl0">
									<div class="success">
									<small>Delivery is available in this Location <i class="fa fa-check" aria-hidden="true"></i> </small>
									</div>									
									</div> 
								  </div>
										--> 
          
        </div>
        <?php ENDIF; ?>
        <?php ELSE : ?>
        <div id="detailspricewraper" class="detailsprice-wraper">
          <div class="pricewraper"> <span class="offerprice">Price on Request</span> </div>
        </div>
        <?php ENDIF; ?>
        <?php if($maincat != 'corporate-gifts'){?>
        <div class="quantity pull-left mr-3">
          <div class="quantity-button quantity-down">-</div>
          <input type="text" class="form-control" id="prices1_<?php echo $productdetails['product_id']; ?>" min="<?php echo $productdetails['minquantity']; ?>" onChange="" onMouseMove="" onKeyPress="return validateQty(event);" onKeyDown="numberkeyvalid(event);" onBlur="checkminqty()" step="1" value="<?php echo $productdetails['minquantity']; ?>">
          <div class="quantity-button quantity-up">+</div>
        </div>
        <?php if($productdetails['soldout']==0)	: ?>
        <?php	
									$clsdisable="";
									if(!isset($_SESSION['shippincode']) || $_SESSION['shippincode']=='' ){									  	
										$clsdisable=" disabled ";
									}else{
										if($isshippingavail==0)
										{
											$clsdisable=" disabled ";
										}
									}
								?>
        <p> <a href="javascript:void(0)" class="common-btn white-btn mr-3 <?php echo $clsdisable; ?>" onClick="addtocart('<?php echo $productdetails['product_id'];?>')";>Add to Cart</a> <a href="javascript:void(0)" class="common-btn <?php echo $clsdisable; ?>" onClick="buynow('<?php echo $productdetails['product_id'];?>')";>Buy Now</a>
          <?php ELSE : ?>
          <a href="javascript:void(0)" class="common-btn white-btn <?php echo $clsdisable; ?>" id="btnaddtocart" onClick="addtocart('<?php echo $productdetails['product_id'];?>');">Add to cart</a>
          <?php ENDIF; ?>
        </p>
        <?php }?>
      </div>
    </div>
  </div>
</section>

<!-- Product Details End --> 
<!-- Product Features Starts -->
<section class="yellow-bg pt-4 pb-4 mt-4">
	<div class="container">
		<h1 class="text-center text-white">Overview</h1>
    <?php if($productdetails['longdescription'] != ''){?>
          <div class="row no-gutters align-items-center">
            <div class="col" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
              <div class="row justify-content-md-center">
                <div class="col-12">
                  <div class="p-3 text-center text-white"><?php echo $productdetails['longdescription'] ;?></div>
                </div>
              </div>
            </div>
          </div>
        <?php }?> 
	</div>
</section>
<section class="features">
  <div class="tile" id="features-tab"> 
    <!-- Nav tabs -->
   
    <!-- Tab panes -->
    
    <div class="container pl-0 pr-0">
          
            <!--feature-->
          <?php if(count($getproductfeature) > 0){?>
           <h1 class="text-center">Features</h1>
		   
           <?php 
				  foreach($getproductfeature as $featurevalue){
					  if($featurevalue['imagealignment'] == 1){
					  ?>
          <div class="row no-gutters align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
              <div class="row justify-content-md-center">
                <div class="col-12 col-md-12 col-lg-8">
                  <p class="features-text1"><?php echo $featurevalue['spectitle'];?></p>
                  <p class="features-text2"><?php echo $featurevalue['specvalue'];?></p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 pt-5 pb-5 text-center"  data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
              <div class="features-image"><img src="<?php echo BASE_URL;?>uploads/productfeatures/<?php echo $featurevalue['specimage'];?>" alt="" class="img-fluid" /></div>
            </div>
          </div>
          <?php }else{
						?>
          <div class="row no-gutters align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 pt-5 pb-5 text-center"  data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000">
              <div class="features-image1"><img src="<?php echo BASE_URL;?>uploads/productfeatures/<?php echo $featurevalue['specimage'];?>" alt="" class="img-fluid" /></div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 pt-5 pb-5" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
              <div class="row justify-content-md-center">
                <div class="col-12 col-md-12 col-lg-8">
                  <p class="features-text1"><?php echo $featurevalue['spectitle'];?></p>
                  <p class="features-text2"><?php echo $featurevalue['specvalue'];?></p>
                </div>
              </div>
            </div>
          </div>
          <?php  
					 }}
		  }?>
                     
                   <?php if($productattributes_video[0]['value'] != ''){?>
                     <!--video-->
                    
                        <h1 class="text-center">Videos</h1>
                      <section class="video">
          <div class="container pt-5 pb-4">
            <div class="row align-items-center">
              <div class="col"  data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                <div id="videoCarousel" class="carousel slide" data-ride="carousel"> 
                  <!-- The slideshow -->
                  <div class="carousel-inner">
                    <?php   foreach($productattributes_video as $attr) {?>
                    <?php echo $attr['value']; ?>
                    <?php }?>
                  </div>
                  <!-- Left and right controls -->
                  <?php //if(count($$productattributes_video) > 1){?>
                  <a class="carousel-control-prev" href="#videoCarousel" data-slide="prev"> <i class="lni lni-arrow-left"></i> </a> <a class="carousel-control-next" href="#videoCarousel" data-slide="next"> <i class="lni lni-arrow-right"></i> </a>
                  <?php //}?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php }?>
        
        <!---spec-->
         <?php if(count($productattributes) > 0 ){?>
           <h1 class="text-center pb-4">Specs &amp; Support</h1>
           
 

         <?php
					 
					   foreach($productattributes as $attr) {						  
										if($attr['value']!='')
										{
											 if($attr['attribute_type'] == 'text'){
							   ?>
                            <div class="container pb-4">   <div class="row justify-content-center">
     <div class="col-12 col-md-12 col-lg-6 border">
        <div class="row">
            <div class="col">
                <div class="spec-heading2"><?php echo $attr['attributename']; ?></div>
            </div>
			<div class="col text-right">
                <div class="spec-text1"><?php echo $attr['value']; ?></div>
            </div>
        </div>
    </div>
</div></div>
                               
                               <?php
						   }else{
											?>
			<div class="container pb-4">
            <div class="row justify-content-center">
              <div class="col-12 col-md-12 col-lg-6 border">
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="spec-heading2"><?php echo $attr['attributename']; ?></div>
                  </div>
                </div>
                <div class="row pt-3 pb-3">
                  <div class="col text-center">
                    <?php if (strpos($attr['value'], 'table table-bordered') !== false) {?>
                    <?php echo $attr['value']; ?>
                    <?php }else{?>
                    <p class="spec-text1"><?php echo $attr['value']; ?></p>
                    <?php }?>
                  </div>
                </div>
              </div>
			  </div>
			  </div>
              <?php }
										}
					  }?>
               <?php }?>       
                      
        </div>
        
        
    
  </div>
</section>

<!-- Other Categories Start -->
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="text-center" style="padding-top: 30px;">
        <h2 class="main-title-dark">Other Categories</h2>
      </div>
    </div>
    <div class="col-sm-12 col-md-12">
      <div class="other-categories-slider">
        <?php foreach($othercategorylist as $othercatlist){ ?>
        <div> <a href="<?php echo BASE_URL.$othercatlist['categoryCode']; ?>">
          <?php if($othercatlist['categorymenuimage']!=''){ ?>
          <img src="<?php echo img_base_url."category/categorymenuimage/".$othercatlist['categorymenuimage']; ?>" class="img-responsive" alt="" />
          <?php } else {?>
          <img src="<?php echo img_base_url;?>noimage/photos/base/noimage.png" class="img-responsive" alt="" />
          <?php } ?>
          <h4><?php echo $othercatlist['categoryName'] ?></h4>
          </a> </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- Other Categories End --> 

<!-- Product Features End --> 
<!-- Recently Viewed Starts -->
<?php   //echo "<pre>";print_r($recentviewproduct);die();
 include('partial/products_recent.php');

?>

<!-- Recently Viewed End -->

<?php include('partial/shipping-details.php');?>

<!--<div id="popwidg" class="pop">
<div class="pop-wrap-box clearfix">
<a class="clsbtn" href="javascript:closeiframe()"><span>x</span></a>
<div class="popwrapbox-inner">

 <?php //include('partial/customizetool.php')?>
</div>
</div>
</div>-->

<?php include('includes/footer.php')?>
<?php include('includes/script.php')?>
<script>
$(document).ready(function(){
	$('a[href="#search"]').on('click', function(event) {                    
		$('#search').addClass('open');
		$('#search > form > input[type="search"]').focus();
	});            
	$('#search, #search button.close').on('click keyup', function(event) {
		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			$(this).removeClass('open');
		}
	});            
});
 
  </script>
<script src="<?php echo BASE_URL;?>static/customsizetool/js/jquery-ui.min.js" type="text/javascript"></script>

<!-- HTML5 canvas library - required -->
<script src="<?php echo BASE_URL;?>static/customsizetool/js/fabric.min.js" type="text/javascript"></script>
<!-- The plugin itself - required -->
<script src="<?php echo BASE_URL;?>static/customsizetool/js/plugins.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL;?>static/js/jquery.fancybox.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var yourDesigner,$yourDesigner;
	    jQuery(document).ready(function(){






	    	 $yourDesigner = $('#clothing-designer'),
	    		pluginOpts = {
		    		stageWidth: 580,
					stageHeight: 580,
		    		editorMode: false,
		    		smartGuides: true,
					langJSON:'<?php echo BASE_URL;?>static/customsizetool/lang/default.json',
					templatesDirectory:'<?php echo BASE_URL;?>html/',
		    		fonts: [
				    	{name: 'Helvetica'},
				    	{name: 'Times New Roman'},
				    	{name: 'Pacifico', url: 'Enter_URL_To_Pacifico'},
				    	{name: 'Arial'},
			    		{name: 'Lobster', url: 'google'}
			    	],
		    		customTextParameters: {
			    		colors: true,
			    		removable: true,
			    		resizable: true,
			    		draggable: true,
			    		rotatable: true,
			    		autoCenter: true,
			    		boundingBox: "Base",
						selectedColor: '#ff0000',
						fontSize:28,
						autoSelect : true
			    	},
		    		customImageParameters: {
			    		draggable: true,
			    		removable: true,
			    		resizable: true,
			    		rotatable: true,
			    		colors: '#000',
			    		autoCenter: true,
			    		boundingBox: "Base",
						autoSelect : true
			    	},
			    	actions:  {
						//'top': ['download','print', 'snap', 'preview-lightbox'],
						//'right': ['magnify-glass', 'zoom', 'reset-product', 'qr-code', 'ruler','snap'],
						'right': [ 'zoom', 'reset-product', 'ruler','snap'],
						'bottom': ['undo','redo'],
						//'left': ['manage-layers','save']
					},
					customImageAjaxSettings: {
						url: '<?php echo BASE_URL;?>ajax/customimghandler',
						method: 'POST',
						dataType: 'json',
						data: {
									saveOnServer: 1, //use integer as boolean value. 0=false, 1=true
									uploadsDir: 'uploads/customtoolsimg', 
									uploadsDirURL: '<?php echo BASE_URL;?>uploads/customtoolsimg' 
								}
					}
	    		},
				

	    	//yourDesigner = new FancyProductDesigner($yourDesigner, pluginOpts);

	    	//print button
			$('#print-button').click(function(){
				yourDesigner.print();
				return false;
			});


			//create an image
			$('#image-button').click(function(){
				var image = yourDesigner.createImage();
				return false;
			});

			//checkout button with getProduct()
			$('#checkout-button').click(function(){
				var product = yourDesigner.getProduct();
				console.log(product);
				return false;
			});

			//event handler when the price is changing
			$yourDesigner.on('priceChange', function(evt, price, currentPrice) {
				$('#thsirt-price').text(currentPrice);
			});

			//save image on webserver
			$('#save-image-php').click(function() {
				
				yourDesigner.getProductDataURL(function(dataURL) {
					$.post( "<?php echo BASE_URL;?>static/customsizetool/php/save_image.php", { base64_image: dataURL} );
				});

			});

			//send image via mail
			$('#send-image-mail-php').click(function() {
				
				yourDesigner.getProductDataURL(function(dataURL) {
					$.post( "<?php echo BASE_URL;?>static/customsizetool/php/send_image_via_mail.php", { base64_image: dataURL} );
				});

			});

	    });

function clearcustomimg()
{
	$.ajax({
				url        : '<?php echo BASE_URL; ?>ajax/clearcustomimg',			
				method     : 'POST',
				dataType   : 'text',   
						
				success: function(response){
				},
			});


}	
		
function addtocart_customimg(proid,wishproid='',wishlist='')
{               
	            var minqty = $("#prices1").val();	
				var json1={};				
				yourDesigner.getProductDataURL(function(dataURL) {
			
                var urll = '<?php echo BASE_URL; ?>ajax/addtocart_insert'
				var serializeData = serializeFormJSON($("#frmcustomattr").serializeArray());
				 json1={proid:proid,minqty:minqty,Iscustomimg:1,customimg:dataURL,wishproid:wishproid,wishlist:wishlist};
				Object.assign(json1, serializeData);
				$.ajax({
				url        : urll,
				contentType: "application/json",
				 
				method     : 'POST',
				dataType   : 'json',   
				data       : JSON.stringify(json1),//Object.assign(JSON.stringify({proid:proid,minqty:minqty,Iscustomimg:1,customimg:dataURL,wishproid:wishproid,wishlist:wishlist}),serializeData),
				//data       : 'proid='+proid+'&minqty='+minqty+'&Iscustomimg=1&customimg='+dataURL+'&wishproid='+wishproid+'&wishlist='+wishlist+"&"+$("#frmcustomattr").serialize(),
				beforeSend: function() {
					//alert("responseb");
					//loading();
				},
				success: function(response){
					
					 // alert(response.rslt);
					if(response.rslt == "1"){
						$("#carcnt").html(response.cartcount);
						var sucmsg = "Product add to cart Successfully";
						listcartcount();
						
						closeiframe();
						
						//swal("Success!",sucmsg, "success");
						
						swal({
						title: "Success!",
						text: sucmsg,
						type: "success",
						confirmButtonText: "OK"
						},
						function(isConfirm){
							if (isConfirm) {
								location.reload();
							}
					    });
							
					}
					else if(response.rslt == "2"){
						var upmsg="   Product already exits";
						swal("We are Sorry !!",upmsg, "warning");
						
					}
					
					if(response.wishlist == "wishlistdelete"){
						Movewishlistpage(); 
					}


				},

			});
		});
}

 serializeFormJSON = function (data) {

        var o = {};
        var a = data;
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

		
		
    </script>
<script type="text/javascript">
	function prodattrchange(aid,sku,did)
	{
		
		var path =  '<?php echo BASE_URL; ?>ajax/prodattrchange'
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
				

				$("#productimage").html("");
				$("#productimage").html(response.changeimg);
				
				if ($(window).width() > 767){
						$('.imgBox').imgZoom({
						boxWidth: 400,
						boxHeight: 400,
						marginLeft: 15,
						});
					}
				
				$(".singleprd-slider").slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				asNavFor: '.thumbnailprd-slider'
			});

			$(".thumbnailprd-slider").slick({
				slidesToShow: 4,
				infinite: false,
				arrows: true,
				autoplay: false,
				vertical: false,
				verticalSwiping: true,
				autoplaySpeed: 4000,
				slidesToScroll: 1,
				asNavFor: '.singleprd-slider',
				focusOnSelect: true,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 1,


						}
					},
					{
						breakpoint: 767,
						settings: {
							
							slidesToShow: 4,
							vertical: false,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							
							slidesToShow: 3,
							vertical: false,
							slidesToScroll: 1
						}
					}
				]
			});
						
						
						
             $('#product-gallery .simpleLens-thumbnails-container img').simpleGallery({
                 loading_image: '<?php echo BASE_URL;?>static/images/loading.gif'
             });
         
             $('#product-gallery .simpleLens-big-image').simpleLens({
                 loading_image: '<?php echo BASE_URL;?>static/images/images/loading.gif'
             });
         $(".simpleLens-thumbnail-wrapper").click(function(){
         $(this).removeClass("active");
         });
         $("#features-tab .nav-tabs a").click(function() {
         var position = $(this).parent().position();
         var width = $(this).parent().width();
         $("#features-tab .slider").css({"left":+ position.left,"width":width});
         });
         var actWidth = $("#features-tab .nav-tabs").find(".active").parent("li").width();
         var actPosition = $("#features-tab .nav-tabs .active").position();
         $("#features-tab .slider").css({"left":+ actPosition.left,"width": actWidth});
         
         		
				
				
				},

			});
	 
	}
	
	function prodattrchange1(aid,sku,did)
	{
		
	
			var path =  '<?php echo BASE_URL; ?>ajax/prodattrchange'
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
	 data="proid=<?php echo $productdetails['product_url']; ?>&sku="+tsku+"&"+$("#frmcustomattr1").serialize();
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
				$("#customdetailsprice").html("");	
				$("#customdetailsprice").html(response.rslt);
				},

			});
	}
	/*
	function checkminqty(){
		input = $('input[type="number"]');
		var min = input.attr('min');
		var max = input.attr('max');
		
		var oldValue = parseFloat(input.val());
		if (oldValue <= min || isNaN(oldValue) || oldValue=="") {
			swal('The Minimum Order Quantity for this product is:'+' '+min);
			$('input[type="number"]').val(min);
		} 
		
	}
	
	function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;
	if (event.keyCode == 8 || event.keyCode == 46
	 || event.keyCode == 37 || event.keyCode == 39) {
		return true;
	}
	else if ( key < 48 || key > 57 ) {
		return false;
	}
	else return true;
	};
	*/
		$('.quantity').each(function () {
			var spinner = $(this),
				input = spinner.find('input[type="text"]'),
				btnUp = spinner.find('.quantity-up'),
				btnDown = spinner.find('.quantity-down'),
				min = input.attr('min'),
				max = input.attr('max'),
				step = parseFloat(input.attr('step'));
			//	console.log(step);

			btnUp.click(function () {
				//console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue >= max) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue + step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});

			btnDown.click(function () {
		
				//	console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue <= min) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue - step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("change");
			});

		});
		
		
		if ($(window).width() > 767){
		$('.imgBox').imgZoom({
		boxWidth: 400,
		boxHeight: 400,
		marginLeft: 15,
		});
	}

	
	
	
	/*produtdeatil slider*/
			$(".singleprd-slider").slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				asNavFor: '.thumbnailprd-slider'
			});

			$(".thumbnailprd-slider").slick({
				slidesToShow: 4,
				infinite: false,
				arrows: true,
				autoplay: false,
				vertical: false,
				verticalSwiping: true,
				autoplaySpeed: 4000,
				slidesToScroll: 1,
				asNavFor: '.singleprd-slider',
				focusOnSelect: true,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 1,


						}
					},
					{
						breakpoint: 767,
						settings: {
							
							slidesToShow: 4,
							vertical: false,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							
							slidesToShow: 3,
							vertical: false,
							slidesToScroll: 1
						}
					}
				]
			});
			/**/
			
			


	
		$(".color-single").click(function(){
			$(".color-single").removeClass("active");
			$(this).addClass("active");
		});
		
		
		$(".customize-product").click(function(){
			
			
		});

		
		
			 $('.branding-options').select2({
			   containerCssClass: "header-country-container",
			   dropdownCssClass: "header-dropdown-container"
			   
		   });

		

    function closeiframe() {
        document.getElementById("popwidg").style.display = "none"
		$("body").removeClass("modal-open");
		$(".fpd-container").removeClass("fpd-active");
		$(".fpd-navigation>div").removeClass("fpd-active");

    }

    function openiframe() {
        document.getElementById("popwidg").style.display = "block";
		$("body").addClass("modal-open");
		
		
		
		

		
    }
$(function(){
	
	 <?php if($productdetails['longdescription'] != ''){?>
	 $('#overview-tab').trigger('click');
	 <?php }?>

<?php if(isset($_REQUEST['customized'])) { ?>	
	openiframe();
<?php } ?>	
});


$('.products').fancybox({
	// Options will go here
});



$(".popwrapbox-inner").mCustomScrollbar({
	theme:"dark"
});

function fnchkCodeAvailable()
{
	
 	$('#divcheckavail').parsley().validate();
	
		
		if ($('#divcheckavail').parsley().isValid()){	
	
	var pcode=$("#shippincode").val();
	 $.ajax({
				url        :'<?php echo BASE_URL;?>ajax/chkzipcode',				
				method     : 'POST',
				dataType   : 'text',   
				data       :"pin="+pcode,
				beforeSend: function() {
					
				},
				success: function(response){					
					if(response==1)
					{
					  $("#chkavallerror").css("display","none");
					  $("#chkavallsucess").css("display","block");
					  $("#btnaddtocart").removeClass("disabled");
					}else{
					  $("#chkavallerror").css("display","block");
					  $("#chkavallsucess").css("display","none");						
					  $("#btnaddtocart").addClass("disabled");
					}
				}
				,

			});
		}	
	
}

$('.other-categories-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    responsive: [
    {
      breakpoint: 1320,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
  });
</script>
</body>
</html>
