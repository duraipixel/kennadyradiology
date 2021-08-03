											

<div class="col-sm-12 col-md-6" id="hidediv">
                    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
					
                    <form id="frmcoupon" name="frmcoupon" onSubmit="CheckCPvalid(); return false;" >
                    <div class="input-group mb-3 coupon-code">
					<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" placeholder="<?php echo $checkoutdisplaylanguage['entercoupon'];?>" />
                      <button class="coupon-button" type="submit"> <?php echo $commondisplaylanguage['apply'];?> </button>
                    </div>
					</form>
                  </div>


				  <div class="col-sm-12 col-md-6" id="couponremovediv">
                    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
                    <form id="frmremove" name="frmremove" onSubmit="removecoupons(); return false;">
                    <div class="input-group mb-3 coupon-code">
					<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" value="<?php echo ($_SESSION['Couponcode'] != '') ? $_SESSION['Couponcode'] : $coupon; ?>" disabled required=''>
                      <button class="coupon-button" type="submit" nClick="removecoupons();"> <?php echo $commondisplaylanguage['remove'];?></button>
                    </div>
					</form>
                  </div>
				   
										 