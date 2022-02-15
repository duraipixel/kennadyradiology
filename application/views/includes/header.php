<?php if ( ($helper instanceof common_function) != true ) {	$helper=$this->loadHelper('common_function');} $helper->getStoreConfig();
 
$headdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'head');
$footdisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'foot');
 $commondisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'common');
 $metadisplaylanguage  = $helper->languagepagenames($_SESSION['lang_id'],'meta');
 
// print_r($metadisplaylanguage);die();
?>
<body class="bodycls<?php echo $_SESSION['lang_css'];?>">
<div id="preloader"></div>
<div class="menu-overlay"></div>
<header>
   <nav class="navbar navbar-expand-xl">
      <div class="container-fluid">
         <div class="row">
            <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 p-0">
               <a class="navbar-brand" href="<?php echo BASE_URL;?>">
               <img src="<?php echo img_base; ?>/static/images/logo.svg" alt="" />
               </a>
            </div>
            <div class="col-8 col-sm-8 col-md-8 col-lg-9 col-xl-10 posi-unset">
               <div class="row align-items-center">
                  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-6">
				  <input type="hidden" name="session_lang_id" id="session_lang_id" value="<?php echo $_SESSION['lang_id'];?>">
                     <form role="search" class="header-search"  id="searchform" action="<?php echo BASE_URL;?>search" method="get">
					  
                        <span class="header-mob-search-close"><i class="flaticon-cancel-12"></i></span>
                        <div class="input-group">							  
							  <select class="form-control select2DD" name="scat" id="category">
			<option value=""><?php echo $headdisplaylanguage['allcat'];?></option>
			<?php $parentcatlist=$helper->searchkeyArrays('0',$GLOBALS['allcategories'],'parentId'); 
			   foreach($parentcatlist as $cat) { 
			   $issel='';
			   if($_REQUEST['scat']==$cat['categoryID'])
				    $issel=' selected="selected" ';
			?>
			<option <?php echo $issel; ?> value="<?php echo $cat['categoryID']; ?>"><?php echo $cat['categoryName']; ?></option>
			   <?php } ?>
        </select>
                           <input type="hidden" id="txt-category">
						   
						   <input type="text" class="form-control headsearch" name="q" id="searchfield" value="<?php echo $_REQUEST['q']; ?>" class="form-control" aria-label="..." placeholder="<?php echo $headdisplaylanguage['searchfor'];?>" required=''>
						   
						   
                           
                           <span class="input-group-btn">
                           <button id="btn-search" type="submit" class="btn btn-default">
                           <i class="flaticon-search"></i>
                           </button>
                           </span>
                        </div>
                     </form>
                  </div>
                  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-6 p-0 hide-on-fixed">                     
                     <div class="header-right-dropdown follow-us">
                        <button class="dropbtn"><i class="flaticon-share-4" aria-hidden="true"></i> <span class="d-none d-xl-block"><?php echo $headdisplaylanguage['followus'];?> <i class="fa fa-angle-down"></i></span></button>
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
                          	<a class="language <?php if($_SESSION['lang_id'] == '1') { echo 'active'; } ?>" href="javascript:void(0);" onClick="changeLanguage('1');">English</a>
							<a class="language <?php if($_SESSION['lang_id'] == '2') { echo 'active'; } ?>" href="javascript:void(0);" onClick="changeLanguage('2');">Spanish</a>
							<a class="language <?php if($_SESSION['lang_id'] == '3') { echo 'active'; } ?>" href="javascript:void(0);" onClick="changeLanguage('3');">portuguese</a>
			
                        </div>
                     </div>
                     <div class="header-right-call d-none d-xl-block">
                        <a href="tel:+919840080008" target="_blank"><span class="d-block d-xl-none">Call Us :<i class="fa fa-phone" aria-hidden="true"></i></span><span class="d-none d-xl-block"><?php echo $headdisplaylanguage['callus'];//echo $helper->languageshortnames($_SESSION['lang_id'],'callus');?>: <strong>+91 - 98400 80008</strong></span></a>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-2 col-md-2 col-lg-12 col-xl-9 posi-unset">
                     <div class="collapse navbar-collapse" id="mobile_nav">
                        <span class="mobile-close d-block d-xl-none"><i class="flaticon-cancel-12"></i></span>
                        <a class="mobile-logo d-block d-xl-none" href="#"><img src="<?php echo img_base; ?>/static/images/logo.svg" alt="" /></a>
                        
                         <?php 		
	echo  $helper->displaymenu($getactmenu[0]); 	
	?>  
                       
                     </div>
                  </div>
                  <div class="col-sm-10 col-md-10 col-lg-12 col-xl-3 p-0">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="flaticon-menu-line-2"></span> 
                     </button>
                     <div class="header-right-dropdown cart-items"  id="dropdownlistcart">
                     </div>
                     <div class="header-right-dropdown user-login">
                        <button class="dropbtn"><span class="user-login-icon"><i class="flaticon-user-7" aria-hidden="true"></i></span> </button>
                        <div class="dropdown-content">
                            <?php  if($_SESSION['Cus_ID']!=''){ ?>
                            	<h6><?php echo $headdisplaylanguage['welcome'];?><strong><?php echo $_SESSION['First_name']; ?></strong></h6>
                            	<a href="<?php echo BASE_URL;?>my-account"><i class="flaticon-user-11"></i> <?php echo $headdisplaylanguage['myaccount'];?></a>
                            	<a href="<?php echo BASE_URL;?>logout"><i class="flaticon-logout"></i> <?php echo $headdisplaylanguage['logout'];?></a>
                            <?php }else{ ?>
                                <a href="<?php echo BASE_URL; ?>login"><i class="flaticon-lock-4"></i> <?php echo $headdisplaylanguage['login'];?></a>
                                <a href="<?php echo BASE_URL;?>register"><i class="flaticon-edit"></i> <?php echo $headdisplaylanguage['register'];?></a>                                
                            <?php } ?>						
                        </div>
                     </div>
					 
					 <span class="header-mob-search"><i class="flaticon-search"></i></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </nav>
</header>

<div id="load" style=" background:url(<?php echo img_base; ?>static/images/preloader.gif)  center center no-repeat rgba(255,255,255,0.9); background-size: 70px 70px; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%; ">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><table width="100%" align="center"  style="border:0px solid #f0f0f0;"   border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle">
         <div align="center" class="loading" style="border:0px solid #fff;">

         <div class="loader"></div>         
         </div>
      </td>
      </tr>
    </table></td>
      </tr>
    </table>

    </div>
	
	 