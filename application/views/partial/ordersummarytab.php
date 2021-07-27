<?php
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
	}
	$disgranttotal=0;
	$disgranttotalslip=0;
		$childsid= $helper->getChildsId();
		$arrexcludecat=explode(",",$childsid);
	
	 foreach($getcheckoutproductlist as $productlist){
	      if(!in_array($productlist['categoryID'],$arrexcludecat)){
		$totaprice = ($productlist['final_prod_attr'] * $productlist['product_qty']);
		$disgranttotalslip+=$totaprice;
	      }
	 }	
	$discount =0;
	$discountslap =  $helper->chkDiscountSlap($disgranttotalslip);	
	$disgranttotal=0;
	$grandtotal=0;
	 foreach($getcheckoutproductlist as $productlist){
		$prodprice = ($productlist['final_price'] * $productlist['product_qty']);
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
	     $grandtotal += $totaprice;		
	 }
//	echo  $disgranttotal; die();
?>

<table class="table table-borderless checkout-total">
  <tbody>
    <tr>
      <td> <?php echo $cartdisplaylanguage['subtotal'];?> </td>
      <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <span id="subtot"> <?php echo number_format(round($grandtotal),2).''; ?> </span></strong></td>
    </tr>
    <?php 

if($_SESSION['Couponamount']!='' && $_SESSION['Couponamount']!='null'){
	if($_SESSION['CouponCatType']=="3" || $_SESSION['CouponCatType']=="4"){
		if($_SESSION['coupontype']=="1")
		{
			 $_SESSION['Couponamount']=($disgranttotal*$_SESSION['couponvalue'])/100; 
		}
		else if($_SESSION['coupontype']=="2")
		{
			 $_SESSION['Couponamount']=$disgranttotal-$_SESSION['couponvalue']; 			
		}
	}else{	

		$_SESSION['Couponamount']= $_SESSION['Couponamount']-(($_SESSION['Couponamount']*$discountslap['DiscountAmount'])/100);

	}		
		?>
    <tr>
      <td> <?php echo $checkoutdisplaylanguage['coupondiscount'];?>(-) </td>
      <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format(round($_SESSION['Couponamount']),2); ?> </strong></td>
    </tr>
    <?php } ?>
    <?php  
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
      <td> <?php echo $checkoutdisplaylanguage['discountslab'];?>(-) </td>
      <td class="text-right"><strong> <?php echo PRICE_SYMBOL;?> <?php echo $discount; ?> </strong></td>
    </tr>
    <?php
}     ?>
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
      <td> <?php echo $checkoutdisplaylanguage['shippingonprice'];?>(+) </td>
      <td class="text-right"><strong> <?php echo number_format(round($shippingcharge),2); ?> </strong></td>
    </tr>
    <?php } 

 $grandtotal=$grandtotal+$shippingcharge-$_SESSION['Couponamount'];

$_SESSION['granttotal'] = $grandtotal; 
?>
    <tr>
      <td class="has-border"> <?php echo $checkoutdisplaylanguage['ordertotal'];?></td>
      <td class="text-right has-border"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format(round($grandtotal),2); ?></strong></td>
    </tr>
  </tbody>
</table>
