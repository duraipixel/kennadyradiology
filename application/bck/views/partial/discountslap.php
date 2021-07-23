<div class="<?php echo $colclass;?> discountslab-wraper">
								<div class="discountslab-inner">
									<div class="discountslab-title">
										Discount Slab Value Wise
									</div>
									<div class="discountslab-list">
									<!--
										<ul class="list-inline">
										    <?php foreach($Discountslab as $value){ ?>
											<li> < <?php echo $value['Discountslabamt']; ?>  - <?php echo $value['DiscountAmount']; ?>% </li>
											<br/>
											<?php } ?>
										</ul>
										-->
										<ul class="list-inline">
										   <?php $maxvalue = count($Discountslab)-1;
										   for($i=0;$i<count($Discountslab);$i++){ 
                                            if($maxvalue==$i){
										   ?>
										    <li>
											<span class="discslab-val">
											<i class="fa fa-inr"></i><?php echo round($Discountslab[$i]['Discountslabamt']); ?>+ 
											</span>
											<span class="discslab-per">
											<?php echo $Discountslab[$i]['DiscountAmount']; ?>%
											</span>
											</li>
											<?php } else{ ?>
										    <li>
											<span class="discslab-val">
											<i class="fa fa-inr"></i><?php echo round($Discountslab[$i]['Discountslabamt']); ?> +
											</span>
											<span class="discslab-per">	
											<?php echo $Discountslab[$i]['DiscountAmount']; ?>% 
											</span>
											</li>
											<?php  } } ?>
										</ul>
									</div>
								</div>
							</div>