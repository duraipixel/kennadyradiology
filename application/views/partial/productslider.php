<?php if(count($products)>0){ ?>

<section class="light-gray-bg" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center"><?php echo $title; ?></h2>
        <h3 class="text-center"><span><?php echo $subtitle;?></span></h3>
        <div class="featured-products">
          <?php
				
			if ( ($helper instanceof common_function) != true ) {
					
					$helper=$this->loadHelper('common_function');
				 	
				}
				if ( ($product instanceof product_model) != true && empty($product)) {
					
				  if (!class_exists("product_model")) {	
					$product=$this->loadModel('product_model');
					}
					else{
					$product=$this->loadModelObject('product_model');
					}
					
				}
//echo "<pre>";
//print_r($products);
				foreach($products as $p) {  
			
				$productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$p['product_url']);
				$arrpath=array();
				//print_r($p);
				$helper->getProductPath($p['categoryID'],$arrpath);
					//print_r($arrpath);	 
			?>
          <div> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" class="featured-products-items">
            <div class="featured-products-image">
              <?php if($p['img_names']!='') { ?>
              <?php 
									$imgs=explode("|",	$p['img_names']);
									$ind=0;
								 // foreach($imgs as $i ) {								  
								  ?>
              <img src="<?php echo img_base;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/base/<?php echo $imgs[0]; ?>" class="img-fluid" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" />
              <?php $ind++; //} ?>
              <?php }  else {  ?>
              <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" class="img-fluid" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" />
              <?php  } ?>
            </div>
            <span class="featured-products-name"><?php echo $p['product_name']; ?>
            <?php if($p['final_price']>0): ?>
            <?php if($p['totpent']>0): ?>
            <strong><?php echo PRICE_SYMBOL.number_format(round($p['final_orgprice']),2); ?></strong> <strong class="offerprice"><?php echo PRICE_SYMBOL. number_format(round($p['final_price_tax']),2); ?></strong>
            <?php ELSE : ?>
            <strong><?php echo PRICE_SYMBOL.number_format(round($p['final_price_tax']),2);  ?></strong>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            <strong ><?php echo $commondisplaylanguage['pricerequest'];?></strong>
            <?php ENDIF; ?>
            </span> </a>
            <button type="button" data-mdb-toggle="tooltip" title="<?php echo $commondisplaylanguage['addtocart'];?>" onclick="addtocart('<?php echo $p['product_id'];?>');" class="common-btn add-to-cart-btn"> <i class="flaticon-cart-bag"></i> </button>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
