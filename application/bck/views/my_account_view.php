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
					<h3 class="text-uppercase">My Details</h3>
					<h4 class="text-dark">Personal Information</h4>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" class="form-control" placeholder="Brandy J" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" class="form-control" placeholder="Larsen" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Email ID</label>
								<input type="email" class="form-control" placeholder="mq3s8nt6p5e@temporary-mail.net" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Mobile Number</label>
								<input type="tel" class="form-control" placeholder="708-280-5713, 708-548-4766" />
							 </div>
						</div>	
						<div class="col-sm-12 col-md-12 col-lg-12 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0">
                           Update
                           </button>
                        </div>
					 </div>
					 <h4 class="text-dark mt-3">Change Password</h4>
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Old Password</label>
								<div class="input-group" id="show_hide_password">
								   <input class="form-control" type="password">
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Confirm Password</label>
								<div class="input-group" id="confirm_password">
								   <input class="form-control" type="password">
								   <div class="input-group-addon">
									  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
								   </div>
								</div>
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0">
                           Update
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