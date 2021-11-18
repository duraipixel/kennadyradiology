<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="product-details-bg">
   <div class="container-fluid">
      <div class="row align-items-center">
				<div class="col-sm-12 col-md-4 col-lg-6">
				<h5><?php echo $productdetails['product_name']; ?></h5>
					<?php 
							 //print_r($productdetails);
							if($productdetails['isbuynow'] == 0){
							if($productdetails['final_price_tax']>0){ 
							if($productdetails['soldout']==0) { ?> 
							<div id="detailspricewraper" class="detailsprice-wraper">
              <?php if($productdetails['totpent']>0){ ?>
			    <p class="offerspan"><?php echo $productdetails['totpent']; ?>%</p>
						<h5><s><?php echo PRICE_SYMBOL;?><?php echo number_format(round($productdetails['final_orgprice']),2);  ?></s></h5>
						
						 <h5><?php echo PRICE_SYMBOL. number_format(round($productdetails['final_price_tax']),2); ?></h5>
							<?php }ELSE {?>
			 <h5> <?php echo PRICE_SYMBOL. number_format(round($productdetails['final_price_tax']),2);  ?></h5>
							<?php }; ?>
							<?php }ELSE { ?>
			 <?php echo $detaildisplaylanguage['soldout'];?><br>
              <?php } ?><small>* <?php echo $detaildisplaylanguage['inclusive'];?></small>
							<?php }; ?>
							<?php }?>
								</div>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-6 text-right">
							<?php 
							if($productdetails['isbuynow'] == 0){?>
							<button type="button" class="add-to-cart-btn1" onClick="addtocart('<?php echo $productdetails['product_id'];?>')";>
                               <?php echo $commondisplaylanguage['addtocart'];?> <i class="flaticon-cart-bag"></i>
                            </button>
							<button type="button" class="buy-now-btn1" onClick="buynow('<?php echo $productdetails['product_id'];?>')";>
                                <?php echo $commondisplaylanguage['buynow'];?> <i class="flaticon-cart-2"></i>
                            </button>
							<?php }else{?>
							 
							<button type="button" class="add-to-cart-btn1" data-mdb-toggle="modal" data-mdb-target="#getaQuoteModal">
                               <?php echo $detaildisplaylanguage['getaquote'];?> <i class="flaticon-dollar-coin"></i>
                            </button>
							<?php }?>
				</div>
			</div>
	</div>
</section>

