<?php
//echo "<pre>"; print_r($getcheckoutproductlist); exit; 
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
		$helper->getStoreConfig();
	}
?>
 <div class=" cart bgwhite cartleftht" id="hidecheckouttable">
 <div class="table-responsive">
 <div class="orderhis">
								<div class="tbl-header ">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								        <col width="16%">
	  									<col width="9%">
										<col width="8%">
	  									<col width="9%"> 
										
										<col width="9%">
	  									<col width="17%">
	  									<col width="12%">
										
								        <tr>
								          <th>Product</th>
								          <th>Item Code</th>
										  <th>Hsn Code</th>
								          <th>Price (&#8377;)</th>
										
										  <th>GST (&#8377;) </th>
								          <th class="centrie">Quantity</th>
								          <th>Total (&#8377;)</th>
										
								        </tr>
								      </thead>
								    </table>
								  </div>
								  <div class="tbl-content scrlcnt tablewith-footer"  id="ordertab">
								    <table cellpadding="0" cellspacing="0" border="0">
								      <tbody>
								         <col width="16%">
	  									<col width="9%">
										<col width="8%">
	  									<col width="9%">
										
										<col width="9%">
	  									<col width="17%">
	  									<col width="12%">
										
									<?php 
									    $grandtotal=0;
										
										$disgranttotal=0;
											$childsid= $helper->getChildsId();
										$arrexcludecat=explode(",",$childsid);
										 foreach($getcheckoutproductlist as $productlist){
										       if(!in_array($productlist['categoryID'],$arrexcludecat)){
											$totaprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
											$disgranttotal+=$totaprice;
										       }
										 }	
										 $discount =0;
										
										 $discountslap =  $helper->chkDiscountSlap($disgranttotal);									
										$cnt=1;
									    foreach($getcheckoutproductlist as $productlist){
												
	                                    $img = explode('|',$productlist['img_names']);
			                            $imgpath =  $img[0];
										$cimgpath =$productlist['attr_images']; 
			                            $single_price = $productlist['final_price'];
			                            $prodprice = ($productlist['final_price'] * $productlist['product_qty']);
										$discount =0;
										if($discountslap['DiscountAmount']!=''){
										      if(!in_array($productlist['categoryID'],$arrexcludecat)){
												if($discountslap['DiscountType']==1){
												$discount = (($productlist['final_prod_attr'] * $productlist['product_qty'])*$discountslap['DiscountAmount'])/100;
												$prodprice = $prodprice-$discount;
												}
												else{
													$discount = $discountslap['DiscountAmount'];
													$prodprice = $prodprice-$discount;
												}
										      }
										}
									
										if( strtoupper($productlist['taxTyp'])=="P"){											
											$totaprice = $prodprice + (($prodprice * $productlist['taxRate'])/100);
										 }	
										 else if(strtoupper($productlist['taxTyp'])=="F"){
											$totaprice = $prodprice +  $productlist['taxRate'];
										 }
										else{
											$totaprice = $prodprice;
										}										
										$strAttr='';
										if($productlist['attr_values']!='')
										{
											$temparr=explode("||",$productlist['attr_values']);
											 $strAttr= "<p><small>".implode(" <br/>", $temparr)."</small></p>";
										}
										$arrpath=array();
										$helper->getProductPath($productlist['categoryID'],$arrpath);
										
                                        //printing options
										if($productlist['attr_price']==''){
											
											$printingoption = "N/A";
										}
										else{
											
											$printingoption = '<i class="fa fa-inr"></i> '.$productlist['attr_price'];
										}
										
									?>	
								        <tr>
								          <td>
								          		<?php if($productlist['IsCustomtool']==1){ ?>
											 <a data-fancybox="gallery<?php echo $cnt; ?>" href="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $productlist['CustomtoolImg']; ?>" class="prdsingle-inner">	
											 <span class="cartproimg">
								          
										 <img  src="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $productlist['CustomtoolImg']; ?>" alt="<?php echo $productlist['product_name']; ?>" class="img-responsive">
										 	</span>
											</a>
												<span class="tblimg-details">											
								          	 	<a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" class="cartprdname-link"> <?php echo $productlist['product_name']; ?></a>
												<a data-fancybox="gallery<?php echo $cnt; ?>"  href="<?php echo BASE_URL;?>uploads/finalcustomimg/<?php echo $productlist['CustomtoolImg']; ?>" class="viewcustom">View Customized</a>
												<?php echo $strAttr; ?>
										 </span>
										   
								           
										 <?php } else { 
										// if($cimgpath != ''){
										 ?>
										 
										 	<!--<a data-fancybox="gallery<?php echo $cnt; ?>" href="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/<?php echo  $cimgpath; ?>" alt="<?php echo $productlist['product_name']; ?>" class="prdsingle-inner">	
											<span class="cartproimg">
								         
								          		<img  src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/<?php echo  $cimgpath; ?>" alt="<?php echo $productlist['product_name']; ?>" class="img-responsive">
										
								          	</span>
											</a>-->
                                            <?php //}else
											if($imgpath != ''){
										 ?>
										 
										 	<a data-fancybox="gallery<?php echo $cnt; ?>" href="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $productlist['product_name']; ?>" class="prdsingle-inner">	
											<span class="cartproimg">
								         
								          		<img  src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $productlist['product_name']; ?>" class="img-responsive">
										
								          	</span>
											</a>
                                            <?php }else{?>
                                            <span class="cartproimg">
								         
								          		<img  src="<?php echo BASE_URL;?>uploads/noimage/photos/thumb/noimage.png" alt="<?php echo $productlist['product_name']; ?>" class="img-responsive">
										
								          	</span>
                                            <?php }?>
								          	<span class="tblimg-details">											
								          	
												<a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" class="cartprdname-link"> <?php echo $productlist['product_name']; ?></a>
												<?php echo $strAttr; ?>
										  	
								          	</span>
											
								          		
										 <?php } ?>	
								        
											
										
								          </td>
								          <td><?php echo $productlist['sku']; ?></td>
										  <td><?php echo $productlist['hsncode']; ?></td>
								          <td><i class="fa fa-inr"></i> <?php echo number_format(round($productlist['final_prod_attr']),2); ?></td>
										
										  
										  <td><i class="fa fa-inr"></i> <?php echo number_format(round($productlist['taxmat']),2); ?></td>
								          <td>
									    <div class="quantity">
										<div  class="quantity-button quantity-down">-</div>
										   <input type="number" id="prices1_<?php echo $productlist['cart_product_id']; ?>" min="<?php echo $productlist['minquantity']; ?>"  onmousemove="" onkeydown="numberkeyvalid(event);"  onblur="quantity_inc_dec(this.value,<?php echo $productlist['cart_product_id']; ?>);" step="1" value="<?php echo $productlist['product_qty']; ?>">
										<div class="quantity-button quantity-up">+</div>
									</div>
										  </td>
								          <td><i class="fa fa-inr"></i> <?php echo number_format(round($totaprice),2);  ?></td>	
											
								        </tr>
									<?php $grandtotal += $totaprice;  $cnt++; } ?>
										
								      </tbody>
								    </table>
								  </div>
								   </div>
								   </div>
								  <div id="divordersummarytab" class="pricetab-wrpaer">
				            <?php
						      include("ordersummarytab.php");
				            ?>
                          
							</div>
							
							
			               </div>
<script src="<?php echo BASE_URL; ?>static/js/jquery.min.js"></script>
<script>

$(function(){
	
	
$('.quantity').each(function () {
			var spinner = $(this),
				input = spinner.find('input[type="text"]'),
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