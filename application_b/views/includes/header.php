<?php 	
	$getactmenu=explode("/", $_REQUEST['route']);	 
?>
<!-- loading div - END -->
<body>
<!-- loading div - START -->
<div id="pageloader" class="white-loader" >
			<div class="vertical-outer">
				<div class="vertical-inner">
					<div class="loading">
						<img src="<?php echo BASE_URL;?>uploads/logo/<?php echo $helper->getStoreConfigvalue('ecomLogo'); ?>" class="img-responsive center-block loaderlogo" alt="logo">
					</div>	
					<div class="text-center loadingtext">
                    <div class="spinloader">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
				</div>		
			</div>
	</div>
    
    
<header class="fixed-top bg-black">
 <div class="container position-unset">
            <div class="row navbar navbar-expand-lg navbar-dark position-unset">
 <!-- <nav class="navbar navbar-expand-lg navbar-dark "><a class="navbar-brand" href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_URL;?>static/images/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    -->
        <div class="col-5 col-sm-4 col-md-4 col-lg-2 col-xl-2">					
                  <a class="navbar-brand" href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_URL;?>static/images/logo-black.png" alt=""></a>
               </div>
                  
    <div class="col-7 col-sm-8 col-md-8 col-lg-10 col-xl-10 position-unset">
     
      <ul class="user-options">
                  <li><a href="#search"><img src="<?php echo BASE_URL;?>static/images/icons/search.png" alt=""></a></li>
        <li class="dropdown"><a href="<?php echo BASE_URL;?>my-account" class="dropdown-toggle"><img src="<?php echo BASE_URL;?>static/images/icons/login.png" alt=""></a>
			<div class="dropdown-menu my-account" aria-labelledby="navbarDropdownMenuLink">
				<ul>
					<li>
                      <?php if($_SESSION['Cus_ID']==''){?>
                       <small>New Customer?</small><a href="<?php echo BASE_URL;?>register" class=""><i class="fa fa-user" aria-hidden="true"></i>Register/Sign up</a>
						
                         <?php }else{?>
                         <a href="<?php echo BASE_URL;?>my-account"><i class="fa fa-user" aria-hidden="true"></i>My Account</a>
                         <?php }?>
                        <?php if($_SESSION['Cus_ID']==''){?>
						<a href="<?php echo BASE_URL;?>login" style="border-bottom: none;"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a>
                        <?php }else{?>
						<a href="<?php echo BASE_URL;?>logout" style="border-bottom: none;"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                        <?php }?>
					</li>
				</ul>
			</div>
		</li>
        <li class="dropdown"><a href="<?php echo BASE_URL; ?>cart" class="cart dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo BASE_URL;?>static/images/icons/cart.png" alt=""><span class="smallval count" id="carcnt"></span></a>
			<div class="dropdown-menu cart customcart-dropmenu" aria-labelledby="navbarDropdownMenuLink">
            <div id="dropdownlist"></div>
					</div>
		</li>
      </ul>
        <div class="mega-menu">
     <?php 		
	echo  $helper->displaymenu($getactmenu[0]); 	
	?></div>
    
    </div>
 <!-- </nav>-->
  </div></div>
</header>
	
<div id="load"></div>
	<!--<div id="load" style=" background:url(<?php echo BASE_URL;?>static/images/overly.png) repeat; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%; ">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><table width="425" align="center"  style="border:0px solid #f0f0f0;"   border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" valign="middle">
         <div align="center" class="loading" style="border:0px solid #fff;">

         <img style="margin-top:150px; border-radius:6px; padding:3px; background:#fff;" src="<?php echo BASE_URL;?>static/images/loading_big.gif" alt="loading"  /> <br />  
				<br/>
				<div id="convprogress">			
									
				</div>			
				
		 
         </div>
      </td>
      </tr>
    </table></td>
      </tr>
    </table>
	
    </div>-->
