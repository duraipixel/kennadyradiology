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
         <h5><s><?php echo PRICE_SYMBOL;?><?php echo number_format(round($productdetails['final_orgprice']),2);  ?></s></h5>

<h5><?php echo PRICE_SYMBOL. number_format(round($productdetails['final_price_tax']),2); ?></h5>

            <?php ELSE : ?>
          <h5> <?php echo PRICE_SYMBOL. number_format(round($productdetails['final_price_tax']),2);  ?></h5>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            --
            <?php ENDIF; ?>
            
          </p>
          
          <small>* <?php echo $detaildisplaylanguage['inclusive'];?></small>
 		
		
 <?php ENDIF; ?>