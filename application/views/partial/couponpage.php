											

<div class="col-sm-12 col-md-6" id="hidediv">
                    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
                    <div class="input-group mb-3 coupon-code">
                    <form id="frmcoupon" name="frmcoupon" onSubmit="CheckCPvalid(); return false;" >
					<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" placeholder="<?php echo $checkoutdisplaylanguage['entercoupon'];?>" />
                      <button class="coupon-button" type="submit"> <?php echo $commondisplaylanguage['apply'];?> </button>
                    </div>
                  </div>


				  <div class="col-sm-12 col-md-6" id="couponremovediv">
                    <h6><?php echo $checkoutdisplaylanguage['applycoupon'];?></h6>
                    <div class="input-group mb-3 coupon-code">
                    <form id="frmremove" name="frmremove" >
					<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" value="<?php echo $_SESSION['Couponcode']; ?>" disabled required=''>
                      <button class="coupon-button" type="button" nClick="removecoupons();"> <?php echo $commondisplaylanguage['apply'];?></button>
                    </div>
                  </div>
				   
										 