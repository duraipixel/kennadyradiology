  <?php 
   
$max_dp = ($productdetails['final_price']*$getmaximum_dp['max_discnt_slap'])/100;
$maxdiscountamtfp = ($productdetails['final_price'] - $max_dp);

  ?>	
 <?php if($productdetails['soldout']==0) : ?>

  <?php if($productdetails['totpent']>0): ?>
          <p class="offerspan"><?php echo $productdetails['totpent']; ?>%</p>
          <?php ENDIF; ?>
          <p class="product-details-price">
            <?php if($productdetails['final_price']>0): ?>
            <?php if($productdetails['totpent']>0): ?>
          <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($productdetails['final_orgprice']),2);  ?></span>  <i class="fa fa-inr"></i> <?php echo  number_format(round($productdetails['final_price_tax']),2); ?> 
            <?php ELSE : ?>
          <i class="fa fa-inr"></i> <?php echo number_format(round($productdetails['final_price_tax']),2);  ?>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            --
            <?php ENDIF; ?>
            
          </p>
          
          <small>* Inclusive of GST</small>
 			<?php if($productdetails['totpent']>0): ?>		
 			<?php ELSE : ?>
  		   <?php ENDIF; ?>
 <?php ENDIF; ?>