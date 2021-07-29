<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, user-scalable=0"  >
	<?php 
			if(!empty($headcss)){
				 echo $headcss;
				} 
				else {  } ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL;?>/static/images/favicon.png"/>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/flaticon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/product-zoom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/basictable.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/static/css/footer.css">	
	<div id="preloader"></div>
	<div class="menu-overlay"></div>
	<!-- <div class="header-search-overlay"></div> -->
</head>	
<body>