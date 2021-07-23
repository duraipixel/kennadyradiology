<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>
<section class="light-gray-bg border-bottom my-account">
   <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
				<h5 class="pb-4 text-uppercase">My Account</h5>
			</div>
			<?php include ('includes/my-account-nav.php') ?>
			<div class="col-sm-12 col-md-8 col-lg-9">
				<div class="box-shadow">
					<h3 class="text-uppercase">My Address</h3>
					<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
					<h4 class="text-dark mb-3">Saved Address</h4>
					</div>
                           <div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> Brandy J Larsen</p>
                                 <p><i class="flaticon-location-fill"></i> 4810  Rose Street, Burr Ridge, IL, Illinois - 61257</p>
                                 <p><i class="flaticon-telephone"></i> 708-280-5713, 708-548-4766</p>
                                 <p><i class="flaticon-email-fill-1"></i> mq3s8nt6p5e@temporary-mail.net</p>
                                 <p class="select-address"><button type="button" class="selected-address" data-mdb-toggle="tooltip" title="Primary Address">
                                    <i class="flaticon-fill-tick"></i>
                                    </button>
									<button type="button" class="edit-address"  data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-12 col-lg-6">
                              <div class="delivery-address">
                                 <p><i class="flaticon-user-7"></i> Willie S Williams</p>
                                 <p><i class="flaticon-location-fill"></i> 4123  Lighthouse Drive, Springfield, Missouri - 65804</p>
                                 <p><i class="flaticon-telephone"></i> 417-242-7923</p>
                                 <p><i class="flaticon-email-fill-1"></i> r9o8vk1ia4@temporary-mail.net</p>
                                 <p class="select-address">
                                    <button type="button" class="edit-address"  data-mdb-toggle="tooltip" title="Edit Address">
                                    <i class="flaticon-edit-1"></i>
                                    </button>
                                 </p>
                              </div>
                           </div>
						   <div class="col-sm-12 col-md-12 col-lg-12">
                              <div class="add-delivery-address">
                                 <button type="button" class="add-to-cart-btn1 edit-address m-0">
                                 Add New Delivery Address <i class="flaticon-location-fill"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="row show-address" style="display:none;">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <h4 class="mb-3">Add/Edit Address</h4>
                           </div>
						   <div class="col-sm-12 col-md-6 col-lg-4">
                              <select class="form-control custom-select">
								<option selected>Primary</option>
								<option>Secondary</option>
								<option>Others</option>
							  </select>
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
                           <div class="col-sm-12 col-md-12 col-lg-12 text-right res-pad-top">
                              <button type="button" class="buy-now-btn1 m-0">
                              Save Address
                              </button>
                           </div>
                        </div>
				</div>
			</div>
        </div>
   </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>