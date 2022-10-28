<?php 
if( isset( $productItems ) && !empty( $productItems ) ) {
?>

<section class="light-gray-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
	  <?php if($subtitle != ''){?>
        <h2 class="text-center"><?php echo $title; ?></h2>
        <h3 class="text-center"><span><?php echo $subtitle;?></span></h3>
	  <?php }else{?>
		<h3 class="text-center"><span><?php echo $title;?></span></h3>
	  <?php }?>
	  <div class="featured-products">
          <?php
				
			if ( ($helper instanceof common_function) != true ) {
                $helper=$this->loadHelper('common_function');
            }
				
            foreach($productItems as $p) {  
                $product_link       = BASE_URL.'products/'.$p->categoryCode.'/'.$p->product_url;
				$arrpath            = array();
				$helper->getProductPath( $p->categoryID, $arrpath );
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
			
			<button type="button" onclick="window.location.href='<?php echo $helper->pathrevise($arrpath).'/'.$p->product_url; ?>'" class="common-btn add-to-cart-btn"> <i class="fa fa-eye"></i> </button>
		
          </div>
		  </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
