												<div class="cpn">
												
								          		<div class="input-group" id="hidediv">
												<form id="frmcoupon" name="frmcoupon" onSubmit="CheckCPvalid(); return false;" >
												
													<div class="row">
														<div class="col-sm-12 col-md-6">
														<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" placeholder="Use Coupon Code" required=''>
														</div>
														<div class="col-sm-12 col-md-6 pt-3">
														<button class="common-btn btn-block btn-lg" type="submit">Apply Coupon</button>
														</div>
													</div>
											</form>	
											</div>
											
											<div class="input-group" id="couponremovediv">
                                            <form id="frmremove" name="frmremove" >
                                            <div class="row">
														<div class="col-sm-12 col-md-6">
														<input type="text" id="txtcoupon" name="txtcoupon" class="form-control" value="<?php echo $_SESSION['Couponcode']; ?>" disabled required=''>
														</div>
														<div class="col-sm-12 col-md-6 pt-3">
														<button class="common-btn btn-block btn-lg" type="button" onClick="removecoupons();">Remove Coupon</button>
														</div>
													</div>
                                                     </form>
												</div>
												
								          	</div>