<?php
			if ( ($helper instanceof common_function) != true ) {
					$helper=$this->loadHelper('common_function');
					$helper->getStoreConfig();
				}
?>				                 <?php if(count($addtowishlist)>0){ ?>
                                   	<div class="tbl-header table-responsive">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="25%">
	  									<col width="15%">
	  									<col width="15%">
	  									<col width="15%">
	  									<col width="10%">
	  									<col width="10%">
										<col width="10%">
								        <tr>
								          <th>Product</th>
								          <th>Item Code</th>
								          <th>Price</th>
								          <th>Quantity</th>
								          <th>Total</th>
								          <th></th>
										  <th></th>
								        </tr>
								      </thead>
								    </table>
								  </div>

								  <div class="tbl-content scrlcnt"  id="ordertab">
								    <table cellpadding="0" cellspacing="0" border="0">
								      <tbody>
								      	<col width="25%">
	  									<col width="15%">
	  									<col width="15%">
	  									<col width="15%">
	  									<col width="10%">
	  									<col width="10%">
										<col width="10%">
										<?php $grandtotal=0; 
										foreach($addtowishlist as $cartlist){ 
			                            $img = explode('|',$cartlist['img_names']);
			                            $imgpath =  $img[0];
			                            $single_price = $cartlist['final_price'];   
			                            $totaprice = ($single_price * $cartlist['product_qty']);
										$cnt=1;
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
										  
								          <td>
								          <a data-fancybox="gallery<?php echo $cnt; ?>" href="<?php echo img_base;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" class="prdsingle-inner">		
										  <span class="cartproimg">
								          		<img src="<?php echo img_base;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="">
								          	</span>
										</a>
								          	<span class="tblimg-details">
								          		<a class="cartprdname-link" href="<?php echo $helper->pathrevise($arrpath).'/'.$cartlist['product_url']; ?>" class="prdsingle-inner"><?php echo $cartlist['product_name']; ?></a>
												<?php echo $strAttr; ?>
								          	</span>
											
								          </td>
								          <td><?php echo $cartlist['sku']; ?></td>
								          <td><i class="fa fa-inr"></i> <?php echo $single_price; ?> </td>
								          <td><?php echo $cartlist['product_qty']; ?></td>
								          <td><i class="fa fa-inr"></i><?php echo $totaprice; ?></td>
										  <td>
										  <input type="hidden" id="prices1" value="<?php echo $cartlist['product_qty']; ?>" />
										 <?php if($cartlist['soldout']==1) { ?>
										 <a href="javascript:void(0);" class="btn buynow-btn" disabled="disabled" ><span>Move to Cart</span> </a><br/> Stock Out 
										 
										 <?php } else { ?>
										  <a href="javascript:void(0);" class="btn buynow-btn" onclick="addtocart('<?php echo $cartlist['product_id'];?>','<?php echo $cartlist['cart_product_id'];?>','wishlist');"><span>Move to Cart</span></a>
										 <?php } ?> 
										  </td>
								          <td>
										  <input type="hidden" id="productid" value="<?php echo $cartlist['cart_product_id']; ?>" >
										  <a href="javascript:void(0);" onclick="deletewishlistpage();"><img src="<?php echo img_base; ?>static/images/close.png"></a></td>
								        </tr>
										<?php 
										 $grandtotal += $totaprice; $cnt++;
			                             } ?>
								      </tbody>
								    </table>
								  </div>
								  
								  	<div class="tbl-header table-responsive tblbtmpad">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="70%">
	  									<col width="30%">
								        <tr>
								          <th>
								          	<span>
								          		<a href="<?php echo img_base; ?>"><button class="btn btn-default">Continue Shopping</button></a>
								          	</span>

								          </th>
								          <th>
								          	<span class="totaltxt">
								          		Total : 
								          	</span>
								          	<span class="totalamt">
								          		<i class="fa fa-inr"></i> <?php echo $grandtotal; ?>
								          	</span>
								          </th>
								        </tr>
								      </thead>
								    </table>
								  </div>
                                <?php } else { ?>
								<div class="cartamount-wraper text-center">There are no items in the Wishlist. Why don’t you add now?</div>
								 	<span>
								        <a href="<?php echo BASE_URL; ?>"><button class="btn btn-default ">Continue Shopping</button></a>
								    </span>
								<?php } ?>