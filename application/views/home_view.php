<?php include ('includes/style.php') ?>
<?php include ('includes/header.php');?>
<?php //echo count($getbannerdisplay);// echo "<pre>";print_r($getbannerdisplay);?>

<div id="home-banner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <?php $i = 0;foreach($getbannerdisplay as $bannerslider) { ?>
        <li data-target="#home-banner-carousel" data-slide-to="<?php echo $i;?>"
            class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
        <?php $i++;}?>
    </ol>
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <?php $i = 1;foreach($getbannerdisplay as $bannerslider) { ?>
        <div class="carousel-item <?php echo ($i == 1) ? 'active' : '';?>">
            <?php if($bannerslider[''] != 'banner_link'){$banlink = $bannerslider['banner_link'];}else{$banlink='javascript:void(0);';}?>
            <picture>
                <source media="(max-width:960px)"
                    srcset="<?php echo img_base;?>uploads/banners/mobile/<?php echo $bannerslider['mobileimage'];?>" />
                <img src="<?php echo img_base;?>uploads/banners/<?php echo $bannerslider['bannerimage'];?>" width="1600"
                    height="550" class="d-block w-100" alt="Banner Image" />
            </picture>
            <div class="carousel-caption">
                <?php if($bannerslider['banner_title'] != '' && $bannerslider['banner_title'] != '#'){?>
                <h1><?php echo $bannerslider['banner_title'];?></h1>
                <?php }?>
                <div class="animated fadeInUp"><a href="<?php echo $banlink;?>"
                        class="banner-btn"><?php echo $homedisplaylanguage['shopnow'];?><i
                            class="flaticon-right-arrow"></i></a></div>
            </div>
        </div>
        <?php $i++;}?>
        <a class="carousel-control-prev" href="#home-banner-carousel" role="button" data-slide="prev"> <span
                class="sr-only"><?php echo $homedisplaylanguage['shopnow'];?></span> </a> <a
            class="carousel-control-next" href="#home-banner-carousel" role="button" data-slide="next"> <span
                class="sr-only"><?php echo $homedisplaylanguage['shopnow'];?></span> </a>
    </div>
</div>

