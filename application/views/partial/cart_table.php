<?php
			if ( ($helper instanceof common_function) != true ) {
					$helper=$this->loadHelper('common_function');
					$helper->getStoreConfig();
				}
		 
if(count($addtocartlist)>0){   ?>

<div class="table-responsive">
  <div id="cartpage" class="carttab-wraper">
    <table id="cart-table" class="table cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price (<?php echo PRICE_SYMBOL;?>)</th>
          <th>GST (<?php echo PRICE_SYMBOL;?>)</th>
          <th class="centrie">Quantity</th>
          <th>Total (<?php echo PRICE_SYMBOL;?>)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $grandtotal=0; 
										
										$disgranttotal=0;
										$totorgprice=0;
										//echo "<pre>"; print_r($addtocartlist); exit;
										$childsid= $helper->getChildsId();
										$arrexcludecat=explode(",",$childsid);
										 foreach($addtocartlist as $cartlist){
											  //print_r($cartlist); die(); 
											 
											 if(!in_array($cartlist['categoryID'],$arrexcludecat)){
											$totaprice = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
											$disgranttotal+=$totaprice;
											 }
										 }	
										 $discount =0;
										
										//print_r($childsid); die();
										 $discountslap =  $helper->chkDiscountSlap($disgranttotal);	
										$cnt=1;
										foreach($addtocartlist as $cartlist){ 
																		
			                            $img = explode('|',$cartlist['img_names']);
			                            $imgpath =  $img[0];
										
										$cimgpath =$cartlist['attr_images']; 
										
										
			                            $single_price = $cartlist['final_price']; 
			                            $prodprice = ($cartlist['final_price'] * $cartlist['product_qty']);
										$orgprodprice  = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
										$discount =0;
										if($discountslap['DiscountAmount']!=''){	
										  	 if(!in_array($cartlist['categoryID'],$arrexcludecat)){	
												if($discountslap['DiscountType']==1){
												$discount = ($orgprodprice*$discountslap['DiscountAmount'])/100;
												$prodprice = $prodprice-$discount;
												}
												else{
													$discount = $discountslap['DiscountAmount'];
													$prodprice = $prodprice-$discount;
												} 
											 }
										}
									  
										if( strtoupper($cartlist['taxTyp'])=="P"){											
											$totaprice = $prodprice + (($prodprice * $cartlist['taxRate'])/100);
										 }	
										 else if(strtoupper($cartlist['taxTyp'])=="F"){
											$totaprice = $prodprice +  $cartlist['taxRate'];
										 }
										else{
											$totaprice = $prodprice;
										}	
										$strAttr='';
										if($cartlist['attr_values']!='')
										{
											$temparr=explode("||",$cartlist['attr_values']);
											 $strAttr= "<p><small>".implode(" <br/>", $temparr)."</small></p>";
										}
										$arrpath=array();
										$helper->getProductPath($cartlist['categoryID'],$arrpath);
										
			                            ?>
        <tr>
          <td><?php if($cartlist['IsCustomtool']==1){} else { ?>
            <a  href="<?php echo $helper->pathrevise($arrpath).'/'.$cartlist['product_url']; ?>" class="cart-items">
            <?php 
			if($imgpath != ''){?>
            <img src="<?php echo img_base;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $cartlist['product_name']; ?>"  class="img-fluid" />
            <?php }
				else{?>
            <img src="<?php echo img_base;?>uploads/noimage/photos/noimage.png" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" class="img-fluid"/>
            <?php }?>
            <span><strong><?php echo $cartlist['product_name']; ?></strong>SKU #<?php echo $cartlist['sku']; ?></span> <?php echo $strAttr; ?> </a>
            <?php } ?></td>
          <td><?php echo PRICE_SYMBOL;?><?php echo number_format(round($cartlist['final_prod_attr']),2); ?></td>
          <td><?php echo PRICE_SYMBOL;?><?php echo number_format(round($cartlist['taxmat']),2); ?></td>
          <td>
            <div class="input-group quantity-buttons">
                              <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus qty2"  data-type="minus" data-field="">
                              <span class="flaticon-minus-2"></span>
                              </button>
                              </span>
                              <input type="text" id="prices1_<?php echo $cartlist['cart_product_id']; ?>" min="<?php echo $cartlist['minquantity']; ?>" onkeydown="numberkeyvalid(event);"  onmousemove="" onblur="quantity_inc_dec_cart(this.value,<?php echo $cartlist['cart_product_id']; ?>);" value="<?php echo $cartlist['product_qty']; ?>" class="form-control input-number" >
                              <span class="input-group-btn">
                              <button type="button" class="quantity-right-plus qty2" data-type="plus" data-field="">
                              <span class="flaticon-plus-1"></span>
                              </button>
                              </span>
                           </div>
                           
           </td>
          <td><?php echo PRICE_SYMBOL;?><?php echo number_format(round($totaprice),2); ?></td>
          <td><input type="hidden" id="productid" value="<?php echo $cartlist['cart_product_id']; ?>" >
            <a href="javascript:void(0);" onclick="deletecartpagelist(<?php echo $cartlist['cart_product_id']; ?>);">
            <button class="cart-close-btn" type="button"><i class="flaticon-cancel-12"></i></button>
            </a></td>
        </tr>
        <?php 
										 $grandtotal += $totaprice;
										 $cnt++;
			                             } ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4" class="text-right"> <strong>SUB TOTAL</strong> </th>
          <th class="text-right"> <strong>$ <?php echo number_format(round($grandtotal),2); ?></strong> </th>
          <th>&nbsp; </th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<p class="cart-buttons">
  <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>';"> Continue Shopping </button>
  <button type="button" class="buy-now-btn1" onclick="location.href='<?php echo BASE_URL; ?>checkout/';"> Proceed to Checkout </button>
</p>
<?php  } else { ?>
<div class="cartamount-wraper text-center">There are no items in the Cart. Would you like to add now?</div>
<span>
<p class="cart-buttons text-center">
  <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>';"> Continue Shopping </button>
</p>
</span>
<?php } ?>