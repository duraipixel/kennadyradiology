<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="pad-lg light-gray-bg border-bottom">
   <div class="container">
            <div class="row justify-content-center">
               <div class="col-sm-12 col-md-12 col-lg-7">
                  <div class="box-shadow">
					 <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">						
							<h5 class="text-center text-uppercase">Register</h5>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" class="form-control" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" class="form-control" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Email ID</label>
								<input type="email" class="form-control" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Mobile Number</label>
								<input type="tel" class="form-control" />
							 </div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="form-group">
								<label>Password</label>
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
					 </div>
                     <div class="row flex-column-reverse flex-md-row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <p>Have an Account? <a href="<?php echo BASE_URL;?>login">Login Here!</a></p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0"  onclick="location.href='<?php echo BASE_URL; ?>login/';">
                           Register
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