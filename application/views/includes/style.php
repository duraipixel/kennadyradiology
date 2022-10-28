<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="google-site-verification" content="ERkgLEtck8r-lMuDoGa8rqovuo-uRtTnOGO40fuvHEI" />
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, user-scalable=0"  >
	<?php 
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
			else  
            $url = "http://";   
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];               
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];                 
			echo $headcss_canonical='<link rel="canonical" href="'.$url.'" />';
			//end canonical			
			if(!empty($headcss)){
				echo $headcss;
			} 
		else {  } 
	?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo img_base;?>/static/images/favicon.png"/>
	
	<!-- Preconnect -->
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin/>
	<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin/>
	<link rel="preconnect" href="https://code.jquery.com" crossorigin/>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Bold.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed-Bold.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Bold.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Italic.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Italic.woff2" type="font/woff2" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Bold.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed-Bold.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Bold.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Italic.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Italic.woff" type="font/woff" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Bold.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINCondensed-Bold.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Bold.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DINExp-Italic.eot" type="font/eot" crossorigin>
	<link rel="preload" as="font" href="<?php echo img_base; ?>/static/fonts/D-DIN-Italic.eot" type="font/eot" crossorigin>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" media="all">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" media="all"/>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" media="all"/>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" media="all"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" media="all"/>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/flaticon.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/basictable.min.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/header.css" media="all">
    <link rel="stylesheet" href="<?php echo img_base; ?>/static/css/main.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/footer.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>static/css/custom.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>static/css/sweetalert.css" media="all">
	<link rel="stylesheet" href="<?php echo img_base; ?>static/css/jquery-ui.css" media="all">		
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/easy-autocomplete.min.css" media="all" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" media="all" />
	<link rel="stylesheet" href="<?php echo img_base; ?>/static/css/easy-autocomplete.themes.min.css" media="all"/>
</head>	