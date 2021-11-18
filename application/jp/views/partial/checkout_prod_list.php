<?php
//echo "<pre>"; print_r($getcheckoutproductlist); exit; 
if ( ($helper instanceof common_function) != true ) {
		$helper=$this->loadHelper('common_function');
		$helper->getStoreConfig();
	}
?>

<div class="table-responsive" id="chechoutdivbind">
  <div id="hidecheckouttable">
    <table id="cart-table" class="table cart-table">
      <thead>
        <tr>
          <th><?php echo $cartdisplaylanguage['cartproduct'];?></th>
          <th><?php echo $cartdisplaylanguage['itemcode'];?></th>
          <th><?php echo $cartdisplaylanguage['cartprice'];?> (<?php echo PRICE_SYMBOL;?>)</th>
          <th><?php echo $cartdisplaylanguage['cartgst'];?> (<?php echo PRICE_SYMBOL;?>) </th>
          <th class="centrie"><?php echo $commondisplaylanguage['quantity'];?></th>
          <th class="text-right"><?php echo $commondisplaylanguage['carttotal'];?> (<?php echo PRICE_SYMBOL;?>)</th>
        </tr>
      </thead>
      <tbody id="ordertab">
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
											
											$printingoption = PRICE_SYMBOL .$productlist['attr_price'];
										}
										
									?>
        <tr>
          <td><?php
											if($imgpath != ''){
										 ?>
										 <a href="<?php echo $helper->pathrevise($arrpath).'/'.$productlist['product_url']; ?>" class="cart-items">
										 
            <img width="68" height="88"  src="<?php echo img_base;?>uploads/productassest/<?php echo $productlist['product_id']; ?>/photos/<?php echo  $imgpath; ?>" alt="<?php echo $productlist['product_name']; ?>"  class="img-fluid">
            <?php }else{?>
            <img  src="<?php echo img_base;?>uploads/noimage/photos/thumb/noimage.png" alt="<?php echo $productlist['product_name']; ?>"  class="img-fluid">
            <?php }?>
            <span><strong> <?php echo $productlist['product_name']; ?></strong>
			<?php echo $strAttr; ?> </span></a></td>
          <td><?php echo $productlist['item_code']; ?></td>
          <td><?php echo PRICE_SYMBOL.number_format(round($productlist['final_orgprice']),2); ?></td>
          <td><?php echo PRICE_SYMBOL. number_format(round($productlist['taxmat']),2); ?></td>
          <td>
			   <?php echo $productlist['product_qty']; ?> 
               </td>
          <td class="text-right"><strong> <?php echo number_format(round($totaprice),2);  ?></strong></td>
        </tr>
        <?php $grandtotal += $totaprice;  $cnt++; } ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row border-bottom">
  <div class="col-sm-12 col-md-12 col-lg-8">
    <?php
	                                             include("couponpage.php");
	                                             ?>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-4" id="divordersummarytab" >
    <?php
						      include("ordersummarytab.php");
				            ?>
    </table>
  </div>
</div>
<script	src="<?php echo img_base; ?>/static/js/jquery-3.5.1.min.js"></script>
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