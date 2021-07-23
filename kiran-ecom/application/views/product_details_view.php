<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section>
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-6">
			 <ul id="glasscase" class="gc-start">
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image1.jpg" alt="Text" data-gc-caption="Product Caption 1" /></li>
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image2.jpg" alt="Text" data-gc-caption="Product Caption 2" /></li>
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image3.jpg" alt="Text" data-gc-caption="Product Caption 3" /></li>
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image4.jpg" alt="Text" data-gc-caption="Product Caption 4" /></li>
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image5.jpg" alt="Text" data-gc-caption="Product Caption 5" /></li>
                    <li><img src="<?php echo BASE_URL;?>/static/images/products/product-image6.jpg" alt="Text" data-gc-caption="Product Caption 6" /></li>
                </ul>
				<div class="tap-to-zoom">Tap Image to Zoom <i class="flaticon-search"></i></div>
		 </div>
		 <div class="col-sm-12 col-md-12 col-lg-6">
			<div class="pad-lef-30">
				<h5>C-ARM PRO ELITE APRON</h5>
				<h4 class="text-gray">SKU #1111000</h4>
				<div class="divider1"></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
						<h6>Color</h6>
						<div class="divider2"></div>
                     <div class="d-flex flex-wrap listing-color">
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
                     </div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6 pad-bot-20">
						<h6>Size</h6>
						<div class="divider2"></div>
						<div class="d-flex flex-wrap listing-color size-checkbox">
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
						 </div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12">
						<h6>Quantity</h6>
							<div class="input-group quantity-buttons">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus"  data-type="minus" data-field="">
                                          <span class="flaticon-minus-2"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="3" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus" data-type="plus" data-field="">
                                            <span class="flaticon-plus-1"></span>
                                        </button>
                                    </span>
                            </div>
						<h5>$940.99</h5>
						<p>
							<button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>shopping-cart/';">
                                Add to Cart <i class="flaticon-cart-bag"></i>
                            </button>
							<button type="button" class="buy-now-btn1" onclick="location.href='<?php echo BASE_URL; ?>checkout/';">
                                Buy Now <i class="flaticon-cart-2"></i>
                            </button>
							<button type="button" class="add-to-cart-btn1" data-mdb-toggle="modal" data-mdb-target="#getaQuoteModal">
                                Get a Quote <i class="flaticon-dollar-coin"></i>
                            </button>
						</p>
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
					<a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
				</li>
				<li class="nav-item">
					<a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Features &amp; Benefits</a>
				</li>
				<li class="nav-item">
					<a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Technical Specifications</a>
				</li>
			</ul>


			<div id="product-detail-tab-content" class="tab-content" role="tablist">
				<div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
					<div class="card-header" role="tab" id="heading-A">
						<h4 class="mb-0">
							<!-- Note: `data-parent` removed from here -->
							<a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
								Description
							</a>
						</h4>
					</div>

					<!-- Note: New place of `data-parent` -->
					<div id="collapse-A" class="collapse show" data-parent="#product-detail-tab-content" role="tabpanel" aria-labelledby="heading-A">
						<div class="card-body">
							<p>Kiran’s Coat Apron with Front Snaplock provides maximum protection from Ionizing Radiation in various clinical scenario with wide range of customization Name tag, Embroidery (In pockets), Size and various Colour Combinations.</p>
							<p>Kiran's Coat Apron with Front Snaplock offers comprehensive protection from Ionizing Radiations.</p>
							<h6>Ideal For</h6>
							<ul>
								<li>Cath Labs</li>
								<li>Interventional Radiology procedures</li>
								<li>Velcro closure for comfortable fit</li>
								<li>Complete frontal protection </li>
							</ul>
						</div>
					</div>
				</div>

				<div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
					<div class="card-header" role="tab" id="heading-B">
						<h4 class="mb-0">
							<a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
								Features &amp; Benefits
							</a>
						</h4>
					</div>
					<div id="collapse-B" class="collapse" data-parent="#product-detail-tab-content" role="tabpanel" aria-labelledby="heading-B">
						<div class="card-body">
							<h6>Features</h6>
							<ul>
								<li>Complete frontal protection</li>
								<li>Padded shoulders for reduced shoulder stress and equitable distribution of weight</li>
								<li>Available with Front Snap Lock instead of Velcro</li>
								<li>Easy to wear and remove.</li>
							</ul>
							<h6>Lead Equivalence</h6>
							<ul>
								<li>Front Protection - 0.50mm Pb or 0.35mm Pb</li>
								<li>Customizable upon requests</li>
							</ul>
						</div>
					</div>
				</div>

				<div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
					<div class="card-header" role="tab" id="heading-C">
						<h4 class="mb-0">
							<a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
								Technical Specifications
							</a>
						</h4>
					</div>
					<div id="collapse-C" class="collapse" role="tabpanel" data-parent="#product-detail-tab-content" aria-labelledby="heading-C">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
										<th>Brand</th>
										<td>Kiran</td>
									</tr>
									<tr>
										<th>Material</th>
										<td>Lead</td>
									</tr>
									<tr>
										<th>Color</th>
										<td>Blue,Black,Green etc.</td>
									</tr>
									<tr>
										<th>Lead Equivalence Front</th>
										<td>0.5mm &amp; Back 0.25mm Pb</td>
									</tr>
									<tr>
										<th>Size</th>
										<td>Small, Medium, Large, XL &amp; XXL</td>
									</tr>
									<tr>
										<th>Application</th>
										<td>Hospital</td>
									</tr>
								</table>
							</div>
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
            <h2 class="text-center">Explore our Products</h2>
            <h3 class="text-center"><span>Related Products</span></h3>
            <div class="featured-products">
               <div>
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
                  <a href="<?php echo BASE_URL;?>product-listing" class="featured-products-items has-border">
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
			<div class="text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
               <a href="#" class="yellow-btn mt-0">Show More Products</a>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<div class="modal fade" id="getaQuoteModal" tabindex="-1" aria-labelledby="getaQuoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">	
		<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"><i class="flaticon-cancel-12"></i></button>
        <h3 class="text-center">Get a Quote</h3>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" placeholder="Elite C Arm" disabled />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" placeholder="Organization Name" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" placeholder="First Name" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="text" class="form-control" placeholder="Last Name" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="email" class="form-control" placeholder="Email Address" />
			</div>
			<div class="col-sm-12 col-md-6">
				<input type="tel" class="form-control" placeholder="Phone Number" />
			</div>
			<div class="col-sm-12 col-md-12">
				<input type="text" class="form-control" placeholder="Type your text here" />
			</div>
			<div class="col-sm-12 col-md-12 text-center">
				<button type="button" class="add-to-cart-btn1">
                    &nbsp; Submit &nbsp;
                </button>
			</div>
		</div>
	  </div>
    </div>
  </div>
</div>