<?php if( isset( $homeproducts ) && !empty( $homeproducts ) ){?>

<section class="light-gray-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000" >
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Products</h2>
                <h3 class="text-center"><span><?php echo $homedisplaylanguage['explore'];?></span></h3>
                <div class="featured-products">
                    <?php 
                    foreach($homeproducts as $p){ 
                   
                      $arrpath      = array();
                      // $productUrl = BASE_URL.'products/'.$p['sku'].'/'.$p['product_url'];
                      $product_link = BASE_URL.'products/'.$p->categoryCode.'/'.$p->product_url;
                      $helper->getProductPath($p->categoryID, $arrpath);
                  ?>
                    <div>
                        <div class="product-listing-div">
                            <a href="<?= $product_link ?>" class="featured-products-items has-border">
                                <div class="featured-products-image">
                                    <?php 
                                    if( isset( $p->img_path ) && !empty( $p->img_path ) ) {
                                        ?>
                                    <img src="<?= img_base ?>uploads/productassest/<?= $p->product_id ?>/photos/<?= $p->img_path ?>"
                                        class="img-fluid" title="<?= $p->product_name ?>" alt="<?= $p->product_name ?>">
                                    <?php  
                                    } else { ?>
                                    <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png"
                                        class="img-fluid" title="<?php echo $p->product_name; ?>" width="700"
                                        height="700" alt="<?php echo $p->product_name; ?>" />
                                    <?php  
                                    }
                                  ?>
                                </div>
                                <span class="featured-products-name"><?php echo $p->product_name; ?></span>
                                <span class="featured-products-price">
                                    <strong>
                                        $<?= $p->productprice ?>
                                    </strong>
                                </span>
                            </a>

                            <button type="button" onclick="window.location.href='<?= $product_link ?>'"
                                class="common-btn add-to-cart-btn"> <i class="fa fa-eye"></i> </button>

                            <?php  if(isset( $p->isbuynow ) && $p->isbuynow == 0){?>
                            <!-- <button type="button" data-mdb-toggle="tooltip" title="<?php echo $commondisplaylanguage['addtocart'];?>" onclick="addtocart('<?php echo $p->product_id;?>');" class="common-btn add-to-cart-btn"> <i class="flaticon-cart-bag"></i> </button>-->
                            <?php }else{?>
                            <!--<button type="button" onclick="window.location.href='<?php echo $helper->pathrevise($arrpath).'/'.$p->product_url; ?>'" class="common-btn add-to-cart-btn"> <i class="fa fa-eye"></i> </button>-->
                            <?php }?>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>


<?php 
  if( isset( $homeproducts ) && !empty( $homeproducts ) ) {
?>
    <section class="home-categories position-relative" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
        <span class="home-bg-heading1">Products</span>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center"><?php echo $homedisplaylanguage['category'];?></h2>
                    <h3 class="text-center"><span>Featured Products</span></h3>
                    <div class="explore-products">
                        <?php 
                          foreach($homeproducts as $p){ 
                            $arrpath    = array();
                            // $productUrl = BASE_URL.'products/'.$p['sku'].'/'.$p['product_url'];
                            $product_link = BASE_URL.'products/'.$p->categoryCode.'/'.$p->product_url;
                            $helper->getProductPath($p->categoryID,$arrpath);
                      ?>
                        <div>
                            <a href="<?= $product_link ?>">
                                <div class="icon-box">
                                    <?php 
                                  if( isset( $p->img_path ) && !empty( $p->img_path ) ) {
                                ?>
                                    <img src="<?= img_base ?>uploads/productassest/<?= $p->product_id ?>/photos/<?= $p->img_path ?>"
                                        class="img-fluid" title="<?= $p->product_name ?>" alt="<?= $p->product_name ?>">
                                    <?php  
                                  } else { ?>
                                    <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png"
                                        class="img-fluid" title="<?php echo $p->product_name; ?>" width="700" height="700"
                                        alt="<?php echo $p->product_name; ?>" />
                                    <?php  
                                  }
                                ?>
                                </div>
                                <span class="home-categories-name"><?php echo $p->product_name; ?></span>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }?>


     
    <?php if(count($trendingcategorys) > 0){
     
     ?>
   <section class="home-categories" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000" style="display:none">
       <div class="container">
           <div class="row">
               <div class="col">
                   <h2 class="text-center"><?php echo $homedisplaylanguage['category'];?></h2>
                   <h3 class="text-center"><span><?php echo $homedisplaylanguage['explore'];?></span></h3>
                   <div class="explore-products">
                       <?php foreach($trendingcategorys as $trendingcat){ 
                       if($trendingcat['parentId']=='0'){
                         $slug = $trendingcat['categoryCode'];
                       }else{
                         $slug = $trendingcat['parentslug'].'/'.$trendingcat['categoryCode'];
                       }
                     ?>
                       <div>
                           <a href="<?php echo BASE_URL.$slug; ?>">
                               <?php if($trendingcat['categorymenuimage']!=''){ ?>
                               <div class="icon-box"><img
                                       src="<?php echo img_base_url."category/categorymenuimage/".$trendingcat['categorymenuimage']; ?>"
                                       width="101" height="101" alt="EXPLORE OUR PRODUCTS" /></div>
                               <?php } else{ ?>
                               <div class="icon-box"><img src="<?php echo img_base_url;?>noimage/photos/base/noimage.png"
                                       width="101" height="101" alt="EXPLORE OUR PRODUCTS" /></div>
                               <?php } ?>
                               <h4><?php echo $trendingcat['categoryName']; ?></h4>
                           </a>
                       </div>
                       <?php }?>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <?php }?>
   

<section class="why-choose-us">
    <span class="home-bg-heading1">Why Choose Us</span>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="why-choose-us-content">
                    <h3>Why Choose Us</h3>
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-9.png" alt="" /> 40+ years of
                            <br />Experience
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-1.png" alt="" /> High Quality,
                            <br />Reliable Products
                        </li>
                        <li data-aos="fade-up" data-aos-delay="150" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-2.png" alt="" /> First-Rate <br />Raw
                            Materials
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon-10.png" alt="" /> Industry
                            Accreditations <br />&amp; Safety Standards
                        </li>
                        <li data-aos="fade-up" data-aos-delay="250" data-aos-duration="1000">
                            <img src="<?php echo img_base;?>/static/images/icon.png" alt="" /> Made in <br />USA
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include ('includes/footer.php') ?>
<?php include ('includes/script.php') ?>
<script type="text/javascript">
function apronredirect() {

    var filters = $('#frmcmnfilter').serialize();
    //var colorid = $('input[class="apcolor"]:checked').val();	 
    //var material = $('input[class="apmaterial"]:checked').val();	
    //var size = $('input[class="apsize"]:checked').val();

    var colorid = [];
    $('input[class="apcolor"]:checked').each(function() {
        colorid.push($(this).val());
    });

    var material = [];
    $('input[class="apmaterial"]:checked').each(function() {
        material.push($(this).val());
    });

    var size = [];
    $('input[class="apsize"]:checked').each(function() {
        size.push($(this).val());
    });

    if (($('input[class="apcolor"]:checked').length == 0 || colorid == 'undefined') && ($(
            'input[class="apmaterial"]:checked').length == 0 || colorid == 'undefined') && ($(
            'input[class="apsize"]:checked').length == 0 || colorid == 'undefined')) {
        swal("Failure!", "Choose any filter criteria", "warning");
        return false;
    }

    if (colorid != '') colorid = colorid + '/';
    if (material != '') material = material + '/';
    if (size != '') size = size + '/';
    /*
 if($('input[class="apcolor"]:checked').length == 0 || colorid == 'undefined'){
		swal("Failure!", "Choose any apron color", "warning");return false;
	}else if($('input[class="apmaterial"]:checked').length == 0  || colorid == 'undefined'){
		swal("Failure!", "Choose any apron material", "warning");return false;
	}else if($('input[class="apsize"]:checked').length == 0  || colorid == 'undefined'){
		swal("Failure!", "Choose any apron size", "warning");return false;
	}*/

    window.location.href = '<?php echo BASE_URL.apronname.'/filter/';?>' + colorid + material + size;
}
</script>