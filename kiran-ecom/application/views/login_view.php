<?php include ('includes/style.php') ?>
<?php include ('includes/header.php') ?>

<section class="pad-lg light-gray-bg border-bottom">
   <div class="container">
      <div class="row justify-content-center align-items-center">
         <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="row login-bg1 justify-content-center">
               <div class="col-sm-12 col-md-12 col-lg-5 d-none d-sm-block">
                  <div class="pad-20">
                     <img src="<?php echo BASE_URL;?>/static/images/login-logo.png" alt=""/>
                     <h4 class="text-white mt-4">About Kiran</h4>
                     <p class="text-white pt-2">
                        Kiran specializes in manufacturing some of the world’s finest radiology equipment, accessories and radiation protection products. Apart from radiating healthcare, Kiran also ventures into X-Ray solutions such as Surgical C-Arm products. Positioned as one of the global leaders in radiology, Kiran is a brand known for its outstanding quality products and unparalleled service standards.
                     </p>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-7 login-bg2">
                  <div class="pad-20 login">
                     <h5 class="text-center text-uppercase">Login</h5>
                     <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" />
                     </div>
                     <div class="form-group">
                        <label>Password</label><a href="#" class="forgot-password">Forgot Password?</a>
                        <div class="input-group" id="show_hide_password">
                           <input class="form-control" type="password">
                           <div class="input-group-addon">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="form-check remember-me">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                        <label class="form-check-label" for="flexCheckDefault">
                        Remember Me
                        </label>
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>checkout/';">
                           Guest Checkout
                           </button>
                           <button type="button" class="buy-now-btn1 pull-right mr-0" onclick="location.href='<?php echo BASE_URL; ?>my-account/';">
                           Login
                           </button>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <p>Not a Member? <a href="<?php echo BASE_URL;?>register">Register Here!</a></p>
                        </div>
                     </div>
                  </div>
				  <div class="pad-20 for-pass" style="display:none;">
                     <h5 class="text-center">Forgot Password</h5>
                     <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" />
                     </div>
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <p>Remember Password? <a href="#" class="show-login">Login!</a></p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                           <button type="button" class="buy-now-btn1 mt-0 mr-0">
                           Submit
                           </button>
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