<section>
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-6">
		 <div id="productimage">
		  <ul id="glasscase" class="gc-start">
		   
		 <?php 
							//  echo "ggg";
						 //echo "<pre>";
							// print_r($productdetails);
							//print_r($productdetails['img_names']); //die(); 
							if($productdetails['img_names']!=''){
							$pro_img = explode('|',$productdetails['img_names']);
                            // foreach($pro_img as $list_img){
						     ?>
							 
			
                    <li><img src="<?php echo img_base;?>uploads/productassest/<?php echo $productdetails['product_id']; ?>/photos/base/<?php echo $pro_img[0]; ?>" alt="Text" data-gc-caption="Product Caption 1" /></li>
                    
               
							<?php }else{?>
							<li><img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" alt="Text" data-gc-caption="Product Caption 1" /></li>
							<?php }?>
							
							 </ul>
							</div>
				<div class="tap-to-zoom">Tap Image to Zoom <i class="flaticon-search"></i></div>
		 </div>
		 <div class="col-sm-12 col-md-12 col-lg-6">
			<div class="pad-lef-30">
				
				<h4 class="text-gray"><?php echo $commondisplaylanguage['sku'];?> <?php echo $productdetails['sku']; ?></h4>
				<p class="product-description"> <?php echo $productdetails['description']; ?></p>
				
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
								 
								// print_r($productfilter); die();
								 
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
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div></div>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</div>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20 colors">
																		<h6>
																				'.$f['attributename'].'
																			</h6>
																			<div class="divider2"></div>
																			<div class="d-flex flex-wrap">
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</div>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap">
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
										case "0":
													 if(in_array($f['attributeid'],$arrattr))
												 {
													  $clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>								  
																 </div>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</div>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap">
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</div>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
																		<h6>
																				'.$f['attributename'].'
																			</h6><div class="divider2"></div><div class="d-flex flex-wrap">

																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		'.$f['dropdown_values'].'
																	</label>								  
																 </div>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
											} 

								  }
								  if($prevtype==0)
								  {
									   $strattrHTML.='</div>';
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
		<?php     $childsid= $helper->getChildsId();
							$arrexcludecat=explode(",",$childsid);
                              // print_r($productdetails); die(); 
								$max_dp = ($productdetails['final_price_tax']*$getmaximum_dp['max_discnt_slap'])/100;
								$maxdiscountamtfp = ($productdetails['final_price_tax'] - $max_dp);
                         
								  ?>
			 
					 
					<div class="pad-lef-30">
					<div class="row">
					 <div class="col-sm-12 col-md-12 col-lg-12">
							
						<h6><?php echo $commondisplaylanguage['quantity'];?></h6>
							<div class="input-group quantity-buttons">
                                    <span class="input-group-btn">
                                        <button type="button" onClick="qtyremove(<?php echo $productdetails['product_id']; ?>)" class="quantity-left-minus"  data-type="minus" data-field="">
                                          <span class="flaticon-minus-2"></span>
                                        </button>
                                    </span>
                                       <input type="text" class="form-control input-number chkqtydetail" id="prices1_<?php echo $productdetails['product_id']; ?>" min="<?php echo $productdetails['minquantity']; ?>" onChange="" onMouseMove="" onKeyPress="return validateQty(event);" onKeyDown="numberkeyvalid(event);" onBlur="chkqtydetail()"  max="100" value="<?php echo $productdetails['minquantity']; ?>" >
									    
									   
                                    <span class="input-group-btn">
                                        <button type="button" onClick="qtyaddition(<?php echo $productdetails['product_id']; ?>)" class="quantity-right-plus" data-type="plus" data-field="">
                                            <span class="flaticon-plus-1"></span>
                                        </button>
                                    </span>
                            </div>
							 
							 
							<?php if($productdetails['brochureimage'] != ''){?>
								<a class="add-to-cart-btn1 download-btn mb-xl-3" href="<?php echo img_base; ?>uploads/brochure/<?php echo $productdetails['brochureimage']; ?>" target="_blank" ><?php echo $detaildisplaylanguage['downloadpdf'];?><i class="flaticon-download pr-2 fa-lg"></i></a>
							<?php }?>
							
		 </div>
				</div>
				</div>
			 
		 </div>
	  </div>
   </div>
</section>
<section class="pt-0">
	<div class="container">
      <div class="row">
         <div class="col">
			<ul id="product-detail-tabs" class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab"><?php echo $commondisplaylanguage['description'];?></a>
				</li>
				<?php
			 
					 	$i = 0;
						foreach($productattributes as $val){	
 					
							if(strip_tags($val["value"]) != ''){
						?>
				<li class="nav-item">
					<a id="attributetag_<?php echo $i;?>" href="#attributediv_<?php echo $i;?>" class="nav-link" data-toggle="tab" role="tab"><?php echo $val["attributename"];?></a>
				</li>
							<?php }
						$i++;}?>
				 
			</ul>


			<div id="product-detail-tab-content" class="tab-content" role="tablist">
				<div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
					<div class="card-header" role="tab" id="heading-A">
						<h4 class="mb-0">
							<!-- Note: `data-parent` removed from here -->
							<a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
								<?php echo $commondisplaylanguage['description'];?>
							</a>
						</h4>
					</div>

					<!-- Note: New place of `data-parent` -->
					<div id="collapse-A" class="collapse show" data-parent="#product-detail-tab-content" role="tabpanel" aria-labelledby="heading-A">
						<div class="card-body">
							<?php echo $productdetails['longdescription'] ;?>
						</div>
					</div>
				</div>

			<?php //print_r($productattributes);
			
			if(count($productattributes) > 0 ){?>
			
			 <?php
					 	$i = 0;
						foreach($productattributes as $val){		
						//echo $val["attributename"];
							if($val["value"] != ''){
						?>
                        
                        
						
				<div id="attributediv_<?php echo $i;?>" class="card tab-pane fade" role="tabpanel" aria-labelledby="attributetag_<?php echo $i;?>">
					<div class="card-header" role="tab" id="heading-B">
						<h4 class="mb-0">
							<a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
								<?php echo $val["attributename"];?>
							</a>
						</h4>
					</div>
					<div id="collapse-B" class="collapse" data-parent="#product-detail-tab-content" role="tabpanel" aria-labelledby="heading-B">
						<div class="card-body">
					<p><?php echo $val["value"];?> </p>
						</div>
					</div>
				</div>
				  <?php }
						$i++;}
						}?>
				 
			</div>
		 </div>
	  </div>
	</div>
</section>
 <section class="light-gray-bg">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="accordion" id="product-details-accordion">
                    <div class="card">
                        <div class="card-header" id="overview">
                            <a href="#" class="btn-header-link" data-toggle="collapse" data-target="#overview"
                            aria-expanded="true" aria-controls="overview">Overview</a>
                        </div>

                        <div id="overview" class="collapse show" aria-labelledby="overview" data-parent="#product-details-accordion">
                            <div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-12">
										<h4 class="mb-2">More about</h4>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6">
										<h4>C-Arm Pro Elite Apron</h4>
										<p>Non sodales neque sodales ut etiam sit. Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim. Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus. Orci porta non pulvinar neque laoreet suspendisse interdum consectetur.</p>
										<p>Arcu risus quis varius quam. Malesuada nunc vel risus commodo vi maecenas accumsan lacus. Aliquam ultrices sagittis orci a scelerisquurus semper. Odio eu feugiat pretium nibh. Sit amet mattis vulputate enim nulla. Eu mibibendum neque egestas congue quisque egestas diam in. Quam adipiscin proin sagittis nisl. Sed vulputate mi sit amet mauris nisl rhoncus mattis rhoncus.</p>
										<img src="<?php echo img_base; ?>/static/images/product-details-image1.png" class="img-fluid mb-3" alt="" />
									</div>
									<div class="col-sm-12 col-md-12 col-lg-6">
										<div class="pad-lef-30">
										<h4>Material Details</h4>
										<h5>803</h5>
										<p>Non sodales neque sodales etiam sit. Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim.</p>
										<h5>Colors</h5>
										<p>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</p>
										<h5>Core</h5>
										<p>Eu mibibendum neque egestas congue quisque egestas diam in. Quam adipiscin proin sagittis nisl. Sed vulputate mi sit amet mauris nisl rhoncus mattis rhoncus.</p>
										<h5>Protection</h5>
										<p>Eu mibibendum neque egestas congue quisque egestas diam in.</p>
										<h5>Sizes</h5>
										<p>Eu mibibendum neque egestas congue quisque egestas diam in.</p>
										<h5>Fabric</h5>
										<p>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</p>
										<h5>Monogram</h5>
										<p>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</p>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="features">
                            <a href="#" class="btn-header-link collapsed" data-toggle="collapse" data-target="#features"
                            aria-expanded="true" aria-controls="features">Features</a>
                        </div>

                        <div id="features" class="collapse" aria-labelledby="features" data-parent="#product-details-accordion">
                            <div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-6 col-lg-5">
										<ul class="features-list">
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
										</ul>
									</div>
									<div class="col-sm-12 col-md-6 col-lg-5">
										<ul class="features-list">
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
											<li>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</li>
										</ul>
									</div>
									<div class="col-sm-12 col-md-6 col-lg-2">
										<img src="<?php echo img_base; ?>/static/images/product-details-image2.png" class="img-fluid" alt="" />
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="benefits">
                            <a href="#" class="btn-header-link collapsed" data-toggle="collapse" data-target="#benefits"
                            aria-expanded="true" aria-controls="benefits">Benefits</a>
                        </div>

                        <div id="benefits" class="collapse" aria-labelledby="benefits" data-parent="#product-details-accordion">
                            <div class="card-body">
                                <ul class="benefits-list">
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image1.png" alt="" />
										<strong>High throughput</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image2.png" alt="" />
										<strong>Highly sensitive</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image3.png" alt="" />
										<strong>detection</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image4.png" alt="" />
										<strong>integrity</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image5.png" alt="" />
										<strong>No disposable</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
									<li>
										<img src="<?php echo img_base; ?>/static/images/benefits-image6.png" alt="" />
										<strong>5 Assays</strong>Fames turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.
									</li>
								</ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="videos">
                            <a href="#" class="btn-header-link collapsed" data-toggle="collapse" data-target="#videos"
                            aria-expanded="true" aria-controls="videos">Videos</a>
                        </div>

                        <div id="videos" class="collapse" aria-labelledby="videos" data-parent="#product-details-accordion">
                            <div class="card-body">
								<div id="sync1" class="slider owl-carousel owl-theme">
									<div class="item-video"><a class="owl-video" href="https://youtu.be/LoTjyIVSA0s"></a></div>
									<div class="item-video"><a class="owl-video" href="https://youtu.be/ziqLSPiWpN4"></a></div>
									<div class="item-video"><a class="owl-video" href="https://youtu.be/gwSiKzzSZWo"></a></div>
								</div>  
								<div id="sync2" class="navigation-thumbs owl-carousel">
								  <div class="item"></div>
								  <div class="item"></div>
								  <div class="item"></div>
								</div>
                            </div>
                        </div>
                    </div>
					
                    <div class="card">
                        <div class="card-header" id="howtouse">
                            <a href="#" class="btn-header-link collapsed" data-toggle="collapse" data-target="#howtouse"
                            aria-expanded="true" aria-controls="howtouse">How to Use</a>
                        </div>

                        <div id="howtouse" class="collapse" aria-labelledby="howtouse" data-parent="#product-details-accordion">
                            <div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-12 col-lg-9">
										<iframe src="https://www.youtube.com/embed/LoTjyIVSA0s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
									<div class="col-sm-12 col-md-12 col-lg-3">
										<div class="pad-lef-30">
										<h4>Fames turpis egest maecenas pharetra convallis.</h4>
										<p>Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus. Fames ac turpis egest maecenas pharetra convallis. Ipsum consequat nisl vel pr lectus.</p>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
 </section>
 
 <section class="get-a-quote">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
				<h5>Get quote</h5>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="Elite C Arm" />
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="Organisation Name" />
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="First Name" />
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="Last Name" />
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="Email Address" />
					</div>
					<div class="col-sm-12 col-md-6 col-lg-6">
						<input type="text" class="form-control" placeholder="Phone Number" />
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12">
						<input type="text" class="form-control" placeholder="Type Your Text Here" />
					</div>					
					<div class="col-sm-12 col-md-12 col-lg-12 text-center">
						<button type="button" class="get-a-quote-btn">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
 </section>
			
			<?php
		//$data=$helper->displayproductsilder('','bestselling','Customer who bought this also viewed this','','10');	    
		$data=$helper->displayproductsilder('','relatedproduct','Customer who bought this also viewed this','','10',$productdetails['product_id'])
		//$data=$helper->displayproductsilder('','suggestedproduct','Customer who bought this also viewed this','','10',$productdetails['product_id'])
	?>	
	
	<?php
		$data=$helper->displayproductsilder('','bestselling','Related products','','10','','','nt-wtn');	    
	?>
                
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<div class="modal fade" id="getaQuoteModal" tabindex="-1" aria-labelledby="getaQuoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">	
		<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"><i class="flaticon-cancel-12"></i></button>
        <h3 class="text-center"><?php echo $detaildisplaylanguage['getaquote'];?></h3>
		<div class="row">
		<form id="jvalidate" name="frmRequest" action="#" method="post"  >
		  <input type="hidden" name="eproductid" id="eproductid" value="<?php echo $productdetails['product_id'];?>"> 
			<div class="col-sm-12 col-md-6">
				<input readonly type="text" class="form-control" name="eproduct_name" id="eproduct_name" placeholder="<?php echo $detaildisplaylanguage['productname'];?>" value="<?php echo $productdetails['product_name']; ?>" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" required='' name="companyname" id="companyname" placeholder="<?php echo $detaildisplaylanguage['organizationname'];?>" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" required name="txtname" id="txtname" placeholder="<?php echo $formdisplaylanguage['firstname'];?>" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" required name="txtlname" id="txtlname" placeholder="<?php echo $formdisplaylanguage['lastname'];?>" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="email" class="form-control" required name="txtemail" id="txtemail" placeholder="<?php echo $formdisplaylanguage['emailaddress'];?>" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="tel" class="form-control" required name="txtmobile" id="txtmobile" minlength="5" maxlength="15"  class="jsrequired" onkeyup="return isNumberupdate(event,this)" onKeyPress="return isNumberupdate(event,this)" onKeyDown="return isNumberupdate(event,this)" onpaste="return false;" placeholder="<?php echo $formdisplaylanguage['mobileno'];?>" />
			</div>
			<div class="col-sm-12 col-md-12">
				<input type="text" class="form-control" name="txtcomment" id="txtcomment" placeholder="<?php echo $detaildisplaylanguage['typetext'];?>" />
			</div>
			<div class="col-sm-12 col-md-12 text-center">
				<button type="button" onClick="btnsaveQuote()" class="add-to-cart-btn1">
                    &nbsp; <?php echo $commondisplaylanguage['submit'];?>&nbsp;
                </button>
			</div>
			</form>
		</div>
	  </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	function btnsaveQuote()
		{ 
		
		$('#jvalidate').parsley().validate();

		if ($('#jvalidate').parsley().isValid())  {
			//if ($('#jvalidate').valid()) { 
		
			$.ajax({
					method     : 'POST',
					dataType   : 'json',
					url: "<?php echo BASE_URL; ?>ajax/saveproductQuote",
					data       : $("#jvalidate").serialize(),
					beforesend:loading(), 		
					cache: false,			
					success: function(response){ 
						unloading();
						  if(response.rslt == "0"){
							  $('#txtname').val('');$('#txtemail').val('');$('#txtmobile').val('');	$('#Address').val('');	$('#txtcomment').val('');	
  							swal({
								title: "Request Submitted Successfully",
								text: " ",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "#66A342",
								confirmButtonText: "Ok",
								closeOnConfirm: true
							},
							function () { });	
							
										
						}
						else if(response.rslt == "2"){
							swal("Failure!", "Category Field Required", "warning");	
						}
						else if(response.rslt == "3"){
							swal("Failure!", "Product Field Required", "warning");	
						}
						else{
							swal("Failure!", "You have already sent a request for this product'", "warning");	
						}
					},
					error:function(msg) {
						unloading();
					}
				});
			
		}
	
}

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
				
				 $('#glasscase').glassCase({
		'thumbsPosition': 'bottom'
	});
	
				if ($(window).width() > 767){
						$('.imgBox').imgZoom({
						boxWidth: 400,
						boxHeight: 400,
						marginLeft: 15,
						});
					}
				 
       
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

function fnchkCodeAvailable(){	
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
  
  
function qtyaddition(id){

var quantitiy=1;
 
         
        var quantity = parseInt($('#prices1_'+id).val());
		quantity = quantity + 1;
            $('#prices1_'+id).val(quantity);

           
}
function qtyremove(id){
     
        var quantity = parseInt($('#prices1_'+id).val());
        quantity = quantity - 1;
        
		if(quantity>0){
           $('#prices1_'+id).val(quantity);
        }
     
}
</script>