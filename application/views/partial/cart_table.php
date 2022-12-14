<?php
			if ( ($helper instanceof common_function) != true ) {
					$helper=$this->loadHelper('common_function');
					$helper->getStoreConfig();
				}
		 
if(count($addtocartlist)>0){   
  
  ?>

<div class="table-responsive">
  <div id="cartpage" class="carttab-wraper">
    <table id="cart-table" class="table cart-table">
      <thead>
        <tr>
          <th><?php echo $cartdisplaylanguage['cartproduct'];?></th>        
          <th><?php echo $cartdisplaylanguage['cartprice'];?> (<?php echo PRICE_SYMBOL;?>)</th>         
          <th class="centrie"><?php echo $commondisplaylanguage['quantity'];?></th>
          <th><?php echo $commondisplaylanguage['carttotal'];?> (<?php echo PRICE_SYMBOL;?>)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $grandtotal=0; 
										
        $disgranttotal=0;
        $totorgprice=0;
        
        $childsid= $helper->getChildsId();
        $arrexcludecat=explode(",",$childsid);

        foreach($addtocartlist as $cartlist) {          
            
          if(!in_array($cartlist['categoryID'],$arrexcludecat)){
            $totaprice = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
            $disgranttotal+=$totaprice;
          }

        }	
        $discount     = 0;	
        $discountslap =  $helper->chkDiscountSlap($disgranttotal);	
        $cnt          = 1;
        foreach($addtocartlist as $cartlist){ 	
          // echo '<pre>'																	;
          // print_r( $cartlist );
          $img            = explode('|',$cartlist['img_names']);
          $imgpath        = $img[0];										
          $cimgpath       = $cartlist['attr_images'];
          $single_price   = $cartlist['final_price']; 
          $cartProductAmount = $cartlist['cartProductAmount'];

          $prodprice      = ($cartProductAmount * $cartlist['product_qty']);

          $orgprodprice   = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
          $discount       = 0;
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
          $product_link = BASE_URL.'products/'.$cartlist['categoryCode'].'/'.$cartlist['product_url'];				
			  ?>
        <tr>
          <td><?php if($cartlist['IsCustomtool']==1){} else { ?>
            <a  href="<?php echo $product_link; ?>" class="cart-items">
            <?php 
			if($imgpath != ''){?>
            <img src="<?php echo img_base;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $cartlist['product_name']; ?>"  class="img-fluid" />
            <?php }
				else{?>
            <img src="<?php echo img_base;?>uploads/noimage/photos/noimage.png" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" class="img-fluid"/>
            <?php }?>
            <span><strong><?php echo $cartlist['product_name']; ?></strong>SKU #<?php echo $cartlist['sku']; ?></span> <?php echo $strAttr; ?> </a>
            <?php } ?></td>
			  <!--<td><?php //echo $cartlist['item_code']; ?></td>-->
          <td><?php echo PRICE_SYMBOL;?><?php echo number_format($cartProductAmount,2); ?></td>
         <td>
		  <div class="input-group quantity-buttons">
        <span class="input-group-btn">
          <button type="button" onClick="qtyremove(<?php echo $cartlist['cart_product_id']; ?>)" class="quantity-left-minus"  data-type="minus" data-field="">
            <span class="flaticon-minus-2"></span>
          </button>
        </span>
            <input type="text" class="form-control input-number chkqtydetail" id="prices1_<?php echo $cartlist['cart_product_id']; ?>" min="<?php echo $cartlist['minquantity']; ?>" onChange="" onMouseMove="" onKeyPress="return validateQty(event);" onKeyDown="numberkeyvalid(event);" onBlur="chkqtydetail()"  max="100" value="<?php echo $cartlist['product_qty']; ?>" >


        <span class="input-group-btn">
          <button type="button" onClick="qtyaddition(<?php echo $cartlist['cart_product_id']; ?>)" class="quantity-right-plus" data-type="plus" data-field="">
            <span class="flaticon-plus-1"></span>
          </button>
        </span>
      </div>
           </td>
          <td><?php echo PRICE_SYMBOL;?><?php echo number_format($prodprice,2); ?></td>
          <td>
            <input type="hidden" id="productid" value="<?php echo $cartlist['cart_product_id']; ?>" >
            <a href="javascript:void(0);" onclick="deletecartpagelist(<?php echo $cartlist['cart_product_id']; ?>);">
            <button class="cart-close-btn" type="button"><i class="flaticon-cancel-12"></i></button>
            </a></td>
        </tr>
        <?php 
          $grandtotal += $prodprice;
          $cnt++;
			  } ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-right"> <strong><?php echo $cartdisplaylanguage['cartsubtotal'];?></strong> </th>
          <th colspan="2" class="text-left"> <strong><?php echo PRICE_SYMBOL;?> <?php echo number_format($grandtotal,2); ?></strong> </th>
          <th>&nbsp; </th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<p class="cart-buttons">
  <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>';"> <?php echo $cartdisplaylanguage['cartshopping'];?></button>
  <button type="button" class="buy-now-btn1" onclick="location.href='<?php echo BASE_URL; ?>checkout/';"> <?php echo $cartdisplaylanguage['cartcheckout'];?> </button>
</p>

<?php  } else { ?>
<div class="cartamount-wraper text-center mb-3">
<div class="row justify-content-center">
<div class="col-sm-12 col-md-8 col-lg-6 col-xl-4">	
<img src="<?php echo img_base; ?>static/images/empty_cart.jpg" class="img-fluid">
<p class="h3 mb-4"><?php echo $commondisplaylanguage['nocartitem'];?></p>
</div>
</div>
</div>

<span>
<p class="cart-buttons text-center">
  <button type="button" class="add-to-cart-btn1" onclick="location.href='<?php echo BASE_URL; ?>';"> <?php echo $cartdisplaylanguage['cartshopping'];?> </button>
</p>
</span>
<?php } ?>

<script>
function qtyaddition(id){

  var quantitiy   = 1;
  var quantity    = parseInt($('#prices1_'+id).val());
  quantity        = quantity + 1;
  $('#prices1_'+id).val(quantity);
  quantity_inc_dec_cart(quantity,id);
      
}

function qtyremove(id){
     
  var quantity  = parseInt($('#prices1_'+id).val());
  quantity      = quantity - 1;
        
  if(quantity>0){
    $('#prices1_'+id).val(quantity);
  }
  quantity_inc_dec_cart(quantity,id);

}
</script>