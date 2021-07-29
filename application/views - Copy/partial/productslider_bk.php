<?php if(count($products)>0){ ?>

<section class="commonthumb-wraper commontop-section <?php echo $addclass; ?>">
  <div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12 nopad section-title text-center"> <?php echo $title; ?> </div>
    <div class="col-md-12 col-sm-12 col-xs-12 nopad commonthumb-slider"> 
      
      <!-- <div class="col-md-12 col-sm-12 col-xs-12 nopad"> -->
      <?php
				
			if ( ($helper instanceof common_function) != true ) {
					
					$helper=$this->loadHelper('common_function');
				 	
				}
				if ( ($product instanceof product_model) != true && empty($product)) {
					
				  if (!class_exists("product_model")) {	
					$product=$this->loadModel('product_model');
					}
					else{
					$product=$this->loadModelObject('product_model');
					}
					
				}
				
				//print_r($products); 
			//scrn-sht
				 foreach($products as $p) {  
			//	print_r($p);  die();
				// $arrdisvalue=$helper->calculateproductDiscountPrice($p['price'],$p['taxTyp'],$p['taxRate'],$p['specialprice'],$p['spl_fromdate'],$p['spl_todate'],$p['prod_DiscountType'],$p['prod_DiscountAmount'],$p['cat_DiscountType'],$p['cat_DiscountAmount'],$p['cust_DiscountType'],$p['cust_DiscountAmount'],$p['deals_DiscountType'],$p['deals_DiscountAmount']);
			
				$productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$p['product_url']);
				$arrpath=array();
				//print_r($p);
				$helper->getProductPath($p['categoryID'],$arrpath);
					//print_r($arrpath);	 
			?>
      <div class="prd-single"> <a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>" class="prdsingle-inner">
        <div class="prdimg-wraper carousel slide" data-ride="carousel" data-interval="1000">
          <button type="button" class="play"><span class="glyphicon glyphicon-play"></span></button>
          <button type="button" class="pause"><span class="glyphicon glyphicon-pause"></span></button>
          <?php if($p['img_names']!='') { ?>
          <div class="prdimginner-slider carousel-inner" role="listbox">
            <?php 
									$imgs=explode("|",	$p['img_names']);
									$ind=0;
								  foreach($imgs as $i ) {								  
								  ?>
            <div class="item <?php echo $ind==0? 'active' :''; ?> prdimginner"> <img src="<?php echo img_base;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/medium/<?php echo $i; ?>" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> </div>
            <?php $ind++; } ?>
          </div>
          <?php }  else {  ?>
          <div class="item <?php echo $ind==0? 'active' :''; ?> prdimginner"> <img src="<?php echo img_base;?>uploads/noimage/photos/medium/noimage.png" class="img-responsive center-block prdimg" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /> </div>
          <?php  } ?>
          <?php if($p['totpent']>0): ?>
          <span class="offerspan"><?php echo $p['totpent']; ?>%</span>
          <?php ENDIF; ?>
        </div>
        </a>
        <div class="prdname-wraper"> <a href="<?php  echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>"  class="prdsingle-inner">
          <div class="prdname"><?php echo $p['product_name']; ?></div>
          </a>
          <div class="pricewraper">
            <?php
							/*	  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
								<div class="productcolor-details" id="divcustomattr">
								<form id="frmcustomattr_<?php echo $p['product_url']; ?>" >
								<?php 
								//echo "<pre>"; 
								 // print_r($productfilter); die();
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
								 
								// print_r($productfilter); die();
								 
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
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
														 
														$strattrHTML.='<!-- <div class="row"> -->
																		<div class="col-md-8">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div> -->
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-md-8">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did))
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img src="'.img_base.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
													 if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
													 }else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
													   $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
												 }
												 else{
													 if(($cntind%2))
													 {
														 if($prevtype==0)
															 $strattrHTML.='</select>';
														 
														 if(count($arrattr)!=0)
															 $strattrHTML.='</div></div>';
														 
														$strattrHTML.=' <!-- <div class="row"> -->
																		<div class="col-md-6 nopad cstm-resw">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div> -->
																			<select class="select2 form-control required" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value,\''.$p['product_url'].'\');">
																			<!-- <option value="">None</option> -->
																			'; 
														$clssel='';
														if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
														  $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 $strattrHTML.='<div class="col-md-8">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value,\''.$p['product_url'].'\');">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did)){
														  $clssel=' selected="selected" ';
														}else if($f['isDefault']){
														 $clssel=' selected="selected" ';
													 }
														 
														 $strattrHTML.='<option '.$clssel.' value="'.$f['dropdown_id'].'"> '.$f['dropdown_values'].' '.$f['dropdown_unit'].'</option>';
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
									   $strattrHTML.='</div> ';
									   //</div>';
								  }
								  else
								  {
									   $strattrHTML.='</div>';
									   //</div>';
									  
								  }
								 echo $strattrHTML; 	
								?>
								</form>
								</div>
								  <?php } */ ?>
            
            <!--<?php if($p['dropdown_values']!=''): ?>
						  <span class="offerprice"><?php echo $p['dropdown_values']." ".$p['dropdown_unit']." - " ; ?></span>
						<?php ENDIF; ?>
					   <?php if($p['final_price']>0): ?>		
					  <?php if($p['totpent']>0): ?>	
						<span class="offerprice"><i class="fa fa-inr"></i> <?php echo  $p['final_price']; ?></span> 
						<span class="actualprice"><i class="fa fa-inr"></i><?php echo $p['final_orgprice']; ?></span>
						<?php ELSE : ?>
							<span class="offerprice"><i class="fa fa-inr"></i><?php echo $p['final_orgprice'];  ?></span>
					   <?php ENDIF; ?>	
						<?php ELSE : ?>
							<span class="offerprice">Price on Request</span>
					   <?php ENDIF; ?>		
                       <a href="javascript:void(0);" id="btnaddtocart" class="btn buynow-btn <?php echo $clsdisable; ?>" onclick="addtocart('<?php echo $p['product_id'];?>');"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;<span>Add to Cart</span></a>	
					   -->
            
            <?php if($p['final_price']>0): ?>
            <?php if($p['dropdown_values']!=''): ?>
            <div class="productcolor-details" id="divcustomattr"> <span class="offerprice gr-ms" >
              <div id="<?php echo $p['product_url']?>" ><?php echo $p['dropdown_values']." ".$p['dropdown_unit']; ?></div>
              </span> </div>
            <?php ENDIF; ?>
            <?php if($p['totpent']>0): ?>
            <span class="offerprice" ><i class="fa fa-inr"></i>
            <div id="<?php echo $p['product_url']?>" > <?php echo  $p['final_price']; ?> </div>
            </span>
            <?php ELSE : ?>
            <span class="offerprice"><i class="fa fa-inr"></i>
            <div id="<?php echo $p['product_url']?>" ><?php echo $p['final_orgprice'];  ?></div>
            </span>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            <span class="offerprice">
            <div id="<?php echo $p['product_url']?>" >Price on Request</div>
            </span>
            <?php ENDIF; ?>
          </div>
          <div id="field1" qa="qty" class="input-group"><span class="input-group-addon">Qty</span>
            <button type="button" id="sub" class="sub form-control">-</button>
            <input id="prices1_<?php echo $p['product_id'];?>" type="text" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
            <button type="button" id="add" class="add form-control">+</button>
          </div>
          <a href="javascript:void(0);" id="btnaddtocart" class="btn buynow-btn <?php echo $clsdisable; ?>" onclick="addtocartslider('<?php echo $p['product_id'];?>','<?php echo $p['attributeId']; ?>','<?php echo $p['dropdown_id']; ?>');"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;<span>Add</span></a> </div>
      </div>
      
      <!--<div class="prdtools-wraper">
							<ul class="prdtools">
								<li class="wishlist_<?php echo $p['product_id']; ?>">

										<?php if(!empty($p['wishlist_id']) && $p['wishlist_id']!="") { ?>
										<a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Wishlist" data-original-title="" title="" class="wishlist-icon commonicon"  >
											<img src="<?php echo img_base;?>/static/images/icons/wishicon.png" class="img-responsive" alt="">
										</a>
										
									<?php } else { ?>
									
									<a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Wishlist" data-original-title="" title="" class="wishlist-icon commonicon" onclick="addtowishlist('<?php echo $p['product_id'];?>',<?php echo $p['minquantity'];?>);" >
											<img src="<?php echo img_base;?>/static/images/icons/wishlist-g.png" class="img-responsive" alt="">
										</a>

									<?php } ?>	

								</li>
								<?php if($_SESSSION['cus_group_id']==2) { ?>
								<li>
									<a href="javascript:void(0);" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Catlog">
										<img src="<?php echo img_base;?>static/images/icons/file.png" class="img-responsive" alt="" />
									</a>
								</li>
								<?php } ?>	
								<li>
									<a href="<?php echo $helper->pathrevise($arrpath).'/'.$p['product_url']."/?customized"; ?>" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Customize Product">
										<img src="<?php echo img_base;?>static/images/icons/edit.png" class="img-responsive" alt="" />
									</a>
								</li>
							</ul>
						</div> --> 
      <!-- </div> -->
      <?php } ?>
    </div>
    <div class="red-mre"> <a href="">Explore All</a> </div>
  </div>
</section>
<?php } ?>
