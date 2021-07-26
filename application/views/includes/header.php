<?php if ( ($helper instanceof common_function) != true ) {	$helper=$this->loadHelper('common_function');} $helper->getStoreConfig();
$headdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'head');
$footdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'foot');
 $commondisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'common');
 
 
//print_r($commondisplaylanguage);
?><header>
   <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
         <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 p-0">
               <a class="navbar-brand" href="<?php echo BASE_URL;?>">
               <img src="<?php echo img_base; ?>/static/images/logo.png" alt="" />
               </a>
            </div>
            <div class="col-8 col-sm-8 col-md-8 col-lg-9 col-xl-10 posi-unset">
               <div class="row hide-on-fixed">
                  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-6">
                     <form role="search" class="header-search">
                        <span class="d-block d-xl-none header-mob-search-close"><i class="flaticon-close"></i></span>
                        <div class="input-group">
                           <div class="input-group-btn">
                              <button type="button" class="btn" data-toggle="dropdown">
                              <span id="srch-category"><?php echo $headdisplaylanguage['allcat'];?><i class="fa fa-angle-down"></i></span> <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" id="mnu-category">
                                 <li><a href="#Category 1">Category 1</a></li>
                                 <li><a href="#Category 2">Category 2</a></li>
                                 <li><a href="#Category 3">Category 3</a></li>
                                 <li><a href="#Category 4">Category 4</a></li>
                                 <li><a href="#Category 5">Category 5</a></li>
                              </ul>
                           </div>
                           <input type="hidden" id="txt-category">
                           <input type="text" id="txt-search" class="form-control" placeholder="<?php echo $headdisplaylanguage['searchfor'];?>">
                           <span class="input-group-btn">
                           <button id="btn-search" type="submit" class="btn btn-default">
                           <i class="flaticon-search"></i>
                           </button>
                           </span>
                        </div>
                     </form>
                  </div>
                  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-6 p-0">
                     <span class="d-block d-xl-none header-mob-search"><i class="flaticon-search"></i></span>
                     <div class="header-right-dropdown follow-us">
                        <button class="dropbtn"><i class="flaticon-share-3" aria-hidden="true"></i> <span class="d-none d-lg-block"><?php echo $headdisplaylanguage['followus'];?> <i class="fa fa-angle-down"></i></span></button>
                        <div class="dropdown-content">
                           <a class="fb" href="https://www.facebook.com/TrivitronIndia" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                           <a class="tw" href="https://twitter.com/account/access" target="_blank"><i class="fa fa-twitter"></i>Twitter</a>
                           <a class="in" href="https://www.linkedin.com/company/trivitron-healthcare" target="_blank"><i class="fa fa-linkedin"></i>Linkedin</a>
                           <a class="insta" href="https://www.instagram.com/trivitronhealthcare/" target="_blank"><i class="fa fa-instagram"></i>Instagram</a>
                           <a class="yt" href="https://www.youtube.com/user/TrivitronHealthcare" target="_blank"><i class="fa fa-youtube"></i>Youtube</a>
                        </div>
                     </div>
                     <div class="header-right-dropdown language">
                        <button class="dropbtn"><img class="yellow-img" src="<?php echo img_base; ?>/static/images/language.png" alt="" /><img class="purple-img" src="<?php echo img_base; ?>/static/images/language1.png" alt="" /> <?php echo $_SESSION['lang_name'];?> &nbsp; <i class="fa fa-angle-down"></i></button>
                        <div class="dropdown-content">
                          	<a class="language <?php if($_SESSION['lang_id'] == '1') { echo 'active'; } ?>" href="javascript:void(0);" onclick="changeLanguage('1');">English</a>
							<a class="language <?php if($_SESSION['lang_id'] == '2') { echo 'active'; } ?>" href="javascript:void(0);" onclick="changeLanguage('2');">Spanish</a>
							<a class="language <?php if($_SESSION['lang_id'] == '3') { echo 'active'; } ?>" href="javascript:void(0);" onclick="changeLanguage('3');">portuguese</a>
			
                        </div>
                     </div>
                     <div class="header-right-call d-none d-lg-block">
                        <a href="tel:1800 9829 0038" target="_blank"><span class="d-block d-lg-none">Call Us :<i class="fa fa-phone" aria-hidden="true"></i></span><span class="d-none d-lg-block"><?php echo $headdisplaylanguage['callus'];//echo $helper->languageshortnames($_SESSION['lang_id'],'callus');?>: <strong>1800 9829 0038</strong></span></a>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-2 col-md-2 col-lg-8 col-xl-9 posi-unset">
                     <div class="collapse navbar-collapse" id="mobile_nav">
                        <span class="mobile-close d-block d-lg-none"><i class="flaticon-cancel-12"></i></span>
                        <a class="mobile-logo d-block d-lg-none" href="#"><img src="<?php echo img_base; ?>/static/images/logo.png" alt="" /></a>
                        
                         <?php 		
	echo  $helper->displaymenu($getactmenu[0]); 	
	?>  
                       
                     </div>
                  </div>
                  <div class="col-sm-10 col-md-10 col-lg-4 col-xl-3 p-0">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="flaticon-menu-line-2"></span> 
                     </button>
                     <div class="header-right-dropdown cart-items"  id="dropdownlistcart">
                   <!--     <button class="dropbtn"><span class="cart-items-icon"><i class="flaticon-cart" aria-hidden="true"></i></span> <span class="d-none d-sm-block">My Cart 2 Item{s} <strong>$0.00</strong></span><span class="mobile-count d-block d-sm-none">2</span></button>-->
                       <!-- <div class="dropdown-content">-->
                     
                           <!--<table class="table mb-0">
                              <tr>
                                 <td>
                                    <a href="#"><img src="<?php echo img_base; ?>/static/images/products/product-image1.png" alt="" class="cart-items-image" /></a>
									<button class="btn btn-danger btn-xs" type="button" title="Remove Product"><i class="flaticon-cancel-12"></i></button>
                                 </td>
                                 <td>
                                    <p class="header-cart-description"><a href="#">Coat Apron</a></p>
                                 </td>
								 <td>
                                    <p class="header-cart-description"><span class="header-cart-price">$240.99</span></p>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <a href="#"><img src="<?php echo img_base; ?>/static/images/products/product-image2.png" alt="" class="cart-items-image" /></a>
                                    <button class="btn btn-danger btn-xs" title="Remove Product" type="button"><i class="flaticon-cancel-12"></i></button>
                                 </td>
                                 <td>
                                    <p class="header-cart-description"><a href="#">Coat Apron</a></p>
                                 </td>
								 <td>
                                    <p class="header-cart-description"><span class="header-cart-price">$240.99</span></p>
                                 </td>
                              </tr>
							  <tr class="no-border">
                                 <td colspan="2">
                                    <h4 class="text-right">Total</h4>
                                 </td>
								 <td>
                                    <h4 class="text-right"><strong>$481.90</strong></h4>
                                 </td>
                              </tr>
                              <tr class="no-border">
                                 <td colspan="3">
                                    <div class="row">
                                       <div class="col-6">
                                          <button class="btn btn-primary" onclick="location.href='<?php echo BASE_URL; ?>shopping-cart/';" type="button">View Cart <i class="flaticon-cart-2"></i></button>
                                       </div>
                                       <div class="col-6">
                                          <button class="btn btn-secondary" onclick="location.href='<?php echo BASE_URL; ?>checkout/';" type="button">Checkout <i class="flaticon-check"></i></button>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </table>-->
                     <!--   </div>-->
                     </div>
                     <div class="header-right-dropdown user-login">
                        <button class="dropbtn"><span class="user-login-icon"><i class="flaticon-user-7" aria-hidden="true"></i></span> </button>
                        <div class="dropdown-content">
                            <?php  if($_SESSION['Cus_ID']!=''){ ?>
                            	<h6><?php echo $headdisplaylanguage['welcome'];?><strong><?php echo $_SESSION['First_name']; ?></strong></h6>
                            	<a href="<?php echo BASE_URL;?>my-account"><i class="flaticon-user-11"></i> <?php echo $headdisplaylanguage['welcome'];?></a>
                            	<a href="<?php echo BASE_URL;?>logout"><i class="flaticon-logout"></i> <?php echo $headdisplaylanguage['logout'];?></a>
                            <?php }else{ ?>
                                <a href="<?php echo BASE_URL; ?>login"><i class="flaticon-lock-4"></i> <?php echo $headdisplaylanguage['login'];?></a>
                                <a href="<?php echo BASE_URL;?>register"><i class="flaticon-edit"></i> <?php echo $headdisplaylanguage['register'];?></a>
                                
                            <?php } ?>
						
                           
						   <!--<a href="<?php echo BASE_URL;?>my-account"><i class="flaticon-user-11"></i> My Account</a>
						    <a href="<?php echo BASE_URL;?>my-address"><i class="flaticon-location"></i> My Address</a>
						   <a href="<?php echo BASE_URL;?>my-orders"><i class="flaticon-menu-line-3"></i> My Orders</a>
						   <a href="<?php echo BASE_URL;?>login"><i class="flaticon-logout"></i> Logout</a>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </nav>
</header>
<div id="load" style=" background:url(<?php echo img_base; ?>static/images/overly.png) repeat; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%; ">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><table width="100%" align="center"  style="border:0px solid #f0f0f0;"   border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle">
         <div align="center" class="loading" style="border:0px solid #fff;">

         <div class="loader"><?php echo $commondisplaylanguage['loading'];?></div>         
         </div>
      </td>
      </tr>
    </table></td>
      </tr>
    </table>

    </div>
	
	 