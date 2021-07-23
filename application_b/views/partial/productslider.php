<?php if(count($products)>0){ ?>

<section class="best-seller">
  <div class="container">
    <div class="best-title">
      <h2 class="main-title-dark"><?php echo $title; ?></h2>
      <h3 class="sub-title-dark"><?php echo $subtitle;?></h3>
    </div>
    <div class="best-seller-wrap">
      <div class="seller-slider"> 
        <!-- start loop -->
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


				foreach($products as $p) {  
			
				$productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$p['product_url']);
				$arrpath=array();
				//print_r($p);
				$helper->getProductPath($p['categoryID'],$arrpath);
					//print_r($arrpath);	 
			?>
        <div>
          <div class="sell-wrap">
            <?php if($p['img_names']!='') { ?>
            <?php 
									$imgs=explode("|",	$p['img_names']);
									$ind=0;
								 // foreach($imgs as $i ) {								  
								  ?>
            <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" ><img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/base/<?php echo $imgs[0]; ?>" class="img-responsive center-block prdimg img-responsive prd-im" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></a>
            <?php $ind++; //} ?>
            <?php }  else {  ?>
            <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" > <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></a>
            <?php  } ?>
            <div class="seller-content"> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" >
              <h4><?php echo $p['product_name']; ?></h4>
              <h6>
                <?php if($p['final_price']>0): ?>
                <?php if($p['totpent']>0): ?>
               <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($p['final_orgprice']),2); ?></span> <span class="offerprice"><i class="fa fa-inr"></i> <?php echo  number_format(round($p['final_price_tax']),2); ?></span> 
                <?php ELSE : ?>
                <span class="offerprice"><i class="fa fa-inr"></i> <?php echo number_format(round($p['final_price_tax']),2);  ?></span>
                <?php ENDIF; ?>
                <?php ELSE : ?>
                <span class="offerprice">Price on Request</span>
                <?php ENDIF; ?>
              </h6>
			  <button class="common-btn white-btn">Add to Cart</button>
              </a> </div>
          </div>
        </div>
        <?php }?>
        <!-- end loop --> 
      </div>
    </div>
  </div>
</section>
<?php } ?>
