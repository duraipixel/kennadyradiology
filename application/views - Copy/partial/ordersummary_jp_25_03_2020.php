<?php
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	$granttotal=0;
	 foreach($getcheckoutproductlist as $productlist){
		$totaprice = ($productlist['final_price_tax'] * $productlist['product_qty']);
		$granttotal+=$totaprice;
	 }	

	
?>
<div class="orderhis cart cartrt bgwhite cartleftrt">
								<div class="tbl-header table-responsive">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="100%">
								        <tr>
								          <th>Cart Summary</th>
								        </tr>
								      </thead>
								    </table>
								  </div>
								  <div class="tbl-content mb30 lastd"  id="ordertab">
								    <table cellpadding="0" cellspacing="0" border="0">
								      <tbody>
								      	<col width="55%">
	  									<col width="45%">
										<tr>
								          <td>Price (<?php echo $noofitem;?> items)</td>
								          <td><i class="fa fa-inr"></i> <?php echo $granttotal ?></td>
								        </tr>
										<?php if($_SESSION['Couponamount']!='' && $_SESSION['Couponamount']!='null'){
											 $granttotal = $granttotal-$_SESSION['Couponamount'];
											?>
								        <tr>
								          <td>Coupon Discount(-)</td>
								          <td><i class="fa fa-inr"></i> <?php echo $_SESSION['Couponamount']; ?></td>
								        </tr> 
										<?php }
										$discountslap =  $helper->chkDiscountSlap($granttotal);
										//echo "<pre>"; print_r($discountslap); exit;
										if($discountslap['DiscountAmount']!=''){
											
											if($discountslap['DiscountType']==1){
                                            $discount = ($granttotal*$discountslap['DiscountAmount'])/100;
											$granttotal = $granttotal-$discount;
											}
											else{
												$discount = $discountslap['DiscountAmount'];
											    $granttotal = $granttotal-$discount;
											}
										?>
										 <tr>
								          <td>Discount Slab(-)</td>
								          <td><i class="fa fa-inr"></i> <?php echo $discount; ?></td>
								        </tr> 
										<?php } 
                                           
										if(!empty($_SESSION['shippingCost']) && isset($_SESSION['shippingCost'])){
											if($_SESSION['pricetype']==1){
                                            $shippingcharge = ($granttotal*$_SESSION['shippingCost'])/100;
											$granttotal = $granttotal+$shippingcharge;
											}
											else{
												$shippingcharge = $_SESSION['shippingCost'];
											    $granttotal = $granttotal+$shippingcharge;
											}
											 
											?>
										 <tr>
								          <td>Shipping Charge(+)</td>
								          <td><i class="fa fa-inr"></i> <?php echo $shippingcharge; ?></td>
								        </tr> 
										<?php } ?>

								      </tbody>
								    </table>
								  </div>
								  <?php $_SESSION['granttotal'] = $granttotal; ?>
								  <div class="tbl-header tblhed table-responsive ftrfnt">
								    <table cellpadding="0" cellspacing="0" border="0" >
								      <thead>
								      	<col width="60%">
								      	<col width="40%">
								        <tr>
								          <th>Amount Payable</th>
								          <th><i class="fa fa-inr"></i><?php echo $granttotal ?></th>
								        </tr>
								      </thead>
								    </table>
								  </div>
								</div>