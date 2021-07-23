  <?php 
   
$max_dp = ($productdetails['final_price']*$getmaximum_dp['max_discnt_slap'])/100;
$maxdiscountamtfp = ($productdetails['final_price'] - $max_dp);

  ?>	
 <?php if($productdetails['soldout']==0) : ?>

		<div class="pricewraper">
			<?php if($productdetails['totpent']>0): ?>		
			<span class="offerprice"><i class="fa fa-inr"></i> <?php echo number_format($productdetails['final_price'],2); ?>
			
			</span>
			<!--<span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span> -->
			<br/>
			<span class="actualprice"><i class="fa fa-inr"></i><?php echo round($productdetails['final_orgprice'],2); ?></span>
			<?php ELSE : ?>
				<span class="offerprice"><i class="fa fa-inr"></i><?php echo  number_format($productdetails['final_price'],2); ?>
				
				</span>
				<!--<span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span> -->
		   <?php ENDIF; ?>
		</div>
		<small>* Inclusive of GST</small>
<div class="chk-avl">
									<div class="form-group">				   
									<div class="col-md-8 pl0">
									<div class="littit"><i class="fa fa-map-marker"></i> <small>Check Availability </small></div>
										<input type="hidden" name="checkout" value="checkoutaddress">
										<input type="text" class="form-control" value="<?php echo $_SESSION['shippincode'];?>" id="shippincode" name="shippincode" placeholder="Enter Deliver Pincode" required="" maxlength="6">
										<button type="submit" onclick="fnchkCodeAvailable();" class="button btn-primary">Check</button>
									</div> 
								  </div>
									</div>
<?php ENDIF; ?>