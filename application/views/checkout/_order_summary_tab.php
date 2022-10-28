<?php
 $itemTotal = $_SESSION['total_product_amount'];
?>
<table class="table table-borderless checkout-total">
    <tbody>
        <tr>
            <td> SubTotal </td>
            <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <span id="subtot"> <?php echo number_format($itemTotal,2).''; ?> </span></strong></td>
        </tr>
		<?php 
		$grandtotal = $itemTotal;
		if($_SESSION['Couponamount']!='' && $_SESSION['Couponamount']!='null') {
		?>
    <tr>
        <td> Coupon Discount : <?= $_SESSION['Couponcode'] ?>(-) </td>
        <td class="text-right"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format($_SESSION['Couponamount'],2); ?> </strong></td>
    </tr>
    <?php } ?>
    <?php  
    $itemDiscount = $_SESSION['itemDiscount'];
    if( isset( $itemDiscount ) && !empty( $itemDiscount ) ) {
    ?>
    <tr>
      <td> Discount (-) </td>
      <td class="text-right"><strong> <?php echo PRICE_SYMBOL;?> <?php echo $itemDiscount; ?> </strong></td>
    </tr>
    <?php
    } 
    if(!empty($_SESSION['shippingCost']) && isset($_SESSION['shippingCost'])){
        if($_SESSION['pricetype']==1){	
            $shippingcharge = ($disgranttotal*$_SESSION['shippingCost'])/100; 
        } else {
            $shippingcharge = $_SESSION['shippingCost'];
        }
?>
    <tr>
      <td> Shipping Fee (+) </td>
      <td class="text-right"><strong> <?php echo number_format($shippingcharge,2); ?> </strong></td>
    </tr>
    <?php 
    } 

    $grandtotal 		= $_SESSION['granttotal'];

?>
    <tr>
      <td class="has-border"> Order Total </td>
      <td class="text-right has-border"><strong><?php echo PRICE_SYMBOL;?> <?php echo number_format($grandtotal,2); ?></strong></td>
    </tr>
  </tbody>
</table>
