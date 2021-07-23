<?php 	if(count($productlists)>0){	

			if(($helper instanceof common_function) != true && empty($helper)){
					$helper=$this->loadHelper('common_function');
				}
			
			if(($product instanceof product_model) != true && empty($product)){
				  if (!class_exists("product_model")) {	
					$product=$this->loadModel('product_model');
				  }
				  else{
					$product=$this->loadModelObject('product_model');
				  }					
			}	
				
			if(($helper instanceof common_function) != true && empty($helper)){					
					$helper=$this->loadHelper('common_function');
			}
				?>

<?php if(count($productlists) > 0){?>
<section class="filter mt-3">
  <div class="container row">
	<div class="col-md-12">
	<div class="col-sm-12 col-md-8 col-lg-9">
		 <?php if( count($productlists) > 0){?>  <p class="filter-showing"><?php echo $catname;?> ( Showing 1 - <?php echo count($productlists);?> Products of <?php echo $productscount;?>)</p>
     <?php }?>
	</div>
	
       <div class="col-sm-12">
	   
        <?php
							$arrbread=array();
							$helper->getProductBread($catinfo['categoryID'],$arrbread);
							
							$breadpath='';
							for($a=count($arrbread)-1;$a>=0;$a--){
								$breadpath.=$arrbread[$a]['code'].'/';
								$catname = $arrbread[$a]['name'];
								$catcode = $arrbread[$a]['code'];
					  ?>
          
          <?php } ?>
          
    
      </div>
     </div>
	  </div>
     </section>
     <?php }?>
     
     <?php if(count($productlists) > 0 && $catcode == 'corporate-gifts'){?>
	 <div class="container">
		<div class="row">
			<div class="col text-right">		
				<button onclick="addtocatalogue_insert()" class="common-btn" style="width: auto; padding:12px 20px;">Generate Catalogue</button>
			</div>
		</div>
	 </div>
     <?php }?>
     
<section class="product-listing mb-5">
  <div class="container prolistviewcontainer">
 
    
    <div class="row">
      <?php 
	  
	  foreach($productlists as $p) { 
		$productfilter=$product->productPricevariationFilter('',$catinfo['categoryID'],$p['product_url']);
		
		 $arrpath=array();
	     $helper->getProductPath($p['categoryID'],$arrpath);
	?>
      <div class="col-sm-6 col-md-6 col-lg-4 prd-singles">
        <div class="product-listing-bg">
        <?php
		
		 if( $catcode == 'corporate-gifts'){?>
        <input type="checkbox" name="corpcatalogue[]" id="corpcatalogue<?php echo $p['product_id'];?>" value="<?php echo $p['product_id'];?>" />
        <?php }?>
		
			<!--<div id="ProducCarousel<?php echo $i;?>" class="carousel slide" data-ride="carousel">
			 
				<div class="carousel-inner">
					<div class="carousel-item <?php echo ($ind == 0) ? 'active' : '';?>">
						<img src="<?php echo BASE_URL;?>static/images/products/product-1.png" alt="">
					</div>
					<div class="carousel-item">
						<img src="<?php echo BASE_URL;?>static/images/products/product-2.png" alt="">
					</div>
					<div class="carousel-item">
						<img src="<?php echo BASE_URL;?>static/images/products/product-3.png" alt="">
					</div>
				</div>
			 
				<a class="carousel-control-prev" href="#ProducCarousel?php echo $i;?>" data-slide="prev">
					<i class="lni lni-arrow-left"></i>
				</a>
				<a class="carousel-control-next" href="#ProducCarousel?php echo $i;?>" data-slide="next">
					<i class="lni lni-arrow-right"></i>
				</a>
			</div>-->
			
			
		<a onclick="return recentview('<?php echo $p['product_id'];?>')" href="<?php  echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>">
        
        <!-- data-ride="carousel"-->
        <div id="ProducCarousel<?php echo $i;?>" class="carousel slide" >
				<!-- The slideshow -->
				<div class="carousel-inner">
                
        
          <?php if($p['img_names']!='') {
			    $imgs=explode("|",	$p['img_names']);
				$ind=0;
				$im=0;
				
				if(count($imgs)>0) {
					foreach($imgs as $i ) {?>
                    <div class="carousel-item <?php echo ($im == 0) ? 'active' : '';?>">
					<img src="<?php echo BASE_URL;?>uploads/productassest/<?php echo $p['product_id']; ?>/photos/base/<?php echo $i; ?>" class="fade-in" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" />
					</div>
                    
          
          <?php $im++;}
		  }else{?>
       <div class="carousel-item active">   <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="fade-in" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></div>
          <?php }?>
          <?php } else {?>
<div class="carousel-item active">          <img src="<?php echo BASE_URL;?>uploads/noimage/photos/base/noimage.png" class="fade-in" title="<?php echo $p['product_name']; ?>" alt="<?php echo $p['product_name']; ?>" /></div>
          <?php }?>
          </div>
          
          <!-- Left and right controls -->
          <?php if(count($imgs)>0) {?>
				<!--<a class="carousel-control-prev" href="#ProducCarousel<?php echo $i;?>" data-slide="prev">
					<i class="lni lni-arrow-left"><?php //echo "k".count($imgs);?></i>
				</a>
				<a class="carousel-control-next" href="#ProducCarousel<?php echo $i;?>" data-slide="next">
					<i class="lni lni-arrow-right"></i>
				</a>-->
                
                <?php }?></div>
          </a>
          <?php
								  if(count($productfilter)>0 && $productfilter[0]['attributeid']!=''){ ?>
          <div class="productcolor-details innper" id="divcustomattr" style="display:none">
            <form class="frmcustomattr_<?php echo $p['product_id']; ?>" id="frmcustomattr_<?php echo $p['product_url']; ?>" >
            
              <?php 
						 
								 $strattrHTML='';
								 $arrattr=array();
								 $cntind=1;
								 $prevtype='';
							 
								 
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
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
													$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio"  '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
																		<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div> -->
																			'; 
																			
														$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
														 	
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.' id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
																	</label>								  
																 </div>';
														 $cntind++;
													 }
													 else {
														  if($prevtype==0)
															 $strattrHTML.='</select>';
														  if(count($arrattr)!=0)
															 $strattrHTML.='</div>';
														 
														 $strattrHTML.='<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			'; 
													$clssel='';
													  $chekradio='';
														if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1)
														{
														   $clssel=' active ';
														    $chekradio=' checked="checked" ';
														}
															
														$strattrHTML.='<div class="radio-inline color-single  '.$clssel.'" onclick="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',\''.$f['dropdown_id'].'\',\''.$p['product_url'].'\');">
																	<input type="radio" '.$chekradio.'  id="color_'.$f['dropdown_id'].'" name="iconatt_'.$f['attributeid'].'" value="'.$f['dropdown_id'].'">
																	<label for="color1" class="color-label">
																		<img  title="'.$f['dropdown_values'].'" src="'.BASE_URL.'uploads/attributes/thumbnails/'.$f['dropdown_images'].'" class="color-img img-responsive" alt="" />
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
													 if(in_array($f['dropdown_id'],$did) || $f['isDefault'] == 1){
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
														if(in_array($f['dropdown_id'],$did)|| $f['isDefault'] == 1){
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
														 $strattrHTML.='<div class="col-md-12">
																		<!--<div class="littit">
																				'.$f['attributename'].'
																			</div>-->
																			<select class="select2 form-control" name="selattr_'.$f['attributeid'].'" onchange="prodattrchange_list(\''.$f['attributeid'].'\',\''.$fsku.'\',this.value,\''.$p['product_url'].'\');">
																			<option value="">select..</option>
																			'; 
														 	
														 $clssel='';
														if(in_array($f['dropdown_id'],$did)|| $f['isDefault'] == 1){
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
          <?php } ?>
          <input id="prices1_<?php echo $p['product_id'];?>" name="prices1_<?php echo $p['product_id'];?>" type="hidden" class="form-control ng-pristine ng-valid ng-not-empty ng-valid-maxlength ng-touched" placeholder="1" maxlength="5" value="1" style="">
          <p class="product-name"><a onclick="return recentview('<?php echo $p['product_id'];?>')" href="<?php  echo $helper->pathrevise($arrpath).'/'.$p['product_url']; ?>"><?php echo $p['product_name']; ?></a></p>
          <?php if($p['totpent']>0): ?>
          <p class="offerspan"><?php echo $p['totpent']; ?>%</p>
          <?php ENDIF; ?>
          <p class="product-price">
            <?php if($p['final_price']>0): ?>
            <?php if($p['totpent']>0): ?>
          <span class="price-strip"><i class="fa fa-inr"></i> <?php echo number_format(round($p['final_orgprice']),2);  ?></span>  <i class="fa fa-inr"></i> <?php echo  number_format(round($p['final_price_tax']),2); ?> 
            <?php ELSE : ?>
          <i class="fa fa-inr"></i> <?php echo number_format(round($p['final_price_tax']),2);  ?>
            <?php ENDIF; ?>
            <?php ELSE : ?>
            --
            <?php ENDIF; ?>
          </p>
          <?php if($catcode != 'corporate-gifts'){?>
          <div class="row no-gutters">
            <div class="col-6"> <a href="javascript:void(0);" class="common-btn"  onclick="buynow('<?php echo $p['product_id'];?>');" > Buy Now </a> </div>
            <div class="col-6"> <a href="javascript:void(0);" id="btnaddtocart"  onclick="addtocart('<?php echo $p['product_id'];?>');" class="common-btn white-btn <?php echo $clsdisable; ?>"> Add to cart </a> </div>
          </div>
          <?php }?>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
</section>
<div class="productpagenation">
  <ul>
    <?php 
			
			if(!empty($productscount)){
				$totpage=ceil($productscount / $helper->getStoreConfigvalue('productsPerpage'));
				
			}		
		//	$totpage=10;
		
				for($i=1;$i<=$totpage;$i++)
				{ 
			      $additionfilter='';
				  if(isset($searchkey) && $searchkey!='')
				  {
					  $additionfilter.='/'.$searchkey;
				  }
			?>
    <li <?php echo $page==($i-1)?'class="next-posts"':'' ?>  ><a href="<?php echo BASE_URL; ?>ajax/products/<?php echo $catid; ?>/<?php echo $i; ?><?php echo $additionfilter; ?>"><?php echo $i; ?></a></li>
    <?php		
				 }
				?>
  </ul>
</div>
<?php } else { ?>
<section class="filter mt-3 pb-5">
  <div class="container">
  <div class="row">
	<div class="col">
		<div class="text-center alert alert-danger">No product Found</</div>
	</div>
  </div>
   </div>
</section>
<?php } ?>


<script src="<?php echo BASE_URL; ?>static/js/jquery.min.js"></script> 
<script src="<?php echo BASE_URL; ?>static/js/jquery-ias.min.js"></script> 
<script>
	var ias;
</script>
<script type="text/javascript">
$(document).ready(function() {
	ias=jQuery.ias({
	    container : '.prolistviewcontainer',
	    item: '.prd-singles',
	    pagination: '.productpagenation',
	    next: '.next-posts a',
	    loader: 'Loadmore...',	   
	});
	
	ias.extension(new IASSpinnerExtension());
    ias.extension(new IASTriggerExtension({offset: 125}));
 // ias.extension(new IASNoneLeftExtension({text: 'Loading... '}));	
});
</script> 
