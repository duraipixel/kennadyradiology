  <?php 
   
$max_dp = ($productdetails['final_price']*$getmaximum_dp['max_discnt_slap'])/100;
$maxdiscountamtfp = ($productdetails['final_price'] - $max_dp);

  ?>	
 <?php if($productdetails['soldout']==0) : ?>

  <?php if($productdetails['totpent']>0): ?>
          <p class="offerspan"><?php echo $productdetails['totpent']; ?>%</p>
          <?php ENDIF; ?>
        
            <?php if($productdetails['final_price']>0): ?>
            <?php if($productdetails['totpent']>0): ?>
         <s><?php echo PRICE_SYMBOL;?>&nbsp;<?php echo number_format(round($productdetails['final_orgprice']),2);  ?></s> 
 <?php echo PRICE_SYMBOL.'&nbsp;'.number_format(round($productdetails['final_price_tax']),2); ?> 

            <?php ELSE : ?>
           <?php echo PRICE_SYMBOL.'&nbsp;'.number_format(round($productdetails['final_price_tax']),2);  ?> 
            <?php ENDIF; ?>
            <?php ELSE : ?>
            --
            <?php ENDIF; ?>
            
         
          
       <!--   <small>* <?php //echo $detaildisplaylanguage['inclusive'];?></small>-->
 		
		
 <?php ENDIF; ?>