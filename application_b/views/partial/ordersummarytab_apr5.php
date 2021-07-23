<?php
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	$disgranttotal=0;
	 foreach($getcheckoutproductlist as $productlist){
		$totaprice = ($productlist['final_price'] * $productlist['product_qty']);
		$disgranttotal+=$totaprice;
	 }	
	$discount =0;
	$discountslap =  $helper->chkDiscountSlap($disgranttotal);	
	$disgranttotal=0;
	$grandtotal=0;
	 foreach($getcheckoutproductlist as $productlist){
		$prodprice = ($productlist['final_price'] * $productlist['product_qty']);
		$discount =0;
		if($discountslap['DiscountAmount']!=''){												
				if($discountslap['DiscountType']==1){
				$discount = ($prodprice*$discountslap['DiscountAmount'])/100;
				$prodprice = $prodprice-$discount;
				}
				else{
					$discount = $discountslap['DiscountAmount'];
					$prodprice = $prodprice-$discount;
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
	//	echo 'jjj'.$prodprice;
		 $disgranttotal+= $prodprice;	
	     $grandtotal += $totaprice;		
	 }
	
?>

<div class="tbl-header">
		<table cellpadding="0" cellspacing="0" border="0">
	
		 <tfoot>
		 <tr>
		 <td> 
				<?php //echo $helper->displayDiscountSlap('col-md-12 nopad'); ?>
		 
			<div class="col-md-12 nopad discountslab-wraper">
								<div class="discountslab-inner">
									<div class="discountslab-title">
										Discount Slab
									</div>
									<div class="discountslab-list">
								
										<ul class="list-inline">
										   										    <li><small>&nbsp;<i class="fa fa-inr"></i>10000.00 + &nbsp;5% <br> </small></li>
											<br>
											
																					    <li><small>&nbsp;<i class="fa fa-inr"></i>30000.00 + &nbsp;7% <br> </small></li>
											<br>
											
																					    <li><small>&nbsp;<i class="fa fa-inr"></i>50000.00 + &nbsp;10% <br> </small></li>
											<br>
<li><small>&nbsp;<i class="fa fa-inr"></i>70000.00 + &nbsp;12% <br> </small></li>
											<br>											
											
																					    <li><small> &nbsp;<i class="fa fa-inr"></i>100000.00+ &nbsp;15% </small></li>
											<br>
										   
											</ul>
									</div>
								</div>
							</div>
			
		 </td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0">
					<tfoot>
						<tr>
						
	<td>
		<div class="tdsingle-row text-uppercase text-left">
			SubTotal
		</div>
	</td>
	
	
	<td class="text-right">
		<span>
			<i class="fa fa-inr"></i>
		</span>
		<span>
			<span id="subtot">
				<?php echo number_format($grandtotal,2).''; ?>
			</span>
		</span>
	</td>
</tr>

<?php if($_SESSION['Couponamount']!='' && $_SESSION['Couponamount']!='null'){
		if($_SESSION['coupontype']=="1")
		{
			 $_SESSION['Couponamount']=($disgranttotal*$_SESSION['couponvalue'])/100; 
		}
		else if($_SESSION['coupontype']=="2")
		{
			 $_SESSION['Couponamount']=$disgranttotal-$_SESSION['couponvalue']; 			
		}
		?>
		
<tr>
	<td>
		<div class="tdsingle-row text-uppercase text-left">
			Coupon Discount(-)
		</div>
	</td>
	
	
	<td>
		<span>
			<i class="fa fa-inr"></i>
		</span>
		<span>
			<span id="">
				<?php echo number_format($_SESSION['Couponamount'],2); ?>
			</span>
		</span>
	</td>
</tr>
<?php } ?>
<?php /*
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


<tr>
	<td>
		<div class="tdsingle-row text-uppercase text-left">
			Discount Slab(-)
		</div>
	</td>
	
	
	<td>
		<span>
			<i class="fa fa-inr"></i>
		</span>
		<span>
			<span id="">
				<?php echo $discount; ?>
			</span>
		</span>
	</td>
</tr>

}  */  ?>
<?php 
//echo $disgranttotal; die();
if(!empty($_SESSION['shippingCost']) && isset($_SESSION['shippingCost'])){
	if($_SESSION['pricetype']==1){	
  	$shippingcharge = ($disgranttotal*$_SESSION['shippingCost'])/100; 
	//$grandtotal = $disgranttotal+$shippingcharge;
	}
	else{
		$shippingcharge = $_SESSION['shippingCost'];
	//	$grandtotal = $disgranttotal+$shippingcharge;
	}
?>

<tr>
	<td>
		<div class="tdsingle-row text-uppercase text-left">
			Shipping Charge(+)
		</div>
	</td>
	
	
	<td>
		<span>
			<i class="fa fa-inr"></i>
		</span>
		<span>
			<span id="">
				<?php echo number_format($shippingcharge,2); ?>
			</span>
		</span>
	</td>
</tr>
<?php } 

 $grandtotal=$grandtotal+$shippingcharge-$_SESSION['Couponamount'];

$_SESSION['granttotal'] = $grandtotal; 
?>

<tr>
	<td>
		<div class="tdsingle-row text-uppercase text-left">
			Amount Payable
		</div>
	</td>
	
	
	<td>
		<span>
			<i class="fa fa-inr"></i>
		</span>
		<span>
			<span id="">
				<?php echo number_format($grandtotal,2); ?>
			</span>
		</span>
	</td>
</tr>
					</tfoot>
				</table>
			</td>
		 </tr>
		 

</tfoot>
</table>
</div>

								  