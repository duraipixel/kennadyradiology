<?php if(count($recentviewproduct['prod_list'])>0){

	 ?>

<section class="best-seller">
  <div class="container">
    <div class="best-title">
      <h2 class="main-title-dark">recently viewed list</h2>
    </div>
    <div class="best-seller-wrap">
      <div class="seller-slider">
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



$imgs = '';
	  foreach($recentviewproduct['prod_list'] as $recentpro){
		  $productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$recentpro['product_url']);
				$arrpath=array();
				//print_r($p);
				 $helper->getProductPath($recentpro['categoryID'],$arrpath);
				
		  $imgs=explode("|",$recentpro['img_names']);
		  ?>
        <div>
          <div class="sell-wrap">
            <?php if($imgs[0] != ''){?>
            <a href="<?php echo $helper->pathrevise($arrpath).'/'.$recentpro['product_url']; ?>" > <img src="<?php echo img_base;?>uploads/productassest/<?php echo $recentpro['product_id']; ?>/photos/base/<?php echo $imgs[0]; ?>" alt=""></a>
            <?php }else{?>
            <a href="<?php echo $helper->pathrevise($arrpath).'/'.$recentpro['product_url']; ?>" > <img src="<?php echo img_base;?>uploads/noimage/photos/base/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></a>
            <?php }?>
            <div class="seller-content"> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$recentpro['product_url']; ?>" >
              <h4><?php echo $recentpro['product_name']; ?></h4>
              </a>
              <h6>
                <?php if($recentpro['final_price']>0): ?>
                <?php if($recentpro['totpent']>0): ?>
                <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($recentpro['final_orgprice']),2); ?></span> <span class="offerprice"><i class="fa fa-inr"></i> <?php echo  number_format(round($recentpro['final_price_tax']),2); ?></span>
                <?php ELSE : ?>
                <span class="offerprice"><i class="fa fa-inr"></i> <?php echo number_format(round($recentpro['final_price_tax']),2);  ?></span>
                <?php ENDIF; ?>
                <?php ELSE : ?>
                <span class="offerprice">Price on Request</span>
                <?php ENDIF; ?>
              </h6>
			  
			  <a href="window.location.href='<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>'" class="common-btn white-btn mt-3">View </a>
			  
			  
			  <?php 
							if($recentpro['isbuynow'] == 0){?>
             <!-- <a  onclick="addtocart('<?php echo $recentpro['product_id'];?>');" href="javascript:void(0)" class="common-btn white-btn mt-3">Add to cart</a>-->
							<?php }else{?>
							
							<!--<a href="window.location.href='<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>'" class="common-btn white-btn mt-3">View </a>-->
							<?php }?>
							</div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</section>
<?php }?>
