<footer>
   <div class="container">
      <div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
			<div class="row">					
				 <div class="col-sm-12 col-md-4 col-lg-4">
					<h5 class="text-orange">Company</h5>
					<ul>
					   <li>
						  <a href="<?php echo BASE_URL; ?>"><?php echo $commondisplaylanguage['home'];?></a>
					   </li>
					  <!-- <li>
						  <a href="<?php echo BASE_URL;?>about-us"><?php echo $footdisplaylanguage['aboutus'];?></a>
					   </li>
					   <li>
						  <a href="#"><?php echo $footdisplaylanguage['blog'];?></a>
					   </li>
					   <li>
						  <a href="#"><?php echo $footdisplaylanguage['media'];?></a>
					   </li>-->
					   <li>
						  <a href="<?php echo BASE_URL;?>contactus"><?php echo $footdisplaylanguage['contactus'];?></a>
					   </li>
					</ul>
				 </div>
				 <div class="col-sm-12 col-md-4 col-lg-4">
					<h5 class="text-orange"><?php echo $footdisplaylanguage['information'];?></h5>
					<ul>
					   <li>
						  <a href="<?php echo BASE_URL;?>shipping-information"><?php echo $footdisplaylanguage['shippinginformation'];?></a>
					   </li>
					   <li>
						  <a href="<?php echo BASE_URL;?>return-policy"><?php echo $footdisplaylanguage['returnpolicy'];?></a>
					   </li>
					   <li>
						  <a href="<?php echo BASE_URL;?>terms-conditions"><?php echo $footdisplaylanguage['termscondition'];?></a>
					   </li>
					   <li>
						  <a href="<?php echo BASE_URL;?>privacy-policy"><?php echo $footdisplaylanguage['privacypolicy'];?></a>
					   </li>
					</ul>
				 </div>
				 <div class="col-sm-12 col-md-4 col-lg-4">
					<h5 class="text-orange"><?php echo $commondisplaylanguage['helpline'];?></h5>
					<p class="mb-2"><a href="tel:+12562594436" target="_blank">+1 256 259 4436</a></p>
					<p><a href="mailto:kennedyradiology@trivitron.com" target="_blank">kennedyradiology@trivitron.com</a></p>
					<h5 class="text-orange"><?php echo $headdisplaylanguage['followus'];?></h5>
					<ul class="footer-socials">
					   <li>
						  <a href="https://www.facebook.com/kennedyradiology/" target="_blank"><i class="fa fa-facebook"></i></a>
					   </li>
					   <li>
						  <a href="https://twitter.com/Kennedy_Imaging" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
					   </li>
					   <li>
						  <a href="https://www.linkedin.com/company/kennedy-radiology" target="_blank"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a>
					   </li>
					   <li>
						  <a href="https://www.instagram.com/kennedyradiology/" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> </a>
					   </li>
					  <!-- <li>
						  <a href="https://www.youtube.com/user/TrivitronHealthcare" target="_blank"><i class="fa fa-youtube"></i></a>
					   </li>-->
					</ul>
				 </div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
			<div class="row justify-content-end">				
				 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10">
					<h5 class="text-orange"><?php echo $footdisplaylanguage['signupnews'];?></h5>
					<p class=""><small><?php echo $footdisplaylanguage['receivemonthlyupdate'];?></small></p>
					<div class="input-group mb-3">
					 
					
					   <input type="email" name="emails" id="emails" required='' class="form-control" placeholder="<?php echo $footdisplaylanguage['emailaddresshere'];?>" />
					   <button class="footer-button" type="button" onclick="emailfun('emails');" >
					   <?php echo $footdisplaylanguage['sendnow'];?>
					   </button>
					</div>
				 </div>
			</div>
		</div>	
      </div>      
   </div>
</footer>
<div class="footer-bottom">
	<div class="container">
		<div class="row align-items-center">
         <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="footer-bottom-text">
               &copy; <?php echo $footdisplaylanguage['copyright'];?> <script>document.write((new Date()).getFullYear());</script>. Kennedy Radiology | <?php echo $footdisplaylanguage['allrights'];?> <?php echo $footdisplaylanguage['designby'];?> <a href="https://www.pixel-studios.com/" target="_blank">Pixel Studios</a>
            </div>
         </div>
         <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="footer-payments">
               <img src="<?php echo img_base;?>/static/images/footer-payments.png" alt="" />
            </div>
         </div>
      </div>
	</div>
</div>
