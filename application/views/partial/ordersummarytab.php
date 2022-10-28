<?php
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	
	$disgranttotal 		= 0;
	$disgranttotalslip 	= 0;
	$totaprice 			= 0;
	$childsid 			= $helper->getChildsId();
	$arrexcludecat 		= explode(",",$childsid);
	
	 foreach($getcheckoutproductlist as $productlist){
	      if(!in_array($productlist['categoryID'],$arrexcludecat)){
			$totaprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
			$disgranttotalslip+=$totaprice;
	      }
	 }	
	$discount 			= 0;
	$discountslap 		= $helper->chkDiscountSlap($disgranttotalslip);	
	$disgranttotal		= 0;
	$grandtotal 		= 0;
	foreach($getcheckoutproductlist as $productlist){
		$prodprice = ($productlist['attr_price'] * $productlist['product_qty']);
		$productPrice = ($productlist['cartProductAmount'] * $productlist['product_qty']);
		$distprodprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
		$discount =0;
		if($discountslap['DiscountAmount']!=''){
		    if(!in_array($productlist['categoryID'],$arrexcludecat)){
				if($discountslap['DiscountType']==1){
				$discount = ( ($productlist['final_prod_attr'] * $productlist['product_qty'])*$discountslap['DiscountAmount'])/100;
			
				$prodprice = $prodprice-$discount;
				$distprodprice =$distprodprice -$discount;
				}
				else{
					$discount = $discountslap['DiscountAmount'];
					$prodprice = $prodprice-$discount;
					$distprodprice =$distprodprice -$discount;
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
		//	echo 'jjj'.$prodprice;
		$disgranttotal+= $distprodprice;	
	     
		$totaprice += $productPrice;
	}
//	echo  $disgranttotal; die();

$_SESSION['total_product_amount'] = $itemTotal;
?>

<table class="table table-borderless checkout-total">
  <tbody>
    <tr>
      <td> <?php echo $checkoutdisplaylanguage['subtotal'];?> </td>
      <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <span id="subtot"> <?php echo number_format($itemTotal,2).''; ?> </span></strong></td>
    </tr>
	<?php 
	$grandtotal = $itemTotal;
	if($_SESSION['Couponamount']!='' && $_SESSION['Couponamount']!='null') {
	
	?>
    <tr>
      <td> <?php echo $checkoutdisplaylanguage['coupondiscount'];?>(-) </td>
      <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format($_SESSION['Couponamount'],2); ?> </strong></td>
    </tr>
    <?php } ?>
    
    <?php 
//echo $disgranttotal; die();
if(!empty($_SESSION['shippingCost']) && isset($_SESSION['shippingCost'])){
	if($_SESSION['pricetype']==1){	
  		$shippingcharge = ($disgranttotal*$_SESSION['shippingCost'])/100; 
		//$grandtotal = $disgranttotal+$shippingcharge;
	} else {
		$shippingcharge = $_SESSION['shippingCost'];
		//	$grandtotal = $disgranttotal+$shippingcharge;
	}
?>
    <tr>
      <td> Shipping Fee (+)</td>
      <td class="text-right"><strong> <?php echo number_format($shippingcharge,2); ?> </strong></td>
    </tr>
    <?php } 

 $grandtotal 			= $grandtotal + $shippingcharge - $_SESSION['Couponamount'];

$_SESSION['granttotal'] = $grandtotal; 
?>
    <tr>
      <td class="has-border"> <?php echo $checkoutdisplaylanguage['ordertotal'];?></td>
      <td class="text-right has-border"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format($grandtotal,2); ?></strong></td>
    </tr>
  </tbody>
</table>
