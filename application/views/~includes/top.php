<?php if ( ($helper instanceof common_function) != true ) {	$helper=$this->loadHelper('common_function');} $helper->getStoreConfig();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="canonical" href="<?php echo rtrim(BASE_URL.$_REQUEST['route'],"/"); ?>">
<?php if(!isset($headcss) || $headcss=='') { ?>
<title><?php echo $helper->getStoreConfigvalue('storeMetaTitle'); ?></title>
<meta name="description" content="<?php echo $helper->getStoreConfigvalue('storeMetaDesc'); ?>">
<meta name="keywords" content="<?php echo $helper->getStoreConfigvalue('storeMetaKey'); ?>">
<?php } else { ?>
<?php echo $headcss; ?>
<?php } ?>
<link href="<?php echo BASE_URL;?>uploads/favicon/<?php echo $helper->getStoreConfigvalue('favIcon'); ?>" rel="icon">
<link href="<?php echo BASE_URL; ?>static/css/jquery-ui.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/price_range_style.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/owl.theme.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/bootstrap.min.css" rel="stylesheet" media='screen,print'>
<link href="<?php echo BASE_URL; ?>static/css/OverlayScrollbars.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>static/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo BASE_URL; ?>static/css/custom.css" rel="stylesheet">


<link href="<?php echo BASE_URL; ?>static/css/sweetalert.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
 
<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/common.css">

<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/responsive.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/slick/slick.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/slick/slick-theme.css">

<link href="<?php echo BASE_URL; ?>static/css/d3RangeSlider.css" rel="stylesheet">

<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
 <!-- Icon Font -->
       <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/jquery.simpleLens.css">
      
      <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/mega-menu.css">
<!-- new end-->

<!-- old style-->
<!--  <link href="<?php echo BASE_URL; ?>static/css/style.css" rel="stylesheet">-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZN68QL2NS9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZN68QL2NS9');
</script>
</head>
