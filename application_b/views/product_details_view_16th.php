<?php  	
//echo "<pre>"; print_r($productdetails); exit;
include ('includes/top.php');

 ?>
  <link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">

<?php include ('includes/header.php') ?>
<section>
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
    </div>
  </div>
</section>

<!-- Product Details Starts -->
<section class="product-details" id="default">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6">
        <div class="simpleLens-gallery-container pt-5" id="product-gallery">
          <div class="simpleLens-container">
            <div class="simpleLens-big-image-container">
              <?php 
							/*echo "ggg";
							echo "<pre>";
							print_r($productdetails); die(); */
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                             foreach($pro_img as $list_img){
						     ?>
              <a href="#"  class="simpleLens-lens-image" 
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $list_img; ?>" class="simpleLens-big-image" alt="product"> </a>
              <?php } } else { ?>
              <a data-lens-image="<?php echo BASE_URL;?>uploads/noimage/photos/noimage.png" class="simpleLens-lens-image"> <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="simpleLens-big-image"> </a>
              <?php } ?>
            </div>
            <!-- data-toggle="modal" data-target="#CustomizeModal"-->
        <?php    if($productdetails['iscustomized'] == 1){?><!--<a  href="javascript:openiframe()"  class="common-btn" >Customize this product</a> -->
        <?php }?>
        </div>
          <div class="simpleLens-thumbnails-container pt-5 mt-5">
            <?php 
						$customimage='';
						if($productdetails['uploadecustomizedimg']!='' )
						{
							 $customimage= BASE_URL.'uploads/customizedproduct/thumbnails/'.$productdetails['uploadecustomizedimg'];
							//$customimage= BASE_URL.'uploads/customizedproduct/thumbnails/1571732194210233_C.jpg';
							
						}							
						if($productdetails['img_names']!=''){
						  $pro_img = explode('|',$productdetails['img_names']);
                           foreach($pro_img as $list_img){
							if($customimage=="")   
							 $customimage= BASE_URL."uploads/productassest/".$productdetails['product_id']."/photos/base/".$list_img;
						   	 
						?>
            <img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/thumb/<?php echo $list_img; ?>" alt="product"> <a href="#" class="simpleLens-thumbnail-wrapper"
                           data-lens-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>"
                           data-big-image="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/<?php echo $list_img; ?>"> <img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/thumb/<?php echo $list_img; ?>"> </a>
            <?php } } else {  ?>
            <img class="img-responsive center-block" src="<?php echo BASE_URL;?>uploads/noimage/photos/thumb/noimage.png" alt="product">
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-6 pt-5">
        <h1><?php echo $productdetails['product_name']; ?></h1>
        <p><?php echo $productdetails['sku']; ?></p>
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
        <div class="productcolor-details" id="divcustomattr">
          <form id="frmcustomattr" >
            <?php 
								//echo "<pre>"; 
								 // print_r($productfilter); die();
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
														if(in_array($f['dropdown_id'],$did))
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
														if(in_array($f['dropdown_id'],$did))
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
														if(in_array($f['dropdown_id'],$did))
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
										case "0":
												if(in_array($f['attributeid'],$arrattr))
												 {
													 $clssel='';
													 if(in_array($f['dropdown_id'],$did)){
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
														if(in_array($f['dropdown_id'],$did)){
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
        
        
        <div id="detailspricewraper" class="detailsprice-wraper">
          <div class="pricewraper"> 
            <!--	<span class="tager">M.R.P. : </span><span class="actualprice"><i class="fa fa-inr"></i><?php echo round($productdetails['final_orgprice'],2); ?></span><br> -->
            <?php if($productdetails['totpent']>0): ?>
            <?php	 if(!in_array($productdetails['categoryID'],$arrexcludecat)){ ?>
            <p class="product-details-price"><i class="fa fa-inr"></i> <?php echo  number_format($productdetails['final_price_tax'],2); ?></p>
            <?php } else { ?>
            <p class="product-details-price"><i class="fa fa-inr"></i> <?php echo  number_format($productdetails['final_price_tax'],2); ?></p>
            <?php } ?>
            
            <!-- <span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span>
											<br/>-->
            
            <?php ELSE : ?>
            <p class="product-details-price"><i class="fa fa-inr"></i> <?php echo  number_format($productdetails['final_price_tax'],2); ?></p>
            <?php ENDIF; ?>
          </div>
          
          <!--
										<small>* Inclusive of GST</small>
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
        <div class="col-md-3">
          <input type="hidden" class="form-control" id="prices1_<?php echo $productdetails['product_id']; ?>" min="<?php echo $productdetails['minquantity']; ?>" onChange="" onMouseMove="" onKeyPress="return validateQty(event);" onKeyDown="numberkeyvalid(event);" onBlur="checkminqty()" step="1" value="1<?php //echo $productdetails['minquantity']; ?>">
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
        <p class="pt-4"> <a href="javascript:void(0)" class="common-btn mr-4 <?php echo $clsdisable; ?>" onClick="addtocart('<?php echo $productdetails['product_id'];?>')";>Add to Cart</a> <a href="javascript:void(0)" class="common-btn mr-4 <?php echo $clsdisable; ?>" onClick="buynow('<?php echo $productdetails['product_id'];?>')";>Buy Now</a>
          <?php ELSE : ?>
          <a href="javascript:void(0)" class="common-btn white-btn <?php echo $clsdisable; ?>" id="btnaddtocart" onClick="addtocart('<?php echo $productdetails['product_id'];?>');">Add to cart</a>
          <?php ENDIF; ?>
        </p>
      </div>
    </div>
  </div>
</section>
<!-- Product Details End --> 
<!-- Product Features Starts -->
<section class="features">
  <div class="tile" id="features-tab"> 
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified" role="tablist">
     <?php if(count($getproductfeature) > 0 || count($productattributes_video) > 0 || count($productattributes) > 0){?>
      <div class="slider"></div>
      <?php }?>
      
     <?php if(count($getproductfeature) > 0){?>
      <li class="nav-item"> <a class="nav-link active" id="features-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="true">Features</a> </li>
      <?php }?>
      
     <?php if(count($productattributes_video) > 0){?>
      <li class="nav-item"> <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false">Videos</a> </li>
      <?php }?>
      
      <?php if(count($productattributes) > 0 ){?>
      <li class="nav-item"> <a class="nav-link" id="spec-tab" data-toggle="tab" href="#spec" role="tab" aria-controls="spec" aria-selected="false">Specs &amp; Support</a> </li>
      <?php }?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade show active" id="features" role="tabpanel" aria-labelledby="features-tab">
        <div class="container-fluid pl-0 pr-0">
          <?php //echo "kk";echo "<pre>";print_r($getproductfeature);?>
          <?php 
				  foreach($getproductfeature as $featurevalue){
					  if($featurevalue['imagealignment'] == 1){
					  ?>
          <div class="row no-gutters align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
              <div class="row justify-content-md-center">
                <div class="col-12 col-md-12 col-lg-8">
                  <p class="features-text1"><?php echo $featurevalue['spectitle'];?></p>
                  <p class="features-text2"><?php echo $featurevalue['specvalue'];?></p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 pt-5 pb-5 text-right"  data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/productfeatures/<?php echo $featurevalue['specimage'];?>" alt="" class="img-fluid" /> </div>
          </div>
          <?php }else{
						?>
          <div class="row no-gutters align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 pt-5 pb-5"  data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000"> <img src="<?php echo BASE_URL;?>uploads/productfeatures/<?php echo $featurevalue['specimage'];?>" alt="" class="img-fluid" /> </div>
            <div class="col-sm-12 col-md-6 col-lg-6 pt-5 pb-5" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
              <div class="row justify-content-md-center">
                <div class="col-12 col-md-12 col-lg-8">
                  <p class="features-text1"><?php echo $featurevalue['spectitle'];?></p>
                  <p class="features-text2"><?php echo $featurevalue['specvalue'];?></p>
                </div>
              </div>
            </div>
          </div>
          <?php  
					 }}?>
        </div>
      </div>
      <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab"> 
        <!-- Video Section Starts -->
        <section class="video">
          <div class="container-fluid pl-0 pr-0 pt-5 pb-4">
            <div class="row no-gutters align-items-center">
              <div class="col"  data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                <div id="videoCarousel" class="carousel slide" data-ride="carousel"> 
                  <!-- The slideshow -->
                  <div class="carousel-inner">
                    <?php   foreach($productattributes_video as $attr) {?>
                    <?php echo $attr['value']; ?> 
                    <!--<div class="carousel-item active">
									   <a href="#" data-toggle="modal" data-target="#VideoModal">
									   <img src="<?php echo BASE_URL;?>static/images/product-details/product-details-video.jpg" alt="">
									   <i class="lni lni-play"></i>
									   </a>
									</div>--> 
                    
                    <!--  <div class="modal fade opacity-animate3" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <iframe height="315" src="https://www.youtube.com/embed/EngW7tLk6R8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>			
            </div>
         </div>
      </div>-->
                    
                    <?php }?>
                  </div>
                  <!-- Left and right controls --> 
                  <a class="carousel-control-prev" href="#videoCarousel" data-slide="prev"> <i class="lni lni-arrow-left"></i> </a> <a class="carousel-control-next" href="#videoCarousel" data-slide="next"> <i class="lni lni-arrow-right"></i> </a> </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Video Section End --> 
      </div>
      <div class="tab-pane fade" id="spec" role="tabpanel" aria-labelledby="spec-tab">
        <section class="spec">
          <div class="container">
            <div class="row">
              <div class="col">
                <p class="spec-heading1">Item# <?php echo $productdetails['product_name']; ?>
                <p> 
              </div>
            </div>
            <div class="row no-gutters">
              <?php
					 // print_r($productattributes);
					  
					   foreach($productattributes as $attr) {
										if($attr['value']!='')
										{?>
              <div class="col-12 col-md-12 col-lg-6 border-right">
                <div class="row">
                  <div class="col-12 col-md-12">
                    <div class="spec-heading2"><?php echo $attr['attributename']; ?></div>
                  </div>
                </div>
                <div class="row pt-3 pb-3">
                  <div class="col text-center">
                    <p class="spec-text1"><?php echo $attr['value']; ?></p>
                  </div>
                </div>
              </div>
              <?php }
					  }?>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<!-- Product Features End --> 
<!-- Recently Viewed Starts -->
<section class="best-seller">
  <div class="container">
    <div class="best-title">
      <h2 class="main-title-dark">recently viewed list</h2>
    </div>
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

<?php include('partial/clientlist.php');?>

<!--<section class="brands pt-0">
         <div class="container">
            <ul class="brand-list">
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-1.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-2.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-3.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-4.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-5.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="">
                  <img src="<?php echo BASE_URL;?>static/images/logos/logo-6.png" alt="">
                  </a>
               </li>
            </ul>
         </div>
      </section>--> 

<!-- Video Modal --> 

 


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
				

	    	yourDesigner = new FancyProductDesigner($yourDesigner, pluginOpts);

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
				input = spinner.find('input[type="number"]'),
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




</script>


  </body>
</html>

</body>
</html>