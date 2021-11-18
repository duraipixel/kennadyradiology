<?php
			if ( ($helper instanceof common_function) != true ) {
					$helper=$this->loadHelper('common_function');
					$helper->getStoreConfig();
				}
			
				
?>				                 <?php if(count($addtocartlist)>0){


                        if($_SESSION['cus_group_id']=='2'){
                     	?>

					<div class="form-group text-right "> 
					
					<a target="_blank" href="<?php echo BASE_URL;?>ajax/Downloadpdfcatalog"><button class="btn btn-default cartproceedbtn">Download Catalogue</button></a>
					
					</div>
						<?php } ?>
				
                                   	<div class="table-responsive">
                                   	<div class="orderhis">
                                   	<div class="tbl-header">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="16%">
	  									<col width="7%">
										<col width="7%">
	  									<col width="9%">
										<col width="9%">
										<col width="9%">
	  									<col width="12%">
	  									<col width="11%">
	  									<col width="12%">
	  									<col width="7%">
								        <tr>
								          <th>Product</th>
								          <th>Item Code</th>
										  <th>HSN Code</th>
								          <th>Price (&#8377;)</th>
										  <th>Printing (&#8377;)</th>
										  <th>GST (&#8377;) <small>(before discount)</small></th>
								          <th>Quantity</th>
								          <th>Total (&#8377;)</th>
										  <th>Discount (&#8377;)</th>
								          <th></th>
								        </tr>
								      </thead>
								    </table>
								  </div>

								  <div class="tbl-content scrlcnt"  id="ordertab">
								    <table cellpadding="0" cellspacing="0" border="0">
								      <tbody>
								      	<col width="16%">
	  									<col width="7%">
										<col width="7%">
	  									<col width="9%">
										<col width="9%">
										<col width="9%">
	  									<col width="12%">
	  									<col width="11%">
	  									<col width="12%">
	  									<col width="7%">
										<?php $grandtotal=0; 
										
										$disgranttotal=0;
										$totorgprice=0;
										//echo "<pre>"; print_r($addtocartlist); exit;
										 foreach($addtocartlist as $cartlist){
											$totaprice = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
											$disgranttotal+=$totaprice;
										 }	
										 $discount =0;
										 $discountslap =  $helper->chkDiscountSlap($disgranttotal);	
										$cnt=1;
										foreach($addtocartlist as $cartlist){ 
																		
			                            $img = explode('|',$cartlist['img_names']);
			                            $imgpath =  $img[0];
			                            $single_price = $cartlist['final_price']; 
			                            $prodprice = ($cartlist['final_price'] * $cartlist['product_qty']);
										$orgprodprice  = ($cartlist['final_prod_attr'] * $cartlist['product_qty']);
										$discount =0;
										if($discountslap['DiscountAmount']!=''){												
												if($discountslap['DiscountType']==1){
												$discount = ($orgprodprice*$discountslap['DiscountAmount'])/100;
												$prodprice = $prodprice-$discount;
												}
												else{
													$discount = $discountslap['DiscountAmount'];
													$prodprice = $prodprice-$discount;
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
										
										//printing options
										if($cartlist['attr_price']==''){
											
											$printingoption = "N/A";
										}
										else{
											
											$printingoption = ' <i class="fa fa-inr"></i>'.$cartlist['attr_price'];
											//$totaprice = $totaprice+$printingoption;
										}
			                            ?>
								        <tr>
										  
								          <td>
										  <?php if($cartlist['IsCustomtool']==1){ ?>
								          <a data-fancybox="gallery<?php echo $cnt; ?>"  href="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $cartlist['CustomtoolImg']; ?>" class="prdsingle-inner">	
										  
										  <span class="cartproimg">
										 
										 <img src="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $cartlist['CustomtoolImg']; ?>" alt="<?php echo $cartlist['product_name']; ?>">
										 </span>
										  </a>
										 <span class="tblimg-details">
								          		<a href="<?php echo $helper->pathrevise($arrpath).'/'.$cartlist['product_url']; ?>" class="cartprdname-link"><?php echo $cartlist['product_name']; ?></a>
												<a data-fancybox="gallery<?php echo $cnt; ?>"  href="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $cartlist['CustomtoolImg']; ?>" class="viewcustom">View Customized</a>
												<?php echo $strAttr; ?>
										  
								          	</span>
										
										 <?php } else { ?>
										 
										 
											  <a data-fancybox="gallery<?php echo $cnt; ?>"  href="<?php echo BASE_URL;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" class="prdsingle-inner">	
										  
										  <span class="cartproimg">
										
								          		<img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $cartlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $cartlist['product_name']; ?>">
										 
								          	</span>
											</a>
										 <span class="tblimg-details">
								          		
												<a href="<?php echo $helper->pathrevise($arrpath).'/'.$cartlist['product_url']; ?>" class="cartprdname-link"><?php echo $cartlist['product_name']; ?></a>
												<?php echo $strAttr; ?>
										   
										  
								          	</span>
											
								          		
										 <?php } ?>	
								          	
									
											
											
											
								          </td>
								          <td><?php echo $cartlist['sku']; ?></td>
										  <td><?php echo $cartlist['hsncode']; ?></td>
								          <td><i class="fa fa-inr"></i> <?php echo number_format($cartlist['final_prod_attr'],2); ?> </td>
										   <td><?php echo $printingoption; ?></td>
										   <td> <i class="fa fa-inr"></i> <?php echo number_format($cartlist['taxmat'],2); ?></td>
								          <td>
										
										   <div class="quantity">
										<div  class="quantity-button quantity-down">-</div>
										<input type="number" id="prices1_<?php echo $cartlist['cart_product_id']; ?>" min="<?php echo $cartlist['minquantity']; ?>" onkeydown="numberkeyvalid(event);"  onmousemove="" onblur="quantity_inc_dec_cart(this.value,<?php echo $cartlist['cart_product_id']; ?>);" step="1" value="<?php echo $cartlist['product_qty']; ?>">
										<div class="quantity-button quantity-up">+</div>
									</div>
										  
										  </td>
								          <td><i class="fa fa-inr"></i><?php echo number_format($totaprice,2); ?></td>
										    <td><?php if($discount>0) {
												echo "<small>You Saved</small></br> <i class='fa fa-inr'></i> ". number_format($discount,2) ."(" . $discountslap['DiscountAmount']. "%)"; 
												} 
												else{
													echo "N/A"; 
													}
												?></td>		
								          <td>
										  <input type="hidden" id="productid" value="<?php echo $cartlist['cart_product_id']; ?>" >
										  <a href="javascript:void(0);" onclick="deletecartpagelist(<?php echo $cartlist['cart_product_id']; ?>);"><img src="<?php echo BASE_URL; ?>static/images/close.png"></a></td>
								        </tr>
										<?php 
										 $grandtotal += $totaprice;
										 $cnt++;
			                             } ?>
								      </tbody>
								    </table>
								  </div>
								  </div>
								  </div>
								  
								  	<div class="tblbtmpad">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="70%">
	  									<col width="30%">
								        <tr>
								          <th>
								          	<span>
								          		<a href="<?php echo BASE_URL; ?>"><button class="btn btn-default">Continue Shopping</button></a>
								          	</span>
								          	<span>
								          		<a href="<?php echo BASE_URL; ?>checkout"><button class="btn btn-default cartproceedbtn">Proceed to Checkout</button></a>
								          	</span>
								          </th>
								          <th>
								          	<span class="totaltxt">
								          		Total : 
								          	</span>
								          	<span class="totalamt">
								          		<i class="fa fa-inr"></i> <?php echo number_format($grandtotal,2); ?>
								          	</span>
								          </th>
								        </tr>
								      </thead>
								    </table>
								  </div>
                                <?php  } else { ?>
								<div class="cartamount-wraper text-center">There are no items in the Cart. Would you like to add now?</div>
								 	<span>
								        <a href="<?php echo BASE_URL; ?>"><button class="btn btn-default">Continue Shopping</button></a>
								    </span>
								<?php } ?>
<script src="<?php echo BASE_URL; ?>static/js/jquery.min.js"></script>
<script>

$(function(){
	
	
$('.quantity').each(function () {
			var spinner = $(this),
				input = spinner.find('input[type="number"]'),
				btnUp = spinner.find('.quantity-up'),
				btnDown = spinner.find('.quantity-down'),
				min = input.attr('min'),
				max = input.attr('max'),
				step = parseFloat(input.attr('step'));
			//	console.log(step);

			btnUp.click(function () {
				//console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue >= max) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue + step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("blur");
			});

			btnDown.click(function () {
				//	console.log(step);
				var oldValue = parseFloat(input.val());
				if (oldValue <= min) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue - step;
				}
				spinner.find("input").val(newVal);
				spinner.find("input").trigger("blur");
			});

		});
	
});	

</script>								