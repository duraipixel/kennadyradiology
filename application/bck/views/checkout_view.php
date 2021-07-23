<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="inner-bg">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
               </ol>
            </nav>
            <h3 class="text-center text-white"><span>Checkout</span></h3>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="row">
         <div class="col">
            <div class="accordion" id="accordionCheckout">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                     <button class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                     Choose your Delivery Address
                     </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionCheckout">
                     <div class="accordion-body">
                        <div class="row">
                           <div class="col-sm-12 col-md-12">
                              <div class="add-delivery-address">
                                 <button type="button" class="add-to-cart-btn1 edit-address">
                                 Add New Delivery Address <i class="flaticon-location-fill"></i>
                                 </button>
                                 <span> Or </span>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">Same as Billing Address</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> Brandy J Larsen</p>
                                 <p><i class="flaticon-location-fill"></i> 4810  Rose Street, Burr Ridge,<br/>IL, Illinois - 61257</p>
                                 <p><i class="flaticon-telephone"></i> 708-280-5713, 708-548-4766</p>
                                 <p><i class="flaticon-email-fill-1"></i> mq3s8nt6p5e@temporary-mail.net</p>
                                 <p class="select-address">
                                    <button type="button" class="add-to-cart-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Deliver Here
                                    </button>
                                    <button type="button" class="edit-address" data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
									<button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Selected">
                                    <i class="flaticon-fill-tick"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> Willie S Williams</p>
                                 <p><i class="flaticon-location-fill"></i> 4123  Lighthouse Drive, Springfield, Missouri - 65804</p>
                                 <p><i class="flaticon-telephone"></i> 417-242-7923</p>
                                 <p><i class="flaticon-email-fill-1"></i> r9o8vk1ia4@temporary-mail.net</p>
                                 <p class="select-address">
                                    <button type="button" class="add-to-cart-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Deliver Here
                                    </button>
                                    <button type="button" class="edit-address"  data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="row show-address" style="display:none;">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <h4 class="mb-3">Add/Update Address</h4>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="First Name" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Last Name" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="tel" class="form-control" placeholder="Phone Number" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Address" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Land Mark" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="City" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Zip Code" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Country" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="State" />
                           </div>
                           <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                              <button type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                              Proceed
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
			   <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                     <button class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="true"
                        aria-controls="collapseFive">
                     Billing Address
                     </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-mdb-parent="#accordionCheckout">
                     <div class="accordion-body">
                        <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
							  <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                    <label class="form-check-label" for="flexCheckDefault1">Same as Delivery Address</label>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="First Name" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Last Name" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="tel" class="form-control" placeholder="Phone Number" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Address" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Land Mark" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="City" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Zip Code" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="Country" />
                           </div>
                           <div class="col-sm-12 col-md-6 col-lg-4">
                              <input type="text" class="form-control" placeholder="State" />
                           </div>
                           <div class="col-sm-12 col-md-12 col-lg-12 text-center res-pad-top">
                              <button type="button" class="buy-now-btn1" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              Proceed
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                     <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     Shipping Method
                     </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionCheckout">
                     <div class="accordion-body">
                        <div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<h6>Free Shipping</h6>
							</div>
                           <div class="col-sm-12 col-md-6 col-lg-6 text-right res-pad-top">
                              <button type="button" class="buy-now-btn1 m-0" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                              Proceed
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                     <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     Payment Gateway
                     </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionCheckout">
                     <div class="accordion-body">
                        
                        <div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6">
								<ul class="payment-methods">
									<li>
										<a href="#" class="active">
											<img src="<?php echo BASE_URL;?>/static/images/payment-methods-visa.jpg" alt="" class="img-fluid"/>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="<?php echo BASE_URL;?>/static/images/payment-methods-mastercard.jpg" alt="" class="img-fluid"/>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="<?php echo BASE_URL;?>/static/images/payment-methods-paypal.jpg" alt="" class="img-fluid"/>
										</a>
									</li>
								</ul>
							</div>
                           <div class="col-sm-12 col-md-6 col-lg-6 text-right res-pad-top">
                              <button type="button" class="buy-now-btn1 mr-0" data-mdb-toggle="collapse" data-mdb-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                              Proceed
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                     <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                     Order Summary
                     </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-mdb-parent="#accordionCheckout">
                     <div class="accordion-body">
                        <div class="table-responsive">
                           <table id="cart-table" class="table cart-table">
                              <thead>
                                 <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Sub Total</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <a href="<?php echo BASE_URL;?>product-listing" class="cart-items">
                                       <img src="<?php echo BASE_URL;?>/static/images/products/product-image1.png" alt="" class="img-fluid" />
                                       <span><strong>Coat Apron with Head Shield</strong>SKU #111100</span>
                                       </a>
                                    </td>
                                    <td>$ 390.90</td>
                                    <td>
                                       01
                                    </td>
                                    <td class="text-right">
                                       <strong>$ 390.90</strong>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="<?php echo BASE_URL;?>product-listing" class="cart-items">
                                       <img src="<?php echo BASE_URL;?>/static/images/products/product-image2.png" alt="" class="img-fluid" />
                                       <span><strong>C-Arm Pro Elite Apron</strong>SKU #111100</span>
                                       </a>
                                    </td>
                                    <td>$ 200.90</td>
                                    <td>
                                       02
                                    </td>
                                    <td class="text-right">
                                       <strong>$ 200.90</strong>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="row border-bottom">
                           <div class="col-sm-12 col-md-6">
								<h6>Apply Coupon</h6>
								<div class="input-group mb-3 coupon-code">
								   <input type="text" class="form-control" placeholder="Enter Coupon Code" />
								   <button class="coupon-button" type="button">
								   Apply
								   </button>
								</div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <table class="table table-borderless checkout-total">
                                 <tbody>
                                    <tr>
                                       <td>
                                          Sub Total
                                       </td>
                                       <td class="text-right">
                                          <strong>$ 591.80</strong>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          Tax (10 %)
                                       </td>
                                       <td class="text-right">
                                          <strong>$ 59.18</strong>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          Shipping Charge
                                       </td>
                                       <td class="text-right">
                                          <strong>$ 20.89</strong>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="has-border">
                                          Order Total Incl. Tax
                                       </td>
                                       <td class="text-right has-border">
                                          <strong>$ 671.87</strong>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-md-6">
                           </div>
                           <div class="col-sm-12 col-md-6 text-right pt-3">
                              <button type="button" class="buy-now-btn1 mr-0">
                              Proceed Checkout with
                              </button><br/>
                              <img src="<?php echo BASE_URL;?>/static/images/payment-methods-paypal.jpg" alt="" class="img-fluid"/>
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
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>