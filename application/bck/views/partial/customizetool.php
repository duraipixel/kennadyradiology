	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/customsizetool/css/FancyProductDesigner-all.min.css" />

    	<div id="main-container">
          	<!--<h3 id="clothing">&nbsp;</h3>-->
          	<div id="clothing-designer" class="fpd-container fpd-shadow-2 fpd-topbar fpd-tabs fpd-tabs-side fpd-top-actions-centered fpd-bottom-actions-centered fpd-views-inside-left" style="float:left">
          		<div class="fpd-product" title="Shirt Front" data-thumbnail="<?php echo $customimage;?>">
	    			<img src="<?php echo $customimage;?>" title="Base" data-parameters='{"left": 300, "top": 300, "colors": "#d59211",  "colorLinkGroup": "Base"}' />
			  		
			  		<span title="Any Text" data-parameters='{"boundingBox": "Base", "left": 300, "top": 182, "zChangeable": true, "removable": true, "draggable": true, "rotatable": true, "resizable": true, "colors": "#000000"}' >Your Company Name</span>
			  	
				</div>
		  	</div>
		  

		  <!--	<div class="fpd-clearfix" style="margin-top: 30px;">
			  	<div class="api-buttons fpd-container fpd-left">
				  	<a href="#" id="print-button" class="fpd-btn">Print</a>
				  	<a href="#" id="image-button" class="fpd-btn">Create Image</a>
				  	<a href="#" id="checkout-button" class="fpd-btn">Checkout</a>
				  	<a href="#" id="recreation-button" class="fpd-btn">Recreate product</a>
			  	</div>
			  	<div class="fpd-right">
				  	<span class="price badge badge-inverse"><span id="thsirt-price"></span> $</span>
			  	</div>
		  	</div>  -->

		 		 
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 prodec-wraper">
						<div class="row">
						<div class="col-md-12 title-wraper">
								<div class="infotitle">
									<span><h1><?php echo $productdetails['product_name']; ?></h1></span>
								</div>
								
						<?php if($productdetails['totpent']>0): ?>	
						<span class="offerspan"><?php echo $productdetails['totpent']; ?>% discount</span>
					    <?php ENDIF; ?>	
						</div>
							<div class="col-md-12">
								<div class="pro-detdec">
									<ul class="dethedul">
									   
										<li>
											<div class="dettit">
												Product Code
											</div>
											<div class="detcnt">
												<p><?php echo $productdetails['sku']; ?></p>
											</div>
										</li>
										<li>
											<div class="dettit">
												Availability
											</div>
											
											<div class="detcnt">
											 <?php if($productdetails['soldout']==0) : ?>
												<span class="text-green">In Stock</span>
											 <?php ELSE : ?>	
												<span class="text-red">Out of Stock</span>
											  <?php ENDIF;  ?>	
											</div> 
										</li>
									</ul>
									<div class="pro-dec">
										<div class="littit">Product Discription</div>
										<div>
											<p><?php echo $productdetails['longdescription']; ?></p>
										</div>										
									</div>
									<div class="proc-attr">
									
									<?php foreach($productattributes as $attr) {
										if($attr['value']!='')
										{
										?>
										<div class="dettit">
											<?php echo $attr['attributename']; ?>	
										</div>
										<div class="detcnt">
										<?php echo $attr['value']; ?>	
										</div>
									<?php		
										}
									 } ?>
									</div>
									
								</div>
								<?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
								<div class="productcolor-details" id="divcustomattr">
								<form id="frmcustomattr1" >
								<input type="hidden" name="customized" id="customized" />
								<?php 
								//echo "<pre>"; 
								 // print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								 
								// print_r($did); die();
								 
								 foreach($productfilter as $f) {
									$fsku=$productdetails['sku'];
									if($f['sku']!='')
										$fsku=$f['sku'];
									switch($f['iconsdisplay']){
										 case "1":
												 if(in_array($f['attributeid'],$arrattr))
												 {
													 $clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<div class="radio-inline color-single"  onclick="prodattrchange1(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');" >
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'"  name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-md-6">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			'; 
														
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														
														$strattrHTML.='<div class="radio-inline color-single"  onclick="prodattrchange1(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'"  name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-md-6">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			'; 
														 $clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														
														$strattrHTML.='<div class="radio-inline color-single"  onclick="prodattrchange1(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\');" >
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'"  name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
													 }													 
												 }
												 $arrattr[]=$f['attributeid'];
												 $prevtype=$f['iconsdisplay'];
												 break;
										case "0":
												if(in_array($f['attributeid'],$arrattr))
												 {
													 $clssel='';
													 if(in_array($f['dropdown_id'],$did))
														  $clssel=' selected="selected" ';
													   $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' + '.$f['price'].'</option>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.='<div class="row">
																		<div class="col-md-6">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			<select class="select2 form-control required" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange1(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<option value="">None</option>
																			'; 
														$clssel='';
														if(in_array($f['dropdown_id'],$did))
														  $clssel=' selected="selected" ';
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' + '.$f['price'].'</option>';
														  $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 $strattrHTML.='<div class="col-md-6">
																		<div class="littit">
																				'.$f['attributename'].'
																			</div>
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange1(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value);">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did))
														  $clssel=' selected="selected" ';
														 
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' + '.$f['price'].'</option>';
													 }													 
												 }
												$arrattr[]=$f['attributeid'];
												$prevtype=$f['iconsdisplay'];
												 break;			
											} 

								  }
								  if($prevtype==0)
								  {
									   $strattrHTML.='</select>';
									   $strattrHTML.='</div></div>';
								  }
								  else
								  {
									   $strattrHTML.='</div></div>';
									  
								  }
								 echo $strattrHTML; 	
								?>
								<input type="hidden" name="iscustomized" id="iscustomized" value="1" />
								</form>
								</div>
								  <?php } 
								  
								  ?>	
							 <?php if($productdetails['final_price']>0): ?>				
								<div id="customdetailsprice" class="detailsprice-wraper">
										<div class="pricewraper">
											<?php if($productdetails['totpent']>0): ?>		
											<span class="offerprice"><i class="fa fa-inr"></i> <?php echo number_format($maxdiscountamtfp,2)."&nbsp;-&nbsp;<i class='fa fa-inr'></i>". number_format($productdetails['final_price'],2); ?>
											<span class="pricesl-caption">/ piece</span>
											</span><span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span>
											<br/>
											<span class="actualprice"><i class="fa fa-inr"></i><?php echo number_format($productdetails['final_orgprice'],2); ?></span>
											<?php ELSE : ?>
												<span class="offerprice"><i class="fa fa-inr"></i><?php echo number_format($maxdiscountamtfp,2)."&nbsp;-&nbsp;<i class='fa fa-inr'></i>". number_format($productdetails['final_price'],2); ?>
												<span class="pricesl-caption">/ piece</span>
												</span>
												<span class="offertext"> MOQ is <?php echo $productdetails['minquantity']; ?></span>
										   <?php ENDIF; ?>
										</div>
										<small>* Exclusive of GST</small>
								</div>
									<?php ELSE : ?>
									<div id="detailspricewraper" class="detailsprice-wraper">
										<div class="pricewraper">
											<span class="offerprice">Price on Request</span>
										</div>
									</div>	
								<?php ENDIF; ?>	
								<div class="detailsprice-wraper">
									<div class="quantity">
										<div class="quantity-button quantity-down">-</div>
										<input type="number" id="prices1" min="<?php echo $productdetails['minquantity']; ?>" onchange="" onmousemove="" onkeypress="return validateQty(event);" onblur="checkminqty()" step="1" value="<?php echo $productdetails['minquantity']; ?>">
										<div class="quantity-button quantity-up">+</div>
									</div>
									
									<?php if($productdetails['soldout']==0)	: ?>	
									<a href="javascript:void(0);" class="btn buynow-btn" onclick="addtocart_customimg('<?php echo $productdetails['product_id'];?>');"><span>Save & Add to Cart</span></a>
									<?php ELSE : ?>
										<a href="javascript:void(0);" class="btn buynow-btn disabled"><span>Save & Add to Cart</span></a>
									<?php ENDIF; ?>
							
									
								</div>
								<br/>
								<div class="alert alert-info">
								<i class="fa fa-info-circle"></i> 
								The Minimum Order Quantity for this product is <?php echo $productdetails['minquantity']; ?>. <br>If you require fewer than <?php echo $productdetails['minquantity']; ?>, please chat with us.
								</div>
								
								
								
							</div>
					
						</div>
						</div>
			

    	</div>

    <!-- Include js files -->

	